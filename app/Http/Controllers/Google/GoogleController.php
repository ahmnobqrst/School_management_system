<?php

namespace App\Http\Controllers\Google;

use App\Http\Controllers\Controller;
use App\Models\MyParent;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class GoogleController extends Controller
{
    public function redirect($type)
    {
        return Socialite::driver('google')
        ->stateless()
        ->with([
            'state' => $type
        ])
        ->redirect();
    }

    public function callback(Request $request)
{
    $type = $request->get('state');

    if (!$type) {
        abort(403, 'Type not defined');
    }

    $googleUser = Socialite::driver('google')
        ->stateless()
        ->user();

    return match ($type) {
        'teacher' => $this->loginTeacher($googleUser),
        'student' => $this->loginStudent($googleUser),
        'parent'  => $this->loginParent($googleUser),
        default   => abort(403),
    };
}



    private function loginTeacher($googleUser)
    {
        $teacher = Teacher::firstOrCreate(
            ['google_id' => $googleUser->id],
            [
                'name' => $googleUser->name,
                'email' => $googleUser->email,
                'password' => bcrypt(Str::random(16)),
                'specialist_id'=>1,
                'gender_id'=>1,
                'address'=>'beni suef',
                'age'=>28,
                'date_of_job'=>'1998-02-02',
                'phone'=>'01021513233',
                'national_teacher_id'=>1,
                'grade_id'=>1,
                'blood_type_teacher_id'=>1
            ]
        );

        Auth::guard('teacher')->login($teacher);
        return redirect()->route('teacher.dashboard');
    }

    private function loginStudent($googleUser)
    {
        $student = Student::firstOrCreate(
            ['google_id' => $googleUser->id],
            [
                'name' => $googleUser->name,
                'email' => $googleUser->email,
                'password' => bcrypt(Str::random(16)),
            ]
        );

        Auth::guard('student')->login($student);
        return redirect()->route('student.dashboard');
    }

    private function loginParent($googleUser)
    {
        $parent = MyParent::firstOrCreate(
            ['google_id' => $googleUser->id],
            [
                'name' => $googleUser->name,
                'email' => $googleUser->email,
                'password' => bcrypt(Str::random(16)),
            ]
        );

        Auth::guard('parent')->login($parent);
        return redirect()->route('parent.dashboard');
    }
}
