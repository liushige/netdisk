<!DOCTYPE html>
<html class="x-admin-sm">
    <head>
        <meta charset="UTF-8">
        <title>欢迎页面-X-admin2.2</title>
        <meta name="renderer" content="webkit">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />

        @include('admin/public/styles')
        @include('admin/public/script')

    </head>
    <body>
        <div class="layui-fluid">
            <div class="layui-row layui-col-space15">
                <div class="layui-col-md12">
                    <div class="layui-card">
                        <div class="layui-card-body ">
                            <blockquote class="layui-elem-quote"> 欢迎您：
                                <span class="x-red" style="color: #009688">{{ $currentUser->user_name }}</span>
                            </blockquote>
                        </div>
                    </div>
                </div>
                {{--<div class="layui-col-md12">--}}
                    {{--<div class="layui-card">--}}
                        {{--<div class="layui-card-header">数据统计</div>--}}
                        {{--<div class="layui-card-body ">--}}
                            {{--<ul class="layui-row layui-col-space10 layui-this x-admin-carousel x-admin-backlog">--}}
                                {{--<li class="layui-col-md2 layui-col-xs6">--}}
                                    {{--<a href="javascript:;" class="x-admin-backlog-body">--}}
                                        {{--<h3>文章数</h3>--}}
                                        {{--<p>--}}
                                            {{--<cite>66</cite></p>--}}
                                    {{--</a>--}}
                                {{--</li>--}}
                                {{----}}
                            {{--</ul>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}

                <div class="layui-col-md12">
                    <div class="layui-card">
                        <div class="layui-card-header">系统信息</div>
                        <div class="layui-card-body ">
                            <table class="layui-table">
                                <tbody>
                                    <tr>
                                        <th>教务网盘版本</th>
                                        <td>1.0.0</td></tr>
                                    <tr>
                                        <th>服务器地址</th>
                                        <td>http://www.netdisk.com</td></tr>
                                    <tr>
                                        <th>会员用户登录网址</th>
                                        <td>http://www.netdisk.com/vip/login</td></tr>
                                    <tr>
                                        <th>管理员登录网址</th>
                                        <td>http://www.netdisk.com/admin/login</td></tr>
                                    <tr>
                                        <th>操作系统</th>
                                        <td>Windows 10</td></tr>
                                    <tr>
                                        <th>运行环境</th>
                                        <td>Apache/2.4.39</td></tr>
                                    <tr>
                                        <th>PHP版本</th>
                                        <td>7.3.4</td></tr>
                                    <tr>
                                        <th>MYSQL版本</th>
                                        <td>5.7.26</td></tr>
                                    <tr>
                                        <th>X-admin版本</th>
                                        <td>2.2</td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="layui-col-md12">
                    <div class="layui-card">
                        <div class="layui-card-header">开发团队</div>
                        <div class="layui-card-body ">
                            <table class="layui-table">
                                <tbody>
                                    <tr>
                                        <th>版权所有</th>
                                        <td> 2020 吉林大学
                                            <a href="http://www.jlu.edu.cn/" target="_blank">访问官网</a></td>
                                    </tr>
                                    <tr>
                                        <th>开发者</th>
                                        <td>刘俊龙(liushige1997@gmail.com)</td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <style id="welcome_style"></style>
                <div class="layui-col-md12">
                    <blockquote class="layui-elem-quote layui-quote-nm">感谢layui,百度Echarts,jquery,本系统由x-admin提供技术支持。</blockquote></div>
            </div>
        </div>
        </div>
    </body>
</html>