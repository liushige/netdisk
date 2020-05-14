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


//后台模块
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
Route::group(['prefix'=>'admin','namespace'=>'Admin','middleware'=>['isLogin','isPermission']],function(){
    //后台首页模块路由
    Route::get('index','LoginController@index');
    //后台欢迎页路由
    Route::get('welcome','LoginController@welcome');

    //后台用户模块路由
    Route::get('user/{id}/auth','UserController@auth');
    Route::post('user/doauth','UserController@doAuth');
    Route::get('user/del','UserController@delAll');
    Route::resource('user','UserController');

    //后台角色模块路由
    Route::get('role/{id}/auth','RoleController@auth');
    Route::post('role/doauth','RoleController@doAuth');
    Route::get('role/del','RoleController@delAll');
    Route::resource('role','RoleController');

    //后台权限模块路由
    Route::get('permission/del','PermissionController@delAll');
    Route::resource('permission','PermissionController');

});
//中间件IsPermission访问无效提示页面
    Route::get('admin/noaccess','Admin\LoginController@noAccess');
//后台退出登录路由
    Route::get('admin/logout','Admin\LoginController@logout');
//后台unicode图标参考路由
Route::get('admin/unicode','Admin\LoginController@unicode');




//前台模块
//前台VIP用户模块路由
Route::get('vip/vipUser/del','Vip\VipController@delAll');
Route::resource('vip/vipUser','Vip\VipController');

//前台登录路由
Route::get('vip/login','Vip\LoginController@login');
Route::post('vip/dologin','Vip\LoginController@doLogin');
Route::get('vip/logout','Vip\LoginController@logout');

//前台vip密码找回
Route::get('vip/forget','Vip\RegisterController@forget');
//密码找回处理
Route::post('vip/doforget','Vip\RegisterController@doforget');
//重置密码
Route::get('vip/reset','Vip\RegisterController@reset');
//重置密码处理
Route::post('vip/doreset','Vip\RegisterController@doreset');

//手机号码注册
Route::get('vip/phoneregister','Vip\RegisterController@phoneReg');
//发送手机验证码处理
Route::get('vip/sendcode','Vip\RegisterController@sendCode');
Route::post('vip/dophoneregister','Vip\RegisterController@doPhoneRegister');

//邮箱注册激活路由
Route::get('vip/emailregister','Vip\RegisterController@register');
Route::post('vip/doregister','Vip\RegisterController@doRegister');
Route::get('vip/active','Vip\RegisterController@active');

//前台首页
Route::get('vip/index','Vip\IndexController@index')->name('index');
Route::get('vip/welcome','Vip\IndexController@welcome');

//前台文件夹路由模块
Route::resource('vip/folder','Vip\FolderController');
Route::get('vip/folder/{folder}/create','Vip\FolderController@folderCreate');
Route::post('vip/folder/{folder}/store','Vip\FolderController@folderStore');