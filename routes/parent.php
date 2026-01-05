<?php

use App\Http\Controllers\Google\GoogleController;
use App\Http\Controllers\parents\ParentController;
use App\Http\Controllers\Teacher\Profile\ProfileController;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Section;
use App\Models\Classroom;
use App\Models\Grade;
use App\Http\Controllers\student\StudentController;
use App\Http\Controllers\Teacher\{TeacherController, TeacherQuizController, TeacherClassesController, LiberaryTeacher};
use Illuminate\Support\Facades\Route;
use App\Livewire\AddParent;

Route::group(
    [
        'prefix'     => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
    ],
    function () {

        Route::middleware(['auth:parent'])->group(function () {
            Route::get('/parent/dashboard', function () {
                return view('Dashboard.parents.dashboard');
            })->name('parent.dashboard');

            //================================================= Parent Profile =====================================================//
            Route::get('Parent-profile', [ProfileController::class, 'get_profile_data_for_parent'])->name('parent.getprofile');
            Route::post('Parent-profile/{parentId}', [ProfileController::class, 'update_profile_for_parent'])->name('parent.update.profile');
            //================================================= End Parent Profile =====================================================//
            
            //================================================= Get Childerns For Parent ===================================================//
            Route::get('get_all_students',[ParentController::class,'get_all_students'])->name('get.all.childern');
            Route::get('get_student_date/{studentId}',[ParentController::class,'show'])->name('parent.show');
            //================================================= End Get Childerns For Parent ===================================================//

            //================================================= Get Childerns Quizzess For Parent ===================================================//
            Route::get('get_all_student_quizzes',[ParentController::class,'get_all_student_quizzes'])->name('get.all.childern_quizzes');
            Route::get('get_all_student_quizze/{studentId}',[ParentController::class,'show_quiz'])->name('parent.show.quize');
            //================================================= End Get Childerns Quizzess For Parent ===================================================//
        });
    }
);
