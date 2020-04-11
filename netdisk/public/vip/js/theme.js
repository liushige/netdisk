/**
 * Main Javascript of Tinection WordPress Theme
 *
 * @package   Tinection
 * @version   1.1.6
 * @date      2015.2.10
 * @author    Zhiyan <chinash2010@gmail.com>
 * @site      Zhiyanblog <www.zhiyanblog.com>
 * @copyright Copyright (c) 2014-2015, Zhiyan
 * @license   http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link      http://www.zhiyanblog.com/tinection.html
**/

//Tooltip
 $(function(){$(".tooltip-trigger").each(function(b){
 	if(this.title){
 		var c=this.title;
 		var a=5; 
 		$(this).mouseover(function(d){
 			this.title="";
 			$(this).append('<div class="tooltip top" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner">'+c+'</div></div>');
 			$(".tooltip").css({left:(($(this).width()-$('.tooltip').width())/2)+"px",bottom:($(this).height()+a)+"px"}).addClass('in').fadeIn(250)
 		}).mouseout(function(){this.title=c;$(".tooltip").remove()});
 	}
 })});

// Content Index
$(document).on("click","#content-index-control",
  function(){
    if($('#content-index-control').hasClass('open')){
      $('#content-index-control').html('[展开]');
      $('#content-index-control').removeClass('open');
      $('#index-ul').css('display','none');
    }else{
      $('#content-index-control').html('[收起]');
      $('#content-index-control').addClass('open');
      $('#index-ul').css('display','block');
    }
  })

//Scroll to top
$(function(){
  showScroll();
  function showScroll(){
    $(window).scroll( function() { 
      var scrollValue=$(window).scrollTop();
	  if($('.floatwidget').length>0) {
        var fwbo = $('.floatwidget').offset(),
	       fwh = $('.floatwidget').height(),
           wdis = fwbo.top + fwh + 60;
        var mbh = $('#main-wrap').height(),
            mbo = $('#main-wrap').offset(),
            mb = mbo.top + mbh;
           maxh = fwh + scrollValue+110;
           if(scrollValue > wdis){
                if($('.floatwidget-container').html()==''){
                    $('.floatwidget').clone().prependTo($('.floatwidget-container'));
                }
                $('.floatwidget-container').fadeIn('slow');
                if(maxh > mb){
                  var newtop = mb-maxh+80;
                  $('.floatwidget-container').css('top',newtop);  
                }else{
                  $('.floatwidget-container').css('top',80);  
                }
            }else{
                $('.floatwidget-container').html('').fadeOut('slow');
            }
       }
      scrollValue > 200 ? $('span[id=back-to-top]').fadeIn('slow'):$('span[id=back-to-top]').fadeOut('slow');
      //fixnav
      (scrollValue > 60 && screen.width>640) ? $('#nav-scroll').addClass('tofix'):$('#nav-scroll').removeClass('tofix');

    } );  
    $('#back-to-top').click(function(){
       $("html,body").animate({scrollTop:0},1000);  
    }); 
  }
})

// 点击喜欢
$(".like-btn").click(function(){
      var _this = $(this);
      var pid = _this.attr('pid');
      if(_this.hasClass('love-yes')) return;
	  $.ajax({type: 'POST', xhrFields: {withCredentials: true}, dataType: 'html', url: tin.ajax_url, data: 'action=like&pid=' + pid, cache: false, success: function(){var num = _this.children("span").text();_this.children("span").text(Number(num)+1);_this.addClass("love-animate").attr("title","已喜欢");setTimeout(function(){_this.removeClass('love-animate').addClass('love-yes');},500);}});
});

//点击收藏或取消收藏
$('.collect').click(function(){
	var _this = $(this);
	//文章id   用户id
	var artid = Number(_this.attr('artid'));

	if(_this.attr('uid')&&_this.hasClass('collect-no')){
		var uid = Number(_this.attr('uid'));
		$.ajax({
			type: 'POST',
			dataType: 'html',
			url: 'collect',
			data: 'uid=' + uid + '&artid=' + artid + '&act=add',
			cache: false,
			success: function(){
				_this.children("span").text("已收藏");
				_this.addClass("collect-animate").attr("title","已收藏");
				setTimeout(function(){_this.removeClass('collect-animate').removeClass('collect-no').addClass('collect-yes');},500);
			}});
		return false;
	}else if(_this.attr('uid')&&_this.hasClass('collect-yes')){
		var uid = Number(_this.attr('uid'));
		$.ajax({
			type: 'POST',
			dataType: 'html',
			url: 'collect',
			data: 'uid=' + uid + '&artid=' + artid + '&act=remove',
			cache: false,
			success: function(){
				_this.children("span").text("点击收藏");
				_this.addClass("collect-animate").attr("title","点击收藏");
				setTimeout(function(){_this.removeClass('collect-animate').removeClass('remove-collect').removeClass('collect-yes').addClass('collect-no');},500);
			}
		});
		return false;
	}else{
		return;
	}   	
})

// 微信二维码浮入
var weixinTimer = null;
$('.weixin-btn').hover(function(){
  clearTimeout(weixinTimer);
  $('#weixin-qt').css('display','block').stop().animate({
    top : 40 ,
    opacity : 1 
  },500);
},function(){
  weixinTimer = setTimeout(function(){
     $('#weixin-qt').fadeOut(100,function(){
      $(this).css('top',80);
    });
  },100);
 
});

var asweixinTimer = null;
$('.as-weixin').hover(function(){
  clearTimeout(asweixinTimer);
  $('#as-weixin-qr').css('display','block').stop().animate({
    bottom : 30 ,
    opacity : 1 
  },500);
},function(){
  asweixinTimer = setTimeout(function(){
     $('#as-weixin-qr').fadeOut(100,function(){
      $(this).css('bottom',60);
    });
  },100);
 
});

