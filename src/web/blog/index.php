<?php
$url_oj_home="https://www.dotcpp.com";
$url_oj="https://www.dotcpp.com/oj/";
////////////////////////////Common head
/*$cache_time=2;
$OJ_CACHE_SHARE=false;
require_once('./include/cache_start.php');*/
require_once('include/db_info.inc.php');
require_once('include/setlang.php');
require_once('include/my_func.inc.php');
$view_title= "分享题解|分享经验|分享故事 - C语言网原创博客";
//题解类文章
$sql="SELECT `blog_id`,`title`,`user_id`,`problem_id`,`language`,`nice`,`scan`,`post_time` FROM `blog` WHERE `problem_id`!='0' AND `status`=1 ORDER BY `post_time` DESC LIMIT 5";
$result=mysqli_query($mysqli,$sql) or die(mysqli_error());

$pblog_data=Array();
$i=0;
while ($row=mysqli_fetch_object($result)){
	$pblog_data[$i]=Array();

    $sql_cnt="SELECT count(1) FROM blog_discuss WHERE blog_id='$row->blog_id'";
    $result_cnt=mysqli_query($mysqli,$sql_cnt);
    $row_cnt=mysqli_fetch_array($result_cnt);
    $disc_cnt=$row_cnt[0];
    mysqli_free_result($result_cnt);

    if ($row->language==0) {
        $language="C";
    }else if ($row->language==1) {
        $language="C++";
    }else if ($row->language==3) {
        $language="JAVA";
    }else {
        $language="";
    }

    $sql_hq="SELECT hq FROM blog WHERE blog_id='$row->blog_id'";
    $result_hq=mysqli_query($mysqli,$sql_hq);
    $row_hq=mysqli_fetch_array($result_hq);
    mysqli_free_result($result_hq);
    if ($row_hq[0]==1) {
        $pblog_data[$i][0]="<td><div class='list_box_index'><a target='_blank' class='list_title_index' href='/".$row->user_id."/".$row->blog_id."'><span style='color: red;font-weight: bold;border: 2px solid red;padding: 0px 3px;'>优质题解</span> ".$row->title."</a><br><br>";
    }
    else{
        $pblog_data[$i][0]="<td><div class='list_box_index'><a target='_blank' class='list_title_index' href='/".$row->user_id."/".$row->blog_id."'>".$row->title."</a><br><br>";
    }

    $pblog_data[$i][1]="<span class='list_normal'>作者：<a href='/".$row->user_id."'>".getNickByid($row->user_id)."</a>　题号：".$row->problem_id."　语言：".$language."　编辑时间：".$row->post_time."</span>";
    $pblog_data[$i][2]="<span class='list_normal' style='float: right;'>浏览：<span class='span_inline_1'>".$row->scan."</span>　　评论：<span class='span_inline_1'>".$disc_cnt."</span>　　赞：<span class='span_inline_1'>".$row->nice."</span></span></div></td>";
	$i++;
}
mysqli_free_result($result);
//非题解文章
$sql="SELECT `blog_id`,`title`,`user_id`,`problem_id`,`language`,`nice`,`scan`,`post_time` FROM `blog` WHERE `problem_id`='0' AND `status`=1 ORDER BY `post_time` DESC LIMIT 5";
$result=mysqli_query($mysqli,$sql) or die(mysqli_error());

$ablog_data=Array();
$i=0;
while ($row=mysqli_fetch_object($result)){
	$ablog_data[$i]=Array();
    $sql_cnt="SELECT count(1) FROM blog_discuss WHERE blog_id='$row->blog_id'";
    $result_cnt=mysqli_query($mysqli,$sql_cnt);
    $row_cnt=mysqli_fetch_array($result_cnt);
    $disc_cnt=$row_cnt[0];
    mysqli_free_result($result_cnt);
    
	$ablog_data[$i][0]="<td><div class='list_box_index'><a target='_blank' class='list_title_index' href='/".$row->user_id."/".$row->blog_id."'>".$row->title."</a><br><br>";
    
    $ablog_data[$i][1]="<span class='list_normal'>作者：<a href='/".$row->user_id."'>".getNickByid($row->user_id)."</a>　编辑时间：".$row->post_time."</span>";
    
    $ablog_data[$i][2]="<span class='list_normal' style='float: right;'>浏览：<span class='span_inline_1'>".$row->scan."</span>　　评论：<span class='span_inline_1'>".$disc_cnt."</span>　　赞：<span class='span_inline_1'>".$row->nice."</span></span></div></td>";
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
    $blog_data_r[$i]=Array();

    $sql_hq="SELECT hq FROM blog WHERE blog_id='$row->blog_id'";
    $result_hq=mysqli_query($mysqli,$sql_hq);
    $row_hq=mysqli_fetch_array($result_hq);
    mysqli_free_result($result_hq);
    if ($row_hq[0]==1) {
        $blog_data_r[$i][0]="<td><a class='' target='_blank' href='/".$row->user_id."/".$row->blog_id."'><span style='color: red;font-weight: bold;border: 2px solid red;padding: 0px 3px;'>优质题解</span> ".$row->title."</a><br>";
    }
    else{
        $blog_data_r[$i][0]="<td><a class='' target='_blank' href='/".$row->user_id."/".$row->blog_id."'>".$row->title."</a><br>";
    }

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

    $sql_hq="SELECT hq FROM blog WHERE blog_id='$row->blog_id'";
    $result_hq=mysqli_query($mysqli,$sql_hq);
    $row_hq=mysqli_fetch_array($result_hq);
    mysqli_free_result($result_hq);
    if ($row_hq[0]==1) {
        $blog_data_ran[$i][0]="<td><a class='' target='_blank' href='/".$row->user_id."/".$row->blog_id."'><span style='color: red;font-weight: bold;border: 2px solid red;padding: 0px 3px;'>优质题解</span> ".$row->title."</a><br>";
    }
    else{
        $blog_data_ran[$i][0]="<td><a class='' target='_blank' href='/".$row->user_id."/".$row->blog_id."'>".$row->title."</a><br>";
    }
    $blog_data_ran[$i][1]="<span class='list_normal' style='float: right;'>浏览：<span class='span_inline_1'>".$row->scan."</span>　　赞：<span class='span_inline_1'>".$row->nice."</span></span></td>";
    $i++;
}
mysqli_free_result($result);

//作者排行
$sql="SELECT `user_id`,`nick` FROM `users` ORDER BY `blog_cnt` DESC LIMIT 10";
$result=mysqli_query($mysqli,$sql) or die(mysqli_error());
$blog_data_u=Array();
$i=0;
while ($row=mysqli_fetch_object($result)){
    $blog_data_u[$i]=Array();
    $blog_data_u[$i]="";
    $blog_data_u[$i]="<td><span style='color: #999;font-weight: bold;'>".($i+1)."</span>　<a target='_blank' class='' style='display: inline-block;text-align: center;width: 85%;' href='/".$row->user_id."'>".$row->nick."</a></td>";
    $i++;
}
mysqli_free_result($result);
require("template/".$OJ_TEMPLATE."/blog_index.php");
?>
