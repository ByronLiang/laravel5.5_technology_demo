<?php
/**
 * 前台路由，默认路由，无前缀
 */
Route::group(['middleware' => 'auth:web'], function () {
});

Route::get('home', 'HomeController@index');
