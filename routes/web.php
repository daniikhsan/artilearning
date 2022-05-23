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


Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::middleware(['admin'])->group(function () {
        Route::resource('user', App\Http\Controllers\UserController::class);
        Route::post('user/import', [App\Http\Controllers\UserController::class, 'import'])->name('user.import');
        Route::resource('lecturer', App\Http\Controllers\LecturerController::class);
        Route::resource('student', App\Http\Controllers\StudentController::class);
        Route::resource('department', App\Http\Controllers\DepartmentController::class);
        Route::resource('major', App\Http\Controllers\MajorController::class);
        Route::resource('course-setting', App\Http\Controllers\CourseSettingController::class);
        Route::get('course-setting/{id}/add-student', [App\Http\Controllers\CourseSettingController::class, 'add_student'])->name('course-setting.add-student');
        Route::post('course-setting/{id}/add-student', [App\Http\Controllers\CourseSettingController::class, 'store_student'])->name('course-setting.store.add-student');
    });
    Route::middleware(['lecturer'])->group(function () {
        Route::get('exam/{course_id}/create', [App\Http\Controllers\ExamController::class, 'create'])->name('exam.create');
        Route::post('exam/{course_id}/create', [App\Http\Controllers\ExamController::class, 'store'])->name('exam.store');
        Route::get('exam/{course_id}/{exam_id}/question', [App\Http\Controllers\ExamController::class, 'add_question'])->name('exam.create.question');
        Route::post('exam/{course_id}/{exam_id}/question', [App\Http\Controllers\ExamController::class, 'store_question'])->name('exam.store.question');
    });
    Route::middleware(['student'])->group(function () {
        Route::get('exam/{course_id}/{exam_id}/attempt', [App\Http\Controllers\ExamController::class, 'attempt'])->name('exam.attempt');
        Route::post('exam/{course_id}/{exam_id}/submit', [App\Http\Controllers\ExamController::class, 'submit'])->name('exam.submit');
        Route::get('exam/{course_id}/{exam_id}/review/{user_exam_id}', [App\Http\Controllers\ExamController::class, 'review'])->name('exam.review');
        Route::get('exam/{course_id}/{exam_id}/review/{user_exam_id}/pdf', [App\Http\Controllers\ExamController::class, 'export_pdf'])->name('exam.pdf');
    });
    Route::resource('course', App\Http\Controllers\CourseController::class);
});
