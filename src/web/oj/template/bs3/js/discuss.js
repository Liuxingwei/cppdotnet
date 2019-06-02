$(document).ready(function(){
	// console.log($(".discuss_msg>div").eq(2).length);
	if($(".discuss_msg").length==0){
		$("#disForm textarea").attr("placeholder","这个题目还没有讨论,抢个沙发先吧?");
	}
	$(".discuss_msg").each(function(){
		var hei=$(this).children().eq(1).children().height();
		if(hei>150){
			$(this).height(hei+80);
			var height_msg=$(this).height();
		}
	});
});
function reply_to(obj,nickname,userid){
	var obj=$(obj);
	var comment_msg=obj.parent().parent().parent().next().children('div').first().children(".comment_msg");
	var reply_to_user=obj.parent().parent().parent().next().children('div').first().children(".reply_to_user");
	var reply_to_user_id=reply_to_user.next();
	// console.log(comment_msg);
	// console.log(reply_to_user);
	reply_to_user.text("@"+nickname);
	reply_to_user.css('display','block');
	comment_msg.css('text-indent',reply_to_user.width());
	reply_to_user_id.val(userid);
}
function dis_inform(discuss_id){
	$.ajax({
		'url':"ajax_dis_inform.php?discuss_id="+discuss_id,
		'type':'GET',
		'success':function(data){
			if(data.indexOf('true')!=-1){
				alert('举报成功!系统会及时处理.');
			}else if(data.indexOf('not have been login.')!=-1){
				alert('请登录后再使用举报功能.');
			}else if(data.indexOf('time limit')!=-1){
				alert('10s内只能举报一次.');
			}else if(data.indexOf('already inform')!=-1){
				alert('这个讨论您已经举报过了.');
			}else{
				alert('举报失败!');
			}
		}
	});
}
function com_inform(comment_id){
	$.ajax({
		'url':"ajax_com_inform.php?comment_id="+comment_id,
		'type':'GET',
		'success':function(data){
			if(data.indexOf('true')!=-1){
				alert('举报成功!系统会及时处理.');
			}else if(data.indexOf('not have been login.')!=-1){
				alert('请登录后再使用举报功能.');
			}else if(data.indexOf('time limit')!=-1){
				alert('10s内只能举报一次.');
			}else if(data.indexOf('already inform')!=-1){
				alert('这个讨论您已经举报过了.');
			}else{
				alert('举报失败!');
			}
		}
	});
}
function showComment(obj){
	var obj = $(obj).parent();
	// console.log(obj.css('top'));
	// obj.css('bottom', 5+);
	// console.log(obj);
	if(obj.css('bottom')!='5px'){
		obj.next().hide();
		obj.parent().height(obj.parent().height()-obj.next().height()-10-obj.height());
		obj.css('bottom', '5px');
		return ;
	}
	obj.parent().height(obj.parent().height()+obj.next().height()+10+obj.height());
	// console.log(obj.next().height());
	obj.css('bottom',obj.next().height()+70+'px');
	obj.next().css('bottom','5px');
	obj.next().show();
}
function dis_nice(obj, discuss_id){
    var obj = $(obj);
    $.ajax({
        'url':"ajax_dis_nice.php?discuss_id="+discuss_id,
        'type':"GET",
        'success':function(data){
            if(data.indexOf("true")!=-1){
                if(obj.html()=="赞"){
                    obj.html("赞(1)");
                }else{
                    obj.html("赞("+(parseInt(obj.html().replace(/[^0-9]/g,""))+1)+")");
                }
            }else if(data.indexOf('have been nice')!=-1){
            	alert('你已经赞过啦!');
            }else{

            }
        }
    });
}
function comment_submit(ori,discuss_id){
	var comment_content = $(ori).parent().parent().find(".comment_msg");
	var userid=comment_content.next().next().val();
	var nowtime="";
	var d=new Date();
	//2016-08-25 15:22:28
	nowtime=d.getFullYear()+"-"+d.getMonth()+"-"+d.getDate()+" "+d.getHours()+":"+d.getMinutes()+":"+d.getSeconds();
	// comment_content.val("");
	if(comment_content.val()==""){
		alert('评论不能为空!!!');
		return ;
	}
	// console.log(userid);
	$.ajax({
		'url':"ajax_comment_submit.php",
		'type':"POST",
		'data':{
			'discuss_id':discuss_id,
			'comment_msg':comment_content.val(),
			'reply_to':userid
		},
		'success':function(data){
			if(data.indexOf("true")!=-1){
				// console.log(data);
				// console.log('success');
				var comment_show=$(ori).parent().parent().parent().find(".comment_show");
				comment_show.parent().parent().height(comment_show.parent().parent().height()-comment_show.parent().height());
				comment_show.html(comment_show.html()+"<div><p><a href='#'>"+$("#profile").text()+"</a> <span style='color:#888'>"+nowtime+"</span> | <button class='btn btn-link' onclick='' >举报</button></p> <p>"+(userid!=''?('@'+userid+" "+comment_content.val()):comment_content.val())+"</p></div>");
				
				comment_show.parent().parent().height(comment_show.parent().parent().height()+comment_show.parent().height()+20);
				comment_show.parent().parent().find(".bottom_right").css('bottom',comment_show.parent().height()+70+'px');
				var comment_cnt = $(ori).parent().parent().parent().parent().find(".comment_cnt");
				if(comment_cnt.html()=="评论"){
                    comment_cnt.html("评论(1)");
                }else{
                    comment_cnt.html("评论("+(parseInt(comment_cnt.html().replace(/[^0-9]/g,""))+1)+")");
                }
                comment_content.next().css('display','none');
                comment_content.next().next().val('');
                comment_content.val("");
                comment_content.css('text-indent', '0');
			}else if(data.indexOf("not login")!=-1){
				alert("请登录后再评论!!!");
				// console.log('error');
			}else if(data.indexOf("too fast")!=-1){
				alert("10s内只能评论一次!!!");
			}else{

			}
		}
	});
}
function isDismsgEmpty(obj){
	/*var obj=$(obj);
	if(obj.find("#cke_blog_edit").val()==""){
		alert("内容不能为空!!!");
		return false;
	}*/
}
//textarea限制输入长度自动截取
$("#dis_edit").on("input propertychange", function() {
    var $this = $(this),
        _val = $this.val();
    if (_val.length > 600) {
        $this.val(_val.substring(0, 600));
    }
});