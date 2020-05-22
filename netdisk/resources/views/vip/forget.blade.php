<!DOCTYPE html>
<!--[if IE 8]>
<html xmlns="http://www.w3.org/1999/xhtml" class="ie8" lang="zh-CN">
<![endif]-->
<!--[if !(IE 8) ]><!-->
<html xmlns="http://www.w3.org/1999/xhtml" lang="zh-CN">
<!--<![endif]-->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title>密码找回</title>

    <link rel='dns-prefetch' href='//s.w.org'/>
    <link rel='stylesheet'
          href='{{ asset('vip/css/login.css') }}'
          type='text/css' media='all'/>
    <meta name='robots' content='noindex,follow'/>
    <meta name="viewport" content="width=device-width"/>
</head>
<body class="login login-action-lostpassword wp-core-ui  locale-zh-cn" style="background: #8080C0">
<div id="login">
    <div style="background-color: white; vertical-align: middle; color: #8080C0; font-weight:bold; font-size: 18px">
        <span style="vertical-align: middle"> <img style="vertical-align: middle" src="http://www.netdisk.com/vip/images/jlulogo.jpg" width="102px" height="56px"></span>
        欢迎登陆吉大教务网盘
    </div>
    <p class="message">请输入您的用户名。您会收到一封包含创建新密码链接的电子邮件。</p>
    <form name="lostpasswordform" id="lostpasswordform"  action="{{ url('vip/doforget') }}"
          method="post">
        {{ csrf_field() }}
        <p>
            <label for="user_login">用户名<br/>
                <input type="text" name="username" id="user_login" required class="input" value="" size="20"/></label>
        </p>
        <p class="submit">
            <input type="submit"  id="wp-submit" class="button button-primary button-large" value="获取新密码" style="background: #8080C0; color: white"/>
        </p>
    </form>

    <p id="backtoblog"><a href="{{ url('vip/login') }}" style="color: white">>>>返回登录<<<</a></p>

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
