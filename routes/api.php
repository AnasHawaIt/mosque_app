<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\HalaqaController;
use App\Http\Controllers\QuranInstructorController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\StudentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/students', [StudentController::class, 'index']);
Route::post('/students', [StudentController::class, 'store']);
Route::put('/students/{id}', [StudentController::class, 'update']);
Route::delete('/students/{id}', [StudentController::class, 'destroy']);

Route::post('/attendance', [AttendanceController::class, 'store']);
Route::get('/attendance/{date}', [AttendanceController::class, 'showByDate']);
Route::put('/attendance/{id}', [AttendanceController::class, 'update']);
Route::put('/attendance/{id}/{date}', [AttendanceController::class, 'updateByTime']);

Route::get('/halaqas', [HalaqaController::class, 'index']);
Route::post('/halaqas', [HalaqaController::class, 'store']);
Route::put('/halaqas/{id}', [HalaqaController::class, 'update']);
Route::delete('/halaqas/{id}', [HalaqaController::class, 'destroy']);
Route::post('/t', [QuranInstructorController::class, 'store']);
Route::get('/a', [ReportController::class, 'halaqatReport']);
Route::get('/reports/absent-students', [ReportController::class, 'absentStudents']);
