<?php

namespace App\Http\Controllers\Teacher\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Models\MyParent;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\{AuthLogin, studentimagetrait};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use function PHPUnit\Framework\isEmpty;

class ProfileController extends Controller
{
    use AuthLogin, studentimagetrait;
    public function get_profile_data()
    {
        $teacher =  Teacher::findOrFail(auth()->user()->id);
        return view('Dashboard.teacher.profile', compact('teacher'));
    }

    public function update_profile(ProfileRequest $request, $teacherId)
    {

        $teacher = Teacher::findOrFail($teacherId);
        if ($request->filled('password')) {
            $newPassword = Hash::make($request->password);
        } else {
            $newPassword = $teacher->password;
        }

        if ($request->hasFile('image')) {
            $this->delete_file($teacher->image);
            $image = $this->uploadImageimage($request->image, 'Teachers/images');
        } else {
            $image = $teacher->image;
        }

        $teacher->update([
            'name'     => ['ar' => $request->name_ar, 'en' => $request->name_en],
            'image'    => $image,
            'password' => $newPassword,
        ]);

        return redirect()->back()->with(['success' => __('Students_trans.profile_updated')]);
    }

    public function get_profile_data_for_admin()
    {
        $admin =  User::findOrFail(auth()->user()->id);
        return view('Dashboard.layouts.profile', compact('admin'));
    }

    public function update_profile_for_admin(ProfileRequest $request, $adminId)
    {

        $admin = User::findOrFail($adminId);
        if ($request->filled('password')) {
            $newPassword = Hash::make($request->password);
        } else {
            $newPassword = $admin->password;
        }

        if ($request->hasFile('image')) {
            $this->delete_file($admin->image);
            $image = $this->uploadImageimage($request->image, 'Admins/images');
        } else {
            $image = $admin->image;
        }

        $admin->update([
            'name'     => ['ar' => $request->name_ar, 'en' => $request->name_en],
            'image'    => $image,
            'password' => $newPassword,
        ]);

        return redirect()->back()->with(['success' => __('Students_trans.profile_updated')]);
    }

    public function get_profile_data_for_student()
    {
        $student =  Student::findOrFail(auth()->user()->id);
        return view('Dashboard.student.profile', compact('student'));
    }

    public function update_profile_for_student(ProfileRequest $request, $studentId)
    {

        $student = Student::findOrFail($studentId);
        if ($request->filled('password')) {
            $newPassword = Hash::make($request->password);
        } else {
            $newPassword = $student->password;
        }

        if ($request->hasFile('image')) {
            $this->delete_file($student->image);
            $image = $this->uploadImageimage($request->image, 'Students/images');
        } else {
            $image = $student->image;
        }

        $student->update([
            'name'     => ['ar' => $request->name_ar, 'en' => $request->name_en],
            'image'    => $image,
            'password' => $newPassword,
        ]);

        return redirect()->back()->with(['success' => __('Students_trans.profile_updated')]);
    }


    public function get_profile_data_for_parent()
    {
        $parent =  MyParent::findOrFail(auth()->user()->id);
        return view('Dashboard.parents.profile', compact('parent'));
    }

    public function update_profile_for_parent(Request $request, $parentId)
    {
        $parent = MyParent::findOrFail($parentId);
        if ($request->filled('password')) {
            $newPassword = Hash::make($request->password);
        } else {
            $newPassword = $parent->password;
        }

        if ($request->hasFile('image')) {
            $this->delete_file($parent->image);
            $image = $this->uploadImageimage($request->image, 'Parents/images');
        } else {
            $image = $parent->image;
        }

        $parent->update([
            'name'     => ['ar' => $request->name_of_father_ar, 'en' => $request->name_of_father_en],
            'image'    => $image,
            'password' => $newPassword,
        ]);

        return redirect()->back()->with(['success' => __('Students_trans.profile_updated')]);
    }
}
