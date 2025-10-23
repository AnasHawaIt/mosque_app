<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\HalaqaController;
use App\Http\Controllers\QuranInstructorController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\StudentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('/students', StudentController::class);
Route::apiResource('/attendance', AttendanceController::class);
Route::apiResource('/halaqas', HalaqaController::class);
Route::apiResource('/instructor', QuranInstructorController::class);
Route::apiResource('/reports', ReportController::class);
