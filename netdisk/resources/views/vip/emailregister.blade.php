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
</head>
<body class="login login-action-login wp-core-ui  locale-zh-cn">
<div id="login">
    <h1><a href="https://www.lmonkey.com/" title="猿圈" tabindex="-1">猿圈</a></h1>

    <form name="loginform" id="loginform" action="{{ url('doregister') }}" method="post">
        {{ csrf_field() }}
        <p>
            <label for="user_login">用户名或电子邮件地址<br>
                <input type="text" name="user_name"  class="input" value="" size="20"></label>
        </p>
        <p>
            <label for="user_pass">密码<br>
                <input type="password" name="user_pass" class="input" value="" size="20"></label>
        </p>
        <p class="submit">
            <input type="submit"  id="wp-submit" class="button button-primary button-large" value="注册">

        </p>
    </form>

    <p id="nav">
        <a href="{{ url('forget') }}">忘记密码？</a>
    </p>
    <p id="backtoblog"><a href="/">← 返回前台首页</a></p>
    <p id="backtoblog"><a href="/phoneregister">← 返回手机注册页</a></p>

</div>


<div class="clear"></div>


</body>
</html>
