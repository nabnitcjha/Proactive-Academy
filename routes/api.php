<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::group([

    'middleware' => 'api',
    'namespace' => 'App\Http\Controllers',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
});

// student routes
Route::group([

    'middleware' => 'api',
    'namespace' => 'App\Http\Controllers'

], function ($router) {

    Route::post('addStudent', 'StudentController@saveData');
    Route::get('getStudents/{allowPagination}', 'StudentController@getData');

    // student-detail page route
    Route::get('student/{id}/detailForAdmin', 'StudentController@detailForAdmin');
    Route::get('student/{student_id}/teacher/{teacher_id}/class', 'StudentController@getTeacherSlot');
    // Route::get('teacher/{teacher_id}/student/{student_id}/class', 'StudentController@getTeacherSlot');
    Route::get('student/{id}/sortedClass', 'StudentController@sortedClass');
    Route::get('admin/sortedClass', 'StudentController@adminSortedClass');
    Route::get('student/{id}/class', 'StudentController@allClasses');
    Route::put('student/{id}/changePassword', 'StudentController@changePassword');

    // change password 
    Route::put('user/{id}/changePassword', 'StudentController@changePassword');

    // student login route
    Route::get('student/{id}/teacher', 'StudentController@getTeacher');
    Route::get('teacher/{teacher_id}/student/{student_id}/detail', 'StudentController@detail');
    Route::get('student/{student_id}/detailForParent', 'StudentController@detailForParent');

    // admin dashboard
    Route::get('admin/dashboard', 'StudentController@adminDashboard');
});

// teacher routes
Route::group([

    'middleware' => 'api',
    'namespace' => 'App\Http\Controllers'

], function ($router) {
    Route::get('teacher/{id}/profileOverview', 'TeacherController@profileOverview');
    Route::get('getTeachers/{allowPagination}', 'TeacherController@getData');
    Route::get('teacher/{id}/sortedClass', 'TeacherController@sortedClass');
    Route::get('teacher/{id}/class', 'TeacherController@allClasses');
    Route::post('addTeacher', 'TeacherController@saveData');
    Route::get('getTeachers/{allowPagination}', 'TeacherController@getData');

    // teacher login route
    Route::get('teacher/{id}/student', 'TeacherController@getStudent');
    Route::get('student/{student_id}/teacher/{teacher_id}/detail', 'TeacherController@detail');
});

// subject routes
Route::group([

    'middleware' => 'api',
    'namespace' => 'App\Http\Controllers'

], function ($router) {

    Route::post('addSubject', 'SubjectController@saveData');
    Route::get('getSubjects/{allowPagination}', 'SubjectController@getData');
});

// class-schedule routes
Route::group([

    'middleware' => 'api',
    'namespace' => 'App\Http\Controllers'

], function ($router) {

    Route::post('addTimetable', 'ClassScheduleController@saveData');
    Route::get('getTimetables/{allowPagination}', 'ClassScheduleController@getData');
    Route::post('timetable/{id}/drag', 'ClassScheduleController@dragUpdate');
    Route::post('timetable/{id}/resourceFile', 'ClassScheduleController@saveResourceFile');
    Route::get('student/{student_id}/timetable/{class_schedule_id}/resourceFile', 'ClassScheduleController@getResourceFile');

    Route::post('assignment/{id}/answer', 'ClassScheduleController@assignmentAnswer');

    Route::get('downloadFile/{id}', 'uploadImageOrFileController@downloadFile');
    Route::get('displayFile/{id}', 'uploadImageOrFileController@displayFile');
    Route::get('assignment/{id}/delete', 'ClassScheduleController@deleteAssignment');
    Route::post('saveZoomLink', 'ClassScheduleController@saveZoomLink');
    Route::get('timetable/{class_unique_id}', 'ClassScheduleController@getClassAccordingUniqueId');
});

// chat routes
Route::group([

    'middleware' => 'api',
    'namespace' => 'App\Http\Controllers'

], function ($router) {
    Route::get('messages/{friend_id}/{my_id}', [App\Http\Controllers\MessageController::class, 'fetchMessages']);
    Route::get('groupMessages/{class_unique_id}/{my_id}', [App\Http\Controllers\MessageController::class, 'fetchGroupMessages']);
    Route::post('messages', [App\Http\Controllers\MessageController::class, 'sendMessage']);
});

// User routes
Route::group([

    'middleware' => 'api',
    'namespace' => 'App\Http\Controllers'

], function ($router) {
    Route::post('user/{id}/userImage', [App\Http\Controllers\UserController::class, 'userImage']);
    Route::get('user/{id}', [App\Http\Controllers\UserController::class, 'userInfo']);
});
