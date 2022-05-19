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
});

Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::resource('user', App\Http\Controllers\UserController::class);
    Route::post('user/import', [App\Http\Controllers\UserController::class, 'import'])->name('user.import');
    Route::resource('lecturer', App\Http\Controllers\LecturerController::class);
    Route::resource('student', App\Http\Controllers\StudentController::class);
    Route::resource('department', App\Http\Controllers\DepartmentController::class);
    Route::resource('major', App\Http\Controllers\MajorController::class);
    Route::resource('course', App\Http\Controllers\CourseController::class);
});
