<!DOCTYPE html>
<!-- saved from url=(0032)https://www.lmonkey.com/wp-login.php -->
<html xmlns="http://www.w3.org/1999/xhtml" lang="zh-CN"><!--<![endif]-->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <title>登录 ‹ 猿圈 — WordPress</title>
    <style type="text/css">
        body.login div#login h1 a {
            background-image: url(https://www.lmonkey.com/wp-content/themes/tinection/images/wordpress-logo.png);
            -webkit-background-size: 85px 85px;
            background-size: 85px 85px;
            width: 85px;
            height: 85px
        }</style>
    <link rel="dns-prefetch" href="http://s.w.org/">
    <link rel="stylesheet" href="{{ asset('home/css/login.css') }}" type="text/css" media="all">
    <meta name="robots" content="noindex,follow">
    <meta name="viewport" content="width=device-width">
    @include('admin.public.script')
</head>
<body class="login login-action-login wp-core-ui  locale-zh-cn">
<div id="login">
    <h1><a href="https://www.lmonkey.com/" title="猿圈" tabindex="-1">猿圈</a></h1>

    <form name="loginform" id="loginform" action="{{ url('dophoneregister') }}" method="post">
        {{ csrf_field() }}
        <p>
            <label for="user_login">手机号<br>
                <input type="text" name="phone"  class="input" value="" size="20"></label>
        </p>
        <p>
            <label for="user_pass">密码<br>
                <input type="password" name="user_pass" id="user_pass" class="input" value="" size="20"></label>
        </p>
        <p>
            <label for="user_pass">验证码<br>
                <input type="password" name="code"  class="input" value="" style="height:36px;width:120px;float:left;">
                <a id="yzm" href="javascript:;" onclick="sendCode();" style="float:right;display: block;line-height:40px;height:40px;width:100px;" >发送验证码</a>

            </label>
        </p>
        <p class="submit">
            <input type="submit"  class="button button-primary button-large" value="注册">

        </p>
    </form>

    <p id="nav">
        <a href="{{ asset('forgetpssword') }}">忘记密码？</a>
    </p>
    <p id="backtoblog"><a href="/">← 返回前台首页</a></p>
    <p id="backtoblog"><a href="/register">← 返回注册页</a></p>
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
            // 1. 获取手机号
            var phone = $('input[name=phone]').val();
            // alert(phone);

            // 2. 判断手机号是否为空
            if(!phone){
                layer.msg('手机号不能为空');
                return ;
            }

            settime();

            // 3. 触发ajax，请求验证码,根据是否成功，给提示信息
            $.get('sendcode',{'phone':phone},function(data){
                    if(data.status == 0){
                        layer.msg('发送成功',{'time':1000,'icon':6})
                    }else{
                        layer.msg('发送失败',{'time':1000,'icon':5})
                    }
            });


        }
    </script>
</div>


<div class="clear"></div>


</body>
</html>
