@extends('layouts.home')
<style>
 #main-wrap-left .span_1 a.fancyimg{
  width: 300px !important;
  padding: 0;
 }
 #main-wrap-left a.fancyimg {
  width: 260px !important;
  float: left!important;
  max-height: 230px;
  overflow: hidden;
 }
</style>
@section('main-wrap')
 <!-- Main Wrap -->
 <div id="main-wrap">
  <div id="sitenews-wrap" class="container"></div>
  @include('home.public.breadcrumb')
  <!-- Header Banner -->
  <!-- /.Header Banner -->
  <!-- CMS Layout -->
  <div class="container two-col-container cms-with-sidebar">
   <div id="main-wrap-left">
    <div class="bloglist-container clr">
     @foreach($arts as $v)
     <article class="home-blog-entry col span_1 clr">
      <a href="{{ url('detail/'.$v->art_id) }}" title="{{ $v->art_title }}" class="fancyimg home-blog-entry-thumb">
       <div class="thumb-img">
        <img src="{{ $v->art_thumb }}" alt="{{ $v->art_title }}" original="">
        <span><i class="fa fa-pencil"></i></span>
       </div> </a>
      <div class="home-blog-entry-text clr">
       <h3> <a href="{{ url('detail/'.$v->art_id) }}" title="{{ $v->art_title }}" target="_blank">{{ $v->art_title }}</a> </h3>
       <!-- Post meta -->
       <div class="meta">
        <span class="postlist-meta-time"><i class="fa fa-calendar"></i>2周前 (09-26)</span>
        <span class="postlist-meta-views"><i class="fa fa-fire"></i>浏览: 3</span>
        <span class="postlist-meta-comments"><i class="fa fa-comments"></i><a href="https://www.lmonkey.com"><span>评论: </span>0</a></span>
       </div>
       <!-- /.Post meta -->
       <p>{{ $v->art_description }}<a rel="nofollow" class="more-link" style="text-decoration:none;" href="{{ url('detail/'.$v->art_id) }}"></a></p>
      </div>
      <div class="clear"></div>
     </article>
     @endforeach
    </div>
    <!-- pagination -->
    <div class="clear">
    </div>
    <div class="pagination">
     {{ $arts->links() }}
    </div>
    <!-- /.pagination -->
   </div>
   @parent
  </div>
  <div class="clear">
  </div>
  <!-- Blocks Layout -->
 </div>
 <!--/.Main Wrap -->
@endsection