<?php

namespace App\Repository;
use App\Models\Fee;
use App\Models\Grade;
use App\Models\Student;
use App\Models\Classroom;
use App\Models\Fee_inovice;
use App\Models\StudentAccount;
use App\Interface\FeeinvoiceRepositoryInterface;
use Illuminate\Support\Facades\DB;

class FeeinvoiceRepository implements FeeinvoiceRepositoryInterface
{

    public function show($id)
    {
       $student = Student::findOrFail($id);
       $fees = Fee::where('classroom_id',$student->classroom_id)->get();
       return view('Dashboard.fee_invoice.add',compact('student','fees'));
    }

    public function store($request)
    {
        $List_Fees = $request->List_Fees;

        DB::beginTransaction();

        try {

            foreach ($List_Fees as $List_Fee) {
                
                $Fees = new Fee_inovice();
                $Fees->invoice_date = date('Y-m-d');
                $Fees->student_id = $List_Fee['student_id'];
                $Fees->grade_id = $request->grade_id;
                $Fees->classroom_id = $request->classroom_id;;
                $Fees->fee_id = $List_Fee['fee_id'];
                $Fees->amount = $List_Fee['amount'];
                $Fees->description = ['ar'=>$List_Fee['desc_ar'],'en'=>$List_Fee['desc_en']];
                $Fees->save();

                
                $StudentAccount = new StudentAccount();
                $StudentAccount->student_id = $List_Fee['student_id'];
                $StudentAccount->type = 'invoice';
                $StudentAccount->date = date('Y-m-d');
                $StudentAccount->fee_invoice_id = $Fees->id;
                $StudentAccount->debit = $List_Fee['amount'];
                $StudentAccount->credit = 0.00;
                $StudentAccount->desc = ['ar'=>$List_Fee['desc_ar'],'en'=>$List_Fee['desc_en']];
                $StudentAccount->save();

               
            }

            DB::commit();
            
            toastr()->success(trans('fee_trans.the fee are added successfully'));
            return redirect()->route('feeinvoices.index');
        } 
        catch (\Exception $e) 
        {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function index()
    {
        $fees = Fee_inovice::paginate(10);
        $grades = Grade::all();
        return view('Dashboard.fee_invoice.index',compact('fees','grades'));
    }

    public function edit($id)
    {
        $fee_invoices = Fee_inovice::findOrFail($id);
        $fees = Fee::where('classroom_id',$fee_invoices->classroom_id)->get();
        return view('Dashboard.fee_invoice.edit',compact('fee_invoices','fees'));

    }

    public function update($request)
    {
        DB::beginTransaction();

        try {
                
                $Fees = Fee_inovice::findOrFail($request->id);
                $Fees->invoice_date = date('Y-m-d');
                $Fees->fee_id = $request->fee_id;
                $Fees->amount = $request->amount;
                $Fees->description = ['ar'=>$request->desc_ar,'en'=>$request->desc_en];
                $Fees->save();

                $StudentAccount = StudentAccount::where('fee_invoice_id',$request->id)->first();
                $StudentAccount->debit = $request->amount;
                $StudentAccount->credit = 0.00;
                $StudentAccount->desc = ['ar'=>$request->desc_ar,'en'=>$request->desc_en];
                $StudentAccount->save();

               
            

            DB::commit();
            
            toastr()->success(trans('fee_trans.the fee are added successfully'));
            return redirect()->route('feeinvoices.index');
        } 
        catch (\Exception $e) 
        {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
       
    }

    public function delete($request)
    {
        Fee_inovice::where('id',$request->id)->delete();
        StudentAccount::where('fee_invoice_id',$request->id)->delete();
        toastr()->error(trans('fee_trans.Deleted'));
        return redirect()->route('feeinvoices.index');


    }

}