var floatbtnqrTimer = null;
$('#qr').hover(function(){
  clearTimeout(floatbtnqrTimer);
  $('#floatbtn-qr').css('display','block').stop().animate({
    left : -140 ,
    opacity : 1 
  },500);
},function(){
  floatbtnqrTimer = setTimeout(function(){
     $('#floatbtn-qr').fadeOut(100,function(){
      $(this).css('left',-180);
    });
  },100);
 
});

//首页布局切换
$('#layoutswt').click(function(){
	if($('#layoutswt i').hasClass('is_blog')){
		window.location.href = $('#layoutswt i').attr('src') + '?layout=cms';
	}else if($('#layoutswt i').hasClass('is_cms')){
		window.location.href = $('#layoutswt i').attr('src') + '?layout=blocks';
	}else{
		window.location.href = $('#layoutswt i').attr('src') + '?layout=blog';
	}
})
//头像旋转
$("#main-wrap img.avatar").mouseover(function(){
	$(this).addClass("avatar-rotate");
});

$("#main-wrap img.avatar").mouseout(function(){
	$(this).removeClass("avatar-rotate");
});

// 清理百度分享多余代码
window.onload=function(){
  $('#bdshare_s').html('');
};

// 评论框快速代码标签
/* comment editor
-----------------------------------------------*/
$(function() {
    function addEditor(a, b, c) {
        if (document.selection) {
            a.focus();
            sel = document.selection.createRange();
            c ? sel.text = b + sel.text + c: sel.text = b;
            a.focus()
        } else if (a.selectionStart || a.selectionStart == '0') {
            var d = a.selectionStart;
            var e = a.selectionEnd;
            var f = e;
            c ? a.value = a.value.substring(0, d) + b + a.value.substring(d, e) + c + a.value.substring(e, a.value.length) : a.value = a.value.substring(0, d) + b + a.value.substring(e, a.value.length);
            c ? f += b.length + c.length: f += b.length - e + d;
            if (d == e && c) f -= c.length;
            a.focus();
            a.selectionStart = f;
            a.selectionEnd = f
        } else {
            a.value += b + c;
            a.focus()
        }
    }
    var g = document.getElementById('comment') || 0;
    var h = {
        strong: function() {
            addEditor(g, '<strong>', '</strong>')
        },
        em: function() {
            addEditor(g, '<em>', '</em>')
        },
        del: function() {
            addEditor(g, '<del>', '</del>')
        },
        underline: function() {
            addEditor(g, '<u>', '</u>')
        },
        quote: function() {
            addEditor(g, '<blockquote>', '</blockquote>')
        },
        private: function() {
            addEditor(g, '[private]','[/private]')
        },
        ahref: function() {
            var a = prompt('请输入链接地址', 'http://');
            var b = prompt('请输入链接描述','');
            if (a) {
                addEditor(g, '<a target="_blank" href="' + a + '" rel="external">' + b + '</a>','')
            }
        },
        img: function() {
            var a = prompt('请输入图片地址', 'http://');
            if (a) {
                addEditor(g, '<img src="' + a + '" alt="" />','')
            }
        },
        code: function() {
            addEditor(g, '<code>', '</code>')
        },
        php: function() {
            addEditor(g, '<pre class="prettyprint linenums php" >', '</pre>')
        },
        js: function() {
            addEditor(g, '<pre class="prettyprint linenums js" >', '</pre>')
        },
        css: function() {
            addEditor(g, '<pre class="prettyprint linenums css" >', '</pre>')
        }
    };
    window['SIMPALED'] = {};
    window['SIMPALED']['Editor'] = h
});

//Rating
$('.stars').mouseover(function(){
	if($('.rates').hasClass('rated')){
		return;
	}else{
	$('.stars').children('i').removeClass('fa-star').addClass('fa-star-o');
	$(this).prevAll().children('i').removeClass('fa-star-o').addClass('fa-star');
	$(this).children('i').removeClass('fa-star-o').addClass('fa-star');	
}});
$('.stars').click(function(){
	if($('.rates').hasClass('rated')){
		return;
	}else{
	$('.rates').addClass('rated');
	var sid = $(this).attr('id');
	var pid = $('.rates').attr('pid');
	var tt = $(this).attr('times');
	tt = Number(tt)+1;
	$(this).attr('times',tt);
	var t1 = $('#starone').attr('times');
	var t2 = $('#startwo').attr('times');
	var t3 = $('#starthree').attr('times');
	var t4 = $('#starfour').attr('times');
	var t5 = $('#starfive').attr('times');
	var alltimes = Number(t1)+Number(t2)+Number(t3)+Number(t4)+Number(t5);
	var allscore = Number(t1)*1+Number(t2)*2+Number(t3)*3+Number(t4)*4+Number(t5)*5;
	ra = allscore/alltimes;
	ra = ra.toFixed(1);
	function refresh_star(ra){
		allt = $('.ratingCount').html();
		allt = Number(allt) + 1;
		$('.ratingCount').html(allt);
		$('.ratingValue').html(ra);
	}
	jQuery.ajax({type: 'POST', xhrFields: {withCredentials: true}, dataType: 'html', url: tin.ajax_url, data: 'action=rating&sid=' + sid + '&pid=' + pid, cache: false, success:refresh_star(ra)});
}});
$('.stars').mouseout(function(){
function back_star(id){
	if($(id).attr('solid')=='y'){
		$(id).children().attr('class','fa fa-star');
	}else{
		$(id).children().attr('class','fa fa-star-o');
	}
};
	if($('.rates').hasClass('rated')){
		return;
	}else{
		back_star('#starone');back_star('#startwo');back_star('#starthree');back_star('#starfour');back_star('#starfive');
	}
});

