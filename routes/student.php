<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;



/*
|--------------------------------------------------------------------------
| Student Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// Auth::routes();

// route::group(['middleware'=>['guest']],function(){

    
// Route::get('/', function()
// {
//     return view('auth.login');
// });

// });





Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath','auth:student' ]
    ], function()
    { 
       
     Route::get('/student/dashboard',function(){
        return view('dashboard.student.dashboard');
     })->name('student.dashboard');





    });

