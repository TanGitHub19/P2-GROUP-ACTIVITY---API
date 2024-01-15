<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\StudentController;
use App\Http\Controllers\API\TeacherController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('students', [StudentController::class, 'index']);
Route::post('students', [StudentController::class, 'store']);
Route::get('students/{id}', [StudentController::class, 'show']);
Route::get('students/{id}/edit', [StudentController::class, 'edit']);
Route::put('students/{id}/update', [StudentController::class, 'update']);
Route::delete('students/{id}/delete', [StudentController::class, 'destroy']);

Route::get('teachers', [TeacherController::class, 'index']);
Route::post('teachers', [TeacherController::class, 'store']);
Route::get('teachers/{id}', [TeacherController::class, 'show']);
Route::get('teachers/{id}/edit', [TeacherController::class, 'edit']);
Route::put('teachers/{id}/update', [TeacherController::class, 'update']);
Route::delete('teachers/{id}/delete', [TeacherController::class, 'destroy']);