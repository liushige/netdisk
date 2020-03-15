<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

//后台登录路由
Route::get('admin/login','Admin\LoginController@login');

//后台验证码路由
Route::get('admin/code','Admin\LoginController@code');

//处理后台登录的路由
Route::post('admin/dologin','Admin\LoginController@doLogin');

//加密路由lock
Route::get('admin/encrypt','Admin\LoginController@lock');

//后台首页路由
Route::get('admin/index','Admin\LoginController@index');

//后台欢迎页路由
Route::get('admin/welcome','Admin\LoginController@welcome');

//后台退出登录路由
Route::get('admin/logout','Admin\LoginController@logout');