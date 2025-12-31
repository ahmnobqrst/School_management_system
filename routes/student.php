<?php

use App\Http\Controllers\Google\GoogleController;
use App\Http\Controllers\Student\StudentDashboardController;
use App\Http\Controllers\Student\StudentExamsController;
use App\Http\Controllers\Teacher\Profile\ProfileController;
use App\Models\Student;
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
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:student']
    ],
    function () {

        Route::get('/student/dashboard', function () {
            return view('dashboard.student.dashboard');
        })->name('student.dashboard');

        Route::group(['prefix' => 'student/dashboard'], function () {
            Route::get('student_grade', [StudentDashboardController::class, 'getStudentGrade'])->name('getstudentgrade');
            Route::get('student_classroom', [StudentDashboardController::class, 'getStudentClassroom'])->name('getstudentclassroom');
            Route::get('student_section', [StudentDashboardController::class, 'getStudentSection'])->name('getstudentsection');
            Route::get('student_teachers', [StudentDashboardController::class, 'getStudentteachers'])->name('getstudentteachers');
            Route::get('student_subjects', [StudentDashboardController::class, 'getStudentsubjects'])->name('getstudentsubjects');
        });

        //======================================== Student Profile =====================================================================//
        Route::get('student-profile', [ProfileController::class, 'get_profile_data_for_student'])->name('student.getprofile');
        Route::post('student-profile/{studentId}', [ProfileController::class, 'update_profile_for_student'])->name('student.update.profile');
       //======================================== End Student Profile =====================================================================//


        //======================================== Student Exam =================================================================//
        Route::get('result_of_exam/{quiz_id}', [StudentExamsController::class, 'show_exam_result'])->name('show_exam_result');
        //========================================= End Student Exam ============================================================//

        //=================================== Google Login ===================================================//
        // Route::get('student/auth/google', [GoogleController::class, 'redirectToGoogle']);
        // Route::get('student/auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);
        //=================================== End Google Login ===================================================//

        Route::resource('student_exams', StudentExamsController::class);
    }
);
