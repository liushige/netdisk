<!DOCTYPE html>
<html class="x-admin-sm">
    
    <head>
        <meta charset="UTF-8">
        <title>新建文件夹页面</title>
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
                        <label for="L_foldername" class="layui-form-label">
                            <span class="x-red">*</span>文件夹名称</label>
                        <div class="layui-input-inline">
                            <input type="text" id="L_foldername" name="foldername" value="{{ $folder->folder_name }}"  readonly="readonly" required="" autocomplete="off" class="layui-input"></div>
                    </div>
                    <div class="layui-form-item">
                        <label for="L_folderpath" class="layui-form-label">
                            <span class="x-red">*</span>将要移动到</label>
                        <div class="layui-input-inline">
                            <input type="hidden" name="id" value="{{ $folder->folder_id }}">
                            <input type="text" id="L_folderpath" name="toFolderid" placeholder="请填写文件夹ID" required="" lay-verify="required|number|folderpath" autocomplete="off" class="layui-input"></div>
                        <div class="layui-form-mid layui-word-aux">
                            <span class="x-red">*</span>1-11位数字(根目录为0)</div>
                    </div>
                    <div class="layui-form-item">
                        <label for="L_repass" class="layui-form-label"></label>
                        <button class="layui-btn" lay-filter="add" lay-submit="">确定</button></div>
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
                    folderpath: function(value) {
                        if (value.length < 1 || value.length > 11) {
                            return '文件夹id必须1-11位数字';
                        }
                    },
                });

                form.on('submit(add)', function(data) {
                    var fpid = $("input[name='id']").val();
                    //发异步，把数据提交给php
                    $.ajax({
                        type:'PUT',
                        dataType:'json',
                        url:'/vip/folder/'+fpid+'/moveUpdate',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data:data.field,
                        success:function (data) {
                            // 弹层提示移动成功，并刷新父页面
                            if (data == 3){
                                layer.alert("文件夹id不存在！", {
                                    icon: 5
                                });
                            } else if(data == 2){
                                layer.alert("抱歉，系统文件夹无法移动！", {
                                    icon: 5
                                });
                            } else if(data == 0){
                                layer.alert("移动成功", {
                                        icon: 6
                                    },
                                    function() {
                                        //关闭当前frame
                                        xadmin.close();

                                        // 可以对父窗口进行刷新
                                        xadmin.father_reload();
                                    });
                            }else{
                                layer.alert("移动失败", {
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

            });
        </script>
        <script>var _hmt = _hmt || []; (function() {
                var hm = document.createElement("script");
                hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
                var s = document.getElementsByTagName("script")[0];
                s.parentNode.insertBefore(hm, s);
            })();</script>
    </body>

</html>