//Send mail message
var errTimer = null;
$('#submit-mail').click(function(){
	$('.err').hide();
	name = $('#t-name').val();
	mail = $('#t-email').val();
	comment = $('#t-comment').val();
	num1 = $('input#t-num1').val();
	num2 = $('input#t-num2').val();
	sum = $('input#captcha2').val();
	clearTimeout(errTimer);
	if(name==''){
		$('.err').html('姓名不能为空').slideToggle(1000);
		$("input#t-name").focus();
		errTimer = setTimeout(function(){
			$('.err').slideToggle(1000);
		},3000);
		return false;
	}
	if(mail==''){
		$('.err').html('邮箱地址不能为空').slideToggle(1000);
		$("input#t-email").focus();
		errTimer = setTimeout(function(){
			$('.err').slideToggle(1000);
		},3000);
		return false;
	}
	if(!mail.match('^([a-zA-Z0-9_-])+((\.)?([a-zA-Z0-9_-])+)+@([a-zA-Z0-9_-])+(\.([a-zA-Z0-9_-])+)+$')){
		$('.err').html('邮箱地址格式不正确').slideToggle(1000);
		$("input#t-email").focus();
		errTimer = setTimeout(function(){
			$('.err').slideToggle(1000);
		},3000);
		return false;
	}
	if(sum==''){
		$('.err').html('验证码不能为空').slideToggle(1000);
		$("input#captcha2").focus();
		errTimer = setTimeout(function(){
			$('.err').slideToggle(1000);
		},3000);
		return false;
	}
	if(Number(num1)+Number(num2)!=Number(sum)){
		$('.err').html('验证码不正确').slideToggle(1000);
		$("input#captcha2").focus();
		errTimer = setTimeout(function(){
			$('.err').slideToggle(1000);
		},3000);
		return false;
	}
	if(comment==''){
		$('.err').html('消息内容不能为空').slideToggle(1000);
		$("textarea#t-comment").focus();
		errTimer = setTimeout(function(){
			$('.err').slideToggle(1000);
		},3000);
		return false;
	}
	$('input#submit-mail').css({'color':'#fff','background':'#1cbdc5'}).val('正在发送');
 	$.ajax({type: 'POST', xhrFields: {withCredentials: true}, dataType: 'html', url: tin.ajax_url, data: 'action=message&tm=' + mail + '&tn=' + name + '&tc=' + comment, cache: false,success: mail_success()});
	function mail_success(){
		errTimer = setTimeout(function(){
			$('#mailmessage').html('<p class="mail-success"><i class="fa fa-check"></i>消息发送成功,你也可以扫描下方微信二维码并随时与我联系.</p><div><img src="'+tin.tin_url+'/images/weixin.png"></div>');
		},2000)
	}
    return false;
})

//mail send download link
var dlmsgTimer = null;
$('.mail-dl-btn').click(function(){
	$('.dl-msg').hide();
	mail = $('.mail-dl').val();
	pid = $('.dl-mail').attr('pid');
	clearTimeout(dlmsgTimer);	
	if(mail==''){
		$('.dl-msg').html('邮箱地址不能为空').slideToggle(1000);
		$("input.mail-dl").focus();
		dlmsgTimer = setTimeout(function(){
			$('.dl-msg').slideToggle(1000);
		},3000);
		return false;
	}
	if(!mail.match('^([a-zA-Z0-9_-])+((\.)?([a-zA-Z0-9_-])+)+@([a-zA-Z0-9_-])+(\.([a-zA-Z0-9_-])+)+$')){
		$('.dl-msg').html('邮箱地址格式不正确').slideToggle(1000);
		$("input.mail-dl").focus();
		dlmsgTimer = setTimeout(function(){
			$('.dl-msg').slideToggle(1000);
		},3000);
		return false;
	}
	if(!document.getElementById('dl-terms-chk').checked){
		$('.dl-msg').html('你必须同意勾选下载条款').slideToggle(1000);
		dlmsgTimer = setTimeout(function(){
			$('.dl-msg').slideToggle(1000);
		},3000);
		return false;
	}
 	$.ajax({type: 'POST', xhrFields: {withCredentials: true}, dataType: 'html', url: tin.ajax_url, data: 'action=maildownload&mail=' + mail + '&pid=' + pid, cache: false,success: dlmail_success()});
	function dlmail_success(){
		dlmsgTimer = setTimeout(function(){
			$('.single-download').html('<span><p class="mail-dl-success"><i class="fa fa-check"></i>请求发送成功,请稍候检查你的收件箱.如果长时间未收到,请检查垃圾箱或者直接通过下方网站下方消息框发送包含该文章链接的邮件消息给我，我会及时处理回复.你也可以扫描下方微信二维码并随时与我联系.</p></span><div><img src="'+tin.tin_url+'/images/weixin.png"></div>');
			$.ajax({type: 'POST', xhrFields: {withCredentials: true}, dataType: 'html', url: tin.ajax_url, data: 'action=whodownload&mail=' + mail + '&pid=' + pid, cache: false});
		},2000);       
	}
    return false;	
})

// Download times
$('.downldlink').click(function(){
    metakey = $(this).attr('id');
    pid = $('.downldlinks-inner').attr('pid');
    $.ajax({type: 'POST', xhrFields: {withCredentials: true}, dataType: 'html', url: tin.ajax_url, data: 'action=downldtimes&key=' + metakey + '&pid=' + pid, cache: false});
})

// Buy resources
$('.buysaledl').click(function(){
    sid = $(this).attr('id');
    pid = $('.downldlinks-inner').attr('pid');
    uid = $('.downldlinks-inner').attr('uid');
    var login_in = 0;
    $.ajax({type: 'POST', dataType: 'json', url: tin.ajax_url, data: 'action=checklogin', cache: false, success: function(check){login_in = check.status;
        if (login_in!=0){
            $.ajax({type: 'POST', dataType: 'json', url: tin.ajax_url, data: 'action=popsaledl&sid=' + sid + '&pid=' + pid + '&uid=' + uid, cache: false, success: function(msg){
                $('.buy-pop-out').fadeIn('fast');
                $('.confirm-buy').html('<button class="cancel-to-back btn btn-warning">取消</button>');
                $(".cancel-to-back").click(function(){$('.buy-pop-out').fadeOut();})
                $('.dl-price').html(msg.price);$('.all-credits').html(msg.credit);
                enough = Number(msg.enough);
                if(enough==0){$('.saledl-msg').html('抱歉，你当前的积分不足以支付该资源！ <a href="http://www.zhiyanblog.com/how-to-earn-credits.html" title="赚取积分" target="_blank">如何赚取积分?</a>');
                }else{
					$('.saledl-msg').html('');
                    $('.confirm-buy').prepend('<button class="yes-to-buy btn btn-success" sid="' + msg.sid + '">确定</button>');
                    $('.yes-to-buy').click(Confirm_to_buy);
                }
            }});            
        }else{
            $('.buy-pop-out').fadeIn('fast');
            $('.confirm-buy').html('<button class="cancel-to-back btn btn-warning">返回</button>');
            $(".cancel-to-back").click(function(){$('.buy-pop-out').fadeOut();});
            $('.buy-des').html('<p>出错了！</p><p>Wordpress未检测到登录，可能你已从别的本站页面注销，请刷新网页并重新登录！</p>');
        }
    }});
})

