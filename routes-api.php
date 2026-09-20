<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\DepartmentController;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\TeacherController;
use App\Http\Controllers\Api\TeachesController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);

Route::post('/login', [AuthController::class, 'login']);

Route::post('/chatbot', [\App\Http\Controllers\Api\ChatbotController::class, 'chat']);

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::apiResource('users', UserController::class);

    Route::apiResource('departments', DepartmentController::class);

    Route::apiResource('students', StudentController::class);

    Route::apiResource('courses', CourseController::class);

    Route::apiResource('teachers', TeacherController::class);

    Route::post('/teaches', [TeachesController::class, 'store']);

    Route::delete(
        '/teaches/{teacher}/{course}',
        [TeachesController::class, 'destroy']
    );
});
