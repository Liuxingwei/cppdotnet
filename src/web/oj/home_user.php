<?php
////////////////////////////Common head
$cache_time=2;
$OJ_CACHE_SHARE=false;
require_once('./include/cache_start.php');
require_once('./include/db_info.inc.php');
require_once('./include/setlang.php');
require_once('./include/my_func.inc.php');
require_once('./include/set_get_key.php');
$url_oj="../oj/";

if(!isset($_GET['user_id'])){
	$view_errors="找不到这个用户.";
    require("template/".$OJ_TEMPLATE."/error.php");
    exit(0);
}
$user_id=$_GET['user_id'];
$nick=getNickByid($user_id);
$view_title= $nick."的主页 - C语言网";

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
}
//扇形统计
$sql="SELECT result,count(1) as cnt FROM solution WHERE `user_id`='$user_id'  AND result>=4 group by result order by result";
$result=mysqli_query($mysqli,$sql);
$view_userstat=array();
$i=0;
$view_summary[4]=$view_summary[5]=$view_summary[6]=$view_summary[7]=$view_summary[9]=$view_summary[10]=$view_summary[11]=0;
while($row=mysqli_fetch_array($result)){
    $view_userstat[$i++]=$row;
    $view_summary[intval($row[0])]=intval($row[1]);
}
$Right=$view_summary[4];
mysqli_free_result($result);
//解决
$sql="SELECT count(DISTINCT problem_id) as `ac` FROM `solution` WHERE `user_id`='".$user_id."' AND `result`=4";
$result=mysqli_query($mysqli,$sql) or die(mysqli_error());
$row=mysqli_fetch_object($result);
$AC=$row->ac;
mysqli_free_result($result);
//提交
$sql="SELECT count(solution_id) as `Submit` FROM `solution` WHERE `user_id`='".$user_id."'";
$result=mysqli_query($mysqli,$sql) or die(mysqli_error());
$row=mysqli_fetch_object($result);
$Submit=$row->Submit;
mysqli_free_result($result);

//EXP
    //blog_cnt
    $sql="SELECT count(blog_id) as cnt_blog FROM `blog` WHERE `user_id`='".$user_id."' AND `status`=1";
    $result=mysqli_query($mysqli,$sql) or die(mysqli_error());
    while ($arr_blog=mysqli_fetch_array($result)) {
        $cnt_blog=$arr_blog['cnt_blog'];
    }
    mysqli_free_result($result);

    $sql="SELECT count(discuss_id) as cnt_blogdiscuss FROM `blog_discuss` WHERE `user_id`='".$user_id."' AND `status`=1";
    $result=mysqli_query($mysqli,$sql) or die(mysqli_error());
    while ($arr_blogdiscuss=mysqli_fetch_array($result)) {
        $cnt_blogdiscuss=$arr_blogdiscuss['cnt_blogdiscuss'];
    }
    mysqli_free_result($result);

    $sql="SELECT sum(nice) as cnt_blognice FROM `blog` WHERE `user_id`='".$user_id."' AND `status`=1";
    $result=mysqli_query($mysqli,$sql) or die(mysqli_error());
    while ($arr_nice=mysqli_fetch_array($result)) {
        $cnt_blognice=$arr_nice['cnt_blognice'];
    }
    mysqli_free_result($result);
    $sql="SELECT sum(scan) as cnt_blogscan FROM `blog` WHERE `user_id`='".$user_id."' AND `status`=1";
    $result=mysqli_query($mysqli,$sql) or die(mysqli_error());
    while ($arr_scan=mysqli_fetch_array($result)) {
        $cnt_blogscan=$arr_scan['cnt_blogscan'];
    }
    mysqli_free_result($result);

    //contest
    $sql="SELECT count(DISTINCT contest_id) as cnt_contest FROM `solution` WHERE `user_id`='".$user_id."'";
    $result=mysqli_query($mysqli,$sql) or die(mysqli_error());
    while ($arr_contest=mysqli_fetch_array($result)) {
        $cnt_contest=$arr_contest['cnt_contest'];
    }
    mysqli_free_result($result);

    $sql="SELECT length(order_contest)-length(replace(order_contest,',','')) as cnt_order FROM `users` WHERE `user_id`='".$user_id."'";
    $result=mysqli_query($mysqli,$sql) or die(mysqli_error());
    while ($arr_order=mysqli_fetch_array($result)) {
        $cnt_order=$arr_order['cnt_order'];
    }
    mysqli_free_result($result);

$userinfo_exp=($AC*10)+($Submit*2)+($cnt_blog*20)+($cnt_blogdiscuss*2)+($cnt_blognice*1)+($cnt_blogscan*0.1)+($cnt_contest*30)+($cnt_order*10);
$sql="UPDATE `users` SET `user_exp`='".$userinfo_exp."' WHERE `user_id`='".$user_id."'";
$result=mysqli_query($mysqli,$sql);

//排名&等级
$userinfo_exp=round($userinfo_exp);
switch ($userinfo_exp) {
    case 0:
        $user_lvl = 0;
        break;
    case $userinfo_exp>=1 && $userinfo_exp<100:
        $user_lvl = 1;
        break;
    case $userinfo_exp>=100 && $userinfo_exp<500:
        $user_lvl = 2;
        break;
    case $userinfo_exp>=500 && $userinfo_exp<1000:
        $user_lvl = 3;
        break;
    case $userinfo_exp>=1000 && $userinfo_exp<5000:
        $user_lvl = 4;
        break;
    case $userinfo_exp>=5000 && $userinfo_exp<10000:
        $user_lvl = 5;
        break;
    case $userinfo_exp>=10000 && $userinfo_exp<20000:
        $user_lvl = 6;
        break;
    case $userinfo_exp>=20000 && $userinfo_exp<50000:
        $user_lvl = 7;
        break;
    case $userinfo_exp>=50000 && $userinfo_exp<100000:
        $user_lvl = 8;
        break;
    case $userinfo_exp>=100000:
        $user_lvl = 9;
        break;
}
$sql="UPDATE `users` SET `user_lvl`='".$user_lvl."' WHERE `user_id`='".$user_id."'";
$result=mysqli_query($mysqli,$sql);

$sql="SELECT count(*) as `Rank` FROM `users` WHERE `user_exp`>$userinfo_exp";
$result=mysqli_query($mysqli,$sql);
$row=mysqli_fetch_array($result);
$userinfo_rank=intval($row[0])+1;
mysqli_free_result($result);

$userinfo_lvl = $user_lvl;
$tag_class = "tag_p".$userinfo_lvl;

require("template/".$OJ_TEMPLATE."/home_user.php");
?>