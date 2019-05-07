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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/article', 'ArticleController@index');
Route::get('/article/{articleId}', 'ArticleController@show');
Route::post('/article/create', 'ArticleController@store');
Route::put('/article/{articleId}', 'ArticleController@update');
Route::delete('/article/{articleId}', 'ArticleController@destroy');

Route::get('/category', 'CategoryController@index');
Route::get('/category/{categoryId}', 'CategoryController@show');
Route::post('/category/create', 'CategoryController@store');
Route::put('/category/{categoryId}', 'CategoryController@update');
Route::delete('/category/{categoryId}', 'CategoryController@destroy');