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



Auth::routes(['register' => false, 'reset' => false]);

Route::group(['prefix'=>'admin','as'=>'admin.', 'middleware' => ['auth']], function(){
    Route::get('home', 'Admin\HomeController@index')->name('index');
    Route::resource('/campuses', 'Admin\CampusController');
    Route::resource('/users', 'Admin\UserController');
    Route::resource('/categories', 'Admin\CategoryController');
    Route::resource('/subjects', 'Admin\SubjectController');
    Route::resource('/semesters', 'Admin\SemesterController');
    Route::resource('/classes', 'Admin\ClassController');
    Route::resource('/shifts', 'Admin\ShiftController');
    Route::resource('/locations', 'Admin\LocationController');
    Route::resource('/schedules', 'Admin\ScheduleController');
    Route::resource('/Courses', 'Admin\CourseController');
});

Route::group(['middleware' => ['auth']], function(){
    Route::get('/', 'HomeController@index')->name('index');
    Route::resource('profile', 'Admin\CourseController');
});