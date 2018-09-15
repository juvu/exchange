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

Route::get('/', 'Home\IndexController@index');

Route::get('/test', 'TestController@index');

//获取热门币种
Route::any('getHotCoin', 'Home\AjaxController@getHotCoin');
//获取币种菜单
Route::any('getJsonMenu', 'Home\AjaxController@getJsonMenu');
//3日趋势
Route::any('trends', 'Home\AjaxController@trends');
//所有币种信息
Route::any('allcoin', 'Home\AjaxController@allcoin');
//资产汇总
Route::any('allfinance', 'Home\AjaxController@allfinance');
//首页通知
Route::any('Article/notice', 'Home\ArticleController@notice');

