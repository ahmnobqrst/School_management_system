<?php

namespace App\Repository;
use App\Models\Fee;
use App\Models\Grade;
use App\Interface\FeesRepositoryInterface;
use Hash;
use DB;

class FeesRepository implements FeesRepositoryInterface
{

    public function index()
    {
        $fees = Fee::all();
        $grades = Grade::all();
        return view('Dashboard.fee.index',compact('fees','grades'));
    }

    public function create()
    {
        $grades = Grade::all();
        return view('Dashboard.fee.create',compact('grades'));
    }

    public function store($request)
    {
        try
        {

         $fees = new Fee();
         $fees->name = ['ar'=> $request->name_ar, 'en'=>$request->name_en];
         $fees->desc = ['ar'=> $request->desc_ar, 'en'=>$request->desc_en];
         $fees->amount = $request->amount;
         $fees->fee_type = $request->fee_type;
         $fees->year = $request->year;
         $fees->grade_id = $request->grade_id;
         $fees->classroom_id = $request->classroom_id;
         $fees->save();

         toastr()->success(trans('fee_trans.the fee are added successfully'));
         return redirect()->route('fees.index');

        }
        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $fee = Fee::findOrFail($id);
        $grades = Grade::all();
        return view('Dashboard.fee.edit',compact('fee','grades'));
    }

    public function update($request)
    {
         $fees = Fee::findOrFail($request->id);

         $fees->name = ['ar'=> $request->name_ar, 'en'=>$request->name_en];
         $fees->desc = ['ar'=> $request->desc_ar, 'en'=>$request->desc_en];
         $fees->amount = $request->amount;
         $fees->year = $request->year;
         $fees->grade_id = $request->grade_id;
         $fees->classroom_id = $request->classroom_id;
         $fees->save();

         toastr()->success(trans('fee_trans.the Fee are updated'));
         return redirect()->route('fees.index');

       
    }

    public function Delete($request)
    {
       Fee::where('id',$request->id)->delete();
       toastr()->error(trans('fee_trans.Deleted'));
       return redirect()->back();
    }
}