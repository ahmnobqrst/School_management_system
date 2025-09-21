<?php

namespace App\Repository;
use App\Models\Student;
use App\Models\Promotion;
use App\Models\Grade;
use App\Models\Section;
use App\Models\Classroom;
use App\Interface\PromotionRepositoeyInterface;
use Hash;
use DB;

class PromotionRepository implements PromotionRepositoeyInterface
{

    public function getPromotions()
    {
      $Grades = Grade::all();
      return view('Dashboard.promotion.index',compact('Grades'));
    }

    public function store($request)
    {
      DB::beginTransaction();

      try {

          $students = student::where('grade_id',$request->grade_id)->where('classroom_id',   $request->classroom_id)->where('section_id',$request->section_id)->
          where('academic_year',$request->academic_year)->get();

          if($students->count() < 1){
              return redirect()->back()->with(['error_promotions'=> __('there is no data')]);
          }

          // update in table student
          foreach ($students as $student){

              $ids = explode(',',$student->id);
              student::whereIn('id', $ids)
                  ->update([
                      'Grade_id'=>$request->Grade_id_new,
                      'Classroom_id'=>$request->Classroom_id_new,
                      'section_id'=>$request->section_id_new,
                      'academic_year'=>$request->academic_year_new,
                  ]);

                  Promotion::updateOrCreate([
                    'student_id'=>$student->id,
                    'from_grade'=>$request->grade_id,
                    'from_classroom'=>$request->classroom_id,
                    'from_section'=>$request->section_id,
                    'to_grade'=>$request->Grade_id_new,
                    'to_classroom'=>$request->Classroom_id_new,
                    'to_section'=>$request->section_id_new,
                    'academic_year'=>$request->academic_year,
                    'academic_year_new'=>$request->academic_year_new
                ]);
          }
          DB::commit();
          toastr()->success(trans('Students_trans.the promotion of student are updated'));
          return redirect()->route('students.index');

      } catch (\Exception $e) {
          DB::rollback();
          return redirect()->back()->withErrors(['error' => $e->getMessage()]);
      }

    }

    public function edit($id)
    {
       $data['grades'] = Grade::all();
       $data['classrooms'] = Classroom::all();
       $data['sections'] = Section::all();
       $data['students'] = Student::all();

       $promotion = Promotion::findOrFail($id);


       return view('Dashboard.promotion.edit_promotion',$data,compact('promotion'));
    }

    public function destroy($request)
    {

               DB::beginTransaction();

               try {
       
                   $promotion = explode(',',$request->Rollback_All_id);
     
                   $promotions = Promotion::whereIn('id',$promotion)->get();
                  
                  foreach($promotions as $prom){
                      $ids = explode(',',$prom->student_id);
                      student::whereIn('id', $ids)
                               ->update([
                               'grade_id'=>$prom->from_grade,
                               'classroom_id'=>$prom->from_classroom,
                               'section_id'=> $prom->from_section,
                               'academic_year'=>$prom->academic_year,
                             ]);

                      Promotion::where('id',$prom->id)->delete();
       
                    }
                       DB::commit();
                       toastr()->error(trans('Students_trans.Rollabacked'));
                       return redirect()->back();
       
       
                   
       
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

             Promotion::where('student_id',$request->student_id)->delete();
             Student::where('id',$request->student_id)->delete();


           
                DB::commit();
                toastr()->success(trans('Students_trans.the student are Graduated'));
                return redirect()->route('graduates.index');


            

        }       
        catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
       
      


    }
    
    
       
       
      


    
    }
    
