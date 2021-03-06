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
Route::prefix('login')->name('login.')->group(function(){
    //{provider}には利用するプロバイダ名が入る。今回はgoogleが入る
    //他サービスを利用することを想定しているため{provider}としている
    Route::get('/{provider}', 'Auth\LoginController@redirectToProvider')->name('{provider}');
    //認証後にプロバイダーからのコールバックを受けるルート
    Route::get('/{provider}/callback', 'Auth\LoginController@handleProviderCallback')->name('{provider}.callback');
});
Route::prefix('register')->name('register.')->group(function(){
    Route::get('/{provider}', 'Auth\RegisterController@showProviderUserRegistrationForm')->name('{provider}');
    Route::post('/{provider}', 'Auth\RegisterController@registerProviderUser')->name('{provider}');
});

Route::get('/', 'ArticleController@index')->name('articles.index');
//middlewareを使い、未ログインユーザーのurl直打ちでの遷移を拒否している
Route::resource('/articles', 'ArticleController')->except(['index', 'show'])->middleware('auth');
Route::resource('/articles', 'ArticleController')->only(['show']);
Route::get('/search', 'ArticleController@search')->name('articles.search');
//prefixメソッドは引数として渡した文字列をURIの先頭につける
Route::prefix('articles')->name('articles.')->group(function(){
    Route::put('/{article}/like', 'ArticleController@like')->name('like')->middleware('auth');
    Route::delete('/{article}/like', 'ArticleController@unlike')->name('unlike')->middleware('auth');
    Route::get('/{artilce}/map', 'ArticleController@map')->name('map');
    Route::put('/{article}/join', 'ArticleController@join')->name('join')->middleware('auth');
    Route::delete('/{article}/join', 'ArticleController@notJoin')->name('notJoin')->middleware('auth');
    Route::get('/{article}/member', 'ArticleController@member')->name('member');
});
//URLでlocalhost/tag/PHPのようにtagの名前が入る形式にするため{name}となる
Route::get('/tags/{name}', 'TagController@show')->name('tags.show');
Route::prefix('users')->name('users.')->group(function(){
    Route::get('/{name}', 'UserController@show')->name('show');
    Route::get('/{name}/likes', 'UserController@likes')->name('likes');
    Route::get('/{name}/joins', 'UserController@joins')->name('joins');
    Route::get('/{name}/followings', 'UserController@followings')->name('followings');
    Route::get('/{name}/followers', 'UserController@followers')->name('followers');
    Route::middleware('auth')->group(function(){
        Route::get('/{name}/edit', 'UserController@edit')->name('edit');
        Route::put('/{name}', 'UserController@update')->name('update');
        Route::put('/{name}/follow', 'UserController@follow')->name('follow');
        Route::delete('/{name}/follow', 'UserController@unfollow')->name('unfollow');
    });
});
Route::resource('comment', 'CommentController')->only(['store']);
Route::get('/genres/{name}', 'GenreController@show')->name('genres.show');
Route::get('/prefectures/{name}', 'PrefectureController@show')->name('prefectures.show');
// Route::get('/search', 'SearchController@show')->name('search.show');
