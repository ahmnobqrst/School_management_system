<?php

use App\Models\Student;
use App\Models\Teacher;
use App\Models\Section;
use App\Models\Classroom;
use App\Models\Grade;
use App\Http\Controllers\student\StudentController;
use App\Http\Controllers\Teacher\TeacherController;
use Illuminate\Support\Facades\Route;

Route::group(
    [
        'prefix'     => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
    ],
    function () {
        
        Route::middleware(['auth:teacher'])->group(function () {
            Route::get('/teacher/dashboard', function () {

                $teacher         = Teacher::findOrFail(auth()->user()->id);
                $section         = $teacher->Sections()->pluck('section_id');
                $data['section_count']   = $section->count();
                $data['student_count']   = Student::whereIn('section_id', $section)->count();
                $data['classroom_count'] = Classroom::whereIn('id', $section)->count();

                return view('dashboard.teacher.dashboard', $data);
            })->name('teacher.dashboard');

            Route::group(['prefix' => 'teacher/dashboard'], function () {
                Route::get('/allstudents', [TeacherController::class, 'getteacherstds'])->name('getstds');
                Route::get('/allclassrooms', [TeacherController::class, 'getteacherclasses'])->name('getclasses');
                Route::get('/allsections', [TeacherController::class, 'getteachersections'])->name('getsections');
                Route::get('/alldatastudent/{id}', [TeacherController::class, 'getalldatastudent'])->name('getstudentsdata');
                Route::get('/attendence', [TeacherController::class, 'attendence'])->name('attendence');
                Route::get('/registerattendence/{sectionId}', [TeacherController::class, 'registerattendence'])->name('registerattendence.show');
                Route::post('/registerattendence/{sectionId}', [TeacherController::class, 'registerattendencestore'])->name('registerattendence.store');
                
                Route::get('/attendence_section', [TeacherController::class, 'attendence_report'])->name('attendence_section');
                Route::get('report_of_attendence',[TeacherController::class, 'report_of_attendence'])->name('report');
                Route::get('/getreportattendence/{sectionId}', [TeacherController::class, 'get_report_attendence'])->name('report_attendence.get');
                Route::get('report_of_attendence',[TeacherController::class, 'attendence_report'])->name('attendance.report');
                Route::post('report_of_attendence',[TeacherController::class, 'get_attendence_report'])->name('get_attendance.report');
                // Route::post('/updateattendence/{sectionId}', [TeacherController::class, 'updateattendencestore'])->name('updateattendence.store');
            });
            
        });
    }
);
