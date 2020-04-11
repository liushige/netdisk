<?php

namespace App\Http\Controllers\Vip;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Vip;

class LoginController extends Controller
{
//    获取前台会员登录页面
        public function login(){
            return view('vip.login');
        }
}
