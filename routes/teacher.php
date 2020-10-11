<?php
Route::group(['prefix'=>'teacher'],function(){

    Route::get('login', 'Teacher\Auth\LoginController@showLoginForm')->name('teacher.login');
	Route::post('login', 'Teacher\Auth\LoginController@login')->name('teacher.login.post');
	Route::get('logout', 'Teacher\Auth\LoginController@logout')->name('teacher.logout');

    
    Route::group(['prefix'=>'password'],function(){
        Route::get('reset', 'Teacher\Auth\ForgotPasswordController@showLinkRequestForm');
        Route::post('email', 'Teacher\Auth\ForgotPasswordController@sendResetLinkEmail')->name('teacherpassword.reset');
        Route::get('reset/{token}', 'Teacher\Auth\ResetPasswordController@showResetForm')->name('teacherpass.reset');
        Route::post('reset', 'Teacher\Auth\ResetPasswordController@reset')->name('teacherpasswordreset');
    });

    Route::group(['middleware'=>['teacherauth']],function(){

        Route::group(['prefix'=>'dashboard'],function(){
            Route::get('/', 'Teacher\DashboardController@index')->name('teacher.dashboard');
        });
        Route::get('library/dashboard','Teacher\DashboardController@libindex')->name('teacher.library.dashboard');
        Route::group(['prefix'=>'profile'],function(){
            Route::get('/', 'Teacher\DashboardController@profile')->name('teacher.profile');
            Route::get('/{id}/edit', 'Teacher\DashboardController@edit')->name('teacher.profile.edit');
            Route::post('/{id}/update', 'Teacher\DashboardController@update')->name('teacher.profile.update');
        });
        
        Route::resource('books', 'Teacher\BookController',[
            'as'=>'teacher'
        ]);
        Route::resource('bookcategories', 'Teacher\BookcategoriesController',[
            'as'=>'teacher'
        ]);
        Route::resource('bookissues', 'Teacher\IssueBooksController',[
            'as'=>'teacher'
        ]);

        Route::resource('assignments', 'Teacher\AssignmentController',[
            'as'=>'teacher'
        ]);

        Route::resource('classes', 'Teacher\StdclassController',[
            'as'=>'teacher'
        ]);
        Route::post('getsection', 'Teacher\StdclassController@getsections')->name('teacher.classes.getsections');
        Route::post('getstudent', 'Teacher\StdclassController@getstudents')->name('teacher.classes.getstudents');
        Route::resource('teachers', 'Teacher\TeacherController',[
            'as'=>'teacher'
        ]);
        Route::resource('parents', 'Teacher\StdparentController',[
            'as'=>'teacher'
        ]);
        Route::post('addstudent', 'Teacher\StdparentController@addstd',[
            'as'=>'teacher'
        ])->name('teacher.parents.updatechildren');
        Route::resource('students', 'Teacher\StudentController',[
            'as'=>'teacher'
        ]);
        Route::post('getduesstudent', 'Teacher\StudentController@getdues')->name('teacher.students.getdues');
        Route::resource('studentattendances','Teacher\StudentattendanceController',[
            'as'=>'teacher'
        ]);
        Route::group(['prefix'=>'studentattendances'],function(){
            Route::get('/{$date}/edit', 'Teacher\StudentattendanceController@edit')->name('teacher.studentattendances.edit');
        });
    });

});