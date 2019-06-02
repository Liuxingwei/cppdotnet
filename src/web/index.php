<?php

require_once('oj/include/db_info.inc.php');
require_once('oj/include/my_func.inc.php');
// require_once('oj/include/cache_start.php');
require_once('oj/lang/cn.php');



if(!isset($_SESSION['user_id']))if(isset($_SESSION['prev_page']))unset($_SESSION['prev_page']);

//friend link
$sql="SELECT `link_id`,`title`,`url` FROM `friend_link` ORDER BY `link_id`";
$result=mysqli_query($mysqli, $sql);
$cnt=0;
while($row=mysqli_fetch_object($result)){
	$view_friend_link[$cnt]['url']=$row->url;
	$view_friend_link[$cnt]['title']=$row->title;
	$cnt++;
}

//problem set

$difficulty_name=Array("入门题", "普及题", "提高题", "难题");
if(!isset($_SESSION['mark_name'])){
  $sql = "SELECT attr_value FROM others WHERE attr_name LIKE 'mark%' ORDER BY attr_name";
  $result=mysqli_query($mysqli, $sql);
  $tmpcnt=0;
  while($row = mysqli_fetch_object($result)){
    $mark_name[$tmpcnt]=$row->attr_value;
    $tmpcnt++;
  }
  $_SESSION['mark_name']=$mark_name;
}else $mark_name=$_SESSION['mark_name'];
$mark_color=Array("btn-success", "btn-info", "btn-warning", "btn-danger","btn-primary", "btn-light_purple","btn-unknow_color","btn-pink");
$difficulty_color=Array("btn-success", "btn-info", "btn-warning", "btn-danger");
//
$sql="SELECT `problem_id`,`title`,`difficulty`,`mark`,`accepted`,`submit` FROM `problem` WHERE `defunct`='N' ORDER BY `problem_id` LIMIT 6";
$result=mysqli_query($mysqli, $sql);

$view_problemset=array();

$cnt=0;
while($row=mysqli_fetch_object($result)){
	$view_problemset[$cnt]['problem_id']=$row->problem_id;
	$view_problemset[$cnt]['title']="<span class=''><a href='/oj/problem".$row->problem_id.".html'>".$row->title."</a></span>";

    $view_problemset[$cnt]['mark']="<a class='center btn hard_label ";
    $view_problemset[$cnt]['difficulty']="<a class='center btn hard_label hard_label_2 "; 
    if($row->difficulty!=-1){
      $view_problemset[$cnt]['difficulty'].=$difficulty_color[$row->difficulty];
      $view_problemset[$cnt]['difficulty'].=" 'href='/oj/problemset.php?difficulty=$row->difficulty'";
    }
    if($row->mark!=-1){
      $view_problemset[$cnt]['mark'].=$mark_color[$row->mark];
      $view_problemset[$cnt]['mark'].=" 'href='/oj/problemset.php?mark=$row->mark'";
    }
    $view_problemset[$cnt]['mark'].="'>";
    if($row->mark!=-1)
      $view_problemset[$cnt]['mark'].=$mark_name[$row->mark];
    $view_problemset[$cnt]['mark'].="</a>";
    $view_problemset[$cnt]['difficulty'].="'>";
    if($row->difficulty!=-1)
      $view_problemset[$cnt]['difficulty'].=$difficulty_name[$row->difficulty];
    $view_problemset[$cnt]['difficulty'].="</a>";
    $view_problemset[$cnt]['accepted']="解决：".$row->accepted;
    $view_problemset[$cnt]['submit']="提交：".$row->submit;
    $cnt++;
}
//

