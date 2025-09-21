<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    
    public function handle(Request $request, Closure $next, string ...$guards)
    {
       if(Auth('web')->check())
       {
         return redirect(RouteServiceProvider::HOME);
       }
       if(Auth('teacher')->check())
       {
         return redirect(RouteServiceProvider::TEACHER);
       }
       if(Auth('student')->check())
       {
         return redirect(RouteServiceProvider::STUDENT);
       }
       if(Auth('parent')->check())
       {
         return redirect(RouteServiceProvider::PARENT);
       }
        return $next($request);
    }
}
