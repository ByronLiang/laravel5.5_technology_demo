<?php
/**
 * 前台路由，默认路由，无前缀
 */
Route::group(['middleware' => 'auth:web'], function () {

});

Route::get('new_test', 'TestController@index');
Route::get('cache', 'HomeController@cacheOption');

Route::group(['middleware' => ['spa:webapp']], function () {
	Route::group(['namespace' => 'My'], function () {
		Route::get('profile', 'MyController@getProfile');
	});
	Route::post('login', 'AuthController@postLogin');
	Route::get('logout', 'AuthController@logout');
	Route::post('register', 'AuthController@postRegister');
	Route::resource('home', 'HomeController');
	Route::group(['middleware' => 'auth:web'], function () {
		Route::get('chat_info', 'ChatController@fetchChatRoomInfo');
		Route::get('pay_order', 'ChatController@finishedPay');
		Route::resource('message', 'ChatController');
	});
	Route::get('test', 'HomeController@test');
	Route::view('{capture?}', 'webapp')->where(['capture' => '.*']);
});
