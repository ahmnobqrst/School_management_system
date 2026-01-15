<?php

namespace App\Http\Controllers\parents;

use App\Http\Controllers\Controller;
use App\Http\Requests\FeesRequest;
use App\Models\{StudentQuizResult, Attendence, Fee_inovice, Reciept, Student, Quiz, Question, Fee, Payment, StudentAccount};
use App\Traits\ZoomTraitIntegration;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ParentController extends Controller
{
    use ZoomTraitIntegration;

    public function get_all_students()
    {
        $students = $this->get_childerns_data();
        return view('Dashboard.parents.childerns.childerns', compact('students'));
    }

    public function show($studentId)
    {
        $student = $this->get_childern_data($studentId);
        if ($student->parent_id == auth()->user()->id) {
            return view('Dashboard.parents.childerns.all_data_of_childern', compact('student'));
        } else {
            toastr()->error(__('Students_trans.sorry_cant_access'));
            return redirect()->route('get.all.childern');
        }
    }

    //================================================= Student Quiz And Result For Parent ==================================================//

    public function get_student_quiz($studentId)
    {
        $student = $this->get_childern_data($studentId);
        if ($student->parent_id == auth()->user()->id) {
            $quizzes = Quiz::where('classroom_id', $student->classroom->id)->where('section_id', $student->Section->id)->paginate(8);
            return view('Dashboard.parents.childerns.exams', compact('student', 'quizzes'));
        } else {
            toastr()->error(__('Students_trans.sorry_cant_access'));
            return redirect()->route('get.all.childern');
        }
    }


    public function get_student_result($studentId, $quizId)
    {
        $student = $this->get_childern_data($studentId);
        if ($student->parent_id == auth()->user()->id) {
            $questions = Question::where('quiz_id', $quizId)->get();
            $totalScore = StudentQuizResult::where('quiz_id', $quizId)->where('student_id', $studentId)->first();
            return view('Dashboard.parents.childerns.report_result', compact('questions', 'totalScore'));
        } else {
            toastr()->error(__('Students_trans.sorry_cant_access'));
            return redirect()->route('get.all.childern');
        }
    }

    //================================================= Student Fees For Parent ==================================================//

    public function get_student_fees($studentId)
    {
        $student = $this->get_childern_data($studentId);
        $fees = Fee::where('classroom_id', $student->classroom->id)->where('grade_id', $student->grade->id)->get();
        $totalFees = $fees->sum('amount');
        $paid = Reciept::where('student_id', $studentId)->sum('Debit');
        $remaining = $totalFees - $paid;
        return view('Dashboard.parents.fees.index', compact('fees', 'student', 'totalFees', 'paid', 'remaining'));
    }

    public function form_create($studentId)
    {
        $student = $this->get_childern_data($studentId);
        $fees = Fee::where('classroom_id', $student->classroom_id)->where('grade_id', $student->grade_id)->get();
        return view('Dashboard.parents.fees.create', compact('student', 'fees'));
    }

    // public function store(Request $request, $studentId)
    // {
    //     try {
    //         $student = $this->get_childern_data($studentId);
    //         Fee::create([
    //             'name' => ['ar' => $request->name_ar, 'en' => $request->name_en],
    //             'desc' => ['ar' => $request->desc_ar, 'en' => $request->desc_en],
    //             'amount' => $request->amount,
    //             'fee_type' => $request->fee_type,
    //             'year' => $request->year,
    //             'grade_id' => $student->grade->id,
    //             'classroom_id' => $student->classroom->id,
    //         ]);

    //         toastr()->success(trans('fee_trans.the fee are added successfully'));
    //         return redirect()->route('get.son.fees', $student->id);
    //     } catch (\Exception $e) {
    //         return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    //     }
    // // }

    public function makePayment(Request $request, $studentId)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'fee_id' => 'required|integer|exists:fees,id',
        ]);

        // $egpAmount = $request->amount;
        // $usdAmount = $egpAmount / 48;

        session()->put('payment_data', [
            'amount' => $request->amount,
            'student_id' => $studentId,
            'fee_id' => $request->fee_id,
        ]);
        
        
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();

        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('payment.success', $studentId),
                "cancel_url" => route('payment.cancel'),
            ],
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => number_format($request->amount, 2, '.', '')
                    ],
                    "description" => "StudentFees-$studentId"
                ]
            ]
        ]);

        foreach ($response['links'] ?? [] as $link) {
            if ($link['rel'] === 'approve') {
                return redirect()->away($link['href']);
            }
        }

        return back()->withErrors(['error' => 'PayPal order failed']);
    }

    public function paymentSuccess(Request $request, $studentId)
    {
        if (!session()->has('payment_data')) {
            return redirect()->route('get.son.fees', $studentId);
        }

        $paymentData = session('payment_data');

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();

        $response = $provider->capturePaymentOrder($request->token);

        if (($response['status'] ?? '') === 'COMPLETED') {
            $amount = $response['purchase_units'][0]['payments']['captures'][0]['amount']['value'];
            $fee_id = $paymentData['fee_id'];

            return $this->saveToDatabase($studentId, $amount, $fee_id);
        }

        dd($response['error']['details'] ?? $response);

        return back()->withErrors(['error' => 'Payment not completed']);
    }

    protected function saveToDatabase($studentId, $amount, $fee_id)
    {
        DB::beginTransaction();

        try {
            $student = Student::findOrFail($studentId);
            $invoice = Fee_inovice::create([
                'invoice_date' => now(),
                'student_id' => $studentId,
                'grade_id' => $student->grade_id,
                'classroom_id' => $student->classroom_id,
                'fee_id' => $fee_id,
                'amount' => $amount,
                'description' => 'PayPal Payment',
            ]);

            StudentAccount::create([
                'date' => now(),
                'type' => 'payment',
                'student_id' => $studentId,
                'fee_invoice_id' => $invoice->id,
                'credit' => $amount,
                'desc' => 'PayPal Payment',
            ]);

            DB::commit();
            session()->forget('payment_data');

            return redirect()->route('get.son.fees', $studentId)
                ->with('success', 'Payment completed');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function paymentCancel()
    {
        return back()->withErrors(['error' => 'Payment cancelled']);
    }
    //================================================= Student Appearence For Parent ==================================================//

    public function get_childern_appearence()
    {
        $students = $this->get_childerns_data();
        return view('Dashboard.parents.childerns.appearence.index', compact('students'));
    }

    public function student_attendence(Request $request, $studentId)
    {
        $student = $this->get_childern_data($studentId);
        $month = $request->input('month', now()->month);
        $year = $request->input('year', now()->year);
        $selectedDate = Carbon::createFromDate($year, $month, 1);
        $attendanceRecords = Attendence::where('student_id', $student->id)
            ->whereYear('attendence_date', $year)
            ->whereMonth('attendence_date', $month)
            ->orderBy('attendence_date', 'desc')
            ->paginate(10);

        $availableMonths = [];
        $startDate = Carbon::create(2026, 1, 1);
        $endDate = Carbon::create(2026, 12, 31);

        $current = $startDate->copy();
        while ($current->lte($endDate)) {
            $availableMonths[] = [
                'month' => $current->month,
                'year' => $current->year,
                'label' => $current->format('Y-m')
            ];
            $current->addMonth();
        }

        $totalAppearneceInMonth = Attendence::where('student_id', $student->id)
            ->whereYear('attendence_date', $year)
            ->whereMonth('attendence_date', $month)
            ->where('attendence_status', 1)
            ->count();

        $totalAbsentInMonth = Attendence::where('student_id', $student->id)
            ->whereYear('attendence_date', $year)
            ->whereMonth('attendence_date', $month)
            ->where('attendence_status', 0)
            ->count();


        return view('Dashboard.parents.childerns.appearence.report_attendence', compact(
            'attendanceRecords',
            'selectedDate',
            'availableMonths',
            'month',
            'year',
            'totalAppearneceInMonth',
            'totalAbsentInMonth',
            'student'
        ));
    }

    //==================================================== Payment Fees ======================================================//
    public function get_childern_paymentFees()
    {
        $students = $this->get_childerns_data();
        return view('Dashboard.parents.childerns.all_student', compact('students'));
    }

    public function student_payment_create($studentId)
    {
        $student = $this->get_childern_data($studentId);
        return view('Dashboard.parents.fees.create', compact('student'));
    }
}
