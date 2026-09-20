<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/dashboard', function () {
    if (auth()->user()->role === 'admin') {
        return view('dashboard');
    }

    return redirect()->route('user.dashboard');
})->middleware('auth')->name('dashboard');

Route::get('/user-dashboard', function () {
    $user = auth()->user();

    $student = $user->load([
        'student.department',
        'student.courses.teachers',
        'student.phones',
    ])->student;

    return view('user-dashboard', compact('student'));
})->middleware('auth')->name('user.dashboard');

Route::resource('departments', DepartmentController::class)
    ->middleware(['auth', 'isAdmin']);

Route::resource('courses', CourseController::class)
    ->middleware(['auth', 'isAdmin']);

Route::resource('students', StudentController::class)
    ->middleware(['auth', 'isAdmin']);

Route::resource('teachers', TeacherController::class)
    ->middleware(['auth', 'isAdmin']);

Route::post(
    '/students/{student}/courses',
    [StudentController::class, 'addCourse']
)->middleware(['auth', 'isAdmin'])
    ->name('students.courses.add');

Route::delete(
    '/students/{student}/courses/{course}',
    [StudentController::class, 'removeCourse']
)->middleware(['auth', 'isAdmin'])
    ->name('students.courses.remove');

Route::post(
    '/students/{student}/phones',
    [StudentController::class, 'addPhone']
)->middleware(['auth', 'isAdmin'])
    ->name('students.phones.add');

Route::delete(
    '/students/{student}/phones/{phoneNumber}',
    [StudentController::class, 'removePhone']
)->middleware(['auth', 'isAdmin'])
    ->name('students.phones.remove');

Route::view('/chatbot', 'chatbot.index')
    ->middleware('auth')
    ->name('chatbot');
