<?php

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
    return redirect('login');
});

Auth::routes();

Route::group(['middleware' => ['auth.admin']], function () {
    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/admin/add-user', 'HomeController@addUser');
    Route::post('/admin/create-user', 'HomeController@createUser');

    Route::get('/admin/edit-user/{id}', 'HomeController@showEditUser');
    Route::post('/admin/update-user/{id}', 'HomeController@updateUser');

    Route::get('/admin/delete-user/{id}', 'HomeController@deleteUser');

    Route::get('/admin/profile', 'HomeController@showProfile');
    Route::post('/admin/update_profile', 'HomeController@updateProfile')->name('update');
});