//contest info
$sql="SELECT `contest_id`,`title`,`start_time`,`start_time`,`end_time`,`private`,`ctype` FROM `contest` ORDER BY `start_time` DESC LIMIT 6";
$result=mysqli_query($mysqli, $sql);
$view_contest=array();
$cnt=0;
while($row=mysqli_fetch_object($result)){
	$view_contest[$cnt]['contest_id']=$row->contest_id;
	$view_contest[$cnt]['title']=$row->title;
	/*$view_contest[$cnt]['title']=mb_strcut($row->title,0,36,utf8);*/

	$start_time=strtotime($row->start_time);
	$end_time=strtotime($row->end_time);
	$now=time();
	$length=$end_time-$start_time;
    $left=$end_time-$now;
    $contest_date=date("Y-m-d",$start_time);
	$order_time=strtotime($contest_date)-25200;

	$view_contest[$cnt]['start_time']=date("Y-m-d H:i:s",$start_time);

    if ($now>$end_time) {
	  	$view_contest[$cnt]['state']= "<span class='text_btn_s text_btn_s_gray'>$MSG_Ended</span>";
	

	}else if ($now<$start_time){
		$view_contest[$cnt]['state']= "<span class='text_btn_s text_btn_s_blue'>$MSG_Start</span>";
	}else{
		$view_contest[$cnt]['state']= "<span class='text_btn_s text_btn_s_red'>$MSG_Running</font>";
	}

	$view_contest[$cnt]['time_length']=$MSG_TotalTime.formatTimeLength($length);
	$private=intval($row->private);
	$ctype_res=$row->ctype;
//order
	  	if ($private==0 && $ctype_res=="main") {
	  		if ($now>$end_time) {
	  			$view_contest[$cnt]['order']= "";
	  		}
	  		else if ($now<$order_time) {
	  			if (isset($_SESSION['user_id'])) {
	  				$user_id_order=$_SESSION['user_id'];
	  				$sql_order="SELECT * FROM `users` WHERE `user_id`='".$user_id_order."' AND find_in_set('".$row->contest_id."',order_contest)";
					$result_order=mysqli_query($mysqli, $sql_order);
					if (mysqli_num_rows($result_order) !==0) {
						$view_contest[$cnt]['order']= "<span style='color:blue'>已预约</span>";
					}
					else {
						$view_contest[$cnt]['order']= "<span style='color:blue;font-weight: bold;'><a href='oj/info_check.php?contest_id=".$row->contest_id."'>点击预约</a></span>";
					}
	  			}
	  			else {
	  				$view_contest[$cnt]['order']= "<span style='color:blue;font-weight: bold;'><a href='oj/info_check.php?contest_id=".$row->contest_id."'>点击预约</a></span>";
	  			}
	  			
	  		}
	  		else {
	  			$view_contest[$cnt]['order']= "<span style='color:red'>预约已关闭</span>";
	  		}
  		}
  		else {
  			$view_contest[$cnt]['order']= "";
  		}
//
		if ($private==0)
	       $view_contest[$cnt]['private']= "<span class='text_btn_s text_btn_s_blue'>$MSG_Public</span>";
	    else
           $view_contest[$cnt]['private']= "<span class='text_btn_s text_btn_s_red'>$MSG_Private</span>";
	$cnt++;
}
mysqli_free_result($result);

//job
$sql="SELECT `id`,`compname`,`position`,`place`,`propt`,`salary`,`salary_min`,`salary_max`,`release_time` FROM `job_list` WHERE `status`='1' ORDER BY `release_time` DESC LIMIT 7";
$result=mysqli_query($mysqli,$sql);

$usercpn_data=Array();
$i=0;
while ($row=mysqli_fetch_object($result)){
	if ($row->salary=='2') {
		$row_salary_min_view=$row->salary_min*0.001;
		$row_salary_max_view=$row->salary_max*0.001;
		$salary_show="<span style='color: green;'>".$row_salary_min_view." - ".$row_salary_max_view." k /月</span>";
	}
	else {
		$salary_show="<span style='color: red;'>面议</span>";
	}
	$usercpn_data[$i]=Array();
	$usercpn_data[$i][0]="<a href='/job/".$row->id.".html'>".$row->position."</a>";
	$usercpn_data[$i][1]=$row->compname;
    $usercpn_data[$i][2]=$row->place;
   	$usercpn_data[$i][3]=$row->propt; 
   	$usercpn_data[$i][4]=$salary_show; 
   	$usercpn_data[$i][5]=date("Y-m-d",strtotime($row->release_time)); 
	$i++;
}
mysqli_free_result($result);



//周榜最热
$blogtime_week_end=date("Y-m-d H:i:s",mktime(0, 0 , 0,date("m"),date('d'),date("Y"))+86400);
$blogtime_week_start=date("Y-m-d H:i:s",mktime(0, 0 , 0,date("m"),date('d'),date("Y"))-(6*86400));
$sql="SELECT `blog_id`,`title`,`user_id`,`nice`,`scan`,`post_time` FROM `blog` WHERE status=1 AND unix_timestamp(post_time) >= unix_timestamp('".$blogtime_week_start."') AND unix_timestamp(post_time) < unix_timestamp('".$blogtime_week_end."') ORDER BY `nice` DESC LIMIT 8";
$result=mysqli_query($mysqli,$sql) or die(mysqli_error());
$blog_data_r=Array();
$i=0;
while ($row=mysqli_fetch_object($result)){

    $blog_data_r[$i]="<p class='p_blogtitle'><a href='https://blog.dotcpp.com/".$row->user_id."/".$row->blog_id."'>".$row->title."</a></p>";
    $blog_data_r[$i].="<span class='span_inline_l'>".$row->post_time."</span>";
    $blog_data_r[$i].="<span class='span_inline_r'><span class='span_inline_2'><img src='oj/template/".$OJ_TEMPLATE."/img/eye_s.png'> 浏览 ".$row->scan."</span><span class='span_inline_3'><img src='oj/template/".$OJ_TEMPLATE."/img/heart_s.png'> 赞 ".$row->nice."</span></span>";
    $i++;
}
mysqli_free_result($result);


