<!DOCTYPE html>
<html class="x-admin-sm">
    
    <head>
        <meta charset="UTF-8">
        <title>后台角色授权页面</title>
        <meta name="renderer" content="webkit">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
        @include('admin/public/styles')
        <script type="text/javascript" src="{{url('admin/lib/layui/layui.js')}}" charset="utf-8"></script>
        <script type="text/javascript" src="{{url('admin/js/xadmin.js')}}"></script>
        <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
        <!--[if lt IE 9]>
            <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
            <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div class="layui-fluid">
            <div class="layui-row">
                @if(!empty(session('msg')))
                    　　<div class="alert alert-success" role="alert">
                        　　　　{{session('msg')}}
                        　　</div>
                @endif
                <form class="layui-form" action="{{ url('admin/user/doauth') }}" method="post" >
                    {{ csrf_field() }}
                    <div class="layui-form-item">
                        <label for="L_username" class="layui-form-label">
                            <span class="x-red">*</span>用户名</label>
                        <div class="layui-input-inline" style="width: 400px" >
                            {{--绑定角色id传回后台--}}
                            <input type="hidden" name="user_id" value="{{ $user->user_id }}">
                            <input type="text" readonly="readonly" id="L_username" name="user_name" value="{{ $user->user_name }}" required="" lay-verify="username" autocomplete="off" class="layui-input"></div>
                    </div>

                    <div class="layui-form-item">
                        <label for="L_username" class="layui-form-label">
                            <span class="x-red">*</span>请选择角色</label>
                        <div class="layui-input-inline" style="width: 500px">
                            @foreach($role as $v)
                                @if(in_array($v->role_id,$role_ids))
                                    <input type="checkbox" name="role_id[]" value="{{ $v->role_id }}" title="{{ $v->role_name }}" checked>
                                @else
                                    <input type="checkbox" name="role_id[]" value="{{ $v->role_id }}" title="{{ $v->role_name }}" >
                                 @endif
                              @endforeach
                        </div>
                    </div>

                    {{--<div class="layui-form-item layui-form-text">--}}
                        {{--<label class="layui-form-label">--}}
                            {{--<span class="x-red">*</span>角色描述</label>--}}
                        {{--<div class="layui-input-block">--}}
                            {{--<textarea placeholder="最多输入100个字符" id="L_roledescription" name="role_description" style="width: 400px" required="" lay-verify="roledescription" autocomplete="off" class="layui-textarea"></textarea>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    <div class="layui-form-item">
                        <label for="L_repass" class="layui-form-label"></label>
                        <button class="layui-btn" lay-filter="auth" lay-submit="">更新角色</button></div>
                </form>
            </div>
        </div>
        <script>layui.use(['form', 'layer','jquery'],
            function() {
                $ = layui.jquery;
                var form = layui.form,
                layer = layui.layer;

                //自定义验证规则
                form.verify({
                    username: function(value) {
                        if (value.length > 30) {
                            return '角色名最多得50个字符';
                        }
                    }
                });

                //监听提交
                form.on('submit(add)', function(data) {
                    //发异步，把数据提交给php
                    // return false;
                });
            });</script>
        <script>var _hmt = _hmt || []; (function() {
                var hm = document.createElement("script");
                hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
                var s = document.getElementsByTagName("script")[0];
                s.parentNode.insertBefore(hm, s);
            })();</script>
    </body>

</html>