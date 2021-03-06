<!DOCTYPE html>
<html class="x-admin-sm">
    
    <head>
        <meta charset="UTF-8">
        <title>前台会员修改页面</title>
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
                            <span class="x-red">*</span>姓名</label>
                        <div class="layui-input-inline">
                            <input type="text" id="L_username" readonly="readonly" name="username" value="{{ $vip->user_name }}" required="" lay-verify="" autocomplete="off" class="layui-input"></div>
                        <div class="layui-form-mid layui-word-aux">将会成为您唯一的登入名（无法更改）</div>
                    </div>
                    <div class="layui-form-item">
                        <label for="L_email" class="layui-form-label">
                            <span class="x-red">*</span>邮箱</label>
                        <div class="layui-input-inline">
                            <input type="hidden" name="uid" value="{{ $vip->user_id }}">
                            <input type="text" id="L_email" name="email" value="{{ $vip->user_email }}" required="" lay-verify="email" autocomplete="off" class="layui-input"></div>
                    </div>
                    <div class="layui-form-item">
                        <label for="L_phone" class="layui-form-label">
                            <span class="x-red">*</span>手机号码</label>
                        <div class="layui-input-inline">
                            <input type="text" id="L_phone" readonly="readonly" name="phone" value="{{ $vip->user_phone }}" required="" lay-verify="phone" autocomplete="off" class="layui-input"></div>
                        <div class="layui-form-mid layui-word-aux">仅允许查看（无法更改）</div>
                    </div>
                    <div class="layui-form-item">
                        <label for="L_pass" class="layui-form-label">
                            <span class="x-red">*</span>密码</label>
                        <div class="layui-input-inline">
                            <input type="password" id="L_pass" name="pass"  required="" lay-verify="pass" autocomplete="off" class="layui-input"  maxlength="20" minlength="6" size="20"></div>
                        <div class="layui-form-mid layui-word-aux">6到20位</div></div>
                    <div class="layui-form-item">
                        <label for="L_repass" class="layui-form-label">
                            <span class="x-red">*</span>确认密码</label>
                        <div class="layui-input-inline">
                            <input type="password" id="L_repass" name="repass" required="" lay-verify="repass" autocomplete="off" class="layui-input"  maxlength="20" minlength="6" size="20"></div>
                    </div>
                    {{--<div class="layui-form-item">--}}
                        {{--<label for="L_active" class="layui-form-label">--}}
                            {{--<span class="x-red">*</span>是否激活</label>--}}
                        {{--<div class="layui-input-inline">--}}
                            {{--<input type="text" id="L_active" name="active" value="{{ $vip->active }}" required="" lay-verify="active" autocomplete="off" class="layui-input"></div>--}}
                        {{--<div class="layui-form-mid layui-word-aux">请填0或1（0：激活，1：不激活）</div></div>--}}
                    <div class="layui-form-item">
                        <label for="L_repass" class="layui-form-label"></label>
                        <button class="layui-btn" lay-filter="edit" lay-submit="" style="background: #8080C0">修改</button></div>
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
                    // nikename: function(value) {
                    //     if (value.length < 5) {
                    //         return '昵称至少得5个字符啊';
                    //     }
                    // },
                    pass: [/(.+){6,20}$/, '密码必须6到20位'],
                    repass: function(value) {
                        if ($('#L_pass').val() != $('#L_repass').val()) {
                            return '两次密码不一致';
                        }
                    }
                });

                //监听提交
                form.on('submit(edit)', function(data) {
                    var uid = $("input[name='uid']").val();
                    //发异步，把数据提交给php
                    $.ajax({
                        type:'PUT',
                        dataType:'json',
                        url:'/vip/vipUser/'+uid,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data:data.field,
                        success:function (data) {
                            // 弹层提示添加成功，并刷新父页面
                            if (data == 0){
                                layer.alert("修改成功", {
                                        icon: 6
                                    },
                                    function() {
                                        //关闭当前frame
                                        xadmin.close();

                                        // 可以对父窗口进行刷新
                                        xadmin.father_reload();
                                    });
                            } else {
                                layer.alert("修改失败", {
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