<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


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


//トップ画面の表示
Auth::routes();


Route::get('/', 'TopController@show_top')->name('Top');

Route::get('/home', 'TopController@show_top')->name('user_top');

Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/error_menu/{languages_id}', 'ErrorController@error_text')->name('error_menu');
Route::post('/error_menu/{languages_id}', 'ErrorController@error_save')->name('error_save');

Route::get('/error_menu/{languages_id}/{error_id}', 'AnswerController@answer_text')->name('answer_menu');
Route::post('/error_menu/{languages_id}/{error_id}', 'AnswerController@answer_save')->name('answer_save');

Route::get('/good/error_menu/{answer_id}', 'AnswerController@good')->name('good');
Route::get('/ungood/error_menu/{answer_id}', 'AnswerController@ungood')->name('ungood');