// Confirm to buy
function Confirm_to_buy(){
    sid = $(this).attr('sid');
    pid = $('.downldlinks-inner').attr('pid');
    uid = $('.downldlinks-inner').attr('uid');
    $.ajax({type: 'POST', dataType: 'json', url: tin.ajax_url, data: 'action=confirmbuy&sid=' + sid + '&pid=' + pid + '&uid=' + uid, cache: false, success: function(msg){
            msg.success = Number(msg.success);
            if(msg.success==1){
                info = '<p>购买成功，已扣除你<span>' + msg.price + '</span>积分，当前你还剩余<span>' + msg.credit + '</span>积分</p><p>同时系统也通过邮件发送下载链接至你在本站资料中所保留的邮箱，以备不时之需！';
            }else if(msg.success==2){
                info = '<p>你似乎已购买过该资源，请刷新页面查看！</p><p>请不要多次点击购买，以免重复扣除积分，如果有积分错误，请站内信或通过邮件消息工具通知管理员！</p>';
            }else{
                info = '<p>购买失败，请重新再试！</p><p>如果你发现积分重复扣除或多扣等错误，请站内信或通过邮件消息工具通知管理员！</p>'
            }
            $('.buy-des').html(info);
            $('.confirm-buy').html('<button class="cancel-to-back btn btn-success">返回</button>');
            $(".cancel-to-back").click(function(){$('.buy-pop-out').fadeOut();})
            setTimeout(function(){
                $('.buy-pop-out').fadeOut('fast');
                location.reload();
            },3000);
    }});
}

// Close pop-up
$(".alert_close, .alert_cancel .btn").click(function(){
    $('.tinalert').fadeOut();
})

// Alert template
function tinAlert($msg){
	var $content = '<div class="tinalert"><div class="alert_title"><h4>来自网页的提醒</h4></div><div class="alert_content"><p>'+$msg+'</p></div><div class="alert_cancel"><button class="cancel-to-back btn btn-danger">确定</button></div><span class="alert_close"><i class="fa fa-close"></i></span></div>';
	$('body').append($content);
	$(".alert_close, .alert_cancel .btn").bind('click',function(){
		$('.tinalert').fadeOut().remove();
	})
	$('.tinalert').fadeIn();
}


// Ajax post basic
var tinRefreshIcon = '<i class="fa fa-spinner fa-spin" style="margin-right:4px;line-height:20px;font-size:20px;font-size:2rem;"></i>';
function tin_do_post(formid, posturl, postdata, contentid){
	$(formid).find('[type="submit"]').addClass('disabled').prepend(tinRefreshIcon);
	$.ajax({
		type: 'POST', 
		url: posturl,
		data: postdata,
		success: function(response) {
			$(contentid).html($(response).find(contentid).html());
		},
		error: function(){
			tin_do_post(formid, posturl, postdata, contentid);
		}
	});
}

//Submit
$('#pmform').submit(function(){
	var formid = '#pmform';
	var p = $(formid);
	tin_do_post(
		formid, 
		location.href, 
		{
		'pmNonce' : p.find('[name="pmNonce"]').val(),
		'pm' : p.find('[name="pm"]').val()
		},
		'.content'
	);
	return false;
});
$('#creditform').submit(function(){
	var formid = '#creditform';
	var p = $(formid);
    var obj;
    var checked;       
    obj=document.getElementsByName('creditChange');   
    if(obj){
        for (var i = 0; i < obj.length; i++){
            if(obj[i].checked){
                checked = obj[i].getAttribute('value');
            }else{checked = 'add';}
        }      
    }else{checked = 'add';}
	tin_do_post(
		formid, 
		location.href, 
		{
		'creditNonce' : p.find('[name="creditNonce"]').val(),
		'creditChange' : checked,
		'creditNum' : p.find('[name="creditNum"]').val(),
		'creditDesc' : p.find('[name="creditDesc"]').val()
		},
		'.content'
	);
	return false;
});

// Add promote code
$('#promoteform').submit(function(){
	var formid = '#promoteform';
	var p = $(formid);
    var obj;
    var checked;       
    obj=document.getElementsByName('promote_type');   
    if(obj){
        for (var i = 0; i < obj.length; i++){
            if(obj[i].checked){
                checked = obj[i].getAttribute('value');
            }else{checked = 'once';}
        }      
    }else{checked = 'once';}
	tin_do_post(
		formid, 
		location.href, 
		{
		'promoteNonce' : p.find('[name="promoteNonce"]').val(),
		'promote_code' : p.find('[name="promote_code"]').val(),
		'promote_type' : checked,
		'discount_value' : p.find('[name="discount_value"]').val(),
		'expire_date' : p.find('[name="expire_date"]').val()
		},
		'.content'
	);
	return false;
});

// Delete promote code
$('.delete_promotecode').on('click',function(){
	var p = $(this).parent('tr').children('input[name=promote_id]');
	var promote_id = p.val();
	var dpromoteNonce = $('.promote-table input[name=dpromoteNonce]').val();
    $.ajax({
		type: 'POST', 
		url: location.href,
		data: {
			'promote_id': promote_id,
			'dpromoteNonce': dpromoteNonce
		},
		success: function(response) {
			$('.content').html($(response).find('.content').html());
		},
		error: function(){
			tinAlert('删除失败,请重新再试');
		}
	});
	return false;
});

