<!-- 顶部开始 -->
<div class="container">
    <div class="logo">
        <a href="index">吉大教务网盘</a></div>
    <div class="left_open">
        <a><i title="展开左侧栏" class="iconfont">&#xe699;</i></a>
    </div>
    <ul class="layui-nav right" lay-filter="">
        <li class="layui-nav-item">
            <a href="javascript:;"><img src="{{ url('vip/images/headerOfVip.jpg') }}" class="layui-nav-img">{{ $currentUser->user_name }}</a>
            <dl class="layui-nav-child">
                <!-- 二级菜单 -->
                <dd>
                    <a onclick="xadmin.open('个人信息','{{ url('vip/vipUser/'.$currentUser->user_id) }}',452,400)" >@method('get')个人中心</a></dd>
                <dd>
                    <a onclick="xadmin.open('修改信息','{{ url('vip/vipUser/'.$currentUser->user_id.'/edit') }}',600,420)">账号设置</a></dd>
                <dd>
                    <a href="logout">退出登录</a></dd>
            </dl>
        </li>
        {{--<li class="layui-nav-item to-index">--}}
            {{--<a href="{{ url('vip/login') }}">前台登录</a></li>--}}
    </ul>
</div>
<!-- 顶部结束 -->