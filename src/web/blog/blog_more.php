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
$view_title= "C语言网博客|文章总览 - C语言网";

$page="1";
if (isset($_GET['page'])){
    $page=intval($_GET['page']);
}
$page_cnt=20;

$sql="SELECT COUNT(`blog_id`) as cnt_id FROM `blog` WHERE `status`=1";
$result=mysqli_query($mysqli,$sql);
$row=mysqli_fetch_object($result);
$cnt=intval($row->cnt_id);
$cnt=intval($cnt/$page_cnt);
$view_total_page=$cnt+1;

$sql="SELECT `blog_id`,`title`,`user_id`,`problem_id`,`language`,`nice`,`scan`,`post_time` FROM `blog` WHERE `status`=1 ORDER BY `post_time` DESC  LIMIT ".($page-1)*$page_cnt.",$page_cnt";
$result=mysqli_query($mysqli,$sql) or die(mysqli_error());

$blog_data=Array();
$i=0;
while ($row=mysqli_fetch_object($result)){
	$blog_data[$i]=Array();
    $sql_cnt="SELECT count(1) FROM blog_discuss WHERE blog_id='$row->blog_id'";
    $result_cnt=mysqli_query($mysqli,$sql_cnt);
    $row_cnt=mysqli_fetch_array($result_cnt);
    $disc_cnt=$row_cnt[0];
    mysqli_free_result($result_cnt);
    if ($row->problem_id!=0) {
        $problem_id="题号：".$row->problem_id;
    }
    else {
        $problem_id="";
    }
    
    if ($row->language==0) {
        $language="语言：C";
    }else if ($row->language==1) {
        $language="语言：C++";
    }else if ($row->language==3) {
        $language="语言：JAVA";
    }else {
        $language="";
    }
	$blog_data[$i][0]="<td><div class='list_box_index'><a target='_blank' class='list_title_index' href='/".$row->user_id."/".$row->blog_id."'>".$row->title."</a><br><br>";

    $blog_data[$i][1]="<span class='list_normal'>作者：<a href='/".$row->user_id."'>".getNickByid($row->user_id)."</a>　".$problem_id."　".$language."　编辑时间：".$row->post_time."</span>";
    $blog_data[$i][2]="<span class='list_normal' style='float: right;'>浏览：<span class='span_inline_1'>".$row->scan."</span>　　评论：<span class='span_inline_1'>".$disc_cnt."</span>　　赞：<span class='span_inline_1'>".$row->nice."</span></span></div></td>";
	$i++;
}
mysqli_free_result($result);

//周榜最热
$blogtime_week_end=date("Y-m-d H:i:s",mktime(0, 0 , 0,date("m"),date('d'),date("Y"))+86400);
$blogtime_week_start=date("Y-m-d H:i:s",mktime(0, 0 , 0,date("m"),date('d'),date("Y"))-(6*86400));
$sql="SELECT `blog_id`,`title`,`user_id`,`nice`,`scan`,`post_time` FROM `blog` WHERE unix_timestamp(post_time) >= unix_timestamp('".$blogtime_week_start."') AND unix_timestamp(post_time) < unix_timestamp('".$blogtime_week_end."') ORDER BY `nice` DESC LIMIT 8";
$result=mysqli_query($mysqli,$sql) or die(mysqli_error());
$blog_data_r=Array();
$i=0;
while ($row=mysqli_fetch_object($result)){
    $blog_data_r[$i]=Array();
    $blog_data_r[$i][0]="<td><a target='_blank' class='' href='/".$row->user_id."/".$row->blog_id."'>".$row->title."</a><br>";
    $blog_data_r[$i][1]="<span class='list_normal' style='float: right;'>浏览：<span class='span_inline_1'>".$row->scan."</span>　　赞：<span class='span_inline_1'>".$row->nice."</span></span></td>";
    $i++;
}
mysqli_free_result($result);

//随机推荐
$sql="SELECT `blog_id`,`title`,`user_id`,`nice`,`scan`,`post_time` FROM `blog` WHERE blog_id >= (SELECT floor( RAND() * ((SELECT MAX(blog_id) FROM `blog`)-(SELECT MIN(blog_id) FROM `blog`)) + (SELECT MIN(blog_id) FROM `blog`))) ORDER BY blog_id LIMIT 5";
$result=mysqli_query($mysqli,$sql) or die(mysqli_error());
$blog_data_ran=Array();
$i=0;
while ($row=mysqli_fetch_object($result)){
    $blog_data_ran[$i]=Array();
    $blog_data_ran[$i][0]="<td><a target='_blank' class='' href='/".$row->user_id."/".$row->blog_id."'>".$row->title."</a><br>";
    $blog_data_ran[$i][1]="<span class='list_normal' style='float: right;'>浏览：<span class='span_inline_1'>".$row->scan."</span>　　赞：<span class='span_inline_1'>".$row->nice."</span></span></td>";
    $i++;
}
mysqli_free_result($result);

require("template/".$OJ_TEMPLATE."/blog_more.php");
?>