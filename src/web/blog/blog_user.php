<?php
////////////////////////////Common head
$cache_time=2;
$OJ_CACHE_SHARE=false;
require_once('./include/cache_start.php');
require_once('./include/db_info.inc.php');
require_once('./include/setlang.php');
require_once('./include/my_func.inc.php');
$url_oj_home="https://www.dotcpp.com";
$url_oj="https://www.dotcpp.com/oj/";

if(!isset($_GET['user_id'])){
    $view_errors="找不到这个用户.";
    require("template/".$OJ_TEMPLATE."/error.php");
    exit(0);
}
$user_id=$_GET['user_id'];
$nick=getNickByid($user_id);
$view_title= $nick."的文章 - C语言网";

$sql="SELECT * FROM `users` WHERE `user_id`='$user_id'";
$result=mysqli_query($mysqli, $sql);
$userrow_cnt=mysqli_num_rows($result);
if ($userrow_cnt==0){ 
  $view_errors= "找不到这个用户!";
  require("template/".$OJ_TEMPLATE."/error.php");
  exit(0);
}
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

//文章
$page_cnt=10;
$sql="SELECT count(1) FROM blog WHERE`user_id`='$user_id'";
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
$sql="SELECT `blog_id`,`title`,`user_id`,`problem_id`,`language`,`nice`,`scan`,`post_time` FROM `blog` WHERE `user_id`='".$user_id."' AND `status`=1 ORDER BY `hq`=1 DESC,cast(post_time as datetime) DESC LIMIT ".($page-1)*$page_cnt.",$page_cnt";
$result=mysqli_query($mysqli,$sql) or die(mysqli_error());
$blog_data=Array();
$i=0;
while ($row=mysqli_fetch_object($result)){
    if ($row->language==0) {
        $language="C";
    }else if ($row->language==1) {
        $language="C++";
    }else if ($row->language==3) {
        $language="JAVA";
    }else {
        $language="";
    }
    $blog_data[$i]=Array();
    $sql_cnt="SELECT count(1) FROM blog_discuss WHERE blog_id='$row->blog_id'";
    $result_cnt=mysqli_query($mysqli,$sql_cnt);
    $row_cnt=mysqli_fetch_array($result_cnt);
    $disc_cnt=$row_cnt[0];
    mysqli_free_result($result_cnt);

    $sql_hq="SELECT hq FROM blog WHERE blog_id='$row->blog_id'";
    $result_hq=mysqli_query($mysqli,$sql_hq);
    $row_hq=mysqli_fetch_array($result_hq);
    mysqli_free_result($result_hq);
    if ($row_hq[0]==1) {
        $blog_data[$i][0]="<td><a target='_blank' class='list_title' href='/".$user_id."/".$row->blog_id."'>　　<span style='color: red;font-weight: bold;border: 2px solid red;padding: 0px 3px;'>优质题解</span> ".$row->title."</a><br>";
    }
    else{
        $blog_data[$i][0]="<td><a target='_blank' class='list_title' href='/".$user_id."/".$row->blog_id."'>　　".$row->title."</a><br>";
    }

    if ($row->problem_id==0) {
        $blog_data[$i][1]="<span class='list_normal'>编辑时间：".$row->post_time."</span>";
    }
    else {
        $blog_data[$i][1]="<span class='list_normal'>题号：".$row->problem_id."　语言：".$language."　编辑时间：".$row->post_time."</span>";
    }
    $blog_data[$i][2]="<span class='list_normal' style='float: right;'>浏览：".$row->scan."　　评论：".$disc_cnt."　　赞：".$row->nice."</span></td>";
    $i++;
}
mysqli_free_result($result);

require("template/".$OJ_TEMPLATE."/blog_user.php");
?>