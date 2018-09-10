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

Route::any('getHotCoin', 'Home\AjaxController@getHotCoin');
Route::any('getJsonMenu', 'Home\AjaxController@getJsonMenu');
Route::any('trends', 'Home\AjaxController@trends');
Route::any('allcoin', 'Home\AjaxController@allcoin');
Route::any('allfinance', 'Home\AjaxController@allfinance');
Route::any('Article/notice', 'Home\ArticleController@notice');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
