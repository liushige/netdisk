<!DOCTYPE html>
<html class="x-admin-sm">
    
    <head>
        <meta charset="UTF-8">
        <title>后台修改页面</title>
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
                        <label for="L_rolename" class="layui-form-label">
                            <span class="x-red">*</span>角色名</label>
                        <div class="layui-input-inline">
                            <input type="hidden" name="id" value="{{ $role->role_id }}">
                            <input type="text" id="L_rolename" name="rolename" value="{{ $role->role_name }}" required="" lay-verify="required|rolename" autocomplete="off" class="layui-input"></div>
                    </div>
                    <div class="layui-form-item">
                        <label for="L_roledescription" class="layui-form-label">
                            <span class="x-red">*</span>角色描述</label>
                        <div class="layui-input-block">
                            <textarea placeholder="最多输入100个字符" id="L_roledescription" name="roledescription" style="width: 400px" required="" lay-verify="roledescription" autocomplete="off" class="layui-textarea">{{ $role->role_description }}</textarea>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label for="L_repass" class="layui-form-label"></label>
                        <button class="layui-btn" lay-filter="edit" lay-submit="">修改</button></div>
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
                    rolename: function(value) {
                        if (value.length > 20 || value.length < 3) {
                            return '角色名必须3-20位';
                        }
                    },
                    roledescription: function(value) {
                        if (value.length > 100) {
                            return '角色描述最多100个字符';
                        }
                    }
                });

                //监听提交
                form.on('submit(edit)', function(data) {
                    var rid = $("input[name='id']").val();
                    //发异步，把数据提交给php
                    $.ajax({
                        type:'PUT',
                        dataType:'json',
                        url:'/admin/role/'+rid,
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