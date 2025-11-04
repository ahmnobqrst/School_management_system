<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Grade\GradeController;
use App\Http\Controllers\Classroom\ClassroomController;
use App\Http\Controllers\Section\SectionController;
use App\Http\Controllers\Teacher\TeacherController;
use App\Livewire\AddParent;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\Student\GraduatedController;
use App\Http\Controllers\Promotion\PromotionController;
use App\Http\Controllers\fees\FeeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\fee_invoice\FeeInvoiceController;
use App\Http\Controllers\reciept\RecieptController;
use App\Http\Controllers\process\ProcessingFee;
use App\Http\Controllers\payment\PaymentController;
use App\Http\Controllers\attendence\AttendenceController;
use App\Http\Controllers\subject\SubjectController;
use App\Http\Controllers\quiz\QuizzesController;
use App\Http\Controllers\question\QuestionController;
use App\Http\Controllers\onlineclasses\OnlineClassesController;
use App\Http\Controllers\liberary\LiberaryController;
use App\Http\Controllers\Teacher\Profile\ProfileController;
use App\Http\Controllers\setting\SettingController;
use Illuminate\Support\Facades\Storage;



/*
|--------------------------------------------------------------------------
| Web Routes
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





Route::group(  // هذا علشان تحفظ اخر مرة اليوزر استخدم انهي لغة للبرنامج سواء عربي او انجليزي
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {
        Route::get('/', [HomeController::class, 'index'])->name('selection');

        Route::group(['namespace' => 'Auth'], function () {
            route::get('/login/{type}', [LoginController::class, 'formlogin'])->middleware('guest')->name('login.show');
            route::Post('/login', [LoginController::class, 'login'])->name('login');
        });
        route::get('/logout/{type}', [LoginController::class, 'logout'])->name('logout');

        /////////////////////////////////////// parent livewire /////////////////////////////////////

        route::view('add_parent', 'livewire.form_add_parent')->name('add_parent');
        //    route::get('test',function(){
        //     return view('test');
        //    });

        \Livewire\Livewire::setScriptRoute(function ($handle) {
            return Route::get('/subfolder/livewire/livewire.js', $handle);
        });
        \Livewire\Livewire::setUpdateRoute(function ($handle) {
            return Route::post('/subfolder/livewire/update', $handle);
        });

        /////////////////////////////////////// parent livewire /////////////////////////////////////




        Route::get('/dashboard', [HomeController::class, 'dashboard'])->middleware('auth')->name('dashboard');

        route::get('/create', [GradeController::class, 'create'])->name('create');
        route::post('grade/delete', [GradeController::class, 'delete'])->name('delete');

        route::get('classrooms/{myclasses_id}', [ClassroomController::class, 'Delete'])->name('delete.class');
        route::Post('/delete_classes', [ClassroomController::class, 'Delete_all'])->name('delete_all');
        route::Post('/filter_classes', [ClassroomController::class, 'filteration_class'])->name('filter_grade');

        route::get('/classes/{id}', [SectionController::class, 'getclasses']);
        route::get('/teachers/{id}', [SectionController::class, 'getteacher']);

        route::get('/classes/{id}', [StudentController::class, 'get_classes']);
        route::get('/sections/{id}', [StudentController::class, 'get_sections']);


        Route::Post('/upload_new_attachments', [StudentController::class, 'save_new_images'])->name('upload_new_attachments');
        Route::Post('/Delete_attachment', [StudentController::class, 'Delete_attachment'])->name('Delete_attachment');
        route::get('Download_attachment/{studentname}/{filename}', [StudentController::class, 'Download_attachment'])->name('Download_attachment');
        Route::get('/Download/{path}', [LiberaryController::class, 'Download_Books'])
            ->where('path', '.*')
            ->name('download.book');
        Route::Post('/offline_class', [OnlineClassesController::class, 'Store_offline_class'])->name('offline.store');
        Route::get('/offline_class', [OnlineClassesController::class, 'offline_class'])->name('offline.class');


        Route::get('admin-profile', [ProfileController::class, 'get_profile_data_for_admin'])->name('admin.getprofile');
        Route::post('admin-profile/{adminId}', [ProfileController::class, 'update_profile_for_admin'])->name('admin.update.profile');

    








        Route::resources([
            'grades' => GradeController::class,
            'classrooms' => ClassroomController::class,
            'section' => SectionController::class,
            'teachers' => TeacherController::class,
            'students' => StudentController::class,
            'promotions' => PromotionController::class,
            'graduates' => GraduatedController::class,
            'fees' => FeeController::class,
            'feeinvoices' => FeeInvoiceController::class,
            'reciept' => RecieptController::class,
            'processingfee' => ProcessingFee::class,
            'payments' => PaymentController::class,
            'attendence' => AttendenceController::class,
            'subjects' => SubjectController::class,
            'quizzes' => QuizzesController::class,
            'questions' => QuestionController::class,
            'online_classes' => OnlineClassesController::class,
            'liberary' => LiberaryController::class,
            'setting' => SettingController::class,

        ]);
    }
);

    // Route::group(  // هذا علشان تحفظ اخر مرة اليوزر استخدم انهي لغة للبرنامج سواء عربي او انجليزي
    //     [
    //         'prefix' => LaravelLocalization::setLocale(),
    //         'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    //     ], function()
    //     { 
     
        
    
    //     Route::get('/livewire', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
    
    //     route::get('/create',[GradeController::class,'create'])->name('create');
    //     route::post('grade/delete',[GradeController::class,'delete'])->name('delete');
    
    //     route::get('classrooms/{myclasses_id}',[ClassroomController::class,'Delete'])->name('delete.class');
    //     route::Post('/delete_classes',[ClassroomController::class,'Delete_all'])->name('delete_all');
    //     route::Post('/filter_classes',[ClassroomController::class,'filteration_class'])->name('filter_grade');
    
    //     route::get('/classes/{id}',[SectionController::class,'getclasses']);
    
    
    //     Route::resources([
    //         'grades'=>GradeController::class,
    //         'classrooms'=>ClassroomController::class,
    //         'section'=>SectionController::class]);
    //     });









// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');