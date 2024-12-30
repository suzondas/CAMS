<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Submitform;
use App\Http\Livewire\Viewapplication;
use App\Http\Controllers\StudentRegistrationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect(route('voyager.login'));
});


Route::group(['prefix' => 'admin', 'middleware' => ['web', 'redirectAfterLogin']], function () {
    Voyager::routes();
});


Route::get('/student-logout', function () {
    Auth::logout();
    return redirect('/');
});


/*Register first time*/

Route::get('student/register', [StudentRegistrationController::class, 'showRegister'])->name('student.register');
Route::post('student/register', [StudentRegistrationController::class, 'sendOtp'])->name('student.register.verify');
Route::get('student/otp', [StudentRegistrationController::class, 'showOtpForm'])->name('student.register.otp');
Route::post('student/verify-otp', [StudentRegistrationController::class, 'verifyOtp'])->name('student.register.verify.otp');


/*big form*/
// Route and controller for the registration form page
Route::get('/registration-form', Submitform::class)->name('students.registration-form')->middleware('auth');
Route::get('/view-application', Viewapplication::class)->name('students.view-application')->middleware('auth');

