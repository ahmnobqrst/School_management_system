<?php


namespace App\Traits;
use Illuminate\Support\Facades\File;
use App\Providers\RouteServiceProvider;

trait AuthLogin {


   public function checkguarded($request)
   {
    if($request->type === 'student')
    {
        return $guardname = 'student';
    }
    elseif($request->type === 'teacher')
    {
        return $guardname = 'teacher';
    }
    elseif($request->type === 'parent')
    {
        return $guardname = 'parent';
    }
    else
    {
        return $guardname = 'web';
    }

    return $guardname;

   }

   public function redirect($request){

        if($request->type === 'student'){
            return redirect()->intended(RouteServiceProvider::STUDENT);
            // return redirect()->route('student.dashboard');
        }
        elseif ($request->type === 'parent'){
            return redirect()->intended(RouteServiceProvider::PARENT);
        }
        elseif ($request->type === 'teacher'){
            return redirect()->intended(RouteServiceProvider::TEACHER);
            // return redirect()->route('teacher.dashboard');
        }
        else{
            return redirect()->intended(RouteServiceProvider::HOME);
        }
    }


}