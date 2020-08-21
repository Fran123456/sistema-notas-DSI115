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
Route::resource('users', 'User\UserController');
Route::get('user/update/password/{id}', 'User\UserController@updatePassword')->name('updatePassword');
Route::post('user/save/password/{id}', 'User\UserController@savePassword')->name('savePassword');
Route::get('user/active/{id}', 'User\UserController@cambiarEstado')->name('cambiarEstado');
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