//week rank
/*$week_day=intval(date("N"));
$st_time=strftime("%Y-%m-%d 23:59:58",time()-60*60*24*$week_day);
$sql="SELECT `user_id`,COUNT(distinct `problem_id`) AS cnt FROM `solution` WHERE `judgetime`>'$st_time' AND `result`=4 GROUP BY `user_id` ORDER BY `cnt` DESC LIMIT 4";
$result=mysqli_query($mysqli, $sql);
$view_rank=array();
$cnt=0;
while($row=mysqli_fetch_object($result)){
	$view_rank[$cnt]['nick']=getNickByid($row->user_id);
	$sql="SELECT COUNT(`result`) AS cnt FROM `solution` WHERE `judgetime`>'$st_time' AND `user_id`='$row->user_id'";
	$tmp_result=mysqli_query($mysqli, $sql);
	$tmprow=mysqli_fetch_object($tmp_result);
	$view_rank[$cnt]['accepted']=$row->cnt;
	$view_rank[$cnt]['submit']=$tmprow->cnt;
	$view_rank[$cnt]['user_id']=$row->user_id;
	$cnt++;
}
mysqli_free_result($result);*/

//use wp db to get wordpress article_info
mysqli_query($mysqli,"set names utf8");
/*if(!mysqli_select_db($mysqli,$DB_WP))
		die('Can\'t use foo : ' . mysqli_error());*/
//sychronize php and mysql server
date_default_timezone_set("PRC");
mysqli_query($mysqli,"SET time_zone ='+8:00'");

$sql="SELECT `post_title`,`guid`,`post_date` FROM `wp_posts` WHERE `post_status`='publish' AND `comment_status`='open' AND `post_type`='post' ORDER BY `post_date` DESC LIMIT 33,12";
// echo "<!-- ".$sql." -->";
$result=mysqli_query($mysqli, $sql);
$cnt=0;
$view_article=array();
while($row=mysqli_fetch_object($result)){
	$view_article[$cnt]['title']=$row->post_title;
	$view_article[$cnt]['url']=$row->guid;
	$view_article[$cnt]['post_date']=date('Y-m-d',strtotime($row->post_date));
	$cnt++;
}

mysqli_query($mysqli,"set names utf8");
if(!mysqli_select_db($mysqli,$DB_NAME))
		die('Can\'t use foo : ' . mysqli_error());
//sychronize php and mysql server
date_default_timezone_set("PRC");
mysqli_query($mysqli,"SET time_zone ='+8:00'");

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="renderer" content="webkit"> 
	<meta charset="UTF-8">
	<!-- <meta http-equiv="x-ua-compatible" content="IE=edge, chrome=1">
	<meta name="renderer" content="webkit|ie-comp|ie-stand"> -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>C语言网 - 领先实用的编程在线学习网站</title>
	<meta name="keywords" content="C语言|C++|java|C语言入门|编程入门|C语言编程软件|C语言教程|OJ在线评测|编程比赛|学编程|C++教程|java教程|数据结构|蓝桥杯|ACM|算法入门|编程题库|题解博客|dotcpp网|C语言网
">
	<meta name="description" content="C语言网(www.dotcpp.com)不仅提供C语言，还包括C++、java、算法与数据结构等课程在内的各种入门教程、视频录像、编程经验、编译器教程及软件下载、题解博客，源码分享等优质资源，提倡边学边练边分享，同时提供对口的IT工作，是国内领先实用的综合性编程学习网站！">

	<link rel="stylesheet" href="oj/template/<?php echo $OJ_TEMPLATE;?>/css/bootstrap.min.css">
	<link rel="stylesheet" href="oj/template/<?php echo $OJ_TEMPLATE;?>/css/basic.css">
    <link rel="stylesheet" href="oj/template/<?php echo $OJ_TEMPLATE;?>/css/homepage.css">
	<!--[if lt IE 9]>
         <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
         <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
      <![endif]-->
  	<style type="text/css">
  		.wrap{
	background-color:#E9EAEC;
}
#body{
	/*background-color:#E9EAEC;*/
	width:1130px;
}

.div_contentbox{
	margin: 10px 0 45px;
}
.contest_box {
	padding: 10px;
	border-bottom: 1px dashed #CCC;
}
.text_boxhead {
    color: #5a5a5a;
    border-bottom: 1px solid #c0c0c0;
    line-height: 27px;
    margin-bottom: 20px;
}


.p_article {
	width: 95%;
	color: #424242;
    line-height: 20px;
    margin: 0px;
    padding-bottom: 20px;
}

