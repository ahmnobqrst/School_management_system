<?php

namespace App\Repository;
use App\Models\Student;
use App\Models\Promotion;
use App\Models\Grade;
use App\Models\Section;
use App\Models\Classroom;
use App\Models\Reciept;
use App\Models\foundAccount;
use App\Models\StudentAccount;
use App\Interface\RecieptRepositoryInterface;
use Hash;
use DB;

class RecieptRepository implements RecieptRepositoryInterface
{

    public function index()
    {
        $reciepts = Reciept::all();
        return view('Dashboard.reciept.index',compact('reciepts'));
    }

    public function show($id)
    {
        $student = Student::findOrFail($id);
        return view('Dashboard.reciept.create',compact('student'));
    }

    public function edit($id)
    {
        $reciept = Reciept::findOrFail($id);
        return view('Dashboard.reciept.edit',compact('reciept'));
    }

    public function store($request)
    {
       
        DB::beginTransaction();

        try {

            $reciept = new Reciept();
            $reciept->date = date('Y-m-d');
            $reciept->student_id = $request->student_id;
            $reciept->Debit = $request->Debit;
            $reciept->description = ['ar'=>$request->description_ar,'en'=>$request->description_en];
            $reciept->save();

            $found_account = new foundAccount();
            $found_account->date = date('Y-m-d');
            $found_account->receipt_id = $reciept->id;
            $found_account->Debit = $request->Debit;
            $found_account->credit = 00.0;
            $found_account->description = ['ar'=>$request->description_ar,'en'=>$request->description_en];
            $found_account->save();

            

            StudentAccount::create([
                'date' => date('Y-m-d'),
                'type' => 'reciept',
                'student_id' => $request->student_id,
                'receipt_id' => $reciept->id,
                'debit' => 0.0,
                'credit' => $request->Debit,
                'desc' => ['ar' => $request->description_ar, 'en' => $request->description_en],
            ]);

            DB::commit();
            return redirect()->route('reciept.index');
            toastr()->success(trans('Students_trans.Reciept are saved'));
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

            $reciept = Reciept::findOrFail($request->id);
            $reciept->date = date('Y-m-d');
            $reciept->student_id = $request->student_id;
            $reciept->Debit = $request->Debit;
            $reciept->description = ['ar'=>$request->description_ar,'en'=>$request->description_en];
            $reciept->save();

            $found_account = foundAccount::where('receipt_id',$reciept->id)->first();
            $found_account->date = date('Y-m-d');
            $found_account->receipt_id = $reciept->id;
            $found_account->Debit = $request->Debit;
            $found_account->credit = 00.0;
            $found_account->description = ['ar'=>$request->description_ar,'en'=>$request->description_en];
            $found_account->save();

            $student_account = StudentAccount::where('receipt_id',$reciept->id)->first();
            $student_account->date = date('Y-m-d');
            $student_account->type = 'reciept';
            $student_account->student_id = $request->student_id;
            $student_account->receipt_id = $reciept->id;
            $student_account->debit = 00.0;
            $student_account->credit = $request->Debit;
            $student_account->desc = ['ar'=>$request->description_ar,'en'=>$request->description_en];
            $student_account->save();

            
            DB::commit();
            toastr()->success(trans('Students_trans.Reciept are updated'));
            return redirect()->route('reciept.index');  
        }       
        catch (\Exception $e) {
            DB::rollback();
            dd($e->getMessage()); // يعرض الخطأ مباشرةً على الشاشة لمساعدتك في التحقق من السبب
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
     

    }

    public function delete($request)
    {
      
      try {
        Reciept::where('id',$request->id)->delete();
        FoundAccount::where('receipt_id',$request->id)->delete();
        StudentAccount::where('receipt_id',$request->id)->delete();
  
        toastr()->error(trans('Students_trans.Reciept are deleted'));
        return redirect()->route('reciept.index');  
     
     }       
        catch (\Exception $e) {
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
     }
    }
       
      


}
    
