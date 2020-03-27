<!-- 顶部开始 -->
<div class="container">
    <div class="logo">
        <a href="index">吉盘后台管理系统1.0</a></div>
    <div class="left_open">
        <a><i title="展开左侧栏" class="iconfont">&#xe699;</i></a>
    </div>
    <ul class="layui-nav right" lay-filter="">
        <li class="layui-nav-item">
            <a href="javascript:;">{{ $currentUser->user_name }}</a>
            <dl class="layui-nav-child">
                <!-- 二级菜单 -->
                <dd>
                    <a onclick="xadmin.open('个人信息','{{ url('admin/user/'.$currentUser->user_id) }}',452,565)" >@method('get')个人中心</a></dd>
                <dd>
                    <a onclick="xadmin.open('修改信息','{{ url('admin/user/'.$currentUser->user_id.'/edit') }}',600,400)">账号设置</a></dd>
                <dd>
                    <a href="logout">退出登录</a></dd>
            </dl>
        </li>
        <li class="layui-nav-item to-index">
            <a href="/">前台首页</a></li>
    </ul>
</div>
<!-- 顶部结束 -->