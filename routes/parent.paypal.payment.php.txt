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
            Route::get('get_all_students', [ParentController::class, 'get_all_students'])->name('get.all.childern');
            Route::get('get_student_date/{studentId}', [ParentController::class, 'show'])->name('parent.show');
            //================================================= End Get Childerns For Parent ===================================================//

            //================================================= Get Childerns Quizzess For Parent ===================================================//
            Route::get('get_student_quizze/{studentId}', [ParentController::class, 'get_student_quiz'])->name('get.son.quiz');
            Route::get('get_student_result/{studentId}/{quizId}', [ParentController::class, 'get_student_result'])->name('get.son.result');
            //================================================= End Get Childerns Quizzess For Parent ===================================================//

            //================================================= Get Childerns Fees For Parent ===================================================//
            Route::get('parent/student-fees/{studentId}',[ParentController::class, 'get_student_fees'])->name('get.son.fees');

            Route::get('parent/pay/{studentId}',[ParentController::class, 'form_create'])->name('parent.pay.form');

            Route::post('paypal/payment/{studentId}',[ParentController::class, 'makePayment'])->name('make.payment');

            Route::get('paypal/success/{studentId}',[ParentController::class, 'paymentSuccess'])->name('payment.success');

            Route::get('paypal/cancel',[ParentController::class, 'paymentCancel'])->name('payment.cancel');

            // Route::get('get_student_result/{studentId}/{quizId}',[ParentController::class,'get_student_result'])->name('get.son.result');
            //================================================= End Get Childerns Fees For Parent ===================================================//

            //================================================= Get Childerns Appearence For Parent ===================================================//
            Route::get('get_childern_appearence', [ParentController::class, 'get_childern_appearence'])->name('get.childern.appearence');
            Route::get('student_Attendence/{studentId}', [ParentController::class, 'student_attendence'])->name('student.attendence');
            // Route::post('store/{studentId}',[ParentController::class,'store'])->name('store.fee.student');
            //================================================= End Get Childerns Appearence For Parent ===================================================//

            //================================================= Get Childerns PaymentFees For Parent ===================================================//
            // Route::get('get_childern_paymentfees',[ParentController::class,'get_childern_paymentFees'])->name('get.all.childern');
            // Route::get('student_Payment_create/{studentId}',[ParentController::class,'student_payment_create'])->name('paymentfees.create.son');
            // Route::get('student_Attendence/{studentId}',[ParentController::class,'student_attendence'])->name('student.attendence');
            // Route::post('store/{studentId}',[ParentController::class,'store'])->name('store.fee.student');
            //================================================= End Get Childerns PaymentFees For Parent ===================================================//


        });
    }
);
