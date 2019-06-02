<?php
////////////////////////////Common head
/*$cache_time=2;
$OJ_CACHE_SHARE=false;
require_once('./include/cache_start.php');*/
require_once('./include/db_info.inc.php');
require_once('./include/setlang.php');
require_once('./include/my_func.inc.php');
$url_oj="../oj/";
$view_title= "题解 - C语言网";

if(!isset($_GET['id'])){
	$view_errors="找不到这个问题.";
    require("template/".$OJ_TEMPLATE."/error.php");
    exit(0);
}

$id=intval($_GET['id']);
$sql="SELECT * FROM problem WHERE problem_id=$id";
$result=mysqli_query($mysqli, $sql);
if(mysqli_num_rows($result)!=1){
    $view_errors="找不到这个问题.";
    require("template/".$OJ_TEMPLATE."/error.php");
    exit(0);
}
$pr_flag=true;
$tmprow=mysqli_fetch_object($result);
$problem_title=$tmprow->title;

$PID="ABCDEFGHIJKLMNOPQRSTUVWXYZ";
$id=$tmprow->problem_id;
if($pr_flag) $view_title= $tmprow->problem_id.": ".$tmprow->title." - 解题报告 - C语言网";
else $view_title= $PID[$pid].": ".$tmprow->title." - 解题报告 - C语言网";
                
mysqli_free_result($result);

/*优质题解*/
$i=0;
$blog_data=Array();
$blog_data[$i]=Array();

$sql="SELECT `blog_id`,`title`,`user_id`,`problem_id`,`language`,`nice`,`scan`,`post_time` FROM `blog` WHERE `problem_id`='".$id."' AND `status`=1 ORDER BY `hq`=1 DESC,`nice` DESC";
$result=mysqli_query($mysqli,$sql) or die(mysqli_error());

while ($row=mysqli_fetch_object($result)){
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
        $blog_data[$i][0]="<td><a target='_blank' class='list_title' href='/blog/".$row->blog_id.".html'>　　<span style='color: red;font-weight: bold;border: 2px solid red;padding: 0px 3px;'>优质题解</span> ".$row->title."</a><br>";
    }
    else{
        $blog_data[$i][0]="<td><a target='_blank' class='list_title' href='/blog/".$row->blog_id.".html'>　　".$row->title."</a><br>";
    }
    if ($row->problem_id==0) {
        $blog_data[$i][1]="<span class='list_normal'>作者：<a href='/home/".$row->user_id."'>".getNickByid($row->user_id)."</a>　编辑时间：".$row->post_time."</span>";
    }
	else {
        $blog_data[$i][1]="<span class='list_normal'>作者：<a href='/home/".$row->user_id."'>".getNickByid($row->user_id)."</a>　题号：".$row->problem_id."　语言：".$language."　编辑时间：".$row->post_time."</span>";
    }
    $blog_data[$i][2]="<span class='list_normal' style='float: right;'>浏览：<span class='span_inline_1'>".$row->scan."</span>　　评论：<span class='span_inline_1'>".$disc_cnt."</span>　　赞：<span class='span_inline_1'>".$row->nice."</span></span></td>";
	$i++;
}
//

mysqli_free_result($result);
$sql="SELECT `blog_id`,`title`,`user_id`,`nice`,`scan`,`post_time` FROM `blog` WHERE blog_id >= (SELECT floor( RAND() * ((SELECT MAX(blog_id) FROM `blog`)-(SELECT MIN(blog_id) FROM `blog`)) + (SELECT MIN(blog_id) FROM `blog`))) AND `status`=1 ORDER BY blog_id LIMIT 7";
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
        $blog_data_r[$i][0]="<td><a target='_blank' class='' href='/blog/".$row->blog_id.".html'><span style='color: red;font-weight: bold;border: 2px solid red;padding: 0px 3px;'>优质题解</span> ".$row->title."</a><br>";
    }
    else {
        $blog_data_r[$i][0]="<td><a target='_blank' class='' href='/blog/".$row->blog_id.".html'>".$row->title."</a><br>";
    }
    $blog_data_r[$i][1]="<span class='list_normal' style='float: right;'>浏览：<span class='span_inline_1'>".$row->scan."</span>　　赞：<span class='span_inline_1'>".$row->nice."</span></span></td>";
    $i++;
}
mysqli_free_result($result);

/*<span style='color: red;font-weight: bold;border: 2px solid red;padding: 0px 3px;'>优质题解</span> */
require("template/".$OJ_TEMPLATE."/blog_list.php");
?>