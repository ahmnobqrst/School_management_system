<?php

namespace App\Http\Controllers\parents;

use App\Http\Controllers\Controller;
use App\Http\Requests\FeesRequest;
use App\Models\{StudentQuizResult, Attendence, Fee_inovice, Reciept, Student, Quiz, Question, Fee, Payment, StudentAccount};
use App\Traits\ZoomTraitIntegration;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
// use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Stripe\Stripe;
use Stripe\Checkout\Session;

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
        $paid = StudentAccount::where('student_id', $studentId)->sum('Debit');
        $remaining = $totalFees - $paid;
        return view('Dashboard.parents.fees.index', compact('fees', 'student', 'totalFees', 'paid', 'remaining'));
    }

    public function form_create($studentId)
    {
        $student = $this->get_childern_data($studentId);
        $fees = Fee::where('classroom_id', $student->classroom_id)->where('grade_id', $student->grade_id)->get();
        return view('Dashboard.parents.fees.create', compact('student', 'fees'));
    }

    public function makeStripePayment(Request $request, $studentId)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'fee_id' => 'required|exists:fees,id',
        ]);

        session()->put('payment_data', [
            'amount' => $request->amount,
            'student_id' => $studentId,
            'fee_id' => $request->fee_id,
        ]);

        Stripe::setApiKey(config('services.stripe.secret'));

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => 'Student Fees',
                    ],
                    'unit_amount' => $request->amount * 100,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('stripe.success', $studentId),
            'cancel_url' => route('parent.pay.form', $studentId),
        ]);

        return redirect($session->url);
    }


    public function stripeSuccess($studentId)
    {
        if (!session()->has('payment_data')) {
            return redirect()->route('get.son.fees', $studentId);
        }

        $data = session('payment_data');

        return $this->saveToDatabase(
            $studentId,
            $data['amount'],
            $data['fee_id']
        );
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
                'description' => 'Stripe Payment',
            ]);

            StudentAccount::create([
                'date' => now(),
                'type' => 'payment',
                'student_id' => $studentId,
                'fee_invoice_id' => $invoice->id,
                'Debit' => $amount,
                'credit' => 0.00,
                'desc' => 'Stripe Payment',
            ]);

            DB::commit();
            session()->forget('payment_data');

            return redirect()->route('get.son.fees', $studentId)
                ->with('success', 'Payment completed successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function stripeWebhook(Request $request)
    {
        $payload = $request->getContent();
        $sig = $request->header('Stripe-Signature');

        try {
            $event = \Stripe\Webhook::constructEvent(
                $payload,
                $sig,
                config('services.stripe.webhook_secret')
            );
        } catch (\Exception $e) {
            return response('Invalid', 400);
        }

        if ($event->type == 'payment_intent.succeeded') {
            // تقدر تحدث الحالة أو تسجل العملية
        }

        return response('OK', 200);
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
