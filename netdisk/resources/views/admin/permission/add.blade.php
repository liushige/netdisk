<!DOCTYPE html>
<html class="x-admin-sm">
    
    <head>
        <meta charset="UTF-8">
        <title>后台权限添加页面</title>
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
                <form class="layui-form" action="{{ url('admin/permission') }}" method="post" >
                    {{ csrf_field() }}
                    <div class="layui-form-item">
                        <label for="L_prename" class="layui-form-label">
                            <span class="x-red">*</span>权限名</label>
                        <div class="layui-input-inline"  style="width: 400px">
                            <input type="text" id="L_prename" name="pre_name" required="" lay-verify="prename" autocomplete="off" class="layui-input"></div>
                    </div>
                    <div class="layui-form-item layui-form-text">
                        <label class="layui-form-label">
                            <span class="x-red">*</span>权限描述</label>
                        <div class="layui-input-block">
                            <textarea placeholder="最多输入100个字符" id="L_predescription" name="pre_description" style="width: 400px" required="" lay-verify="predescription" autocomplete="off" class="layui-textarea"></textarea>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label for="L_preroute" class="layui-form-label">
                            <span class="x-red">*</span>权限路由</label>
                        <div class="layui-input-inline"  style="width: 400px">
                            <input type="text" id="L_preroute" name="pre_url" required="" lay-verify="preroute" autocomplete="off" class="layui-input"></div>
                    </div>
                    <div class="layui-form-item">
                        <label for="L_repass" class="layui-form-label"></label>
                        <button class="layui-btn" lay-filter="add" lay-submit="">添加</button></div>
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
                    prename: function(value) {
                        if (value.length > 30) {
                            return '权限名最多得30个字符';
                        }
                    },
                    predescription: function(value) {
                        if (value.length > 100) {
                            return '权限描述最多得100个字符';
                        }
                    },
                    preroute: function(value) {
                        if (value.length > 100) {
                            return '权限路由最多得30个字符';
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