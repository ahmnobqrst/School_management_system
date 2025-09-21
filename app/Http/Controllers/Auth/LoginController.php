<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use App\Traits\AuthLogin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    
    // use AuthenticatesUsers;
    // protected $redirectTo = RouteServiceProvider::HOME;

    use AuthLogin;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function formlogin($type)
    {
        return view('auth.login',compact('type'));
    }

    public function login(Request $request)
    {
        if(Auth::guard($this->checkguarded($request))->attempt(['email'=>$request->email,'password'=>$request->password]))
        {
            return $this->redirect($request);
        }
        else
        {
            return redirect()->back()->withErrors(['email' => __('Students_trans.data_error')]);
        }
    }
    public function logout(Request $request,$type)
    {
         Auth::guard($type)->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
        
    }

}
