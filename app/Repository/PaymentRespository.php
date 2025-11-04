<?php

namespace App\Repository;
use App\Models\Fee;
use App\Models\Payment;
use App\Models\Student;
use App\Models\foundAccount;
use App\Models\StudentAccount;
use App\Interface\PaymentRepositoryInterface;
use Illuminate\Support\Facades\DB;

class PaymentRespository implements PaymentRepositoryInterface
{

    public function index()
    {
        $payment_students = Payment::all();
        return view('Dashboard.payment.index',compact('payment_students'));
       
    }

    public function show($id)
    {
        $student = Student::findOrFail($id);
        return view('Dashboard.payment.add',compact('student'));
    }

    public function store($request)
    {

        DB::beginTransaction();

        try {

            $payment = new Payment();
            $payment->date = date('Y-m-d');
            $payment->student_id = $request->student_id;
            $payment->amont = $request->Debit;
            $payment->description = ['ar'=>$request->description_ar,'en'=>$request->description_en];
            $payment->save();

            $found_account = new foundAccount();
            $found_account->date = date('Y-m-d');
            $found_account->payment_id = $payment->id;
            $found_account->Debit = 0.00;
            $found_account->credit = $request->Debit;
            $found_account->description = ['ar'=>$request->description_ar,'en'=>$request->description_en];
            $found_account->save();

            
            StudentAccount::create([
                'date' => date('Y-m-d'),
                'type' => 'payment',
                'student_id' => $request->student_id,
                'payment_id' => $payment->id,
                'debit' => $request->Debit,
                'credit' => 0.00,
                'desc' => ['ar' => $request->description_ar, 'en' => $request->description_en],
            ]);

            DB::commit();
            return redirect()->route('payments.index');
            toastr()->success(trans('Students_trans.Payment are saved'));
        }       
        catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

        
      
    }
    public function update($request)
    {
        DB::beginTransaction();

        try {

            $payment = Payment::findOrFail($request->id);
            $payment->date = date('Y-m-d');
            $payment->student_id = $request->student_id;
            $payment->amont = $request->Debit;
            $payment->description = ['ar'=>$request->description_ar,'en'=>$request->description_en];
            $payment->save();

            $found_account = foundAccount::where('payment_id',$payment->id)->first();
            $found_account->date = date('Y-m-d');
            $found_account->payment_id = $payment->id;
            $found_account->Debit = 0.00;
            $found_account->credit = $request->Debit;
            $found_account->description = ['ar'=>$request->description_ar,'en'=>$request->description_en];
            $found_account->save();

            $student_account = StudentAccount::where('payment_id',$payment->id)->first();
            $student_account->date = date('Y-m-d');
            $student_account->type = 'payment';
            $student_account->student_id = $request->student_id;
            $student_account->payment_id = $payment->id;
            $student_account->debit = $request->Debit;
            $student_account->credit = 0.00;
            $student_account->desc = ['ar'=>$request->description_ar,'en'=>$request->description_en];
            $student_account->save();

            DB::commit();
            return redirect()->route('payments.index');
            toastr()->success(trans('Students_trans.Payment are updated'));
        }       
        catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
      $payment_student = Payment::findOrFail($id);
      return view('Dashboard.payment.edit',compact('payment_student'));
    }
    public function destroy($request)
    {
      Payment::where('id',$request->id)->delete();
      return redirect()->route('payments.index');
      toastr()->success(trans('Students_trans.Payment are deleted'));

    }
}