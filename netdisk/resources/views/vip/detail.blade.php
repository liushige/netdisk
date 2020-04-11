@extends('layouts.home')

@section('main-wrap')
 <!-- Main Wrap -->
 <div id="main-wrap">
  <div id="sitenews-wrap" class="container"></div>
  <!-- Header Banner -->
  <!-- /.Header Banner -->
  <!-- CMS Layout -->
  <div class="container two-col-container cms-with-sidebar">
   <div id="main-wrap-left">
    <!-- Content -->
    <div class="content">
     <!-- Post meta -->
     <div id="single-meta">
      <span class="single-meta-author"><i class="fa fa-user">&nbsp;</i><a href="" title="{{ $art->art_title }}" rel="author">{{ $art->art_title }}</a></span>
      <span class="single-meta-time"><i class="fa fa-calendar">&nbsp;</i>3周前 (09-19)</span>
      <span class="single-meta-category"><i class="fa fa-folder-open">&nbsp;</i><a href="{{ url('lists/'.$art->cate_id) }}" rel="category tag">{{ $art->cate->cate_name }}</a></span>
      <span class="single-meta-comments">|&nbsp;&nbsp;<i class="fa fa-comments"></i>&nbsp;<a href="#" class="commentbtn">抢沙发</a></span>
      <span class="single-meta-views"><i class="fa fa-fire"></i>&nbsp;{{ $art->art_view }}&nbsp;</span>
     </div>
     <!-- /.Post meta -->
     <!-- Rating plugin -->
     <div class="rates" pid="5136">
      <span class="ratesdes">文章评分 <span class="ratingCount">0</span> 次，平均分 <span class="ratingValue">0.0</span> ： <span id="starone" class="stars" title="1星" times="0" solid="n"><i class="fa fa-star-o"></i></span> <span id="startwo" class="stars" title="2星" times="0" solid="n"><i class="fa fa-star-o"></i></span> <span id="starthree" class="stars" title="3星" times="0" solid="n"><i class="fa fa-star-o"></i></span> <span id="starfour" class="stars" title="4星" times="0" solid="n"><i class="fa fa-star-o"></i></span> <span id="starfive" class="stars" title="5星" times="0" solid="n"><i class="fa fa-star-o"></i></span> </span>
     </div>
     <!-- /.Rating plugin -->
     <!-- Single article intro -->
     <!-- /.Single article intro -->
     <!-- Top ad -->
     {{--<div id="singletop-banner">--}}
      {{--<script async="" src="js/adsbygoogle.js"></script>--}}
      {{--<!-- 自适应广告 -->--}}
      {{--<ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-8963660216421975" data-ad-slot="9559704844" data-ad-format="auto"></ins>--}}
      {{--<script>--}}
          {{--(adsbygoogle = window.adsbygoogle || []).push({});--}}
      {{--</script>--}}
     {{--</div>--}}
     <!-- /.Top ad -->
     <div class="single-thumb">
     </div>
     <div class="single-text">
     {!! $art->art_content !!}
      <!-- Page links -->
      <!-- /.Page links -->
     </div>
     <div class="single-tag">
      <i class="fa fa-tag"></i>&nbsp;&nbsp;
      <a href="https://www.lmonkey.com/tag/%e8%a7%86%e9%87%8e" rel="tag">{{ $art->art_tag }}</a>
     </div>

     <!-- Bottom ad -->
     {{--<div id="singlebottom-banner">--}}
      {{--<script async="" src="js/adsbygoogle.js"></script>--}}
      {{--<!-- 自适应广告 -->--}}
      {{--<ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-8963660216421975" data-ad-slot="9559704844" data-ad-format="auto"></ins>--}}
      {{--<script>--}}
          {{--(adsbygoogle = window.adsbygoogle || []).push({});--}}
      {{--</script>--}}
     {{--</div>--}}
     <!-- /.Bottom ad -->
     <!-- Single Activity -->
     <div class="single-activity">
      <div class="mark-like-btn tinlike clr">
       <a class="share-btn like-btn" pid="5136" href="javascript:;" title="点击喜欢"> <i class="fa fa-heart"></i> <span>0</span>人喜欢 </a>
       <a class="share-btn collect collect-no" style="cursor:default;" title="你必须注册并登录才能收藏"> <i class="fa fa-star"></i> <span>0人收藏 </span> </a>
      </div>
      <div id="bdshare" class="bdshare_t bds_tools get-codes-bdshare baidu-share">
       <a href="#" class="bds_tsina weibo-btn share-btn" data-cmd="tsina"> <i class="fa fa-weibo"></i>分享到微博 </a>
       <a href="#" class="bds_weixin weixin-btn share-btn"> <i class="fa fa-weixin"></i>分享到朋友圈
        <div id="weixin-qt" style="display: none; top: 80px; opacity: 1;">
         <img src="http://qr.liantu.com/api.php?text=https://www.lmonkey.com/5136.html" width="120" />
         <div id="weixin-qt-msg">
          打开微信，点击底部的“发现”，使用“扫一扫”即可将网页分享至朋友圈。
         </div>
        </div> </a>
       <a href="#" class="bds_more more-btn share-btn" data-cmd="more"><i class="fa fa-share-alt fa-flip-horizontal"></i><span class="pc-text">更多</span><span class="mobile-text">分享</span></a>
      </div>
     </div>
     <!-- /.Single Activity -->
     <!-- Single Author Info -->
     {{--<div class="single-author clr">--}}
      {{--<div class="img">--}}
       {{--<img src="/vip/images/dcaf6a953ef7f2d89ba09c56e3327bf2?s=100&amp;d=wavatar&amp;r=g" class="avatar" width="100" height="100" />--}}
      {{--</div>--}}
      {{--<div class="single-author-info">--}}
       {{--<div class="word">--}}
        {{--<div class="wordname">--}}
         {{--关于--}}
         {{--<a href="https://www.lmonkey.com/author/tyuan629" title="由甲子田发布" rel="author">甲子田</a>--}}
        {{--</div>--}}
        {{--<div class="authordes"></div>--}}
        {{--<div class="authorsocial">--}}
         {{--<span class="social-icon-wrap"><a class="as-img as-email" href="mailto:tianguoliang629@126.com" title="给我写信"><i class="fa fa-envelope"></i></a></span>--}}
        {{--</div>--}}
       {{--</div>--}}
      {{--</div>--}}
     {{--</div>--}}
     <div class="clear"></div>
     <!-- /.Single Author Info -->
     <!-- Related Articles -->
     <div class="relatedposts">
      <!--h3 class="multi-border-hl"><span>相关文章</span></h3-->
      <ul>
       @foreach($similar as $v)
       <li>
        <div class="relatedposts-inner">
         <div class="relatedposts-inner-pic">
          <a href="{{ url('detail/'.$v->art_id) }}" title="{{ $v->art_title }}" class="">
           <div class="thumb-img">
            <img src="{{ $v->art_thumb }}" />
            <span><i class="fa fa-plus"></i></span>
           </div> </a>
         </div>
         <div class="relatedposts-inner-text">
          <a href="{{ url('detail/'.$v->art_id) }}" title="{{ $v->art_title }}">{{ $v->art_title }} </a>
         </div>
        </div>
        <div class="clear"></div> </li>
      @endforeach
      </ul>
     </div>
     <!-- /.Related Articles -->
     <!-- Prev or Next Article -->
     <div class="navigation">
      <div class="navigation-left">
       @if(is_object($pre))
       <span>上一篇</span>
       <a href="{{ url('detail/'.$pre->art_id) }}" rel="prev">{{ $pre->art_title }}</a>
        <a>&nbsp;</a>
       @else
        <span>没有上一篇了</span>
       @endif
      </div>
      <div class="navigation-right">
       @if(is_object($next))
       <span>下一篇</span>
        <a>&nbsp;</a>
       <a href="{{ url('detail/'.$next->art_id) }}" rel="next">{{ $next->art_title }}</a>
        @else
        <span>没有下一篇了</span>
       @endif
      </div>
     </div>
     <!-- /.Prev or Next Article -->
    </div>
    <!-- /.Content -->
    <!-- Comments -->
    <div class="comments-main">
     <div id="respond_box">
      <div style="margin:8px 0 8px 0">
       <h3 class="multi-border-hl"><span>发表评论</span></h3>
      </div>
      <div id="respond">
       <div class="cancel-comment-reply" style="margin-bottom:5px">
        <small><a rel="nofollow" id="cancel-comment-reply-link" href="/5136.html#respond" style="display:none;">点击这里取消回复。</a></small>
       </div>
       <form action="{{ url('comment') }}" method="post" id="commentform">
        <div class="author">
         <div id="real-avatar">
          {{ csrf_field() }}
          <img alt="" src="/home/images/b062768781e30573f0a3c8001ad4240c?s=40&amp;d=wavatar&amp;r=g" srcset="http://gravatar.duoshuo.com/avatar/b062768781e30573f0a3c8001ad4240c?s=80&amp;d=wavatar&amp;r=g 2x" class="avatar avatar-40 photo" height="40" width="40" />
         </div>
         <div id="welcome">
          欢迎回来
          <strong style="color: #f00;">Lmonkey</strong>
          <a href="javascript:toggleCommentAuthorInfo();" id="toggle-comment-author-info">更改</a>
         </div>
        </div>
        <script type="text/javascript" charset="utf-8">
            var changeMsg = "更改";
            var closeMsg = "隐藏";
            function toggleCommentAuthorInfo() {
                jQuery('#comment-author-info').slideToggle('slow', function(){
                    if ( jQuery('#comment-author-info').css('display') == 'none' ) {
                        jQuery('#toggle-comment-author-info').text(changeMsg);
                    } else {
                        jQuery('#toggle-comment-author-info').text(closeMsg);
                    }
                });
            }
            jQuery(document).ready(function(){
                jQuery('#comment-author-info').hide();
            });
        </script>
        <div id="comment-author-info">
         <p class="comment-form-input-info" style="width:30%"> <label for="author">昵称 *</label> <input type="text" name="author" id="author" class="commenttext" value="Lmonkey" size="22" tabindex="1" required="" /> </p>
         <p class="comment-form-input-info" style="width:35%"> <label for="email">邮箱 *</label> <input type="email" name="email" id="email" class="commenttext" value="3223123@qq.con" size="22" tabindex="2" required="" /> </p>
         <p class="comment-form-input-info" style="width:35%;padding-right:0"> <label for="url">网址</label> <input type="text" name="url" id="url" class="commenttext" value="" size="22" tabindex="3" /> </p>
        </div>
        <div class="clear"></div>
        <div class="comt-box">
         <textarea name="comment" id="comment" tabindex="5" rows="5" placeholder="说点什么吧..." required=""></textarea>
         {{--<div class="comt-ctrl">--}}
          {{--<span data-type="comment-insert-smilie" class="comt-smilie"><i class="fa fa-smile-o"></i> 表情</span>--}}
          {{--<span class="comt-format"><i class="fa fa-code"></i> 格式</span>--}}
          <button class="submit btn btn-submit" name="submit" type="submit"  tabindex="6"><i class="fa fa-check-square-o"></i> 提交评论</button>
          {{--<!--input class="reset" name="reset" type="reset" id="reset" tabindex="7" value="重　　写" /-->--}}
          <input type="hidden" name="comment_post_ID" value="{{ $art->art_id }}" id="comment_post_ID" />
          {{--<input type="hidden" name="comment_parent" id="comment_parent" value="0" />--}}
          {{--<p style="display: none;"><input type="hidden" id="akismet_comment_nonce" name="akismet_comment_nonce" value="856f7f2a96" /></p>--}}
          {{--<span class="mail-notify-check"><input type="checkbox" name="comment_mail_notify" id="comment_mail_notify" value="comment_mail_notify" checked="checked" style="vertical-align:middle;" /><label for="comment_mail_notify" style="vertical-align:middle;">有人回复时邮件通知我</label></span>--}}
          {{--<p style="display: none;"><input type="hidden" id="ak_js" name="ak_js" value="65" /></p>--}}
          {{--<div class="clr"></div>--}}
         {{--</div>--}}
        </div>
       </form>
       <div class="clear"></div>
      </div>
     </div>
     <div class="commenttitle">
      <a href="#normal_comments"><span id="comments" class="active"><i class="fa fa-comments-o"></i>0 评论</span></a>
      <a></a>
      <a href="#quote_comments"><span id="comments_quote"><i class="fa fa-share"></i>0 引用</span></a>
     </div>
     <ol class="commentlist" id="normal_comments">
      @foreach($comment as $v)
      <li class="comment even thread-even depth-1" id="comment-22456">
       <div id="div-comment-22456" class="comment-body">
        <img src="/home/images/?s=54&amp;d=wavatar&amp;r=g" class="avatar" width="54" height="54" />
        <span class="floor"> #10 </span>
        <div class="comment-main">
         <span style="color:#C00; font-style:inherit; margin-top:5px; line-height:25px;">{{ $v->content }}</span>
         <br />
         <div class="comment-author">
          <div class="comment-info">
           <span class="comment_author_link">{{ $v->nickname }}</span>
           <span class="comment_author_vip tooltip-trigger" title="评论达人 LV.1"><span class="vip vip1">评论达人 LV.1</span></span>
           <span class="datetime"> 1小时前 </span>
           <span class="reply"> <a rel="nofollow" class="comment-reply-login user-login" href="javascript:">登录以回复</a> </span>
           <!-- edit_comment_link(__('编辑','tinection'));-->
          </div>
         </div>
         <div class="clear"></div>
        </div>
       </div> </li>
      @endforeach
      <div class="cpagination"></div>
     </ol>
     <ol class="commentlist" id="quote_comments">
      <div class="go-trackback">
       <input type="text" class="trackback-url" value="https://www.lmonkey.com/5136.html/trackback" />
       <button type="submit" class="quick-copy-btn">复制引用</button>
      </div>
     </ol>
    </div>
    <!-- /.Comments -->
   </div>
   @parent
  </div>
  <div class="clear">
  </div>
  <!-- Blocks Layout -->
 </div>
 <!--/.Main Wrap -->
@endsection