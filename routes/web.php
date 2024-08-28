<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CourseController;


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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('admin/home', [HomeController::class, 'adminHome'])->name('admin.home')->middleware('is_admin');

Route::get('deletedata', [CourseController::class, 'deletedata'])->name('deletedata');

Route::get('addInstmojoPayment',[CourseController::class,'addInstmojoPayment'])->name('addInstmojoPayment');

Route::post('addInstmojoPaymentBut',[CourseController::class,'buttonInstamojo'])->name('addInstmojoPaymentBut');

Route::get('addInstmojoPaymentButSuccess',[CourseController::class,'paymentSuccess'])->name('addInstmojoPaymentButSuccess');

// Route::get('courses', [CourseController::class,'index'])->name('courses');
Route::resource('/courses', CourseController::class)->names([
  'index' => 'courses.index',
  'create' => 'courses.create',
  'store' => 'courses.store',
  'show' => 'courses.show',
]);