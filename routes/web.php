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

Route::get('/', 'MainController@index');

Route::post('/', 'MainController@submit');

Route::get('/submission/{id}', 'SubmissionsController@show');

Route::post('/submission/{id}', 'SubmissionsController@reply');

Route::get('/api/vote/{id}/upvote', 'MainController@upvote');

Route::get('/api/vote/{id}/downvote', 'MainController@downvote');