.text_btn_s{
	display: inline-block;
    padding: 0px 6px;
    font-size: 12px;
    line-height: 20px;
}
.text_btn_s_blue{
	color: #FFF;
    background: #2465e2;
}
.text_btn_s_red{
	color: #FFF;
    background: #ec3c3c;
}
.text_btn_s_gray{
	color: #8f8f8f;
    background: #d5d5d5;
}

table.tb_homepage {
	table-layout: fixed;
	width: 872px;
	margin-left: 228px;
	background: #fafafa;
}
table.tb_homepage .toprow_jqbs {
	background: #2465e2;
}
table.tb_homepage .toprow_xltk {
	background: #1da053;
}
table.tb_homepage .toprow_rmgz {
	background: #227dc9;
}
.tb_hm_jqbs thead {
	border-right: 1px solid #2465e2; 
}
.tb_hm_xltk thead {
	border-right: 1px solid #1da053; 
}
.tb_hm_rmgz thead {
	border-right: 1px solid #227dc9; 
}

table.tb_homepage>thead>tr>th {
	color: #FFF;
	line-height: 17px;
	border: 0px;
}

table.tb_homepage>tbody {
	border-bottom: 1px solid #e2e2e2; 
	border-right: 1px solid #e2e2e2; 
}

table.tb_homepage1>tbody>tr>td {
	overflow:hidden;white-space: nowrap;text-overflow: ellipsis;
	line-height: 26px;
	border-top: 1px solid #e2e2e2; 
}
table.tb_homepage1>tbody>tr>td:last-child {
	padding: 0px;
	border: 0px;
}
table.tb_homepage1>tbody>tr>td:first-child {
	padding: 0px;
	border: 0px;
}

.tb_hm_jqbs table.tb_homepage1>thead>tr>th:nth-child(1),.tb_hm_jqbs table.tb_homepage1>thead>tr>th:nth-child(3){
	text-align: center;
}
.tb_hm_xltk table.tb_homepage1>thead>tr>th{
	text-align: center;
}
.tb_hm_xltk table.tb_homepage1>thead>tr>th:nth-child(1){
	text-align: right;
}
.tb_hm_xltk table.tb_homepage1>thead>tr>th:nth-child(3),.tb_hm_xltk table.tb_homepage1>thead>tr>th:nth-child(6){
	text-align: left;
}
.tb_hm_rmgz table.tb_homepage2 tr>td:nth-child(1){
	padding-left: 30px;
}
.tb_hm_rmgz table.tb_homepage2 tr>td:nth-child(6){
	padding-right: 40px;
}

.tb_hm_td_last {
	float: left;
	line-height: 26px;
	padding: 8px;
	border-top: 1px solid #e2e2e2;
}
.tb_hm_td_first {
	float: right;
	line-height: 26px;
	padding: 8px;
	border-top: 1px solid #e2e2e2;
}
.tb_hm_jqbs .tb_hm_td_last{
	width: 50px;
}
.tb_hm_jqbs .tb_hm_td_first{
	width: 280px;
}
.tb_hm_xltk .tb_hm_td_last{
	width: 100px;
}
.tb_hm_xltk .tb_hm_td_first{
	width: 50px;
}


.tb_hm_jqbs span.text_leftpro {
	color: #FFF;
	font-size: 12px;
	font-weight: bold;
	position: absolute;
	top: 160px;
    left: 20px;
}
.tb_hm_xltk span.text_leftpro {
	color: #FFF;
	font-size: 12px;
	font-weight: bold;
	position: absolute;
	top: 160px;
    left: 45px;
}
.tb_hm_rmgz span.text_leftpro {
	color: #FFF;
	font-size: 12px;
	font-weight: bold;
	position: absolute;
	top: 160px;
    left: 90px;
}
.tb_hm_rmbk span.text_leftpro {
	color: #FFF;
	font-size: 12px;
	font-weight: bold;
	position: absolute;
	top: 160px;
    left: 90px;
}
.img_leftpro {
	position: absolute;
	top: 110px;
    left: 60px;
}

.hard_label {
    font-size: 14px;
    padding: 3px 6px;
    border-radius: 0px;
}

table.tb_homepage2 tbody tr:nth-child(odd) td{
	background: #fafafa;
}
table.tb_homepage2 tbody tr:nth-child(even) td{
	background: #ececec;
}

.blog_box{
	border-top: 1px solid #e2e2e2;
	padding: 10px 0;
	height: 76px;
}
.noborder{
	border: 0px;
}

.p_blogtitle{
	font-size: 16px;
    font-weight: bold;
    line-height: 30px;
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
}

.span_inline_2{
	float: left;
	width: 100px;
}
.span_inline_3{
	float: left;
	width: 50px;
}
.span_inline_r{
	width: 160px;
	float: right;font-size: 12px;color: #999;
}
.span_inline_l{
	float: left;font-size: 12px;color: #999;
}













