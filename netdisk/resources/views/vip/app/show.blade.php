<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>软件展示页面</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('admin.public.styles')
    <script type="text/javascript" src="{{url('admin/lib/layui/layui.js')}}" charset="utf-8"></script>
    <script type="text/javascript" src="{{url('admin/js/xadmin.js')}}"></script>
    <script type="text/javascript" src="{{ url('admin/js/jquery.min.js')}}"></script>
</head>

<body>
<div>
    <button>名称</button>
    {{$app->app_name}}</div>
<div>
    <button>来源</button>
    {{$app->app_url}}</div>
<div>
    <button>平台</button>
    @if($app->app_platform == 1) Linux @else Windows @endif</div>
<div>
    <button>版本</button>
    {{$app->app_version}}</div>
<div>
    <button>介绍</button>
    {{$app->app_doc}}
    </div>

<a href="http://{{$app->app_location}}" class="layui-btn">点击下载</a>

</body>
    <script>
    </script>
<script>var _hmt = _hmt || []; (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
    })();</script>
</html>