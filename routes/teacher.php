<?php

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

        Route::middleware(['auth:teacher'])->group(function () {
            Route::get('/teacher/dashboard', function () {

                $teacher         = Teacher::findOrFail(auth()->user()->id);
                $section         = $teacher->Sections()->pluck('section_id');
                $data['section_count']   = $section->count();
                // dd($data['section_count']);
                $data['student_count']   = Student::whereIn('section_id', $section)->count();
                $data['classroom_count'] = Classroom::whereIn('id', $section)->count();
                // dd($data['classroom_count']);

                return view('dashboard.teacher.dashboard', $data);
            })->name('teacher.dashboard');

             route::view('get-parent','livewire.get_student_parent')->name('get_student_parent');

            Route::group(['prefix' => 'teacher/dashboard'], function () {
                Route::get('/allstudents', [TeacherController::class, 'getteacherstds'])->name('getstds');
                Route::get('/get_grade', [TeacherController::class, 'getgrade'])->name('getgrade');
                Route::get('/get_subject', [TeacherController::class, 'getsubject'])->name('getsubject');
                Route::get('/allclassrooms', [TeacherController::class, 'getteacherclasses'])->name('getclasses');
                // Route::get('/allsections', [TeacherController::class, 'sections'])->name('getsections');
                // Route::get('/allsections', [TeacherController::class, 'getteachersections'])->name('getsections');
                Route::get('/alldatastudent/{id}', [TeacherController::class, 'getalldatastudent'])->name('getstudentsdata');

                // Routes for Attendence For Teacher's Students
                Route::get('/attendence', [TeacherController::class, 'attendence'])->name('attendence');
                Route::get('/registerattendence/{sectionId}', [TeacherController::class, 'registerattendence'])->name('registerattendence.show');
                Route::post('/registerattendence/{sectionId}', [TeacherController::class, 'registerattendencestore'])->name('registerattendence.store');

                Route::get('/attendence_section', [TeacherController::class, 'attendence_report'])->name('attendence_section');
                Route::get('report_of_attendence', [TeacherController::class, 'report_of_attendence'])->name('report');
                Route::get('/getreportattendence/{sectionId}', [TeacherController::class, 'get_report_attendence'])->name('report_attendence.get');
                Route::get('report_of_attendence', [TeacherController::class, 'attendence_report'])->name('attendance.report');
                Route::post('report_of_attendence', [TeacherController::class, 'get_attendence_report'])->name('get_attendance.report');
                // Route::post('/updateattendence/{sectionId}', [TeacherController::class, 'updateattendencestore'])->name('updateattendence.store');

                // End Routes for Attendence For Teacher's Students

                // Theses Routes For Quizzes For Teacher 
                route::get('/classes_for_grade/{grade_id}', [TeacherQuizController::class, 'get_classes_for_grade'])
                    ->name('teacher.classes_for_grade');

                route::get('/sections_for_grade/{classroom_id}', [TeacherQuizController::class, 'get_sections_for_grade'])
                    ->name('teacher.sections_for_grade');
                // theses End Routes For Teacher 


                // route For Questions for Teacher

                Route::get('/question_sections', [TeacherController::class, 'question_section_report'])->name('question_section');
                Route::get('/getquestions/{sectionId}', [TeacherController::class, 'get_questions'])->name('questions');
                Route::get('/createquestion/{sectionId}', [TeacherController::class, 'create_question_for_section'])->name('questionsss.create');
                Route::post('/storequestion/{sectionId}', [TeacherController::class, 'store_question_for_section'])->name('questionsss.store');
                Route::get('/editquestion/{question}', [TeacherController::class, 'edit_question'])->name('question.edit');
                Route::put('/updatequestion/{question}', [TeacherController::class, 'update_question'])->name('question.update');
                Route::delete('/deletequestion/{sectionId}', [TeacherController::class, 'delete_question'])->name('question.destroy');
                // End Route For Question For teacher



                // Routes For Classes

                // Route::get('/get_grade', [TeacherClassesController::class, 'getgrade'])->name('getgrade');
                // Route::get('/allclassrooms', [TeacherClassesController::class, 'getteacherclasses'])->name('getclasses');
                Route::get('/allsections', [TeacherClassesController::class, 'sections'])->name('getsectionss');
                Route::post('/OnlineClasses', [TeacherClassesController::class, 'online_create_class'])->name('onlineclasses.store');
                Route::post('/OfflineClasses', [TeacherClassesController::class, 'offline_create_class'])->name('offlineclasses.store');
                Route::delete('/delete', [TeacherClassesController::class, 'delete_online_class'])->name('onlineclass.destroy');
                Route::get('/classes', [TeacherClassesController::class, 'index'])->name('classes.index');
                Route::get('/create_online_class', [TeacherClassesController::class, 'get_online_form'])->name('online.create');
                Route::get('/create_offline_class', [TeacherClassesController::class, 'get_offline_form'])->name('offline.create');

                // End Routes For Classes

                Route::get('/Download/{path}', [LiberaryTeacher::class, 'Download_Books'])
                    ->where('path', '.*')
                    ->name('download.book');

                ////////////////////////// Liverwire ////////////////


                Route::get('profile',[ProfileController::class,'get_profile_data'])->name('getprofile');
                Route::post('profile/{teacherId}',[ProfileController::class,'update_profile'])->name('update.profile');

               


                Route::resources([
                    'quizz' => TeacherQuizController::class,
                    'lib' => LiberaryTeacher::class,
                ]);
            });
        });
    }
);
