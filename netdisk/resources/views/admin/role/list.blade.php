<!DOCTYPE html>
<html class="x-admin-sm" xmlns:float="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="UTF-8">
        <title>后台角色列表页面</title>
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
          <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" onclick="location.reload()" title="刷新">
            <i class="layui-icon layui-icon-refresh" style="line-height:30px"></i></a>
        </div>
        <div class="layui-fluid">
            <div class="layui-row layui-col-space15">
                <div class="layui-col-md12">
                    <div class="layui-card">
                        <div class="layui-card-body ">
                            <form class="layui-form layui-col-space5" method="get" action="{{ url('admin/role') }}">
                                <div class="layui-inline layui-show-xs-block">
                                    <select name="num" lay-verify="">
                                        <option value="5" @if($request->input('num')==5)    selected    @endif>每页5条记录</option>
                                        <option value="10" @if($request->input('num')==10)    selected    @endif>每页10条记录</option>
                                    </select>
                                </div>
                                <div class="layui-inline layui-show-xs-block">
                                    <input type="text" name="rolename"  value="{{ $request->input('rolename') }}" placeholder="请输入角色名" autocomplete="off" class="layui-input">
                                </div>
                                <div class="layui-inline layui-show-xs-block">
                                    <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
                                </div>
                            </form>
                        </div>
                        <div class="layui-card-header">
                            <button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除</button>
                            <button class="layui-btn" onclick="xadmin.open('添加用户','{{ url('admin/role/create') }}',600,400)"><i class="layui-icon"></i>添加</button>
                        </div>
                        <div class="layui-card-body layui-table-body layui-table-main">
                            <table class="layui-table layui-form">
                                <thead>
                                  <tr>
                                    <th>
                                      <input type="checkbox" lay-filter="checkall" name="" lay-skin="primary">
                                    </th>
                                    <th>ID</th>
                                    <th>角色名</th>
                                    <th>角色描述</th>
                                    <th>操作</th></tr>
                                </thead>
                                <tbody>
                                @foreach($role as $v)
                                  <tr>
                                    <td>
                                      <input type="checkbox" lay-skin="primary" value="{{ $v->role_id }}">
                                    </td>
                                    <td>{{ $v->role_id }}</td>
                                    <td>{{ $v->role_name }}</td>
                                    <td>{{ $v->role_description }}</td>
                                    <td class="td-manage">
                                      <a title="授权" href="{{ url('admin/role/'.$v->role_id.'/auth') }}">
                                          <i class="layui-icon">&#xe612;</i>
                                      </a>
                                      <a title="修改"  onclick="xadmin.open('修改','{{ url('admin/role/'.$v->role_id.'/edit') }}',600,400)" href="javascript:;">
                                        <i class="layui-icon">&#xe642;</i>
                                      </a>
                                      <a title="删除" onclick="member_del(this,'{{ $v->role_id }}')" href="javascript:;">
                                        <i class="layui-icon">&#xe640;</i>
                                      </a>
                                    </td>
                                  </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="layui-card-body ">
                            <div class="page">
                                <div class="layui-inline layui-show-xs-block"> {!! $role->appends($request->all())->render() !!} </div>
                                <div class="layui-inline layui-show-xs-block">共有 {!! $role->total() !!} 条记录</div>
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
          var  form = layui.form;


        // 监听全选
        form.on('checkbox(checkall)', function(data){

          if(data.elem.checked){
            $('tbody input').prop('checked',true);
          }else{
            $('tbody input').prop('checked',false);
          }
          form.render('checkbox');
        }); 
        
        //执行一个laydate实例
        laydate.render({
          elem: '#start' //指定元素
        });

        //执行一个laydate实例
        laydate.render({
          elem: '#end' //指定元素
        });


      });


      /*角色-删除*/
      function member_del(obj,id){
          layer.confirm('确认要删除吗？',function(index){
              $.post('/admin/role/'+id,{"_method":"delete","_token":"{{ csrf_token() }}"},function (data) {
                    if(data==0){
                        //发异步删除数据
                        $(obj).parents("tr").remove();
                        layer.msg('已删除!',{icon:6,time:1000});
                    }else{
                        layer.msg('已删除!',{icon:5,time:1000});
                    }
              })


          });
      }



      function delAll (argument) {
        var ids = [];

        // 获取选中的id 
        $('tbody input').not('.header').each(function(index, el) {
            if($(this).prop('checked')){
               ids.push($(this).val())
            }
        });
  
        layer.confirm('确认要删除吗？',function(index){
            $.get('/admin/role/del',{'ids':ids},function (data) {
                if(data==0){
                    //捉到所有被选中的，发异步进行删除
                    $(".layui-form-checked").not('.header').parents('tr').remove();
                    layer.msg('删除成功', {icon: 6});
                }else{
                    layer.msg('删除失败', {icon: 6});
                }
            });
        });
      }
    </script>
</html>