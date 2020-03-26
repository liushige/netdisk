<?php

namespace App\Http\Middleware;

use Closure;
use App\Model\User;
use App\Model\Role;
use App\Model\Permission;

class IsPermission
{
    /**
     * 处理用户：根据用户是否有权限取得某些路由酌情操作.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
//        1.获取当前请求路由的控制器及方法，即Route::get('role/{id}/auth','RoleController@auth');的Action部分
        $url = \Route::current()->getActionName();
//        2.获取当前用户拥有的所有权限
        $user = User::find(session()->get('user')->user_id);
        $roles = $user->role;
//        $pres放用户拥有所有权限的url集合(可能存在重复权限)
        $pres = [];
        foreach ($roles as $v){
            $ps = $v->permission;
            foreach ($ps as $p){
                $pres[] = $p->pre_url;
            }
        }
//        3.权限去重
        $pres = array_unique($pres);
//        4.根据当前用户是否拥有对当前页面访问的权限给予合理操作
        if(in_array($url,$pres)){
            //满足条件，给予权限
            return $next($request);
        }else{
            return redirect('noaccess');
        }
//        5.


    }
}
