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
 
    return view('welcome');
});

/* All the none Guest routes should be protected by this middleware */
Route::group(['prefix' => 'domain'], function() {
      Route::get('/', ['as' => 'create',
            'uses' => '\App\Http\Controllers\CrudController@index']
    );
          Route::get('/list', ['as' => 'create',
            'uses' => '\App\Http\Controllers\CrudController@getDomainsList']
    );
    Route::post('create', ['as' => 'create',
            'uses' => '\App\Http\Controllers\CrudController@createDomain']
    );
});
Route::group(['prefix' => 'page'], function() {
      Route::get('/', ['as' => 'create',
            'uses' => '\App\Http\Controllers\CrudController@getPage']
    );
    Route::post('create', ['as' => 'create',
            'uses' => '\App\Http\Controllers\CrudController@createPage']
    );
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
