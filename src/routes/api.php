<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'articles'], function () {
    // 記事一覧取得
    Route::get('/', 'Api\ArticlesController@index');
    // 記事投稿
    Route::post('/', 'Api\ArticlesController@store');
    // 記事詳細取得
    Route::get('/{id}', 'Api\ArticlesController@show');
    // 編集用記事取得
    Route::get('edit/{id}', 'Api\ArticlesController@edit');
    // 記事更新
    Route::put('/{id}', 'Api\ArticlesController@update');
    // 記事検索結果取得
    Route::get('/search/{freeword}', 'Api\ArticlesController@search');
});
