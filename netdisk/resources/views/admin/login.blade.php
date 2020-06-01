<!doctype html>
<html  class="x-admin-sm">
<head>
	<meta charset="UTF-8">
	<title>吉大教务网盘后台管理系统1.0</title>
	<meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="stylesheet" href="{{asset('admin/css/login.css')}}">
    @include('admin/public/styles')
    @include('admin/public/script')

</head>
<body class="login-bg">
    
    <div class="login layui-anim layui-anim-up">
        <div class="message">吉大教务网盘后台管理系统1.0</div>
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
        <div id="darkbannerwrap"></div>

        <form method="post" class="layui-form" action="{{ url('admin/dologin') }}">

            {{--//解决419报错--}}
            {{ csrf_field() }}

            <input name="username" placeholder="用户名"  type="text" lay-verify="required" maxlength="20" minlength="3" class="layui-input" >
            <hr class="hr15">
            <input name="password" lay-verify="required" placeholder="密码"  type="password" maxlength="20" minlength="6" class="layui-input">
            <hr class="hr15">
            <input name="code" style="height: 40px; width: 150px; float: left;" lay-verify="required" placeholder="验证码" type="text" class="layui-input">
            <img src="{{ url('admin/code') }}" alt="" style="float: right;" onclick="this.src='{{url('admin/code')}}?'+Math.random()">
            <hr class="hr15">
            <input value="登录" lay-submit lay-filter="login" style="width:100%;" type="submit">
            <hr class="hr20" >
        </form>
    </div>

    <script>
        $(function  () {
            layui.use('form', function(){
              var form = layui.form;
              // layer.msg('玩命卖萌中', function(){
              //   //关闭后的操作
              //   });
              //监听提交
              form.on('submit(login)', function(data){

              });
            });
        })
    </script>
    <!-- 底部结束 -->
    <script>
    //百度统计可去掉
    var _hmt = _hmt || [];
    (function() {
      var hm = document.createElement("script");
      hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
      var s = document.getElementsByTagName("script")[0]; 
      s.parentNode.insertBefore(hm, s);
    })();
    </script>
</body>
</html>