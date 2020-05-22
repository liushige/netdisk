<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="zh-CN"><!--<![endif]-->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <title>密码重置</title>
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
    <form name="loginform" id="loginform" action="{{ url('vip/doreset') }}" method="post">
        {{ csrf_field() }}
        <p>
            <label for="user_login">用户名<br>
                <input type="hidden" name="user_id" value="{{ $user->user_id }}">
                <input type="text" name="user_name" id="user_login" readonly="readonly" class="input" value="{{ $user->user_name }}" size="20"></label>
        </p>
        <p>
            <label for="user_pass">密码<br>
                <input type="password" name="user_pass" required id="user_pass" class="input" value="" size="20"></label>
        </p>
        <p>
            <label for="user_pass">确认密码<br>
                <input type="password" name="repass" required id="user_pass" class="input" value="" size="20"></label>
        </p>
        <p class="submit">
            <input type="submit"  id="wp-submit" class="button button-primary button-large" value="重置密码">
        </p>
    </form>

    <p id="nav">
        <a href="{{ asset('forgetpssword') }}">忘记密码？</a>
    </p>

    <script type="text/javascript">
        function wp_attempt_focus() {
            setTimeout(function () {
                try {
                    d = document.getElementById('user_login');
                    d.focus();
                    d.select()
                } catch (e) {
                }
            }, 200)
        }

        wp_attempt_focus();
        if (typeof wpOnload == 'function') wpOnload();</script>

</div>

</body>
</html>
