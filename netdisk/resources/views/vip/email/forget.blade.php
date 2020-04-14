<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>重置密码</title>
</head>
<body>
    <p>尊敬的{{ $user->user_name }}，<br>&nbsp;&nbsp;&nbsp;&nbsp;您好，<a href="http://www.netdisk.com/vip/reset?uid={{ $user->user_id }}&token={{ $user->token }}">点击此处重置密码</a> </p>
</body>
</html>