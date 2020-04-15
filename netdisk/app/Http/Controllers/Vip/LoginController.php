<?php

namespace App\Http\Controllers\Vip;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Vip;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
//use Illuminate\Support\Facades\Input;

class LoginController extends Controller
{
//    获取前台会员登录页面
        public function login(){
            return view('vip.login');
        }

//        处理前台登录逻辑
         public function dologin(Request $request){
             $input = $request->except('_token','wp-submit');
//        dd($input);
             $username = $input['user_name'];
             $password = $input['user_pass'];
//        $token = md5(uniqid(rand(), TRUE));
             $timeout = time() + 60*60*24*7;

             if(isset($input['rememberme'])){
                 setcookie('username', "$username", $timeout);
                 setcookie('password', "$password", $timeout);
             }else{
                 setcookie('username', "", time()-1);
                 setcookie('password', "",time()-1);
             }


//        3. 验证用户是否存在

             $user = Vip::where('user_name',$input['user_name'])->first();
             if(empty($user)){
                 return redirect('vip/login')->with('errors','用户名不存在');
             }



//        4. 密码是否正确
             if($input['user_pass'] !=  Crypt::decrypt($user->user_pass) ){
                 return redirect('vip/login')->with('errors','密码错误');
             }

             //如果登录成功，将登录用户信息保存到session中

             session()->put('vip',$user);

             return redirect('vip/index');
         }

}
