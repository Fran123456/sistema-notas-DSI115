<?php

use App\Role;
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

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/*USERS*/
//
Route::resource('users', 'User\UserController');
Route::get('user/update/password/{id}', 'User\UserController@updatePassword')->name('updatePassword');
Route::post('user/save/password/{id}', 'User\UserController@savePassword')->name('savePassword');
Route::get('user/active/{id}', 'User\UserController@changeStatus')->name('changeStatus');
//
/*USERS*/


/*ROLES*/
//
Route::resource('roles', 'Role\RoleController');
//
/*ROLES*/

/*RUTAS DEMO*/
Route::get('secretary', 'User\UserController@demoSecretary')->name('secretaryurl');
Route::get('teacher', 'User\UserController@demoTeacher')->name('teacherurl');
Route::get('administrator', 'User\UserController@demoAdmin')->name('adminurl');
/*RUTAS DEMO*/


/*DEGREES*/
Route::resource('degrees', 'Degree\DegreeController');
Route::post('degree/update/{id}', 'Degree\DegreeController@update')->name('degree_update');
Route::get('degree/active/{id}', 'Degree\DegreeController@changeStatusDegree')->name('changeStatusDegree');


/*DEGREES*/


/*SCHOOL YEAR*/
Route::resource('years', 'SchoolYear\SchoolYearController');
Route::get('year/teacher/grade/{id}', 'SchoolYear\SchoolYearController@createYearTeacher')->name('teacher-grade');
Route::post('year/teacher/grade/store', 'SchoolYear\SchoolYearController@storeYearTeacher')->name('storeYearTeacher');
Route::get('year/active/{id}', 'SchoolYear\SchoolYearController@changeStatusSchoolYear')->name('changeStatusSchoolYear');

/*SCHOOL YEAR*/
