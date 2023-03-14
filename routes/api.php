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

    Route::post('login', [App\Http\Controllers\AuthController::class, 'login']);
    Route::post('logout', [App\Http\Controllers\AuthController::class, 'logout']);
    Route::post('refresh', [App\Http\Controllers\AuthController::class, 'refresh']);
    Route::post('me', [App\Http\Controllers\AuthController::class, 'me']);
});
Route::post('forgot-password', [App\Http\Controllers\StudentController::class, 'forgotPassword']);
// student routes
Route::group([

    'middleware' => 'api',
    'namespace' => 'App\Http\Controllers'

], function ($router) {

    Route::post('addStudent', [App\Http\Controllers\StudentController::class, 'saveData']);
    Route::get('getStudents/{allowPagination}', [App\Http\Controllers\StudentController::class, 'getData']);
    Route::delete('student/{id}/delete', [App\Http\Controllers\StudentController::class, 'deleteStudent']);

    // student-detail page route
    Route::get('student/{id}/detailForAdmin', [App\Http\Controllers\StudentController::class, 'detailForAdmin']);
    Route::get('student/{student_id}/teacher/{teacher_id}/class', [App\Http\Controllers\StudentController::class, 'getTeacherSlot']);
    // Route::get('teacher/{teacher_id}/student/{student_id}/class', 'StudentController@getTeacherSlot');
    Route::get('student/{id}/sortedClass', [App\Http\Controllers\StudentController::class, 'sortedClass']);
    Route::get('student/{id}/todayClass', [App\Http\Controllers\StudentController::class, 'todayClass']);
    Route::get('admin/sortedClass', [App\Http\Controllers\StudentController::class, 'adminSortedClass']);
    Route::get('student/{id}/class',[App\Http\Controllers\StudentController::class, 'allClasses'] );

    // student login route
    Route::get('student/{id}/teacher',[App\Http\Controllers\StudentController::class, 'getTeacher'] );
    Route::get('teacher/{teacher_id}/student/{student_id}/detail', [App\Http\Controllers\StudentController::class, 'detail']);
    Route::get('student/{student_id}/detailForParent',[App\Http\Controllers\StudentController::class, 'detailForParent'] );

    // admin dashboard
    Route::get('admin/dashboard', [App\Http\Controllers\StudentController::class, 'adminDashboard']);

    // parent dashboard
    Route::get('parent/{id}/todayClass',[App\Http\Controllers\StudentController::class, 'todayClass'] );

    // forgot password
    
});

// teacher routes
Route::group([

    'middleware' => 'api',
    'namespace' => 'App\Http\Controllers'

], function ($router) {
    Route::get('teacher/{id}/profileOverview', [App\Http\Controllers\TeacherController::class, 'profileOverview']);
    Route::get('getTeachers/{allowPagination}',[App\Http\Controllers\TeacherController::class, 'getData'] );
    Route::get('teacher/{id}/sortedClass',[App\Http\Controllers\TeacherController::class, 'sortedClass'] );
    Route::get('teacher/{id}/todayClass',[App\Http\Controllers\TeacherController::class, 'todayClass'] );
    Route::get('teacher/{id}/class', [App\Http\Controllers\TeacherController::class, 'allClasses']);
    Route::post('addTeacher', [App\Http\Controllers\TeacherController::class, 'saveData']);
    Route::get('getTeachers/{allowPagination}', [App\Http\Controllers\TeacherController::class, 'getData']);
    Route::delete('teacher/{id}/delete', [App\Http\Controllers\TeacherController::class, 'deleteTeacher']);

    // teacher login route
    Route::get('teacher/{id}/student', [App\Http\Controllers\TeacherController::class, 'getStudent']);
    Route::get('student/{student_id}/teacher/{teacher_id}/detail', [App\Http\Controllers\TeacherController::class, 'detail']);
});

// subject routes
Route::group([

    'middleware' => 'api',
    'namespace' => 'App\Http\Controllers'

], function ($router) {

    Route::post('addSubject', [App\Http\Controllers\SubjectController::class, 'saveData']);
    Route::get('getSubjects/{allowPagination}', [App\Http\Controllers\SubjectController::class, 'getData']);
    Route::delete('subject/{id}/delete', [App\Http\Controllers\SubjectController::class, 'deleteSubject']);
});

// class-schedule routes
Route::group([

    'middleware' => 'api',
    'namespace' => 'App\Http\Controllers'

], function ($router) {

    Route::post('addTimetable', [App\Http\Controllers\ClassScheduleController::class, 'saveData']);
    Route::get('getTimetables/{allowPagination}',[App\Http\Controllers\ClassScheduleController::class, 'getData'] );
    Route::post('timetable/{id}/drag',[App\Http\Controllers\ClassScheduleController::class, 'dragUpdate'] );
    Route::post('timetable/{id}/resourceFile',[App\Http\Controllers\ClassScheduleController::class, 'saveResourceFile'] );
    Route::get('student/{student_id}/timetable/{class_schedule_id}/resourceFile',[App\Http\Controllers\ClassScheduleController::class, 'getResourceFile'] );

    Route::post('assignment/{id}/answer', [App\Http\Controllers\ClassScheduleController::class, 'fetchMessages']);

    Route::get('downloadFile/{id}',[App\Http\Controllers\uploadImageOrFileController::class, 'downloadFile']);
    Route::get('displayFile/{id}', [App\Http\Controllers\uploadImageOrFileController::class, 'displayFile']);
    Route::get('assignment/{id}/delete', [App\Http\Controllers\ClassScheduleController::class, 'deleteAssignment']);
    Route::post('saveZoomLink', [App\Http\Controllers\ClassScheduleController::class, 'saveZoomLink']);
    Route::get('timetable/{class_unique_id}',[App\Http\Controllers\ClassScheduleController::class, 'getClassAccordingUniqueId'] );
    Route::delete('timetable/{class_unique_id}/delete',[App\Http\Controllers\ClassScheduleController::class, 'deleteTimetable'] );
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
    Route::post('user/{id}/changePassword', [App\Http\Controllers\UserController::class, 'changePassword']);

});
