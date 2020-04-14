<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="zh-CN"><!--<![endif]-->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <title>邮箱注册</title>
    <link rel="dns-prefetch" href="http://s.w.org/">
    <link rel="stylesheet" href="{{ asset('vip/css/login.css') }}" type="text/css" media="all">
    <meta name="robots" content="noindex,follow">
    <meta name="viewport" content="width=device-width">
</head>
<body class="login login-action-login wp-core-ui  locale-zh-cn">
<div id="login">
    <div style="background-color: white; vertical-align: middle; color: #0085ba; font-weight:bold; font-size: 18px">
        <span style="vertical-align: middle"> <img style="vertical-align: middle" src="http://www.netdisk.com/vip/images/jlulogo.jpg" width="102px" height="56px"></span>
        欢迎登陆吉大教务网盘
    </div>
    <form name="loginform" id="loginform" action="{{ url('vip/doregister') }}" method="post" onsubmit = "return postComment()">
        {{ csrf_field() }}
        <p>
            <label for="user_login">用户名<br>
                <input type="text" name="user_name" placeholder="必填" required class="input" value="" size="20"></label>
        </p>
        <p>
            <label for="user_login">电子邮件地址<br>
                <input type="text" name="user_email" required  class="input" value="" size="20"></label>
        </p>
        <p>
            <label for="user_pass">密码<br>
                <input type="password" name="user_pass" required class="input" value="" size="20"></label>
        </p>
        <p class="submit">
            <input type="submit"  id="wp-submit" class="button button-primary button-large" value="注册">

        </p>
    </form>

    <p id="backtoblog"><a href="{{ url('vip/login') }}">>>>返回登录<<<</a></p>

</div>

<script type="text/javascript">

    /**
     * 使用jquery在前台页面验证邮箱输入是否正确
     */
    function postComment() {
        //验证邮箱
        if(!/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+((\.[a-zA-Z0-9_-]{2,3}){1,2})$/.test(user_email)) {
            layer.msg("邮箱格式不正确！请重新输入");
            return false;
        }
    }
</script>

</body>

</html>
