<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\User;
use Illuminate\Http\Request;
use App\Org\code\Code;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;

class LoginController extends Controller
{
    //返回后台登录页面
    public function login()
    {
        return view('admin.login');
    }

    //返回验证码
    public function code()
    {
        $code = new Code();
        return $code->make();
    }

    //处理用户登录方法（后台表单验证）
    public function doLogin(Request $request)
    {
//        1.接受表单提交的数据
        $input = $request->except('_token');
//        2.进行表单验证
//        $validator = Validator::make('需要验证的表单数据','验证规则','错误提示信息')

        $rule = [
            'username'=>'required|between:4,18',
            'password'=>'required|between:4,18|alpha_num'
        ];
        $msg = [
            'username.required'=>'请输入用户名',
            'username.between'=>'用户名长度要求4-18位之间',
            'password.required'=>'请输入密码',
            'password.between'=>'密码长度要求4-18位之间',
            'password.alpha_num'=>'密码要求包含数字、字母'
        ];

//        用validator门面进行后台表单验证
        $validator = Validator::make($input,$rule,$msg);

        if ($validator->fails()) {
            return redirect('admin/login')
                ->withErrors($validator)
                ->withInput();
        }
//        3.验证此用户是否存在（验证码、用户名、密码）
        if(strtolower($input['code']) != strtolower(session()->get('code'))){
            return redirect('admin/login')->with('errors','验证码错误');
        }

        $user = User::where('user_name',$input['username'])->first();

        if(!$user){
            return redirect('admin/login')->with('errors','用户名错误');
        }

        if($input['password'] != Crypt::decrypt($user->user_pass)){
            return redirect('admin/login')->with('errors','密码错误');
        }
//        4.保存用户信息到session
        session()->put('user',$user);
//        5.跳转到后台index页面
        return redirect('admin/index');
    }
    //加密算法MD5，Hash（65bit每次生成的都不一样），Encrypted
    public function lock(){
         $str = '123456';
         $en_str = 'eyJpdiI6ImJoWUo3bmx2UkxvM1BXYStpckVzblE9PSIsInZhbHVlIjoieEFVS0ZuN01OUHdzL2U2TGQycW1FUT09IiwibWFjIjoiODU3OWIzMzgxNzlkODBmNjQ3MTlhZjg1NzgxMmU4OTg0NThiYjE3NDk1YTBiMzVmYTE2ZGI3ZTMxNzM3NzUzMyJ9';
         $crypt_str = Crypt::encrypt($str);
         return $crypt_str;
    }
    //返回后台首页
    public function index(){
        return view('admin.index');
    }
    //返回后台首页中的欢迎页
    public function welcome(R){
        return view('admin.welcome');
    }

    //返回后台退出登录页面
    public function logout()
    {
//    1.清空session
        session()->flush();
//    2.重定向到登录页面
        return redirect('admin/login');
    }
}
