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
Auth::routes();

Route::get('/', 'ArticleController@index')->name('articles.index');
//middlewareを使い、未ログインユーザーのurl直打ちでの遷移を拒否している
Route::resource('/articles', 'ArticleController')->except(['index'])->middleware('auth');