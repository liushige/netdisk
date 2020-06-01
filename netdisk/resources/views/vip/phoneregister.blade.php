<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="zh-CN"><!--<![endif]-->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>手机号码注册</title>
    <link rel="dns-prefetch" href="http://s.w.org/">
    <link rel="stylesheet" href="{{ asset('vip/css/login.css') }}" type="text/css" media="all">
    <meta name="robots" content="noindex,follow">
    <meta name="viewport" content="width=device-width">
    @include('admin.public.script')
    @include('vip.public.styles')
    <script type="text/javascript" src="{{url('admin/js/xadmin.js')}}"></script>
</head>
<body class="login login-action-login wp-core-ui  locale-zh-cn" style="background: #8080C0">
<div id="login">
    <div style="background-color: white; vertical-align: middle; color: #8080C0; font-weight:bold; font-size: 18px">
        <span style="vertical-align: middle"> <img style="vertical-align: middle" src="http://www.netdisk.com/vip/images/jlulogo.jpg" width="102px" height="56px"></span>
        欢迎登陆吉大教务网盘
    </div>
    <form name="loginform" id="loginform" action="{{ url('vip/dophoneregister') }}" method="post">
        {{ csrf_field() }}
        @if (!empty($errors))
            <div class="alert alert-danger">
                <ul>
                    @if(is_object($errors))
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    @else
                        <li>{{ $errors }}</li>
                    @endif
                </ul>
            </div>
        @endif
        <p>
            <label for="user_login">用户名<br>
                <input type="text" name="username" required class="input" value="" maxlength="20" minlength="3" size="20" placeholder="3-20位字符作为唯一登录名"></label>
        </p>
        <p>
            <label for="user_login">手机号<br>
                <input type="text" name="phone" required class="input" value="" size="20"></label>
        </p>
        <p>
            <label for="user_login">邮箱<br>
                <input type="text" name="email" required class="input" value="" size="20"></label>
        </p>
        <p>
            <label for="user_pass">密码<br>
                <input type="password" name="user_pass" required id="user_pass" class="input" value="" maxlength="20" minlength="6" size="20" placeholder="请填写6-20位"></label>
        </p>
        <p>
            <label for="user_pass">验证码<br>
                <input type="password" name="code" required class="input" value="" style="height:36px;width:120px;float:left;">
                <a id="yzm" href="javascript:;" onclick="sendCode();" style="float:right;display: block;line-height:40px;height:40px;width:100px;" >发送验证码</a>

            </label>
        </p>
        <p class="submit">
            <input type="submit"  class="button button-primary button-large" value="注册" style="background: #8080C0; color: white">

        </p>
    </form>

    <p id="backtoblog"><a href="{{ asset('vip/login') }}" style="color: white">>>>返回登录<<</a></p>

    <script type="text/javascript">

        // 倒计时60s
        var countdown = 60;
        function settime(){
            if(countdown == 0){
                $('#yzm').attr('onclick','sendCode');
                $('#yzm').text('发送验证码');
                countdown = 60;
            }else{
                $('#yzm').removeAttr('onclick','sendCode');
                $('#yzm').text('重新发送（'+countdown+'s)');
                countdown--;
                setTimeout(function () {
                    settime();
                },1000);
            }
        }

        function sendCode(){
            // 1. 获取用户名、手机号和密码
            var username = $('input[name=username]').val();
            var phone = $('input[name=phone]').val();
            var email = $('input[name=email]').val();
            var pass = $('input[name=user_pass]').val();

            // 2. 判断是否为空
            if(!username){
                layer.msg('用户名不能为空');
                return ;
            }
            if(!phone){
                layer.msg('手机号不能为空');
                return ;
            }
            if(!/^1[34578]\d{9}$/.test(phone)){
                layer.msg('手机号填写有误');
                return ;
            }
            if(!/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+((\.[a-zA-Z0-9_-]{2,3}){1,2})$/.test(email)){
                layer.msg('邮箱填写有误');
                return ;
            }
            if(!pass){
                layer.msg('密码不能为空');
                return ;
            }

            settime();

            // 3. 触发ajax，请求验证码,根据是否成功，给提示信息
            $.get('sendcode',{'phone':phone},function(data){
                    if(data == 0){
                        layer.msg('发送成功',{'time':1000,'icon':6})
                    }else if (data == 1){
                        layer.msg('发送失败',{'time':1000,'icon':5})
                    }else {
                        layer.msg('此手机号码已注册过，请更换后重新注册',{'time':1000,'icon':5})
                    }
            });
        }
    </script>
</div>


<div class="clear"></div>


</body>
</html>
