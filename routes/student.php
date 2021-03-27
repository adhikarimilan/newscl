<?php
Route::group(['prefix'=>'student'],function(){

    Route::get('login', 'Student\Auth\LoginController@showLoginForm')->name('student.login');
	Route::post('login', 'Student\Auth\LoginController@login')->name('student.login.post');
	Route::get('logout', 'Student\Auth\LoginController@logout')->name('student.logout');

    

    Route::group(['middleware'=>['studentauth']],function(){

        Route::group(['prefix'=>'dashboard'],function(){
            Route::get('/', 'Student\DashboardController@index')->name('student.dashboard');
        });

        Route::group(['prefix'=>'profile'],function(){
            Route::get('/', 'Student\DashboardController@profile')->name('student.profile');
            Route::get('/{id}/edit', 'Student\DashboardController@edit')->name('student.profile.edit');
            Route::put('/{id}/update', 'Student\DashboardController@update')->name('student.profile.update');
        });
        Route::get('student/{id}','Student\DashboardController@student')->name('student.student.view');
        Route::get('assignment/{id}','Student\DashboardController@assignment')->name('student.assignment.view');
        Route::get('assignments','Student\DashboardController@studentassignments')->name('student.assignments');
        Route::get('bookissues','Student\DashboardController@bookissues')->name('student.bookissues');
        Route::get('studentattendance','Student\DashboardController@stdattendance')->name('student.stdattendance.view');
    });

});