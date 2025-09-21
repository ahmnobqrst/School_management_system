<?php 

namespace App\Repository;
use App\Models\Grade;
use App\Models\Student;
use App\Models\Promotion;
use App\Interface\StudentGraduatedInterface;

class StudentGraduatedRepository implements StudentGraduatedInterface
{

    public function index()
    {
       $students = Student::onlyTrashed()->get();
       $promotions = Promotion::onlyTrashed()->get();
       return view('Dashboard.graduate.index',compact('students','promotions'));
    }

    public function create()
    {
        $Grades = Grade::all();
        return view('Dashboard.graduate.create',compact('Grades'));
    }

    public function store($request)
    {
        $students = Student::where('grade_id',$request->grade_id)->where('classroom_id',   $request->classroom_id)->where('section_id',$request->section_id)->get();
      
        if(empty($students->count())){
            return redirect()->back()->with(['error_promotions'=> __('Students_trans.there is no data')]);
        }
        
        foreach($students as $student){
            $ids = explode(',',$student->id);
            Student::whereIn('id',$ids)->delete();  // علشان احذفهم من جدول الطلاب العادي 
        }

        toastr()->success(trans('Students_trans.the graduated of student are updated'));
        return redirect()->route('graduates.index');
    }

    public function update($request)
    {
      
         

        $student =  Student::onlyTrashed()->where('id',$request->id)->first()->restore();
        
        Promotion::where('student_id',$student)->restore();

        toastr()->error(trans('Students_trans.Rollabacked'));
        return redirect()->back();
    }

    public function destroy($request)
    {
        $student = Student::onlyTrashed()->where('id',$request->id)->first()->forceDelete();
        Promotion::where('student_id',$student)->forceDelete();

        toastr()->error(trans('Students_trans.the student are deleted'));
        return redirect()->route('graduates.index');

        

    }
        
}