// Subscribe
$('button#subscribe').click(function(){
	email = $('input#subscribe').val();
	if(email==''||(!email.match('^([a-zA-Z0-9_-])+((\.)?([a-zA-Z0-9_-])+)+@([a-zA-Z0-9_-])+(\.([a-zA-Z0-9_-])+)+$'))){
		$('#subscribe-msg').html('请输入正确邮箱').slideToggle('slow');
		setTimeout(function(){$('#subscribe-msg').slideToggle('slow');},2000);
	}else{
		$.ajax({type: 'POST', dataType: 'json', url: tin.ajax_url, data: 'action=subscribe&email=' + email, cache: false, success:function(){
			$('#subscribe-span').html('你已成功订阅该栏目，同时你也会收到一封提醒邮件.');
		}})
	}
})
	
// Unsubscribe
$('button#unsubscribe').click(function(){
	email = $('input#unsubscribe').val();
	if(email==''||(!email.match('^([a-zA-Z0-9_-])+((\.)?([a-zA-Z0-9_-])+)+@([a-zA-Z0-9_-])+(\.([a-zA-Z0-9_-])+)+$'))){
		$('#unsubscribe-msg').html('请输入正确邮箱').slideToggle('slow');
		setTimeout(function(){$('#unsubscribe-msg').slideToggle('slow');},2000);
	}else{
		$.ajax({type: 'POST', dataType: 'json', url: tin.ajax_url, data: 'action=unsubscribe&email=' + email, cache: false, success:function(data){
			$('#unsubscribe-span').html(data.msg);
		}})
	}
})
	
// Cookie
// function set cookie
function tinSetCookie(c_name,value,expire,path){
	var exdate=new Date();
	exdate.setTime(exdate.getTime()+expire*1000);
	document.cookie=c_name+ "=" +escape(value)+((expire==null) ? "" : ";expires="+exdate.toGMTString())+((path==null) ? "" : ";path="+path);
}
// function get cookie
function tinGetCookie(c_name){
	if (document.cookie.length>0){
		c_start=document.cookie.indexOf(c_name + "=");
		if (c_start!=-1){ 
			c_start=c_start + c_name.length+1;
			c_end=document.cookie.indexOf(";",c_start);
			if (c_end==-1) c_end=document.cookie.length;
			return unescape(document.cookie.substring(c_start,c_end));
		}
	}
	return ""
}
// function set wp nonce cookie
function set_tin_nonce(){
//	$.ajax({
//		type: 'POST', url: tin.ajax_url, data: { 'action' : 'tin_create_nonce' },
//		success: function(response) {
//			tinSetCookie('tin_check_nonce',$.trim(response),3600,tin.home);
//		},
//		error: function(){
//			set_tin_nonce();
//		}
//	});
}
// var get wp nonce cookie
var wpnonce = tinGetCookie('tin_check_nonce');
// action set wp nonce cookie ( if wp nonce is null or empty )
if (wpnonce==null || wpnonce=="") set_tin_nonce();

// Ajax update traffic
function update_tin_traffic(t,p){
	$.ajax({
		type: 'POST', 
		url: tin.ajax_url, 
		data: {
			'action' : 'tin_tracker_ajax',
			'type' : t,
			'pid' : p,
			'wp_nonce' : tinGetCookie('tin_check_nonce')
		},
		success: function(response) {
			//~ @action reset wp nonce ( if response invalid ) and try again
			if($.trim(response)==='NonceIsInvalid'){
				set_tin_nonce();
				update_tin_traffic(t,p);
			}
		},
		error: function(){
			//~ @action try again ( if error )
			update_tin_traffic(t,p);
		}
	});
}

// Get promoter name in url
function tinGetQueryString(name){
     var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
     var r = window.location.search.substr(1).match(reg);
     if(r!=null)return  unescape(r[2]); return null;
}

// Header search slide
	$('.search-btn-click').bind('click',function(){
        if($(this).children('.header-search-slide').css('display')=='none'){
            $(this).css({'background':'#fafafa'});
            $(this).children('.header-search-slide').slideDown();
            $(this).children('.header-search-slide').children().children('input').focus();
        }
	})
	$('.header-search-slide').children().children('input').bind('blur',function(){
		$('.search-btn-click').css({'background':'transparent'});
		$('.header-search-slide').slideUp();
	})
	
// Toggle mobile menu
    var opened=false;
    $('.toggle-menu').bind('click',function(event){
		if(screen.width>640){
			$('#primary-navigation ul').slideToggle();
		}
			$('#content-container').toggleClass('push');
			$('#navmenu-mobile-wraper').toggleClass('push');
			if(opened){
				opened=false;
				setTimeout(function(){
					$('#navmenu-mobile').removeClass('push');
				},500)
			}else{
				$('#navmenu-mobile').addClass('push');
				opened=true
			}
    });
    $('#main-wrap').bind('click',function(){
        if(screen.width<=640 && opened==true){
            $('#content-container').toggleClass('push');
            $('#navmenu-mobile-wraper').toggleClass('push');
            setTimeout(function(){
                $('#navmenu-mobile').removeClass('push');
            },500);
            opened=false;
        }
    })

// Toggle sortpage menu
$('#page-sort-menu-btn a').click(function(){
	$('.pagesidebar ul').slideToggle();
})	
	
// Slide nav
	$(".menu-item-has-children").bind('mouseover',function(){
		if(screen.width>640&&!$(this).children('ul').is(":animated")) $(this).children('ul').slideDown(); 
	}).bind('mouseleave',function(){
		if(screen.width>640) $(this).children('ul').slideUp(); 
	});

	$('.login-yet-click').bind('mouseover',function(){
		if(!$(this).children('.user-tabs').is(":animated"))$(this).children('.user-tabs').slideDown();
	}).bind('mouseleave',function(){
		$(this).children('.user-tabs').slideUp();
	})

