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

Auth::routes();

Route::get('/home', array(
	'as'=>'home',
	'uses'=>'HomeController@index'
));

//Video Routes
Route::get('/create-video', array(
	'as'=>'createVideo',
	'middleware'=>'auth',
	'uses'=>'VideoController@createVideo'
));

Route::post('/save-video', array(
	'as'=>'saveVideo',
	'middleware'=>'auth',
	'uses'=>'VideoController@saveVideo'
));

Route::get('/thumbnail/{filename}', array(
	'as'=>'imageVideo',
	'uses'=>'VideoController@getImage'
));

Route::get('/video/{video_id}', array(
	'as'=>'detailVideo',
	'uses'=>'VideoController@getVideoDetail'
));

Route::get('/video-file/{filename}', array(
	'as'=>'fileVideo',
	'uses'=>'VideoController@getVideo'
));

Route::get('/delete-video/{video_id}', array(
	'as'=>'videoEdit',
	'middleware'=>'auth',
	'uses'=>'VideoController@edit'
));

Route::get('/edit-video/{video_id}', array(
	'as'=>'videoEdit',
	'middleware'=>'auth',
	'uses'=>'VideoController@edit'
));

//Comments
Route::post('/comment', array(
	'as'=>'comment',
	'middleware'=>'auth',
	'uses'=>'CommentController@store'
));

Route::get('/delete-comment/{comment_id}', array(
	'as'=>'commentDelete',
	'middleware'=>'auth',
	'uses'=>'CommentController@delete'
));

