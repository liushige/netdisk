@extends('layouts.home')
@section('title','博客系统')


 @section('main-wrap')
  <!-- Main Wrap -->
  <div id="main-wrap">
   <div id="sitenews-wrap" class="container"></div>
   <!-- Header Banner -->
   <!-- /.Header Banner -->
   <!-- CMS Layout -->
   <div class="container two-col-container cms-with-sidebar">
    <div id="main-wrap-left">
     <!-- Stickys -->
     <!-- /.Stickys -->

     <!-- pagination -->
     <div class="clear">
     </div>
     <div class="pagination">
     </div>
     <!-- /.pagination -->
    </div>
    <script type="text/javascript">
        $('.site_loading').animate({'width':'55%'},50);  //第二个节点
    </script>
     {{--父模板中的右侧边栏部分--}}
      @parent
    {{--父模板中的右侧边栏部分--}}
   </div>
   <div class="clear">
   </div>
   <!-- Blocks Layout -->
  </div>
  <!--/.Main Wrap -->
 @endsection

