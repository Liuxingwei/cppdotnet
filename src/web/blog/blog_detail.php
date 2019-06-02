<?php
////////////////////////////Common head
/*$cache_time=2;
$OJ_CACHE_SHARE=false;
require_once('./include/cache_start.php');*/
require_once('./include/db_info.inc.php');
require_once('./include/setlang.php');
require_once('./include/my_func.inc.php');

if(!isset($_SESSION['user_id'])){
    $_SESSION['prev_page']=curPageURL();
    // echo "<!-- ".$_SESSION['prev_page']." -->";
}

$url_oj_home="https://www.dotcpp.com";
$url_oj="https://www.dotcpp.com/oj/";
if(!isset($_GET['blog_id'])){
	$view_errors="找不到这篇文章.";
    require("template/".$OJ_TEMPLATE."/error.php");
    exit(0);
}
$blog_id=$_GET['blog_id'];

$sql="SELECT `blog_id`,`title`,`content`,`user_id`,`problem_id`,`nice`,`scan`,`post_time`,`status`,`hq` FROM `blog` WHERE `blog_id`='".$blog_id."'";
$result=mysqli_query($mysqli,$sql) or die(mysqli_error());
$tmprow=mysqli_fetch_array($result);
mysqli_free_result($result);

$status=$tmprow['status'];
if ($status!=1) {
    $view_errors="找不到这篇文章，可能已被删除.";
    require("template/".$OJ_TEMPLATE."/error.php");
    exit(0);
}

$problem_id=$tmprow['problem_id'];
$user_id=$tmprow['user_id'];

$sql="SELECT `title` FROM `problem` WHERE `problem_id`='".$problem_id."'";
$result=mysqli_query($mysqli,$sql) or die(mysqli_error());
$titlerow=mysqli_fetch_array($result);
$blog_problink=$titlerow['title'];
mysqli_free_result($result);

$nick=getNickByid($tmprow['user_id']);
$view_title=$tmprow['title']." - ".$nick."的博客 - C语言网";

/*优质题解标题标记*/
if ($tmprow['hq']==1) {
    $blog_tt="<span style='color: red;font-weight: bold;border: 2px solid red;padding: 0px 3px;'>优质题解</span> ".$tmprow['title'];
}
else {
    $blog_tt=$tmprow['title'];
}

$sql="SELECT * FROM `users` WHERE `user_id`='$user_id'";
$result=mysqli_query($mysqli, $sql);
if($row=mysqli_fetch_object($result)){
    $userinfo_reg_time=$row->reg_time;
    $userinfo_subject=$row->subject;
    $userinfo_phone=$row->phone;
    $userinfo_address=$row->address;
    $userinfo_age=intval($row->age);
    $userinfo_school=$row->school;
    $userinfo_autograph=$row->user_sign;
    $userinfo_intro=$row->user_intro;
    $userinfo_work_field=$row->field;
    $userinfo_solved=$row->solved;
    $userinfo_scan=$row->scan;
    if($row->is_work=='0'){
    }else if($row->is_work=='1'){
        $userinfo_iswork='学生';
        $userinfo_iswork='在职';
    }else{
        $userinfo_iswork='待业';
    }
    $userinfo_last_nick_time=$row->last_nick_time;
    $userinfo_exp=$row->user_exp;
    $userinfo_lvl = $row->user_lvl;
    $tag_class = "tag_p".$userinfo_lvl;
}

//blog_cnt
$sql="SELECT count(blog_id) as cnt_blog FROM `blog` WHERE `user_id`='".$user_id."' AND `status`=1";
$result=mysqli_query($mysqli,$sql) or die(mysqli_error());
while ($arr_blog=mysqli_fetch_array($result)) {
    $cnt_blog=$arr_blog['cnt_blog'];
}
mysqli_free_result($result);
//contest
$sql="SELECT count(DISTINCT contest_id) as cnt_contest FROM `solution` WHERE `user_id`='".$user_id."'";
$result=mysqli_query($mysqli,$sql) or die(mysqli_error());
while ($arr_contest=mysqli_fetch_array($result)) {
    $cnt_contest=$arr_contest['cnt_contest'];
}
mysqli_free_result($result);
//排名
$sql="SELECT count(*) as `Rank` FROM `users` WHERE `user_exp`>$userinfo_exp";
$result=mysqli_query($mysqli,$sql);
$row=mysqli_fetch_array($result);
$userinfo_rank=intval($row[0])+1;
mysqli_free_result($result);
//其他文章
$sql="SELECT `blog_id`,`title`,`user_id`,`nice`,`scan`,`post_time` FROM (SELECT * FROM `blog` WHERE `user_id`='$user_id') blog_u WHERE status=1 AND blog_id >= (SELECT floor( RAND() * ((SELECT MAX(blog_id) FROM `blog`)-(SELECT MIN(blog_id) FROM `blog`)) + (SELECT MIN(blog_id) FROM `blog`))) ORDER BY blog_id LIMIT 3";
$result=mysqli_query($mysqli,$sql) or die(mysqli_error());
$blog_data_r=Array();
$i=0;
while ($row=mysqli_fetch_object($result)){
    $blog_data_r[$i]=Array();
    $blog_data_r[$i][0]="<td><a target='_blank' class='' href='/".$row->blog_id."/".$row->blog_id."'>".$row->title."</a><br>";
    $blog_data_r[$i][1]="<span class='list_normal' style='float: right;'>浏览：<span class='span_inline_1'>".$row->scan."</span>　　赞：<span class='span_inline_1'>".$row->nice."</span></span></td>";
    $i++;
}
mysqli_free_result($result);

