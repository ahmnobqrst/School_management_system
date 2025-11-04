<?php
namespace App\Repository;

use App\Interface\TeacherRepositoryInterface;
use App\Models\BloodType;
use App\Models\Gender;
use App\Models\National;
use App\Models\Specialist;
use App\Models\{Teacher,Grade};
use Illuminate\Support\Facades\Hash;

class TeacherRepository implements TeacherRepositoryInterface
{
    public function getTeachersData()
    {
        return Teacher::paginate(10);
    }

    public function getSpecializations()
    {
        return Specialist::all();
    }

    public function getGenders()
    {
        return Gender::all();
    }
    public function getNationality()
    {
        return National::all();
    }
    public function getBloodType()
    {
        return BloodType::all();
    }
    public function getGrades()
    {
        return Grade::all();
    }

    public function StoreTeachers($request)
    {

        try {

            $teachers                        = new Teacher;
            $teachers->email                 = $request->email;
            $teachers->password              = Hash::make($request->password);
            $teachers->name                  = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $teachers->address               = ['en' => $request->address_en, 'ar' => $request->address_ar];
            $teachers->age                   = $request->age;
            $teachers->phone                 = $request->phone;
            $teachers->date_of_job           = $request->date_of_job;
            $teachers->specialist_id         = $request->specialist_id;
            $teachers->gender_id             = $request->gender_id;
            $teachers->blood_type_teacher_id = $request->blood_type_teacher_id;
            $teachers->national_teacher_id   = $request->national_teacher_id;
            $teachers->grade_id = $request->grade_id;
            $teachers->save();

            toastr()->success(trans('teacher_trans.Added'));

            return redirect()->route('teachers.index');

        } catch (\Exception $e) {
            $this->catchError = $e->getMessage();
        }
    }

    public function EditTeacher($id)
    {
        return Teacher::findOrFail($id);
    }

    public function UpdateTeacher($request)
    {

        try {

            $teachers                        = Teacher::findOrFail($request->id);
            $teachers->name                  = ['ar' => $request->name_ar, 'en' => $request->name_en];
            $teachers->address               = ['ar' => $request->address_ar, 'en' => $request->address_en];
            $teachers->email                 = $request->email;
            $teachers->password              = Hash::make($request->password);
            $teachers->age                   = $request->age;
            $teachers->phone                 = $request->phone;
            $teachers->date_of_job           = $request->date_of_job;
            $teachers->gender_id             = $request->gender_id;
            $teachers->specialist_id         = $request->specialist_id;
            $teachers->blood_type_teacher_id = $request->blood_type_teacher_id;
            $teachers->national_teacher_id   = $request->national_teacher_id;
            $teachers->grade_id = $request->grade_id;

            $teachers->save();
            toastr()->success(trans('teacher_trans.the data are update'));

            return redirect()->route('teachers.index');

        } catch (\Exception $e) {
            $this->catchError = $e->getMessage();
        }
    }

    public function DeleteTeacher($request)
    {

        Teacher::findOrFail($request->id)->delete();
        toastr()->error(trans('teacher_trans.Delete_Data'));

        return redirect()->route('teachers.index');
    }
}
