<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\ParentController;
use App\Http\Controllers\PresenceController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('auth')->group(function() {
    Route::controller(AuthController::class)->group(function () {
        Route::post('/login', 'login');
        Route::post('/login/parent', 'loginParent');
    });
});

Route::prefix('data')->group(function() {
    Route::prefix('get')->group(function() {
        // Route::controller(DataController::class)->group(function () {
        //     Route::post('/user', 'getUser');
        // });
        Route::get('student', [StudentController::class, 'getStudents']);
        Route::get('class', [ClassController::class, 'getClasses']);
        Route::get('teacher', [TeacherController::class, 'getTeachers']);
        Route::get('subject', [SubjectController::class, 'getSubjects']);
        Route::get('parent', [ParentController::class, 'getParents']);
        Route::get('presence', [PresenceController::class, 'getPresences']);
    });
    
    Route::prefix('store')->group(function() {
        // Route::controller(DataController::class)->group(function () {
        //     Route::post('/student', 'setStudent');
        // });

        Route::post('student', [StudentController::class, 'setStudent']);
        Route::post('class', [ClassController::class, 'setClass']);
        Route::post('teacher', [TeacherController::class, 'setTeacher']);
        Route::post('subject', [SubjectController::class, 'setSubject']);
        Route::post('parent', [ParentController::class, 'setParent']);
        Route::post('presence', [PresenceController::class, 'setPresence']);
    });

    Route::prefix('getByPrimary')->group(function() {
        Route::get('/student/{nisn}', [StudentController::class, 'getStudent']);
        Route::get('/class/{name}', [ClassController::class, 'getClass']);
        Route::get('/teacher/{nip}', [TeacherController::class, 'getTeacher']);
        Route::get('/subject/{uuid_subject}', [SubjectController::class, 'getSubject']);
        Route::get('/parent/{email}', [ParentController::class, 'getParent']);
        Route::get('/presence/{uuid_presence}', [PresenceController::class, 'getPresence']);
    });

    Route::prefix('edit')->group(function() {
        Route::post('/student/{nisn}', [StudentController::class, 'putStudent']);
        Route::post('/class/{name}', [ClassController::class, 'putClass']);
        Route::post('/teacher/{nip}', [TeacherController::class, 'putTeacher']);
        Route::post('/subject/{uuid_subject}', [SubjectController::class, 'putSubject']);
        Route::post('/parent/{email}', [ParentController::class, 'putParent']);
        Route::post('/presence/{uuid_presence}', [PresenceController::class, 'putPresence']);
    });

    Route::prefix('delete')->group(function() {
        Route::post('/student/{nisn}', [StudentController::class, 'deleteStudent']);
        Route::post('/class/{name}', [ClassController::class, 'deleteClass']);
        Route::post('/teacher/{nip}', [TeacherController::class, 'deleteTeacher']);
        Route::post('/subject/{uuid_subject}', [SubjectController::class, 'deleteSubject']);
        Route::post('/parent/{email}', [ParentController::class, 'deleteParent']);
        Route::post('/presence/{uuid_presence}', [PresenceController::class, 'deletePresence']);
    });
});