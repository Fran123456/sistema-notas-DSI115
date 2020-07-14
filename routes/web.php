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

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/*USERS*/
//
Route::resource('users', 'User\userController');
Route::get('user/update/password/{id}', 'User\userController@updatePassword')->name('updatePassword');
Route::post('user/save/password/{id}', 'User\userController@savePassword')->name('savePassword');
//
/*USERS*/


/*ROLES*/
//
Route::resource('roles', 'Role\RoleController');
//
/*ROLES*/

/*RUTAS DEMO*/
Route::get('secretary', 'User\userController@demoSecretary')->name('secretaryurl');
Route::get('teacher', 'User\userController@demoTeacher')->name('teacherurl');
Route::get('administrator', 'User\userController@demoAdmin')->name('adminurl');