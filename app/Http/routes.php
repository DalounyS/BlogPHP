<?php

// Sécurisé les paramètres variables des routes
Route::pattern('id','[0-9]+');

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

Route::get('/','FrontController@index');
Route::get('article/{id}','FrontController@show'); // show($id)
Route::get('categories/{id}','FrontController@show'); // show($id)
Route::get('user/{id}','FrontController@showPostByUser'); // show($id)
Route::get('category/{id}','FrontController@showCategory'); // show($id)
Route::get('tag/{id}','FrontController@showTag'); // show($id)


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
    Route::any('login','LoginController@login');
    Route::get('logout', 'LoginController@logout');

    Route::group(['middleware' => ['auth']], function () {
        Route::resource('post','PostController');
        Route::get('changeStatus/{id}', 'PostController@changeStatus');
    });

    /*Route::get('test', function(){

        session()->put('test', 'test');



    });

    Route::get('test2', function(){

        dd(session()->get('test'));



    });*/

});

