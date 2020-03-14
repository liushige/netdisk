<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Org\code\Code;
use Illuminate\Support\Facades\Validator;

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


    }
}
