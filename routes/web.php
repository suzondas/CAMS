<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
})->name('home');


Route::group(['prefix' => 'admin', 'middleware' => ['web', 'redirectAfterLogin']], function () {
    Voyager::routes();
});


Route::get('/student-logout', function() {
    Auth::logout();
    return redirect('/');
});


use App\Http\Controllers\StudentRegistrationController;

Route::get('student/register', [StudentRegistrationController::class, 'showRegistrationForm'])->name('student.register');
Route::post('student/register', [StudentRegistrationController::class, 'sendOtp'])->name('student.register.verify');
Route::get('student/otp', [StudentRegistrationController::class, 'showOtpForm'])->name('student.register.otp');
Route::post('student/verify-otp', [StudentRegistrationController::class, 'verifyOtp'])->name('student.register.verify.otp');

// Route and controller for the registration form page
Route::get('/registration-form', function () {
    return view('students.registration-form');
})->name('students.registration-form')->middleware('auth');

