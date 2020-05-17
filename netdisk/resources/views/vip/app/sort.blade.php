<!DOCTYPE html>
<html class="x-admin-sm" xmlns:float="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8">
    <title>文件夹列表页面</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    {{--<meta name="csrf-token" content="{{ csrf_token() }}">--}}
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    @include('admin/public/styles')
    <script type="text/javascript" src="{{url('admin/lib/layui/layui.js')}}" charset="utf-8"></script>
    <script type="text/javascript" src="{{url('admin/js/xadmin.js')}}"></script>
    <!--[if lt IE 9]>
    <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
    <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="x-nav">
          <span class="layui-breadcrumb">
            <a href="">首页</a>
            <a href="">演示</a>
            <a>
              <cite>导航元素</cite></a>
          </span>
    <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right;background-color: #8080C0" onclick="location.reload()" title="刷新">
        <i class="layui-icon layui-icon-refresh" style="line-height:30px"></i></a>
</div>
<div class="layui-fluid">
    <div class="layui-row layui-col-space15">
        <div class="layui-col-md12">

            {{--软件展示部分--}}
            <div class="layui-card-body layui-table-body layui-table-main">
                <table class="layui-table layui-form">
                    <thead>
                    <tr>
                        <th>
                            <i class="iconfont">&#xe705;</i>
                        </th>
                        <th>ID</th>
                        <th>软件名称</th>
                        <th>操作</th></tr>
                    </thead>
                    <tbody>
                    @foreach($app as $v)
                        <tr>
                            <td>
                                <i class="iconfont">&#xe705;</i>
                            </td>
                            <td>{{ $v->app_id }}</td>
                            <td>{{ $v->app_name }}</td>
                            <td class="td-manage">
                                <a title="打开" href="{{ url('vip/app/'.$v->app_id) }}">
                                    <i class="layui-icon">&#xe617;</i>
                                </a>
                                <a title="移动"  onclick="xadmin.open('移动','{{ url('vip/app/'.$v->app_id.'/move') }}',600,400)" href="javascript:;">
                                    <i class="layui-icon">&#xe609;</i>
                                </a>
                                <a title="编辑" href="{{ url('vip/app/'.$v->app_id.'/edit') }}">
                                    <i class="layui-icon">&#xe642;</i>
                                </a>
                                <a title="删除" onclick="app_del(this,'{{ $v->app_id }}')" href="javascript:;">
                                    <i class="layui-icon">&#xe640;</i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            {{--底部统计模块--}}
            <div class="layui-card-body ">
                <div class="page">
                    <div class="layui-inline layui-show-xs-block">共 {!! sizeof($app) !!} 个软件</div>
                </div>
            </div>

            </div>
        </div>
    </div>
</div>
</body>
<script>
    layui.use(['laydate','form'], function(){
        var laydate = layui.laydate;
        var form = layui.form;

        //执行一个laydate实例
        laydate.render({
            elem: '#start' //指定元素
        });

        //执行一个laydate实例
        laydate.render({
            elem: '#end' //指定元素
        });
    });

    /*app-删除*/
    function app_del(obj,id){
        layer.confirm('确认要删除吗？',function(index){
            $.post('/vip/app/'+id,{"_method":"delete","_token":"{{ csrf_token() }}"},function (data) {
                if(data==0){
                    //发异步删除数据
                    $(obj).parents("tr").remove();
                    layer.msg('删除成功!',{icon:6,time:1000});
                    // 可以对父窗口进行刷新
                    xadmin.father_reload();
                }else {
                    layer.msg('删除失败!',{icon:5,time:1000});
                }
            })
        });
    }

</script>
</html>