<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/admin', ['as' => 'adminhomepage', 'uses' => 'adminPageController@index']);

    Route::resource('/admin/post', 'adminPostController');

    Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);
    Route::get('/blog/{slug}', ['as' => 'blogshow', 'uses' => 'HomeController@show']);
    Route::get('/about', ['as' => 'about', 'uses' => 'HomeController@about']);
    Route::get('/contact', ['as' => 'contact', 'uses' => 'HomeController@contact']);
    Route::post('/contact', ['as' => 'sendcontact', 'uses' => 'HomeController@sendContact']);
});