/*.text_contest_title {
	font-weight: bold;
}


.sub_portal:hover {
	box-shadow: 0px 10px 60px #696969;
}
.sub_portal{
	display:inline-block;
    width: 365px;
    height: 200px;
	float:left;
	margin-right:20px;
	box-shadow: 0px 10px 20px #C0C0C0;
}
.sub_portal_last{
	margin-right: 0px;
}*/

#wechat{
	margin-top:20px;
	float: right;
	width:30%;
	background-color:white;
	padding:20px 20px;
	text-align:center;

}
#wechat h2{
	font-size:25px;
	text-align:left;
}
#friend_link{
	padding:10px 20px;
	clear:both;
	margin-bottom:30px;
}
#friend_link h4{
	/*font-size:25px;*/
	border-bottom: 1px solid #CCC;
	color: #444;
    font-weight: bold;
    line-height: 36px;
}
#friend_link ul{
	line-height: 30px;
}
#friend_link ul li{
	list-style-type:none;
	display:inline;
}
#friend_link a{
	/*color:#444;*/
	color: #444;
	margin-right: 16px; 
}
#friend_link a:hover{
	color:#A9A9A9;
}

a{
	color: #444;
}
a:hover{
	color:#D0D0D0;
	text-decoration: none;
}
a:focus{
	text-decoration: none;
}

