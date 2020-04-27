<!-- 左侧菜单开始 -->
<div class="left-nav">
    <div id="side-nav">
        <ul id="nav">
            <li>
                <a href="javascript:;">
                    <i class="iconfont left-nav-li" lay-tips="管理员管理">&#xe726;</i>
                    <cite>管理员管理</cite>
                    <i class="iconfont nav_right">&#xe697;</i></a>
                <ul class="sub-menu">
                    <li>
                        <a onclick="xadmin.add_tab('管理员列表','{{ url('admin/user') }}')">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>管理员列表</cite></a>
                    </li>
                    <li>
                        <a onclick="xadmin.add_tab('添加管理员','{{ url('admin/user/create') }}')">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>添加管理员</cite></a>
                    </li>

                </ul>
            </li>

            <li>
                <a href="javascript:;">
                    <i class="iconfont left-nav-li" lay-tips="角色管理">&#xe732;</i>
                    <cite>角色管理</cite>
                    <i class="iconfont nav_right">&#xe697;</i></a>
                <ul class="sub-menu">
                    <li>
                        <a onclick="xadmin.add_tab('角色列表','{{ url('admin/role') }}')">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>角色列表</cite></a>
                    </li>
                    <li>
                        <a onclick="xadmin.add_tab('添加角色','{{ url('admin/role/create') }}')">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>添加角色</cite></a>
                    </li>

                </ul>
            </li>

            <li>
                <a href="javascript:;">
                    <i class="iconfont left-nav-li" lay-tips="权限管理">&#xe82b;</i>
                    <cite>权限管理</cite>
                    <i class="iconfont nav_right">&#xe697;</i></a>
                <ul class="sub-menu">
                    <li>
                        <a onclick="xadmin.add_tab('权限列表','{{ url('admin/permission') }}')">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>权限列表</cite></a>
                    </li>
                    <li>
                        <a onclick="xadmin.add_tab('权限添加','{{ url('admin/permission/create') }}')">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>权限添加</cite></a>
                    </li>

                </ul>
            </li>

            <li>
                <a href="javascript:;">
                    <i class="iconfont left-nav-li" lay-tips="前台会员管理">&#xe6b8;</i>
                    <cite>前台会员管理</cite>
                    <i class="iconfont nav_right">&#xe697;</i></a>
                <ul class="sub-menu">
                    <li>
                        <a onclick="xadmin.add_tab('会员列表','{{ url('vip/vipUser') }}')">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>会员列表</cite></a>
                    </li>
                    <li>
                        <a onclick="xadmin.add_tab('添加会员','{{ url('vip/vipUser/create') }}')">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>添加会员</cite></a>
                    </li>

                </ul>
            </li>

            <li>
                <a href="javascript:;">
                    <i class="iconfont left-nav-li" lay-tips="图标字体参考">&#xe6b4;</i>
                    <cite>图标字体参考</cite>
                    <i class="iconfont nav_right">&#xe697;</i></a>
                <ul class="sub-menu">
                    <li>
                        <a onclick="xadmin.add_tab('图标对应字体','{{ url('admin/unicode') }}')">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>图标对应字体</cite></a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="javascript:;">
                    <i class="iconfont left-nav-li" lay-tips="数据库备份">&#xe744;</i>
                    <cite>数据库备份</cite>
                    <i class="iconfont nav_right">&#xe697;</i></a>
                <ul class="sub-menu">
                    <li>
                        <a onclick="xadmin.add_tab('数据库备份','{{ url('') }}')">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>数据库备份</cite></a>
                    </li>
                </ul>
            </li>

        </ul>
    </div>
</div>
<!-- <div class="x-slide_left"></div> -->
<!-- 左侧菜单结束 -->