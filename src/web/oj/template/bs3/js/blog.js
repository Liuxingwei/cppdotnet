function blog_scan(blog_id){
    $.ajax({
        'url':"/oj/ajax_blog_scan.php?blog_id="+blog_id,
        'type':"GET"
    });
}
function home_scan(user_id){
    $.ajax({
        'url':"/oj/ajax_blog_scan.php?user_id="+user_id,
        'type':"GET"
    });
}
function blog_del(blog_id)
{
    var confirm_del=confirm("确定删除吗？");
    if (confirm_del==true)
        window.location = "/oj/blog_del.php?blog_id="+blog_id;
}
function blog_nice(obj, blog_id){
    var obj = $(obj);
    $.ajax({
        'url':"/oj/ajax_blog_nice.php?blog_id="+blog_id,
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
                alert('你的赞被小怪兽吃辣!');
            }
        }
    });
}
function dis_nice(obj, discuss_id){
    var obj = $(obj);
    $.ajax({
        'url':"/oj/ajax_blogdis_nice.php?discuss_id="+discuss_id,
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
        'url':"/oj/ajax_blog_comment_submit.php",
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
                comment_show.html(comment_show.html()+"<div><p><a href='#'>"+$("#profile").text()+"</a> <span style='color:#888'>"+nowtime+"</span></p> <p>"+(userid!=''?('@'+userid+" "+comment_content.val()):comment_content.val())+"</p></div>");
                
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
                alert("回复失败，信息被小怪兽吃了!!!");
            }
        }
    });
}
//textarea限制输入长度自动截取
$("#dis_edit").on("input propertychange", function() {
    var $this = $(this),
        _val = $this.val();
    if (_val.length > 600) {
        $this.val(_val.substring(0, 600));
    }
});