// Slide focus-us
$('#focus-us').bind('mouseover',function(){
	if(!$(this).children('#focus-slide').is(":animated"))$(this).children('#focus-slide').slideDown();
}).bind('mouseleave',function(){
	$(this).children('#focus-slide').slideUp();
})

//Toggle smiles
$('.comt-smilie').bind('click',function(){
	$('#comt-format').hide();
    $('#comt-smilie').toggle();
})
$('.comt-format').bind('click',function(){
    $('#comt-smilie').hide();
    $('#comt-format').toggle();
})

//Upload avatar
$('#edit-avatar').click(function(){
    $('#upload-input').slideToggle();
})
$('#upload-avatar').click(function(){
    var file = $('#upload-input input[type=file]').val();
    if(file==''){
        $('#upload-avatar-msg').html('请选择一个图片').slideDown();
        setTimeout(function(){$('#upload-avatar-msg').html('').slideUp();},2000);
    }else{
       document.getElementById('info-form').enctype = "multipart/form-data";
        $('form#info-form').submit();
    } 
})

//general popup
$("[data-pop]").on("click", function() {
    var b = $(this).attr("data-pop");
    $("div.overlay").length<=0?$(".header-wrap").before('<div class="overlay"></div>'):$("div.overlay").show();
    $(".popupbox").hide(), $("#" + b).fadeIn();
})

$("[data-top]").on("click", function() {
    var b = $(this).attr("data-top");
    "true" == b && $("body,html").animate({
        scrollTop: 0
    }, 0)
})

$('body').on("click","div.overlay,a.popup-close",function(){
    $("div.popupbox, div.overlay").fadeOut();
})

// amount plus or minus
function calculate() {
    $("#total-price").find("strong").text("￥" + Number($("#order_quantity").val() * $("#order_price").val()).toFixed(2))
}
$("div.amount-number a").on("click", function(b) {
    b.preventDefault(), fieldName = $(this).attr("field"), fieldstyle = $(this).attr("id");
    var c = parseInt($("input[name=" + fieldName + "]").val());
	var d = parseInt($('li.summary-amount span.dt-num').text());
    "plus" == fieldstyle ? Number(c) >= d ? $("input[name=" + fieldName + "]").val(d) : isNaN(c) ? $("input[name=" + fieldName + "]").val(0) : $("input[name=" + fieldName + "]").val(c + 1) : "minus" == fieldstyle && (!isNaN(c) && c > 1 ? $("input[name=" + fieldName + "]").val(c - 1) : $("input[name=" + fieldName + "]").val(1))
}), 
$("input[name=amountquantity]").keyup(function() {
    var c = $(this).val();
	var d = parseInt($('li.summary-amount span.dt-num').text());
    if(!/^(\+|-)?\d+$/.test(c) || 0 >= c) $(this).val(1);
	if(d<c) $(this).val(d)
}), 
$("a.buy-btn").on("click", function(b) {
    b.preventDefault(), $("input[name=order_quantity]").val($("input[name=amountquantity]").val()), calculate()
}),
$("#order_quantity").keyup(function() {
    var c = $(this).val();
    "" == c ? $(this).val(1) : ($("#pay-submit").removeAttr("disabled"), (!/^(\+|-)?\d+$/.test(c) || 0 >= c) && $(this).val(1)),calculate()
})

// create a order
$('#pay-submit').on('click',function create_order(){
	var product_id = $('input#product_id').val(),
        promote_code = $('input#promote_code').val(),
        order_name = $('input#order_name').val(),
		order_quantity = $('input#order_quantity').val(),
		receive_name = $('input#receive_name').val(),
		receive_address = $('input#receive_address').val(),
		receive_zip = $('input#receive_zip').val(),
        receive_email = $('input#receive_email').val(),
		receive_phone = $('input#receive_phone').val(),
		receive_mobile = $('input#receive_mobile').val(),
		order_msg = $('input[name=order_body]').val(),
		wp_nonce = $('input[name=order_nonce]').val();
	$.ajax({
		type: 'POST',
		dataType: 'json',
		async: false,
		url: tin.ajax_url, 
		data: {
			'action' : 'create_order',
			'product_id' : product_id,
            'promote_code': promote_code,
            'order_name' : order_name,
			'order_quantity' : order_quantity,
			'receive_name' : receive_name,
			'receive_address' : receive_address,
			'receive_zip' : receive_zip,
            'receive_email' : receive_email,
			'receive_phone' : receive_phone,
			'receive_mobile' : receive_mobile,
			'order_msg' : order_msg,
			'wp_nonce' : wp_nonce
		},
		success: function(response) {
			//~ @action reset wp nonce ( if response invalid ) and try again
			if($.trim(response.msg)=='NonceIsInvalid'){
				tinAlert('安全验证未通过,订单未被提交,请刷新页面再试');
			}else if(response.success==0){
				tinAlert(response.msg);
			}else if(response.redirect==0){
				location.replace(location.href);
			}else if(response.redirect==1){
				$('input#order_id').val(response.order_id);
				$('form#alipayment').submit();
			}else{
                return;
            }
		},
	});
	return false;
});

//use promote code
$('#promote_code_apply').click(function(){
	var code = $('input#promote_code').val();
	var total = Number($("#order_quantity").val() * $("#order_price").val()).toFixed(2);
	if(code==''){return;}else{
		$.ajax({
			type: 'POST',
			dataType: 'json',
			async: false,
			url: tin.ajax_url, 
			data:{
				'action' : 'use_promote_code',
				'promote_code': code,
				'order_total_price': total
			},
			success:function(response){
				if(response.success==1){
					$('#promote_code,#promote_code_apply').css('display','none');
					$('#promote').append('应用优惠码成功,请直接提交支付');
					$("#total-price").find("strong").text("￥"+response.total_price);
				}else{tinAlert(response.msg);}
			},
		
		});
	}
})

