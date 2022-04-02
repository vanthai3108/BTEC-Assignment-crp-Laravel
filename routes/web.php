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



Auth::routes(['register' => false]);
Route::get('/login/{provider}', 'LoginBySocialController@loginSocial')->name('login_social');
Route::get('/login/{provider}/process', 'LoginBySocialController@loginSocialHandle')->name('login_social_handle');

Route::group(['prefix'=>'admin','as'=>'admin.', 'middleware' => ['auth', 'block', 'role:admin']], function(){
    Route::get('home', 'Admin\HomeController@index')->name('index');
    Route::resource('/campuses', 'Admin\CampusController');
    Route::get('/users/block/{user}', 'Admin\UserController@blockUser')->name('users.block');
    Route::get('/users/unblock/{user}', 'Admin\UserController@unblockUser')->name('users.unblock');
    Route::get('/users/static', 'Admin\UserController@static')->name('users.static');
    Route::resource('/users', 'Admin\UserController');
    Route::resource('/categories', 'Admin\CategoryController');
    Route::resource('/subjects', 'Admin\SubjectController');
    Route::resource('/semesters', 'Admin\SemesterController');
    Route::resource('/classes', 'Admin\ClassController');
    Route::resource('/shifts', 'Admin\ShiftController');
    Route::resource('/locations', 'Admin\LocationController');
    Route::get('/schedules/{schedule}/attendance', 'Admin\ScheduleController@attendance')->name('schedules.attendance');
    Route::post('/schedules/{schedule}/attendance', 'Admin\ScheduleController@attendanceHandle')->name('schedules.attendance_handle');
    Route::get('/schedules/{schedule}/attendance/edit', 'Admin\ScheduleController@attendanceEdit')->name('schedules.attendance_edit');
    Route::post('/schedules/{schedule}/attendance/edit', 'Admin\ScheduleController@attendanceEditHandle')->name('schedules.attendance_edit_handle');
    Route::resource('/schedules', 'Admin\ScheduleController');
    Route::get('/courses/{course}/add_schedule', 'Admin\CourseController@addScheduleView')->name('courses.add_schedule_view');
    // Route::post('/courses/{course}/add_schedule', 'Admin\CourseController@addSchedule')->name('courses.add_schedule');
    Route::get('/courses/{course}/add_trainee', 'Admin\CourseController@addTraineeView')->name('courses.add_trainee_view');
    Route::post('/courses/{course}/add_trainee', 'Admin\CourseController@addTrainee')->name('courses.add_trainee');
    Route::delete('/courses/{course}/{user}/', 'Admin\CourseController@deleteTrainee')->name('courses.delete_trainee');
    Route::get('/courses/static', 'Admin\CourseController@static')->name('courses.static');
    Route::get('/courses/{course}/trainees/', 'Admin\CourseController@trainees')->name('courses.trainees');
    Route::get('/courses/{course}/grading', 'Admin\CourseController@gradeCourse')->name('courses.grade');
    Route::post('/courses/{course}/grading', 'Admin\CourseController@gradeCourseHandle')->name('courses.grade_handle');
    Route::resource('/courses', 'Admin\CourseController');
});

Route::group(['middleware' => ['auth', 'block', 'role:trainer']], function(){
    Route::get('/my_schedule/{schedule}/attendance', 'HomeController@attendance')->name('my_schedule.attendance');
    Route::post('/my_schedule/{schedule}/attendance', 'HomeController@attendanceHandle')->name('my_schedule.attendance_handle');
    Route::get('/my_schedule/{schedule}/attendance/edit', 'HomeController@attendanceEdit')->name('my_schedule.attendance_edit');
    Route::post('/my_schedule/{schedule}/attendance/edit', 'HomeController@attendanceEditHandle')->name('my_schedule.attendance_edit_handle');
    Route::get('/my_course/{course}/grading', 'HomeController@gradeCourse')->name('my_course.grade');
    Route::post('/my_course/{course}/grading', 'HomeController@gradeCourseHandle')->name('my_course.grade_handle');
    Route::get('/my_course/{schedule}/attendance_view', 'HomeController@attendanceView')->name('my_course.attendance_view');
    Route::get('/my_course/{course}/add_test', 'ExamController@create')->name('my_course.add_test_view');
    Route::post('/my_course/add_test', 'ExamController@store')->name('my_course.add_test');
    Route::resource('/tests', 'TestController', ['except' => ['index']]);
});

Route::group(['middleware' => ['auth', 'block']], function(){
    // Route::get('/', 'HomeController@index')->name('index');
    Route::get('/', 'HomeController@myCourse')->name('my_course.list');
    Route::get('/my_course/{course}', 'HomeController@showCourse')->name('my_course.show');
    Route::get('/tests', 'TestController@index')->name('tests.index');
    Route::get('/my_course/test/{courseTest}', 'ExamController@show')->name('my_course.course_test');
    Route::get('/my_course/test/{courseTest}/delete', 'ExamController@destroy')->name('my_course.course_test_delete');
    Route::post('/my_course/test/{courseTest}/submit', 'ExamController@submit')->name('my_course.course_test_submit');
    Route::get('/my_course/test/{courseTest}/result', 'ExamController@result')->name('my_course.course_test_result');
    Route::get('/my_schedule', 'HomeController@mySchedule')->name('my_schedule.list');
    Route::get('profile/edit_password', 'ProfileController@editPassword')->name('profile.edit_password');
    Route::post('profile/edit_password', 'ProfileController@updatePassword')->name('profile.update_password');
    Route::post('profile/update_avatar', 'ProfileController@updateAvatar')->name('profile.update_avatar');
    Route::resource('profile', 'ProfileController');
    Route::get('{user}/info', 'ProfileController@info')->name('info');
});
Route::group(['middleware' => ['auth', 'block', 'role:admin']], function(){
    Route::get('export/course_grade/{course}', 'ExportDataController@exportGrades')->name('export.course_grade')->middleware(['role:trainer']);
    Route::get('export/static_grade', 'ExportDataController@exportStaticGrades')->name('export.static_grade');
});

