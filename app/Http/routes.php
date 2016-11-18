<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});


//前端路由
Route::group(['prefix'=>'home','namespace'=>'Home'],function(){
	//登录
	Route::get('login','userController@login');
	Route::post('login','userController@login');

	//注册
	Route::get('register','userController@register');
	Route::post('register','userController@register');

	//用户中心
	Route::get('/','indexController@index');
	Route::get('/user','userController@index');

	//发送邮件
	Route::get('mail/send','mailController@send');


	Route::get('/ball','ballController@index');
	Route::get('/ball/getRand','ballController@getRand');
});

//获取验证码图形html
Route::get('/getCaptcha','CaptchaController@getCaptchaImg');
Route::get('/getCaptchaSrc','CaptchaController@getCaptchaSrc');
Route::get('/verifyCaptcha','CaptchaController@verifyCaptcha');

//后端路由
Route::group(['prefix'=>'admin','namespace'=>'Admin','middleware' => 'auth'],function(){
	//登录
	Route::get('login','LoginController@login')->name('login');
	Route::post('doLogin','LoginController@handleLgoin');
	Route::match(['get', 'post'],'loginout','LoginController@loginOut');

	//初始化超级管理员
	// Route::get('InitializationAdmin','LoginController@register');//系统建好以后就不用了

	//注册
	Route::get('register','userController@register');
	Route::post('register','userController@register');

	//后台首页
	Route::get('index','IndexController@Index');


	//用户中心
	Route::get('/','userController@index');
	Route::get('/user','userController@index');

	//发送邮件
	Route::get('mail/send','mailController@send');


	Route::get('/ball','ballController@index');
	Route::get('/ball/getRand','ballController@getRand');
});


