<?php

namespace App\Repository;
use App\Models\Fee;
use App\Models\Grade;
use App\Models\ProceesingFee;
use App\Models\StudentAccount;
use App\Models\Student;
use App\Interface\processingFeeRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class processingFeeRepository implements processingFeeRepositoryInterface
{

    public function index()
    {
        $ProcessingFees = ProceesingFee::all();
        return view('Dashboard.processingfee.index',compact('ProcessingFees'));
    }

    public function show($id)
    {
       $student = Student::findOrFail($id);
       return view('Dashboard.processingfee.create',compact('student'));
    }

    public function store($request)
    {
        
        DB::beginTransaction();

        try {

            $ProcessingFees = new ProceesingFee();
            $ProcessingFees->date = date('Y-m-d');
            $ProcessingFees->student_id = $request->student_id;
            $ProcessingFees->amount = $request->amount;
            $ProcessingFees->description = ['ar'=>$request->description_ar,'en'=>$request->description_en];
            $ProcessingFees->save();

            StudentAccount::create([
                'date' => date('Y-m-d'),
                'type' => 'ProcessingFees',
                'student_id' => $request->student_id,
                'process_id' => $ProcessingFees->id,
                'debit' => 0.0,
                'credit' => $request->amount,
                'desc' => ['ar' => $request->description_ar, 'en' => $request->description_en],
            ]);

            DB::commit();
            return redirect()->route('processingfee.index');
            toastr()->success(trans('Students_trans.processingFees are saved'));
        }       
        catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
       $ProcessingFee = ProceesingFee::findOrFail($id);
       return view('Dashboard.processingfee.edit',compact('ProcessingFee'));
    }

    public function update($request)
    {
         
        DB::beginTransaction();

        try {

            $ProcessingFees = ProceesingFee::findOrFail($request->id);
            $ProcessingFees->date = date('Y-m-d');
            $ProcessingFees->student_id = $request->student_id;
            $ProcessingFees->amount = $request->amount;
            $ProcessingFees->description = ['ar'=>$request->description_ar,'en'=>$request->description_en];
            $ProcessingFees->save();

            $student_account = StudentAccount::where('process_id',$ProcessingFees->id)->first();
            $student_account->date = date('Y-m-d');
            $student_account->type = 'ProcessingFees';
            $student_account->student_id = $request->student_id;
            $student_account->process_id = $ProcessingFees->id;
            $student_account->debit = 00.0;
            $student_account->credit = $request->Debit;
            $student_account->desc = ['ar'=>$request->description_ar,'en'=>$request->description_en];
            $student_account->save();

            DB::commit();
            return redirect()->route('processingfee.index');
            toastr()->success(trans('Students_trans.processingFees are updated'));
        }       
        catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
       
    }

    public function destroy($request)
    {
        ProceesingFee::destroy($request->id);
        StudentAccount::where('process_id',$request->id)->delete();
        return redirect()->route('processingfee.index');
        toastr()->error(trans('Students_trans.processingFees are deleted'));
        
    }
}