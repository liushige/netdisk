<!-- 左侧菜单开始 -->
<div class="left-nav">
    <div id="side-nav">
        <ul id="nav">
            <li>
                <a href="javascript:;">
                    <i class="iconfont left-nav-li" lay-tips="我的网盘">&#xe6cb;</i>
                    <cite>我的网盘</cite>
                    <i class="iconfont nav_right">&#xe6cb;</i></a>
                <ul class="sub-menu">
                    <li>
                        <a onclick="xadmin.add_tab('全部软件','{{ url('vip/folder') }}')">
                            <i class="iconfont">&#xe696;</i>
                            <cite>全部软件</cite>
                        </a>
                    </li>
                    <li>
                        <a onclick="xadmin.add_tab('系统','{{ url('vip/app/0/sortShow') }}')">
                            <i class="iconfont">&#xe6ae;</i>
                            <cite>系统</cite>
                        </a>
                    </li>
                    <li>
                        <a onclick="xadmin.add_tab('网络','{{ url('vip/app/1/sortShow') }}')">
                            <i class="iconfont">&#xe828;</i>
                            <cite>网络</cite>
                        </a>
                    </li>
                    <li>
                        <a onclick="xadmin.add_tab('安全','{{ url('vip/app/2/sortShow') }}')">
                            <i class="iconfont">&#xe71c;</i>
                            <cite>安全</cite>
                        </a>
                    </li>
                    <li>
                        <a onclick="xadmin.add_tab('编程','{{ url('vip/app/3/sortShow') }}')">
                            <i class="iconfont">&#xe6da;</i>
                            <cite>编程</cite>
                        </a>
                    </li>
                    <li>
                        <a onclick="xadmin.add_tab('设计','{{ url('vip/app/4/sortShow') }}')">
                            <i class="iconfont">&#xe6de;</i>
                            <cite>设计</cite>
                        </a>
                    </li>
                    <li>
                        <a onclick="xadmin.add_tab('办公','{{ url('vip/app/5/sortShow') }}')">
                            <i class="iconfont">&#xe6d4;</i>
                            <cite>办公</cite>
                        </a>
                    </li>
                    <li>
                        <a onclick="xadmin.add_tab('媒体','{{ url('vip/app/6/sortShow') }}')">
                            <i class="iconfont">&#xe719;</i>
                            <cite>媒体</cite>
                         </a>
                    </li>
                    <li>
                        <a onclick="xadmin.add_tab('Windows','{{ url('vip/app/8/sortShow') }}')">
                            <i class="iconfont">&#xe6f2;</i>
                            <cite>Windows</cite>
                        </a>
                    </li>
                    <li>
                        <a onclick="xadmin.add_tab('Linux','{{ url('vip/app/9/sortShow') }}')">
                            <i class="iconfont">&#xe6f2;</i>
                            <cite>Linux</cite>
                        </a>
                    </li>
                    <li>
                        <a onclick="xadmin.add_tab('其他','{{ url('vip/app/7/sortShow') }}')">
                            <i class="iconfont">&#xe6bf;</i>
                            <cite>其他</cite>
                        </a>
                    </li>

                </ul>
            </li>

        </ul>
    </div>
</div>
<!-- <div class="x-slide_left"></div> -->
<!-- 左侧菜单结束 -->