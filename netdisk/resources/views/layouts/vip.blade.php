<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <!-- 引入页面描述和关键字模板 -->
    <title>@yield('title')</title>
    <meta name="description" content="猿圈专注于提供多元化的阅读体验，以阅读提升生活品质" />
    <meta name="keywords" content="猿圈,悦读,阅读,文字,历史,杂谈,散文,见闻,游记,人文,科技,杂碎,冷笑话,段子,语录" />

    @include('vip.public.styles')
    @include('vip.public.script')
</head>
<body id="wrap" class="home blog">
<!-- Nav -->
<!-- Moblie nav-->
<div id="body-container">

    <!-- Moblie nav -->

    <!-- /.Moblie nav -->
    <section id="content-container" style="background:#f1f4f9; ">
    {{--header start--}}
    @include('vip.public.header')
    {{--header end--}}
    <!-- Main Wrap -->
        @section('main-wrap')

            {{--右侧边栏 start--}}
            @include('vip.public.aside')
            {{--右侧边栏 end--}}

            @show
    <!--/.Main Wrap -->

        {{--footer --}}
        @include('vip.public.footer')
        {{--footer --}}

    </section>
</div>
{{--登录--}}
@include('vip.public.signin')
{{--登录--}}


</body>
</html>