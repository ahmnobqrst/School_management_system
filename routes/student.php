<?php

use App\Http\Controllers\Google\GoogleController;
use App\Http\Controllers\Student\StudentDashboardController;
use App\Http\Controllers\Student\StudentExamsController;
use App\Http\Controllers\Teacher\Profile\ProfileController;
use App\Models\Student;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Student\Timelab\TimelabStudent;

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

        //=================================== Timelab ===================================================//
        Route::get('student/timelab', [TimelabStudent::class, 'index'])->name('student.timelab');
        //=================================== End Timelab ===================================================//

        //======================================== Student Appearnce =================================================================//
        Route::get('MyAppearnce', [StudentExamsController::class, 'student_appearnce'])->name('student.appearnce');
        //========================================= End Student Appearnce ============================================================//

        //======================================== Student Leactures =================================================================//
        Route::get('MyLeactures', [StudentExamsController::class, 'student_leacture'])->name('student.leactures');
        //========================================= End Student Leactures ============================================================//

        //======================================== Student Books =================================================================//
        Route::get('MyBooks', [StudentExamsController::class, 'student_books'])->name('student.books');
        Route::get('/Download/{path}', [StudentExamsController::class, 'Download_Books'])->where('path', '.*')->name('student.download.book');
        //========================================= End Student Books ============================================================//

        Route::get('student/settings', [TimelabStudent::class, 'student_settings'])->name('student.settings');

        //=================================== Google Login ===================================================//
        // Route::get('student/auth/google', [GoogleController::class, 'redirectToGoogle']);
        // Route::get('student/auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);
        //=================================== End Google Login ===================================================//

        Route::resource('student_exams', StudentExamsController::class);
    }
);