//join vip
$('#joinvip-submit').click(function create_vip_order(){
	$('#joinvip-submit').addClass('disabled').prepend(tinRefreshIcon);
	var obj;
    var product_id = -1;       
    obj=document.getElementsByName('product_id');   
    if(obj){
        for (var i = 0; i < obj.length; i++){
            if(obj[i].checked){
                product_id = obj[i].getAttribute('value');
            }
        }      
    }
	$.ajax({
			type: 'POST',
			dataType: 'json',
			async: false,
			url: tin.ajax_url, 
			data:{
				'action' : 'create_vip_order',
				'product_id': product_id
			},
			success:function(response){
				$('#joinvip-submit').removeClass('disabled');
				$('#joinvip-submit i').remove();
				if(response.success==1){
					$('input#order_id').val(response.order_id);
					$("form#joinvip").attr('onsubmit','').submit();
				}else{tinAlert(response.msg);}
			},	
		});
	return false;
})

//credit recharge order
$('#creditrechargesubmit').on('click',function(){
	var obj = $('#creditrechargeform');
	obj.find('[type="submit"]').addClass('disabled').prepend(tinRefreshIcon);
    var product_id = -4,
		creditrechargeNum = obj.find('input[name=creditrechargeNum]').val();       
	$.ajax({
			type: 'POST',
			dataType: 'json',
			async: false,
			url: tin.ajax_url, 
			data:{
				'action' : 'create_credit_recharge_order',
				'product_id': product_id,
				'creditrechargeNum': Number(creditrechargeNum)
			},
			success:function(response){
				if(response.success==1){
					obj.find('input#order_id').val(response.order_id);
					obj.attr('onsubmit','').submit();
				}else{tinAlert(response.msg);}
			},	
		});
	return false;
})

// Daily sign
$('a#daily_sign').bind('click',function(){
	var $this = $(this);
	$.ajax({
		type: 'POST',
		dataType: 'json',
		async: false,
		url: tin.ajax_url,
		data: {'action':'daily_sign'},
		success: function(response) {
			if(response.success==1){
				$this.attr({'id':'daily_signed','title':'今日已签到'}).text('已签到');
				if($this.prev('a').length>0){
					var credit = Number($.trim($this.prev('a').text()))+Number(response.credits);
					$this.prev('a').text(' '+credit);
				}else{
					tinAlert(response.msg);
				}
			}else{
				tinAlert(response.msg);
			}
		},
	});
});