/*banner*/
.banner_full{
	width: 100%;
	height: 390px;
	background-image: -moz-linear-gradient(top, #262835, #E9EAEC);
	background-image: -ms-linear-gradient(top, #262835, #E9EAEC);
	background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#262835), to(#E9EAEC));
	background-image: -webkit-linear-gradient(top, #262835, #E9EAEC);
	background-image: -o-linear-gradient(top, #262835, #E9EAEC);
}


*{list-style-type:none;}
div#div_slides {margin: auto;max-width: 1920px;height: 390px;}
div#div_slides ul {padding: 0px;margin: 0px;}
div.visual{width:100%!important;height:390px;position:relative;min-width:1170px;}
div.visual ul.slides_container{width:100% !important;height:390px;display:inline-block;position:relative;}
div.visual ul.slides_container li{text-align:center;width:100% !important;position:relative;height:390px;overflow:hidden;background:#fff;}
img.imgVis{position:absolute;left:50%;top:0;margin-left:-960px;height: 390px;}

div.slideControl{width:930px;height:63px;margin:0;overflow:hidden;position:absolute;display: inline-block; top: 327px;left: 177px;}
div.slideControl ul.ul_pagination{width:930px;height:63px;margin:0;overflow:hidden;}
div.slideControl ul.ul_pagination li{width:308px !important;float:left;border-right: 1px solid #3d375a;}
div.slideControl ul.ul_pagination li a{width:307px;height:66px;display:inline-block;background:rgba(52,52,52,0.55);text-decoration:none;line-height: 60px;color: #FFF;font-size: 14px;text-align: center;}
div.slideControl ul.ul_pagination li a strong{font-size: 18px;}

.slides_center{width: 1100px;margin: 0 auto;position: relative;top: -395px; z-index: 9;}
.indexbox{display: inline-block;position: absolute;height: 390px;}
.p_indexbox{display: inline-block;position: absolute; width: 177px; color: #FFF;z-index: 99;}
.p_indexbox a{color: #FFF;}

.toptip{
	background: #fafafa;
	padding-left: 10px;
	width: 100%;
	height: 48px;
	line-height: 48px;
	border: 1px solid #d3d3d3;
	margin-bottom: 30px;
}

  	</style>
</head>
<body>
	<div class="wrap">
		<?php 
			$gonggao="0";
			include("oj/template/$OJ_TEMPLATE/nav.php");
		?>	
		<!-- <div class="banner"> -->
			<!-- <img src="img/banner1920.jpg" alt="" style="width:100%;max-width:100%;height:450px;"> -->
		<!-- </div> -->
		<div class="banner_full">
		<div id="div_slides">
			<div id="slides" class="visual">
				<ul class="slides_container">
					<li><a style="height:390px;width: 1920px;" href="/oj/problemset.html"> <img src="oj/template/<?php echo $OJ_TEMPLATE;?>/img/banner1.jpg"  alt="" class="imgVis" width="1920px" /></a>
					</li>
					<li><a href="/wp/"> <img src="oj/template/<?php echo $OJ_TEMPLATE;?>/img/banner2.jpg"  alt="" class="imgVis" width="1920px" /></a>
					</li>
					<li><a href="/vipjoin/"> <img src="oj/template/<?php echo $OJ_TEMPLATE;?>/img/banner3.jpg"  alt="" class="imgVis" width="1920px" /></a>
					</li>
				</ul>
				<div class="slides_center">
				<div class="indexbox">
					
					<div class="p_indexbox">
						<div class="p_fastpath" style="padding: 20px 0 20px 20px;">
							<p style="font-weight: bolder;font-size: 18px;padding-left: 30px;">学习积累</p><br>
							<a href="/course/c/10101.html">C语言教程</a>　<a href="/course/cpp/200001.html">C++教程</a>　<a href="/oj/livelist.html">在线课堂</a>
						</div>
						<div class="p_fastpath" style="padding: 20px 0 20px 20px;">
							<p style="font-weight: bolder;font-size: 18px;padding-left: 30px;">应用练习</p><br>
							<a href="/oj/problemset.html">训练场</a>　　<a href="/oj/contest.html">参加比赛</a>
						</div>
						<div class="p_fastpath" style="padding: 20px 0 20px 20px;">
							<p style="font-weight: bolder;font-size: 18px;padding-left: 30px;">工作相关</p><br>
							<a href="/job/list">找工作</a>　　<a href="/oj/job_release.php">发布招聘</a>
						</div>
					</div>
					<img style="height: 390px;position: absolute;top: 0px" src="oj/template/<?php echo $OJ_TEMPLATE;?>/img/banner0.png">

				</div>
				<div class="slideControl">
						<!-- <p class="slide_rBt"><a href="#" class="next"></a></p> -->
						<ul class="ul_pagination">
						  <li> <a href="#" rel="0"><strong>练习</strong> / Practice</a> </li>
						  <li> <a href="#" rel="1"><strong>资源</strong> / Resource</a> </li>
						  <li> <a href="#" rel="2"><strong>VIP学习</strong> / VIP Learning</a> </li>
						</ul>
						<!-- <p class="slide_lBt"><a href="#" class="prev"></a></p> -->
					</div>
				</div>
			</div>
			
		</div>
		</div>
		<div class="container" id="body">

			<?php

			  if($dir=="oj") {
			    if(file_exists("./xktms/msg.txt"))
			    $view_marquee_msg=file_get_contents($OJ_SAE?"saestor://web/msg.txt":"./xktms/msg.txt");
			  }  
			  else $view_marquee_msg=file_get_contents($path_fix."xktms/msg.txt");
			?>
			      <div class="toptip"> 
			      		<img src="oj/template/<?php echo $OJ_TEMPLATE;?>/img/guangbo.png" style="float: left;padding: 9px;">
			            <ul style="margin-top: 0px;padding-left: 140px;"><?php echo $view_marquee_msg;?></ul> 
			      </div>

			<div class="div_contentbox" style="height: 400px;">
				<div class="text_boxhead">
					<img style="margin: 0px 10px 8px 8px;" src="oj/template/<?php echo $OJ_TEMPLATE;?>/img/icon.png">
					<span style="font-size: 18px;font-weight: bold;">原创文章</span>　<span style="font-size: 12px;color: #5a5a5a; font-weight: normal;">/ Article</span>
				</div>
				<div style="margin: 0 3% 0 1%;width: 48%;float: left;">
					<div style="position: relative;">
						<a href="<?php echo $view_article[0]['url'];?>"><img style="padding-bottom: 22px;" src="oj/template/<?php echo $OJ_TEMPLATE;?>/img/index_article_fir.png"></a>

						<span style="position: absolute;overflow:hidden;white-space: nowrap;text-overflow: ellipsis;font-size: 24px;color: #FFF;left: 20px;bottom: 30px;width: 500px">
							<a style="color: #FFF;" href="<?php echo $view_article[0]['url'];?>"><?php echo $view_article[0]['title'];?></a>
						</span>
					</div>
						<?php 
								echo "<p class='p_article'><a href='".$view_article[1]['url']."'>".$view_article[1]['title']."<span style='float: right;'>".$view_article[1]['post_date']."</span></a></p>";
								echo "<p class='p_article'><a href='".$view_article[2]['url']."'>".$view_article[2]['title']."<span style='float: right;'>".$view_article[2]['post_date']."</span></a></p>";
						 ?>
				</div>
				<div style="width: 48%;float: left;">
						<?php 
							array_shift($view_article);
							array_shift($view_article);
							array_shift($view_article);
							foreach($view_article as $row)
								echo "<p class='p_article'><a href='".$row['url']."'>".$row['title']."<span style='float: right;'>".$row['post_date']."</a></p>";
						 ?>
				</div>
			</div>
			<div class="div_contentbox tb_hm_jqbs" style="background: url(oj/template/<?php echo $OJ_TEMPLATE;?>/img/jinqibisai.png) no-repeat;position: relative;">
			<img class="img_leftpro" src="oj/template/<?php echo $OJ_TEMPLATE;?>/img/text_jqbs.png">
			<span class="text_leftpro">Competition in the near future</span>
				<table class='table tb_homepage tb_homepage1'>
					<thead>
						<tr class=toprow_jqbs><th width=35%>比赛名称<th width=10%>比赛状态<th width=19%>时间<th width=15%>比赛时长<th width=11%><th width=10%>类型</tr>
					</thead>
					<tbody>
						<?php
						/*$cnt=0;*/
						foreach($view_contest as $table_cell){
						/*if ($cnt)
						echo "<tr class='oddrow'>";
						else
						echo "<tr class='evenrow'>";*/
						echo "<tr>";
						echo "<td>";
						echo "<div class='tb_hm_td_first'>";
						echo "<a style='font-size:15px;font-weight:bold;color:#5a5a5a;' href='oj/contest.html?cid=".$table_cell['contest_id']."'>".$table_cell['title']."</a>";
						echo "</div>";
						echo "</td>";
						echo "<td>";
						echo $table_cell['state'];
						echo "</td>";
						echo "<td>";
						echo $table_cell['start_time'];
						echo "</td>";
						echo "<td>";
						echo $table_cell['time_length'];
						echo "</td>";
						echo "<td>";
						echo $table_cell['order'];
						echo "</td>";
						echo "<td>";
						echo "<div class='tb_hm_td_last'>";
						echo $table_cell['private'];
						echo "</div>";
						echo "</td>";
						
						echo "</tr>";
						}
						?>
					</tbody>
				</table>
			</div>

			<div class="div_contentbox tb_hm_xltk" style="background: url(oj/template/<?php echo $OJ_TEMPLATE;?>/img/xunliantiku.png) no-repeat;position: relative;">
			<img class="img_leftpro" src="oj/template/<?php echo $OJ_TEMPLATE;?>/img/text_xltk.png">
			<span class="text_leftpro">Training question bank</span>
				<table class='table tb_homepage tb_homepage1'>
					<thead>
						<tr class=toprow_xltk><th width=8%>题号<th width=40%>题目名称<th width=14%>　类型<th width=10%>难度<th width=12%>已解决<th width=16%>　　已提交</tr>
					</thead>
					<tbody>
						<?php
						/*$cnt=0;*/
						foreach($view_problemset as $table_cell){
						/*if ($cnt)
						echo "<tr class='oddrow'>";
						else
						echo "<tr class='evenrow'>";*/
						echo "<tr>";
						echo "<td>";
						echo "<div class='tb_hm_td_first'>";
						echo $table_cell['problem_id'];
						echo "</div>";
						echo "</td>";
						echo "<td>";
						echo $table_cell['title'];
						echo "</td>";
						echo "<td>";
						echo $table_cell['mark'];
						echo "</td>";
						echo "<td>";
						echo $table_cell['difficulty'];
						echo "</td>";
						echo "<td>";
						echo $table_cell['accepted'];
						echo "</td>";
						echo "<td>";
						echo "<div class='tb_hm_td_last'>";
						echo $table_cell['submit'];
						echo "</div>";
						echo "</td>";
						
						echo "</tr>";
						}
						?>
					</tbody>
				</table>
			</div>

			<div class="div_contentbox tb_hm_rmgz" style="background: url(oj/template/<?php echo $OJ_TEMPLATE;?>/img/remengongzuo.png) no-repeat;position: relative;">
			<img class="img_leftpro" src="oj/template/<?php echo $OJ_TEMPLATE;?>/img/text_rmgz.png">
			<span class="text_leftpro">Hot jobs</span>
				<table class='table tb_homepage tb_homepage2'>
					<thead>
						<tr class=toprow_rmgz><th width=25%>　　需求职位<th>公司名称<th width=13%>地点<th width=8%>性质<th width=13%>薪资<th width=15%>更新时间</tr>
					</thead>
					<tbody>
						<?php

						foreach($usercpn_data as $row){
							echo "<tr>";
							foreach ($row as $table_cell) {
								echo "<td>";
								echo $table_cell;
								echo "</td>";
							}
							
							echo "</tr>";
						}
						?>
					</tbody>
				</table>
			</div>

			<div class="div_contentbox tb_hm_rmbk" style="background: url(oj/template/<?php echo $OJ_TEMPLATE;?>/img/remenboke.png) no-repeat;position: relative;">
			<img class="img_leftpro" src="oj/template/<?php echo $OJ_TEMPLATE;?>/img/text_rmbk.png">
			<span class="text_leftpro">Hot blogs</span>
				<div style="height: 310px;width: 872px;margin-left: 228px;background: #fafafa;border: 1px solid #e2e2e2;border-left: 0px;">
					<div style="width: 45%;margin-left: 2%;margin-right: 3%;float: left;">
						<?php
							for ($i=0; $i < 4; $i++) { 
								if ($i==0) {
									echo "<div class='blog_box noborder'>";
								}
								else {
									echo "<div class='blog_box'>";
								}
								echo $blog_data_r[$i];
								echo "</div>";
							}
						?>
					</div>
					<div style="width: 45%;margin-left: 2%;margin-right: 3%;float: left;">
						<?php
							for ($i=4; $i < 8; $i++) { 
								if ($i==4) {
									echo "<div class='blog_box noborder'>";
								}
								else {
									echo "<div class='blog_box'>";
								}
								echo $blog_data_r[$i];
								echo "</div>";
							}
						?>
					</div>
				</div>
			</div>
			
			<!-- <div id="wechat">
				<h2>关注我们</h2>
				<img src="oj/template/<?php echo $OJ_TEMPLATE;?>/img/wechat.jpg" alt="" style="height:233px;width:200px;">
			</div> -->
			<div class="text_boxhead">
				<img style="margin: 0px 10px 8px 8px;" src="oj/template/<?php echo $OJ_TEMPLATE;?>/img/icon.png">
				<span style="font-size: 18px;font-weight: bold;">友情链接</span>　<span style="font-size: 12px;color: #5a5a5a; font-weight: normal;">/ Friendship link</span>
			</div>
			<div id="friend_link" style="text-align: center;color: #5a5a5a;">
				<ul>
					<?php 
						$cnt=1;
						foreach($view_friend_link as $row) {
							if ($cnt%7==0) {
								$br="<br>";
							}
							else $br="";
							echo "<li><a target='_blank' href='".htmlspecialchars($row['url'], ENT_QUOTES)."'>".$row['title']."</a></li>".$br;
							$cnt++;
						} 
					?>
				</ul>
			</div>
		</div>
	</div>
	<footer id="footer">
		<div class="container">
			<ul class="pull-right list-unstyled list-inline">
				<li><a href="/tag.html">标签分类</a></li>
				<li><a href="oj/intro.php">网站介绍</a></li>
				<li><a href="oj/business.php">交流合作</a></li>
				<li><a href="oj/contactus.php">联系我们</a></li>
         	</ul>
			<p>&copy;2014-<?php echo date("Y");?> C语言网 版权所有 备案:辽ICP备10203779号</p>
		</div>
	</footer>
	<script src="oj/template/<?php echo $OJ_TEMPLATE;?>/js/jquery.min.js"></script>
	<script src="oj/template/<?php echo $OJ_TEMPLATE;?>/js/slides.jquery2.js"></script>
	<script src="oj/template/<?php echo $OJ_TEMPLATE;?>/js/bootstrap.min.js"></script>
	<script src="oj/template/<?php echo $OJ_TEMPLATE;?>/js/scrolltoptip.js"></script>

	<script type="text/javascript">
	$(function(){
		$('#slides').slides({
			container: 'slides_container',
			preload: true,
			play: 4000,
			pause: 1500,
			hoverPause: true,
			effect: 'slide',
			slideSpeed: 850
		});
	});
	</script>


	<script>
	var _hmt = _hmt || [];
	(function() {
	  var hm = document.createElement("script");
	  hm.src = "//hm.baidu.com/hm.js?56aab7d208d6169b3fb33801cc12fcbe";
	  var s = document.getElementsByTagName("script")[0]; 
	  s.parentNode.insertBefore(hm, s);
	})();
	$(".menu-item-has-children").mouseover(function(){
		$(this).css("background-color","#3061FD");
		$(this).find(".sub-menu").show();
	});
	$(".menu-item-has-children").mouseout(function(){
		$(this).find(".sub-menu").hide();
		$(this).css("background-color","transparent");
		// $(".current_page_item").css("background-color","#3061FD");
	});
	/*<?php
		$view_marquee_msg=file_get_contents("oj/xktms/msg.txt");
	 ?>
	
	var msg="<marquee  id=broadcast scrollamount=5 scrolldelay=0 onMouseOver='this.stop()' onMouseOut='this.start()'><span style='display: inline-block;padding: 5px 0px;font-size: 16px;border-radius: 30px;background: -webkit-linear-gradient(bottom, rgba(48, 97, 253, 1), rgba(48, 97, 253, 0));background: -o-linear-gradient(bottom, rgba(48, 97, 253, 1), rgba(48, 97, 253, 0));background: linear-gradient(to top, rgba(48, 97, 253, 1), rgba(48, 97, 253, 0));'>　<?php echo str_replace("\r\n", '', $view_marquee_msg); ?>　</span></marquee>";
    $("#body").prepend(msg);
    $("form").append("<div id='csrf' />");
    $("#csrf").load("oj/csrf.php");*/
	</script>

<!-- 百度信誉名片 -->
<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "https://hm.baidu.com/hm.js?7f9cc9f1afc9429871a342a49a6f556c";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>
	
</body>
</html>
<?php 
// if(file_exists('./include/cache_end.php'))
// 	require_once('./include/cache_end.php');
 ?>
