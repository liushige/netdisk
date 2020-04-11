<!DOCTYPE html>
<!--[if IE 8]>
<html xmlns="http://www.w3.org/1999/xhtml" class="ie8" lang="zh-CN">
<![endif]-->
<!--[if !(IE 8) ]><!-->
<html xmlns="http://www.w3.org/1999/xhtml" lang="zh-CN">
<!--<![endif]-->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title>忘记密码 &lsaquo; 猿圈 &#8212; WordPress</title>
    <style type="text/css">
        body.login div#login h1 a {
            background-image: url(https://www.lmonkey.com/wp-content/themes/tinection/images/wordpress-logo.png);
            -webkit-background-size: 85px 85px;
            background-size: 85px 85px;
            width: 85px;
            height: 85px;
        }
    </style>
    <link rel='dns-prefetch' href='//s.w.org'/>
    <link rel='stylesheet'
          href='{{ asset('home/css/login.css') }}'
          type='text/css' media='all'/>
    <meta name='robots' content='noindex,follow'/>
    <meta name="viewport" content="width=device-width"/>
</head>
<body class="login login-action-lostpassword wp-core-ui  locale-zh-cn">
<div id="login">
    <h1><a href="http://www.lmonkey.com" title="猿圈" tabindex="-1">猿圈</a></h1>
    <p class="message">请输入您的用户名或电子邮箱地址。您会收到一封包含创建新密码链接的电子邮件。</p>

    <form name="lostpasswordform" id="lostpasswordform"  action="{{ url('doforget') }}"
          method="post">
        {{ csrf_field() }}
        <p>
            <label for="user_login">用户名或电子邮件地址<br/>
                <input type="text" name="email" id="user_login" class="input" value="" size="20"/></label>
        </p>

        <p class="submit"><input type="submit"  id="wp-submit"
                                 class="button button-primary button-large" value="获取新密码"/></p>
    </form>

    <p id="nav">
        <a href="{{ url('login') }}">登录</a>
    </p>

    <p id="backtoblog"><a href="{{ url('index') }}">&larr; 返回到猿圈</a></p>

</div>

<script type="text/javascript">
    try {
        document.getElementById('user_login').focus();
    } catch (e) {
    }
    if (typeof wpOnload == 'function') wpOnload();
</script>

<div class="clear"></div>
</body>
</html>
