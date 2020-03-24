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

//Route::get('/', function () {
//    return view('welcome');
//});


//无需中间件配置组
Route::group(['prefix'=>'admin','namespace'=>'Admin'],function(){
    //后台登录路由
    Route::get('login','LoginController@login');

    //后台验证码路由
    Route::get('code','LoginController@code');

    //处理后台登录的路由
    Route::post('dologin','LoginController@doLogin');

    //加密路由lock
    Route::get('encrypt','LoginController@lock');
});


//配置中间件，路由分组
Route::group(['prefix'=>'admin','namespace'=>'Admin','middleware'=>'isLogin'],function(){
    //后台首页路由
    Route::get('index','LoginController@index');

    //后台欢迎页路由
    Route::get('welcome','LoginController@welcome');

    //后台退出登录路由
    Route::get('logout','LoginController@logout');

    //后台用户相关路由模块
    Route::get('user/del','UserController@delAll');
    Route::resource('user','UserController');

    //后台角色模块路由
    Route::get('role/{id}/auth','RoleController@auth');
    Route::post('role/doauth','RoleController@doAuth');
    Route::get('role/del','RoleController@delAll');
    Route::resource('role','RoleController');
});

