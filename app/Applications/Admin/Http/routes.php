<?php

Route::auth();

Route::get('/', function () {
    return redirect()->route('admin.login');
});

Route::middleware('auth')->group(function() {

    Route::get('/login', 'Auth\LoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\LoginController@login')->name('admin.login.submit');

    Route::get('/dashboard', 'DashboardController@index')->name('admin.dashboard');

    Route::resource('users','UserController');

    Route::get('roles', 'RoleController@index')->middleware('permission:role-list|role-create|role-edit|role-delete')->name('roles.index');
    Route::get('roles/create', 'RoleController@create')->middleware('permission:role-create')->name('roles.create');
    Route::post('roles/create', 'RoleController@store')->middleware('permission:role-create')->name('roles.store');
    Route::get('roles/{id}', 'RoleController@show')->name('roles.show');
    Route::get('roles/{id}/edit', 'RoleController@edit')->middleware('permission:role-edit')->name('roles.edit');
    Route::patch('roles/{id}', 'RoleController@update')->middleware('permission:role-edit')->name('roles.update');
    Route::delete('roles/{id}', 'RoleController@destroy')->middleware('permission:role-delete')->name('roles.destroy');

});