// Document ready
// --------------------
// -------------------- //
$(document).ready(function(){
    //QR img
    var qcode = {
      api : "http://qr.liantu.com/api.php?text=",
      url :  window.location.href,
      exist : false,
      create : function(){
      if(!this.exist){
        var image = document.createElement('img');
        image.src = this.api + this.url;
        image.width = 120;
        this.exist = true;
        return image;
        }
      }
    };
    document.getElementById('floatbtn-qr').insertBefore(qcode.create(),document.getElementById('floatbtn-qr-msg'));
	
	//Toggle Content
	$('.toggle-click-btn').click(function(){
		$(this).next('.toggle-content').slideToggle('slow');
        if($(this).hasClass('yes')){
            $(this).removeClass('yes');
            $(this).addClass('no');
        }else{
            $(this).removeClass('no');
            $(this).addClass('yes');
        }
	});

    //Archves page
    (function(){
         $('#archives span.al_mon').each(function(){
             var num=$(this).next().children('li').size();
             var text=$(this).text();
             $(this).html(text+'<em> ( '+num+' 篇文章 )</em>');
         });
         var $al_post_list=$('#archives ul.al_post_list'),
             $al_post_list_f=$('#archives ul.al_post_list:first');
         $al_post_list.hide(1,function(){
             $al_post_list_f.show();
         });
         $('#archives span.al_mon').click(function(){
             $(this).next().slideToggle('slow');
             return false;
         });
         $('#al_expand_collapse').toggle(function(){
             $al_post_list.show();
         },function(){
             $al_post_list.hide();
         });
     })();

     //Title loading 
     $('h3 a').click(function(){
        myloadoriginal = this.text;
        $(this).text('请稍等，正在努力加载中...');
        var myload = this;
        setTimeout(function() { $(myload).text(myloadoriginal); }, 2000);
    });
	
	//Infobg close
	$('.infobg-close').click(function(){
		$(this).parent('.contextual').fadeOut('slow');
	})

    //Marquee site news
    function startmarquee(lh,speed,delay,index){ 
        var t; 
        var p=false; 
        var o=document.getElementById("news-scroll-zone"+index); 
        o.innerHTML+=o.innerHTML; 
        o.onmouseover=function(){p=true} 
        o.onmouseout=function(){p=false} 
        o.scrollTop = 0; 
        function start(){ 
            t=setInterval(scrolling,speed); 
            if(!p){ o.scrollTop += 1;} 
        } 
        function scrolling(){ 
            if(o.scrollTop%lh!=0){ 
            o.scrollTop += 1; 
            if(o.scrollTop>=o.scrollHeight/2)
                o.scrollTop = 0; 
            }else{ 
                clearInterval(t); 
                setTimeout(start,delay); 
            } 
        } 
        setTimeout(start,delay); 
    }
    if($('#news-scroll-zone').length>0){
        startmarquee(20,30,5000,'');
    }  
	
	//Lazyload
	$(".fancyimg img, .post-item-thumbnail img, tab-item-thumbnail img .avatar img, .newsletter-thumbnail img").lazyload({
//        	placeholder:tin.tin_url+"/images/image-pending.gif",
            effect:"fadeIn"
    });
	
	// action tin affiliate url and trackback url
	$('.tin_aff_url,.trackback-url,input[name=rss]').click(function(){
		$(this).select();
	});
	$('.quick-copy-btn').click(function(){
		$(this).parent().children('input').select();
		alert('请用CTRL+C复制');
	})
	
	// action set affiliate cookie ( credit )
	if(tinGetQueryString('aff')) tinSetCookie('tin_aff',tinGetQueryString('aff'),86400,tin.home);
	
	// action update traffic
//	if(!(typeof(tin.Tracker) == "undefined")) update_tin_traffic(tin.Tracker.type,tin.Tracker.pid);
	
	// go to comment
	$('.commentbtn').click(function(){$('html,body').animate({scrollTop:$('#comments').offset().top}, 800);});
	
	// loading complete
	$('.site_loading').fadeOut();

    // comments tabs
    $('.commenttitle span').click(function(e){
        $('.commenttitle span').removeClass('active');
        $(this).addClass('active');
        $('.commentlist').hide();
        $($(this).parent('a').attr('href')).fadeIn();
        e.preventDefault();
    })
	
	// stickys & latest tabs
    $('.stickys span.heading-text-cms').click(function(e){
        $('.stickys span.heading-text-cms').removeClass('active');
        $(this).addClass('active');
        $('.stickys-latest-list').hide();
        $($(this).attr('id')).fadeIn();
        e.preventDefault();
    })
	
    // Mobile nav append
    $('#menu-mobile li.menu-item-has-children').prepend('<span class="child-menu-block"></span>');
    // Mobile menu click toggle
    $('.child-menu-block').on('click',function(){
        $(this).parent().children('.sub-menu').slideToggle();
        if($(this).parent().hasClass('expand')){
            $(this).parent().removeClass('expand');
        }else{
            $(this).parent().addClass('expand');
        }
    })
	
	// href add _blank
	var titles = $('h1 a,h2 a,h3 a');
	titles.each(function(){
		$(this).attr('target','_blank');
	})
	
	// code highlight
    window.prettyPrint && prettyPrint();
	
	// Tabs widget
	$(function() {
		var $tabsNav       = $('.tin-tabs-nav'),
			$tabsNavLis    = $tabsNav.children('li'),
			$tabsContainer = $('.tin-tabs-container');

		if($tabsNav.length>0)$tabsNav.each(function() {
			var $this = $(this);
			$this.next().children('.tin-tab').stop(true,true).hide()
			.siblings( $this.find('a').attr('href') ).show();
			$this.children('li').first().addClass('active').stop(true,true).show();
		});

		$tabsNavLis.on('mouseover', function(e) {
			var $this = $(this);
			if($this.hasClass('active')) return;
			$this.siblings().removeClass('active').end()
			.addClass('active');
			
			$this.parent().next().children('.tin-tab').stop(true,true).hide()
			.siblings( $this.find('a').attr('href') ).fadeIn();
			e.preventDefault();
		})//.children( window.location.hash ? 'a[href=' + window.location.hash + ']' : 'a:first' ).trigger('click');
		$tabsNavLis.on('click', function(e) {
			e.preventDefault();
		})
	})
	
	// Store switch
	$(function() {
        var $wrapNav       = $('#wrapnav ul.nav'),
            $wrapNavLis    = $wrapNav.children('li');
        if($wrapNav.length>0)$wrapNav.each(function() {
            var $this = $(this);
            $this.children('li').first().addClass('active');
            $($this.find('a').attr('href')).show();
        });

        $wrapNavLis.on('click', function(e) {
            var $this = $(this);
            if($this.hasClass('active')) return;
            $this.siblings().removeClass('active').end().addClass('active');
            $this.parent().parent().next().children('.wrapbox').stop(true,true).hide().siblings( $this.find('a').attr('href') ).fadeIn();
            e.preventDefault();
        })//.children( window.location.hash ? 'a[href=' + window.location.hash + ']' : 'a:first' ).trigger('click');

	})
	
	// lightbox
	$("a[rel^='prettyPhoto']").prettyPhoto({theme: 'pp_default',slideshow:3000, autoplay_slideshow:false});
	
	// ajax more
	var $maxclick = 0,
		$doing = false;
	function ajax_load_data(e,p){
		if(p&&p==1)e.preventDefault();
		var $this = $('.aload a'),
			$loader = $('.aload_loading');
		$loader.fadeIn();
		$this.text('加载中...');
		$.ajax({
			type: "GET",
			async: false,
			url: $this.attr('href') + '#fluid_blocks',
			dataType: "html",
			success: function(out){
				result = $(out).find('#fluid_blocks span.masonry-box');
				nextlink = $(out).find('.aload a').attr('href');
				$maxclick++;
				$('#fluid_blocks').append(result);
				setTimeout(function(){$loader.fadeOut();result.imagesLoaded(function(){
					result.fadeIn(2000);
					$('#fluid_blocks').masonry('appended',result);
				});if(nextlink != undefined && $maxclick <5){
					$this.attr('href',nextlink);
				}else if(nextlink != undefined){
					$this.attr('href',nextlink);
					$loader.remove();
					$this.text('加载更多');
					$('.aload').fadeIn();
				}else{
					$loader.remove();
					$this.remove();
					$('.aload').removeClass('aload').addClass('bload').fadeIn().html('<a style="cursor:default;">没有更多了...</a>');
				}$doing = false;},2500);				
			}
		});
	};
	
	$(window).scroll(function(){
		if($('#fluid_blocks').length>0){
			$top = $('#fluid_blocks').offset().top;
			$h = $('#fluid_blocks').height();
			if(($(document).height()-$(this).scrollTop()-$(this).height()<100||$top + $h -$(this).scrollTop()<360) && $maxclick <5 && $doing == false){
				$doing = true;
				ajax_load_data();
			}
		}
	});
	
	$('.aload a').on('click',function(e){
		ajax_load_data(e,1);
	});

  // radio page box switch
  $('.box-control li').on('click',function(){
      var box = $('#'+$(this).attr('data'));
      $(this).parent().children('li').removeClass('active');
      $(this).addClass('active');
      $('.box').hide();
      box.show();
  });
	
  // footer position fixed
  var ft_t = $('#footer-nav-wrap').offset().top,
	  ft_h = $('#footer-nav-wrap').height();
  if(ft_t+ft_h<$(window).height()&&!$('body').hasClass('home')){
	   var fix_h = $(window).height()-ft_t-ft_h;
	   $('#footer-nav-wrap,#footer-wrap').css('bottom',(-1)*fix_h+'px');
	   $('#body-container,html,body').css('height','100%');
	   $('.separator').hide();
  }
}); 