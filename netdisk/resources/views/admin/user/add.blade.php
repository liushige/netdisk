<!DOCTYPE html>
<html class="x-admin-sm">
    
    <head>
        <meta charset="UTF-8">
        <title>后台添加页面</title>
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
                <form class="layui-form">
                    <div class="layui-form-item">
                        <label for="L_username" class="layui-form-label">
                            <span class="x-red">*</span>用户名</label>
                        <div class="layui-input-inline">
                            <input type="text" id="L_username" name="username" required="" lay-verify="nikename" maxlength="20" minlength="3" autocomplete="off" class="layui-input"></div>
                        <div class="layui-form-mid layui-word-aux">
                            <span class="x-red">*</span>将会成为您唯一的登入名（无法更改）</div>
                    </div>
                    <div class="layui-form-item">
                        <label for="L_email" class="layui-form-label">
                            <span class="x-red">*</span>邮箱</label>
                        <div class="layui-input-inline">
                            <input type="text" id="L_email" name="email" required="" lay-verify="email" autocomplete="off" class="layui-input"></div>
                    </div>
                    <div class="layui-form-item">
                        <label for="L_admin_status" class="layui-form-label">
                            <span class="x-red">*</span>是否启用
                        </label>
                        <div class="layui-input-inline" style="z-index:9999;position: relative;">
                            <select name="status">
                                <option value="0">不启用</option>
                                <option value="1">启用</option>
                            </select>
                        </div>
                        <div class="layui-form-mid layui-word-aux">
                            <span class="x-red">*</span>启用才可以正常登录</div>
                    </div>
                    {{--<div class="layui-form-item">--}}
                        {{--<label for="L_username" class="layui-form-label">--}}
                            {{--<span class="x-red">*</span>是否启用</label>--}}
                        {{--<div class="layui-input-inline">--}}
                            {{--<input type="text" id="L_username" name="username" required="" lay-verify="nikename" autocomplete="off" class="layui-input"></div>--}}
                        {{--<div class="layui-form-mid layui-word-aux">--}}
                            {{--<span class="x-red">*</span>将会成为您唯一的登入名</div>--}}
                    {{--</div>--}}
                    <div class="layui-form-item">
                        <label for="L_pass" class="layui-form-label">
                            <span class="x-red">*</span>密码</label>
                        <div class="layui-input-inline">
                            <input type="password" id="L_pass" name="pass" required="" lay-verify="pass" autocomplete="off" maxlength="20" minlength="6" class="layui-input"></div>
                        <div class="layui-form-mid layui-word-aux">6到20位</div></div>
                    <div class="layui-form-item">
                        <label for="L_repass" class="layui-form-label">
                            <span class="x-red">*</span>确认密码</label>
                        <div class="layui-input-inline">
                            <input type="password" id="L_repass" name="repass" required="" lay-verify="repass" autocomplete="off" maxlength="20" minlength="6" class="layui-input"></div>
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
                    nikename: function(value) {
                        if (value.length < 3 || value.length > 20) {
                            return '用户名必须3-20位';
                        }
                    },
                    pass: [/(.+){6,20}$/, '密码必须6到20位'],
                    repass: function(value) {
                        if ($('#L_pass').val() != $('#L_repass').val()) {
                            return '两次密码不一致';
                        }
                    }
                });

                //监听提交
                form.on('submit(add)', function(data) {
                    //发异步，把数据提交给php
                    $.ajax({
                        type:'POST',
                        dataType:'json',
                        url:'/admin/user',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data:data.field,
                        success:function (data) {
                            // 弹层提示添加成功，并刷新父页面
                            if (data == 0){
                                layer.alert("添加成功", {
                                        icon: 6
                                    },
                                    function() {
                                        //关闭当前frame
                                        xadmin.close();

                                        // 可以对父窗口进行刷新
                                        xadmin.father_reload();
                                    });
                            } else if(data ==1){
                                layer.alert("添加失败", {
                                    icon: 5
                                });
                            }else {
                                layer.alert("用户名已存在，请更换后重新添加", {
                                    icon: 5
                                });
                            }
                        },
                        error:function () {
                            // 提示错误信息
                        }
                    });
                    return false;
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