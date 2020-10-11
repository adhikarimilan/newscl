<?php
Route::group(['prefix'=>'parent'],function(){

    Route::get('login', 'Parent\Auth\LoginController@showLoginForm')->name('parent.login');
	Route::post('login', 'Parent\Auth\LoginController@login')->name('parent.login.post');
	Route::get('logout', 'Parent\Auth\LoginController@logout')->name('parent.logout');

    

    Route::group(['middleware'=>['parentauth']],function(){

        Route::group(['prefix'=>'dashboard'],function(){
            Route::get('/', 'Parent\DashboardController@index')->name('parent.dashboard');
        });

        Route::group(['prefix'=>'profile'],function(){
            Route::get('/', 'Parent\DashboardController@profile')->name('parent.profile');
            Route::get('/{id}/edit', 'Parent\DashboardController@edit')->name('parent.profile.edit');
            Route::put('/{id}/update', 'Parent\DashboardController@update')->name('parent.profile.update');
        });
        Route::get('student/{id}','Parent\DashboardController@student')->name('parent.student.view');
        Route::get('assignment/{id}','Parent\DashboardController@assignment')->name('parent.assignment.view');
        Route::get('studentassignment/{id}','Parent\DashboardController@studentassignments')->name('parent.stdassignments.view');
        Route::get('studentattendance','Parent\DashboardController@stdattendance')->name('parent.stdattendance.view');
    });

});