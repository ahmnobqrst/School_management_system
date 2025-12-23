<?php 

namespace App\Repository;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Grade;
use App\Models\Classroom;
use App\Models\Gender;
use App\Models\MyParent;
use App\Models\National;
use App\Models\Section;
use App\Models\Specialist;
use App\Models\Religions;
use App\Models\BloodType;
use App\Models\Image;
use App\Traits\studentimagetrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Interface\StudentRepositoryInterface;
use App\Models\Subject;
use Illuminate\Support\Facades\Hash;

class StudentRepository implements StudentRepositoryInterface
{

   use studentimagetrait;

   public function getStudentData()
   {
      
    $data['Genders'] = Gender::all();
    $data['my_classes'] = Classroom::all();
    $data['parents'] = MyParent::all();
    $data['sections'] = Section::all();
    $data['grades'] = Grade::all();
    $data['students'] = Student::paginate(10);

    return view('Dashboard.student.index',$data);

   }

   public function CreateStudent()
   {

    $data['Genders'] = Gender::all();
    $data['nationals'] = National::all();
    $data['bloods'] = BloodType::all();
    $data['parents'] = MyParent::all();
    $data['grades'] = Grade::all();
    $data['subjects'] = Subject::all();


    return view('Dashboard.student.create',$data);

   }

   public function get_classes($id)
   {
      $list_classes = Classroom::where("grade_id", $id)->pluck("name", "id");
        
        return $list_classes;

   }

   public function get_sections($id)
   {
      $sections = Section::where("Class_id", $id)->pluck("section_name", "id");
        
        return $sections;

   }

   public function SaveStudentData($request)
   {
      DB::beginTransaction();
      try {

         $students = new Student();
         $students->name = ['ar'=> $request->name_ar, 'en'=>$request->name_en];
         $students->email = $request->email;
         $students->password = Hash::make($request->password);
         $students->birth_of_date = $request->birth_of_date;
         $students->academic_year = $request->academic_year;
         $students->grade_id = $request->grade_id;
         $students->classroom_id = $request->classroom_id;
         $students->parent_id = $request->parent_id;
         $students->section_id = $request->section_id;
         $students->grade_id = $request->grade_id;
         $students->blood_type_student_id = $request->blood_type_student_id;
         $students->national_student_id = $request->national_student_id;
         $students->gender_id = $request->gender_id;
         $students->save();

         $students->Subjects()->attach($request->subject_id);

         if($request->hasfile('photos')) {
            foreach($request->file('photos') as $file) {
                $name = time().'_'.$file->getClientOriginalName();
                $file->storeAs('attachments/students/'.$students->name, $name, 'upload_attachments');
                $images = new Image();
                $images->filename = $name;
                $images->imageable_id = $students->id;
                $images->imageable_type = Student::class;
                $images->save();
            }
        }
        DB::commit();
 
         toastr()->success(trans('Students_trans.the student are saved'));
         return redirect()->route('students.index');
 
     }
 
     catch (\Exception $e){
      DB::rollback();
         return redirect()->back()->withErrors(['error' => $e->getMessage()]);
     }


   }

   public function EditStudentData($id)
   {
      $data['nationals'] = National::all();
      $data['Genders'] = Gender::all();
      $data['bloods'] = BloodType::all();
      $data['parents'] = MyParent::all();
      $data['grades'] = Grade::all();
      $data['subjects'] = Subject::all();

      $students = Student::with('Subjects')->findOrFail($id);

      return view('Dashboard.student.edit',$data,compact('students'));

   }

   public function UpdateStudentData($request)
   {
      
      try {
         $students = Student::findOrFail($request->id);
         if(!empty($request->password))
         {
            $new_password = Hash::make($request->password);
         }
         else
         {
            $new_password = $students->password;
         }

         $students->name = ['en'=>$request->name_en,'ar'=>$request->name_ar];
         $students->email = $request->email;
         $students->password = $new_password;
         $students->birth_of_date = $request->birth_of_date;
         $students->academic_year = $request->academic_year;
         $students->grade_id = $request->grade_id;
         $students->classroom_id = $request->classroom_id;
         $students->parent_id = $request->parent_id;
         $students->section_id = $request->section_id;
         $students->grade_id = $request->grade_id;
         $students->blood_type_student_id = $request->blood_type_student_id;
         $students->national_student_id = $request->national_student_id;
         $students->gender_id = $request->gender_id;

         $students->save();
         $students->Subjects()->sync($request->subject_id);
         
         toastr()->success(trans('Students_trans.the student are updated'));
         return redirect()->route('students.index');
     }
 
     catch (\Exception $e){
         return redirect()->back()->withErrors(['error' => $e->getMessage()]);
     }

         

   }

   public function DeleteStudentData($request)
   {
      Student::findOrFail($request)->delete();
      toastr()->error(trans('Students_trans.the student are deleted'));
      return redirect()->route('students.index');
      
   }

   public function ShowStudentData($id)
   {
      $Student = Student::findOrFail($id);

      return view('Dashboard.student.All_data_of_student',compact('Student'));

   }

   public function save_new_images($request){
     
         foreach($request->file('photos') as $file) {
             $name = time().'_'.$file->getClientOriginalName();
             $file->storeAs('attachments/students/'.$request->student_name, $name, 'upload_attachments');
             $images = new Image();
             $images->filename = $name;
             $images->imageable_id = $request->student_id;
             $images->imageable_type = Student::class;
             $images->save();
         }
         toastr()->success(trans('Students_trans.the new attachments are added'));
         return redirect()->route('students.show',$request->student_id);

         //return redirect()->back();
    
   }

   public function Delete_attachment($request)
   {
    Storage::disk('upload_attachments')->delete('attachments/students/'.$request->student_name.'/'.$request->filename);
    $image = Image::where('id',$request->id)->where('filename',$request->filename)->delete();
    toastr()->error(trans('Students_trans.the attachment of student are deleted'));
   return redirect()->route('students.show',$request->student_id);

     

   }

   public function Download_attachment($studentname,$filename)
   {
      return response()->download(public_path('upload_attachments/attachments/students/'.$studentname.'/'.$filename));
   }

        
}