<?php
Route::group(['prefix'=>'admin'],function(){

    Route::get('login', 'Admin\Auth\LoginController@showLoginForm')->name('admin.login');
	Route::post('login', 'Admin\Auth\LoginController@login')->name('admin.login.post');
	Route::get('logout', 'Admin\Auth\LoginController@logout')->name('admin.logout');

    
    Route::group(['prefix'=>'password'],function(){
        Route::get('reset', 'Admin\Auth\ForgotPasswordController@showLinkRequestForm');
        Route::post('email', 'Admin\Auth\ForgotPasswordController@sendResetLinkEmail')->name('adminpassword.reset');
        Route::get('reset/{token}', 'Admin\Auth\ResetPasswordController@showResetForm');
        Route::post('reset', 'Admin\Auth\ResetPasswordController@reset')->name('adminpasswordreset');
    });

    Route::group(['middleware'=>['adminauth']],function(){

        Route::group(['prefix'=>'dashboard'],function(){
            Route::get('/', 'Admin\DashboardController@index')->name('admin.dashboard');
        });

        Route::group(['prefix'=>'profile'],function(){
            Route::get('/', 'Admin\DashboardController@profile')->name('admin.profile');
            Route::get('/{id}/edit', 'Admin\DashboardController@edit')->name('admin.profile.edit');
            Route::post('/{id}/update', 'Admin\DashboardController@update')->name('admin.profile.update');
        });
        Route::get('/users', 'Admin\DashboardController@allusers')->name('admin.users');
        Route::get('/users/create', 'Admin\DashboardController@createuser')->name('admin.users.create');
        Route::post('/users/create', 'Admin\DashboardController@storeuser')->name('admin.users.store');
        Route::delete('/users/{id}', 'Admin\DashboardController@deluser')->name('admin.users.destroy');
        
        Route::resource('classes', 'StdclassController');
        Route::post('getsection', 'StdclassController@getsections')->name('classes.getsections');
        Route::post('getstudent', 'StdclassController@getstudents')->name('classes.getstudents');
        Route::resource('teachers', 'TeacherController');
        Route::resource('parents', 'StdparentController');
        Route::post('addstudent', 'StdparentController@addstd')->name('parents.updatechildren');
        Route::resource('students', 'StudentController');
        Route::post('getduesstudent', 'StudentController@getdues')->name('students.getdues');
        Route::resource('results', 'ResultController');
         Route::resource('teacherattendances', 'TeacherattendanceController');
        Route::resource('studentattendances', 'StudentattendanceController');
        Route::resource('books', 'BookController');
        Route::resource('bookcategories', 'BookcategoriesController');
        Route::resource('bookissues', 'IssueBooksController');
        Route::resource('events', 'SchooleventController');
         Route::group(['prefix'=>'teacherattendances'],function(){
            //Route::get('/', 'TeacherController@takeattendance')->name('teacherattendances.index');
            Route::get('/{$date}/edit', 'TeacherattendanceController@edit')->name('teacherattendances.edit');
        });
        Route::group(['prefix'=>'studentattendances'],function(){
            Route::get('/{$date}/edit', 'StudentattendanceController@edit')->name('studentattendances.edit');
        });
        Route::get('assignments/{id}', 'AssignmentController@show')->name('assignments.show');
        Route::get('assignments', 'AssignmentController@index')->name('assignments.index');

        Route::get('contact-details',[
            'as' => 'admin.contact',
            'uses' => 'ContactController@index'
        ]);
        Route::get('contact-details/edit',[
            'as' => 'admin.editcontact',
            'uses' => 'ContactController@edit'
        ]);
        Route::post('contact-details/update',[
            'as' => 'admin.updatecontact',
            'uses' => 'ContactController@update'
        ]);

        Route::get('message',[
            'as' => 'admin.message',
            'uses' => 'MessageController@index'
        ]);
        Route::get('message/{id}',[
            'as' => 'admin.message.view',
            'uses' => 'MessageController@show'
        ]);
        Route::delete('message/{id}',[
            'as' => 'admin.message.delete',
            'uses' => 'MessageController@destroy'
        ]);
    });
});