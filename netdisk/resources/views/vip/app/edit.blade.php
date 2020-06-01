<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>软件上传页面</title>
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
<div class="x-body">

    @if (!empty($errors))
        <label for="L_app_path" class="layui-form-label">
            <span class="x-red"></span></label>
        <div class="layui-input-inline" style="top: 6px">
            <ul>
                @if(is_object($errors))
                    @foreach ($errors->all() as $error)
                        <li style="color: #8080C0">{{ $error }}</li>
                    @endforeach
                @else
                    <li style="top: 6px; color: #8080C0">{{ $errors }}</li>
                @endif
            </ul>
        </div>
    @endif

    <form class="layui-form" id="art_form" action="{{ url('vip/app/'.$appid.'/storeagain') }}" method="post">
        <div class="layui-form-item">
        </div>
        {{--<div class="layui-form-item">--}}
            {{--<label for="L_app_path" class="layui-form-label">--}}
                {{--<span class="x-red">*</span>存放到</label>--}}
            {{--<div class="layui-input-inline">--}}
                {{--<input type="hidden" name="id" value="{{ $appid }}">--}}
                {{--<input type="text" id="L_app_path" name="app_path" value="" required="" lay-verify="required|number|apppath" autocomplete="off" class="layui-input"></div>--}}
                {{--<div class="layui-form-mid layui-word-aux">--}}
                    {{--<span class="x-red">*</span>请输入文件夹ID：1-11位数字（根目录为0）</div>--}}
        {{--</div>--}}

        <div class="layui-form-item">
            <label for="L_app_name" class="layui-form-label">
                <span class="x-red">*</span>软件名称
            </label>
            <div class="layui-input-inline" style="width: 470px">
                {{csrf_field()}}
                <input type="text" id="L_app_name" name="app_name" required="" lay-verify="required|appname" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_app_url" class="layui-form-label">
                <span class="x-red">*</span>软件链接
            </label>
            <div class="layui-input-inline" style="width: 470px">
                <input type="hidden" name="id" value="{{ $appid }}">
                <input type="text" id="L_app_url" name="app_url" required="" lay-verify="required|appurl" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_app_version" class="layui-form-label">
                <span class="x-red">*</span>软件版本
            </label>
            <div class="layui-input-inline">
                <input type="text" id="L_app_version" name="app_version" required="" lay-verify="required|appver" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_app_sort" class="layui-form-label">
                <span class="x-red">*</span>功能大类
            </label>
            <div class="layui-input-inline" style="z-index:9999;position: relative;">
                <select name="app_sort">
                    <option value="0">系统</option>
                    <option value="1">网络</option>
                    <option value="2">安全</option>
                    <option value="3">编程</option>
                    <option value="4">设计</option>
                    <option value="5">办公</option>
                    <option value="6">媒体</option>
                    <option value="7">其他</option>
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_app_plat" class="layui-form-label">
                <span class="x-red">*</span>软件平台
            </label>
            <div class="layui-input-inline">
                <select name="app_plat">
                    <option value="0">Windows</option>
                    <option value="1">Linux</option>
                </select>
            </div>
        </div>

        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label">
                <span class="x-red">*</span>软件上传
            </label>
            <div class="layui-input-block layui-upload">
                <input type="hidden" id="img1" class="hidden" name="art_thumb" value="">
                <button type="button" class="layui-btn" id="test1" style="background: #8080C0">
                    <i class="layui-icon">&#xe681;</i>重新上传
                </button>
                <input type="file" name="app" id="app_upload" style="display: none;">
            </div>
        </div>


        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label">
                <span class="x-red">*</span>上传状态
            </label>
            <div class="layui-input-inline">
                {{--<img src="" alt="" id="art_thumb_img" style="max-width: 350px; max-height:100px;">--}}
                {{--<span id="art_thumb_img">你好</span>--}}
                {{--<textarea name="file_up" id="art_thumb_img" placeholder="请点击上传">--}}
                {{--</textarea>--}}
                <input type="text" id="art_thumb_img" name="file_up" value="" placeholder=" 未上传，请点击上方按钮上传软件" readonly="readonly" style="width: 470px; height: 38px; border: none">
            </div>
        </div>


        <div class="layui-form-item" style="width: 100%">
            <label for="L_art_tag" class="layui-form-label">
                <span class="x-red">*</span>内容
            </label>
            <div class="layui-input-block">
                <script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.config.js"></script>
                <script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.all.min.js"> </script>
                <script type="text/javascript" charset="utf-8" src="/ueditor/lang/zh-cn/zh-cn.js"></script>
                <script id="editor" type="text/plain" name="app_doc" style="width:90%;height:700px;"></script>
                <script type="text/javascript">

                //实例化编辑器
                //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
                var ue = UE.getEditor('editor');
                </script>

            </div>
        </div>

        <div class="layui-form-item">
            <label for="L_submmit" class="layui-form-label"></label>
            <button  class="layui-btn" lay-filter="add" lay-submit="" style="background: #8080C0">修改</button>
            {{--<a href="{{ url('vip/app/store') }}" class="layui-btn"><i class="layui-icon"></i>全部提交</a>--}}
        </div>
    </form>