//随机推荐
$sql="SELECT `blog_id`,`title`,`user_id`,`nice`,`scan`,`post_time` FROM `blog` WHERE status=1 AND blog_id >= (SELECT floor( RAND() * ((SELECT MAX(blog_id) FROM `blog`)-(SELECT MIN(blog_id) FROM `blog`)) + (SELECT MIN(blog_id) FROM `blog`))) ORDER BY blog_id LIMIT 5";
$result=mysqli_query($mysqli,$sql) or die(mysqli_error());
$blog_data_ran=Array();
$i=0;
while ($row=mysqli_fetch_object($result)){
    $blog_data_ran[$i]=Array();
    $blog_data_ran[$i][0]="<td><a target='_blank' class='' href='/".$row->blog_id."/".$row->blog_id."'>".$row->title."</a><br>";
    $blog_data_ran[$i][1]="<span class='list_normal' style='float: right;'>浏览：<span class='span_inline_1'>".$row->scan."</span>　　赞：<span class='span_inline_1'>".$row->nice."</span></span></td>";
    $i++;
}
mysqli_free_result($result);


$page_cnt=8;
$sql="SELECT count(1) FROM blog_discuss WHERE blog_id='$blog_id'";
$result=mysqli_query($mysqli,$sql);
$row=mysqli_fetch_array($result);
$disc_cnt=$row[0];
$view_total_page=intval(ceil($disc_cnt/$page_cnt));
$pr_flag=true;
if (isset($_GET['page'])) {
    $page=$_GET['page'];
}
else{
    $page=1;
}
$sql="SELECT * FROM blog_discuss WHERE blog_id='$blog_id' ORDER BY `post_time` DESC LIMIT ".($page-1)*$page_cnt.",$page_cnt";            //$page
$result=mysqli_query($mysqli,$sql);
$view_cnt=0;
while($row=mysqli_fetch_object($result)){
    $view_discuss[$view_cnt]['discuss_id']=$row->discuss_id;
    $view_discuss[$view_cnt]['nice']=$row->nice;
    $view_discuss[$view_cnt]['content']=$row->content;
    $view_discuss[$view_cnt]['post_time']=$row->post_time;
    $view_discuss[$view_cnt]['nick']=getNickByid($row->user_id);
    $view_discuss[$view_cnt]['user_id']=$row->user_id;
    $sql="SELECT user_id, post_time, content, comment_id FROM blog_comment WHERE discuss_id=$row->discuss_id ORDER BY `post_time`";
    $tmpresult=mysqli_query($mysqli, $sql);
    $tmpcnt=0;
    while($tmprow1=mysqli_fetch_object($tmpresult)){
        $view_discuss[$view_cnt]['comment'][$tmpcnt]['nick']=getNickByid($tmprow1->user_id);
        $view_discuss[$view_cnt]['comment'][$tmpcnt]['user_id']=$tmprow1->user_id;
        $view_discuss[$view_cnt]['comment'][$tmpcnt]['post_time']=$tmprow1->post_time;
        $view_discuss[$view_cnt]['comment'][$tmpcnt]['content']=$tmprow1->content;
        $view_discuss[$view_cnt]['comment'][$tmpcnt]['comment_id']=$tmprow1->comment_id;
        $tmpcnt++;
    }
    $view_discuss[$view_cnt]['comment_cnt']=$tmpcnt;
    mysqli_free_result($tmpresult);
    $view_cnt++;
}
mysqli_free_result($result);

require("template/".$OJ_TEMPLATE."/blog_detail.php");
?>