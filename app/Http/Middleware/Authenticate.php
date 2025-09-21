<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if (!$request->expectsJson()) {
            if ($request->is(app()->getLocale() . '/student/dashboard')) {
                return route('selection');
            } elseif ($request->is(app()->getLocale() . '/teacher/dashboard')) {
                return route('selection');
            } elseif ($request->is(app()->getLocale() . '/parent/dashboard')) {
                return route('selection');
            } else {
                return route('selection');
            }
        }

        return null;
    }
}