</div>
</body>
    <script>
       $.ajaxSetup({
           headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
       });
    </script>
    <script>
        layui.use(['form','layer','upload','element','jquery'], function(){
            $ = layui.jquery;
            var form = layui.form
                ,layer = layui.layer;
            var upload = layui.upload;
            var element = layui.element;


            //自定义验证规则
            form.verify({
                apppath: function(value) {
                    if (value.length < 1 || value.length > 11) {
                        return '文件夹ID必须1-11位数字';
                    }
                },
                appname: function(value) {
                   if (value.length < 1 || value.length > 50) {
                      return '软件名称必须1-50个字符';
                   }
                },
                appurl: function(value) {
                   if (value.length > 200) {
                      return '软件链接长度超过最大限度';
                   }
                },
                appver: function(value) {
                   if (value.length > 200) {
                      return '软件链接长度超过最大限度';
                   }
                },
            });

            $('#test1').on('click',function () {
                $('#app_upload').trigger('click');
                $('#app_upload').on('change',function () {
                    var obj = this;

                    var formData = new FormData($('#art_form')[0]);

                    var fpid = $("input[name='id']").val();
                    $.ajax({
                        url: '/vip/app/'+fpid+'/uploadagain',
                        type: 'post',
                        data: formData,
                        // 因为data值是FormData对象，不需要对数据做处理
                        processData: false,
                        contentType: false,
                        success: function(data){
                            if(data['ServerNo']=='200'){
                                {{--$('#art_thumb_img').attr('src', '{{ env('ALIOSS_DOMAIN')  }}'+data['ResultData']);--}}
                                {{--$('#art_thumb_img').attr('src', '{{ env('QINIU_DOMAIN')  }}'+data['ResultData']);--}}
                                // $('input[name=art_thumb]').val(data);
                                layer.alert("上传成功", {
                                    icon: 6
                                });
                                // $('#art_thumb_img').attr('text', data['ResultData']);
                                // $("#art_thumb_img").val('/app_cache/'+data['ResultData']);
                                $("#art_thumb_img").val( data['OriginalName']+' 已成功上传');
                                $('input[name=art_thumb]').val('www.netdisk.com'+'/app_cache/'+data['ResultData']);
                                $(obj).off('change');
                            }else{
                                // 如果失败
                                alert(data['ResultData']);
                            }
                        },
                        error: function(XMLHttpRequest, textStatus, errorThrown) {
                            var number = XMLHttpRequest.status;
                            var info = "错误号"+number+"文件上传失败!";
                            alert(info);
                        },
                        async: true
                    });
                });

            });


          // 监听提交
          //   form.on('submit(add)', function(data){
          //
          //   });
        });
    </script>
<script>var _hmt = _hmt || []; (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
    })();</script>
</html>