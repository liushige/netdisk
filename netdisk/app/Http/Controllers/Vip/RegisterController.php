<?php

namespace App\Http\Controllers\Vip;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Sms\SendTemplateSMS;
use App\Sms\M3Result;
use Illuminate\Support\Facades\Crypt;
//use Mail;
use App\Model\Vip;

class RegisterController extends Controller
{
    //手机注册页面
    public function phoneReg()
    {
        return view('vip.phoneregister');
    }

    //发送手机验证码
    public function sendCode(Request $request)
    {
//        1. 获取要发送的手机号
        $phone = $request->phone;

//        2. 生成模板中需要的参数 ，验证码和时间
        $code = rand(1000,9999);
        $arr = [$code,5];

//      3 调用容联云通讯的接口
        $templateSMS = new SendTemplateSMS();
        $M3result = new M3Result();

        $M3result = $templateSMS->sendTemplateSMS($phone,$arr,1);


//        4 将验证码存入session
        session()->put('phone',$code);

//        5 给前台返回容联云通讯的响应结果
        return $M3result->toJson();

    }

    //    手机号注册处理
    public function doPhoneRegister(Request $request)
    {
        $input = $request->except('_token');


//        如果未填验证码或者验证码不对
        if(!empty(session()->get('phone')) and session()->get('phone') != $input['code']){
            return redirect('vip/phoneregister')->with('errors','验证码填写有误');
        }

//        查找vip用户是否已用改手机号注册




        $input['user_pass'] = Crypt::encrypt($input['user_pass']);
        $input['expire'] = time()+3600*24;

        $user = Vip::create(['user_name'=>$input['username'],'user_phone'=>$input['phone'],'user_pass'=>$input['user_pass']]);

        if($user){
            return redirect('vip/login')->with('errors','恭喜您，注册成功');
        }else{
            return back();
        }
    }

    //前台邮箱注册页
    public function register()
    {
        return view('vip.emailregister');
    }

    //    邮箱登录处理
    public function doRegister(Request $request)
    {
        $input = $request->except('_token');
//        dd($input);
        $input['user_pass'] = Crypt::encrypt($input['user_pass']);
        $input['email'] = $input['user_name'];
        $input['token'] = md5($input['email'].$input['user_pass'].'123');
        $input['expire'] = time()+3600*24;

        $user = HomeUser::create($input);

        if($user){

            Mail::send('email.active',['user'=>$user],function ($m) use ($user) {
//              $m->from('hello@app.com', 'Your Application');

                $m->to($user->email, $user->name)->subject('激活邮箱');
            });


            return redirect('login')->with('active','请先登录邮箱激活账号');
        }else{
            return redirect('emailregister');
        }

    }


    //注册账号邮箱激活
    public function active(Request $request){
        //找到要激活的用户，将用户的active字段改成1

        $user = HomeUser::findOrFail($request->userid);

        //验证token的有效性，保证链接是通过邮箱中的激活链接发送的
        if($request->token  != $user->token){
            return '当前链接非有效链接，请确保您是通过邮箱的激活链接来激活的';
        }
        //激活时间是否已经超时
        if(time() > $user->expire){
            return '激活链接已经超时，请重新注册';
        }

        $res = $user->update(['active'=>1]);
        //激活成功，跳转到登录页
        if($res){
            return redirect('login')->with('msg','账号激活成功');
        }else{
            return '邮箱激活失败，请检查激活链接，或者重新注册账号';
        }
    }

//    忘记密码
    public function forget()
    {
        return view('vip.forget');
    }
    //密码找回处理（发送密码找回邮件）
    public function doforget(Request $request)
    {
        //要发送邮件的账号
        $email = $request->email;
        // 根据账号名查询用户信息
        $user = Vip::where('user_name',$email)->first();
        if($user){
            //想此用户发送密码找回邮件
            Mail::send('email.forget',['user'=>$user],function ($m) use ($user) {
//              $m->from('hello@app.com', 'Your Application');

                $m->to($user->email, $user->name)->subject('找回密码');


            });

            return '请登录您的邮箱查看重置密码邮件，重新设置密码';
        }else{
            return '用户不存在，请重新输入要找回密码的账号';
        }

    }
    //重新设置密码页面
    public function reset(Request $request)
    {
        $input = $request->all();
        //验证token，判断是否是通过重置密码邮件跳转过来的

        $user = Vip::find($input['uid']);
        return view('vip.reset',compact('user'));
    }

    //重置密码逻辑
    public function doreset(Request $request)
    {
//        1. 接收要重置密码的账号、新密码
        $input = $request->all();

        $pass = Crypt::encrypt($input['user_pass']);

//        2.将此账号的密码重置为新密码
        $res = Vip::where('user_name',$input['user_name'])->update(['user_pass'=>$pass]);

//        3. 判断更新是否成功
        if($res){
            return redirect('vip/login');
        }else{
            return redirect('vip/reset');
        }
    }


}
