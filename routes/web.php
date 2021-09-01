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

// Route::get('/', function () {
//     return view('front.welcome');
// })->name('welcome');

Route::get('/contact', function () {
    return view('front.contact');
})->name('contact');

Route::get('/','Front\FrontendController@index')->name('welcome');
Route::get('events','Front\FrontendController@events')->name('events');

Route::get('events/{id}','Front\FrontendController@singleevent')->name('singleevent');
Route::get('downloads','Front\FrontendController@downloads')->name('downloads');
Route::get('gallery','Front\FrontendController@gallery')->name('gallery');
Route::post('/savemsg','Front\FrontendController@savemessage')->name('savemsg');

Route::get('/help/{id?}', function ($id='') {
    return "<h2 style=\"text-align:center;\">help".$id."</h2>";
});


// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
// Route::get('/class', function () {
//     $class= new Stdclass;
//     $class->name="test class";
//     $class->description="test desc";
//     $class->shift="morning";
//     $class->save();
// });

// Route::get('test', function () {
//     return view('back.admin.dashboard');
// });

require('admin.php');
require('teacher.php');
require('parent.php');
require('student.php');