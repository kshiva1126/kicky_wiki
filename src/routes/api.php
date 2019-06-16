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
    Route::get('/{article}', 'Api\ArticlesController@show');
    // 記事更新
    Route::put('/{article}', 'Api\ArticlesController@update');
    // 記事検索結果取得
    Route::get('/search/{freeword}', 'Api\ArticlesController@search');
});
