<?php 
$OJ_CACHE_SHARE=false;
$cache_time=60;
require_once('./include/db_info.inc.php');
require_once('./include/cache_start.php');
require_once('./include/setlang.php');
// require_once('./include/const.inc.php');

/*//静态化
if (isset($_GET['page'])) {
  $str_page="_page".intval($_GET['page']);
}
else {
  $str_page="";
}
if (isset($_GET['difficulty'])) {
  $str_difficulty="_difficulty".intval($_GET['difficulty']);
}
else {
  $str_difficulty="";
}
if (isset($_GET['mark'])) {
  $str_mark="_mark".intval($_GET['mark']);
}
else {
  $str_mark="";
}

$statis_file = "../staticfiles/timu".$str_page.$str_difficulty.$str_mark.".html";//对应静态页文件

require_once('include/cache-static_start.php');

//*/

  $view_title= "蓝桥杯ACM训练系统 - C语言网";

if(!isset($_SESSION['user_id']))if(isset($_SESSION['prev_page']))unset($_SESSION['prev_page']);

$first=1000;
  //if($OJ_SAE) $first=1;
$sql="SELECT max(`problem_id`) as upid FROM `problem`";
$page_cnt=25;

/*tag*/
$view_category="";
$sql= "select distinct source "
    ."FROM `problem` "
    ."LIMIT 500";
$result=mysqli_query($mysqli, $sql);

$category=array();
  while ($row = mysqli_fetch_array($result)){
    $cate=explode(" ",$row['source']);
    foreach($cate as $cat){
      array_push($category,trim($cat)); 
    }
}
$category=array_unique($category);

$view_category.= "<div style='padding: 15px;'><p>";

foreach ($category as $cat){
  if(trim($cat)=="") continue;
  $view_category.= "<a class='a_gray' style='margin-right:10px;line-height:30px;' href='problemset.php?tag=".rawurlencode(htmlentities($cat,ENT_QUOTES,'UTF-8'))."'><button style='border-radius: 0px;' type='button' class='btn btn-primary btn-xs'>".$cat."</button></a>";
}

$view_category.= "</p></div>";

/*tag*/

if(isset($_GET['difficulty'])){
  $difficulty=intval($_GET['difficulty']);
  if($difficulty<0 || $difficulty>3)$difficulty=0;
  $sql="SELECT COUNT(`problem_id`) as upid FROM `problem` WHERE difficulty=$difficulty";
}else if(isset($_GET['mark'])){
  switch ($_GET['mark']) {
    case 'bianchenglianxi':
      $mark_=0;
      break;
    case 'jisuanjierji':
      $mark_=1;
      break;
    case 'acm':
      $mark_=2;
      break;
    case 'oi':
      $mark_=3;
      break;
    case 'pat':
      $mark_=4;
      break;
    case 'shujujiegou':
      $mark_=5;
      break;
    case 'lanqiaobei':
      $mark_=6;
      break;
    case 'mingxiao':
      $mark_=7;
      break;
    default:
      $mark_=intval($_GET['mark']);
      break;
  }
  if($mark_<0 || $mark_>7)$mark_=0;
  $sql="SELECT COUNT(`problem_id`) as upid FROM `problem` WHERE mark=$mark_";
}else if(isset($_GET['search'])){
  $search=mysqli_real_escape_string($mysqli,$_GET['search']);
  $sql="SELECT COUNT(`problem_id`) as upid FROM `problem` WHERE ( source like '%$search%' or title like '%$search%') ";
}
else if(isset($_GET['tag'])){
  $tag=mysqli_real_escape_string($mysqli,$_GET['tag']);
  $sql="SELECT COUNT(`problem_id`) as upid FROM `problem` WHERE ( source like '%$tag%') ";
}
$result=mysqli_query($mysqli,$sql);
echo mysqli_error($mysqli);
$row=mysqli_fetch_object($result);
if(isset($difficulty) || isset($mark_) || isset($search) || isset($tag))
  $cnt=intval($row->upid);
else $cnt=intval($row->upid)-$first;
$cnt=intval($cnt/$page_cnt);
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
  //remember page
  $page="1";
if (isset($_GET['page'])){
    $page=intval($_GET['page']);
    //if(isset($_SESSION['user_id'])){
    //     $sql="update users set volume=$page where user_id='".$_SESSION['user_id']."'";
    //     mysqli_query($mysqli,$sql);
    //}
}else{
    //if(isset($_SESSION['user_id'])){
    //        $sql="select volume from users where user_id='".$_SESSION['user_id']."'";
    //        $result=@mysqli_query($mysqli,$sql);
    //        $row=mysqli_fetch_array($result);
    //        $page=intval($row[0]);
    //}
    if(!is_numeric($page)||$page<0)
        $page='1';
}
  //end of remember page



$pstart=$first+$page_cnt*intval($page)-$page_cnt;
$pend=$pstart+$page_cnt;

$sub_arr=Array();
// submit
if (isset($_SESSION['user_id'])){
    $sql="SELECT `problem_id` FROM `solution` WHERE `user_id`='".$_SESSION['user_id']."'".
                                                                           //  " AND `problem_id`>='$pstart'".
                                                                           // " AND `problem_id`<'$pend'".
    	" group by `problem_id`";
    $result=@mysqli_query($mysqli,$sql) or die(mysqli_error($mysqli));
    while ($row=mysqli_fetch_array($result))
    	$sub_arr[$row[0]]=true;
}

$acc_arr=Array();
// ac
if (isset($_SESSION['user_id'])){
    $sql="SELECT `problem_id` FROM `solution` WHERE `user_id`='".$_SESSION['user_id']."'".
                                                                           //  " AND `problem_id`>='$pstart'".
                                                                           //  " AND `problem_id`<'$pend'".
    	" AND `result`=4".
    	" group by `problem_id`";
    $result=@mysqli_query($mysqli,$sql) or die(mysqli_error());
    while ($row=mysqli_fetch_array($result))
    	$acc_arr[$row[0]]=true;
}
$isquery=false;
if(isset($_GET['search'])&&trim($_GET['search'])!=""){
  $search=mysqli_real_escape_string($mysqli,$_GET['search']);
    $filter_sql=" ( source like '%$search%' or title like '%$search%')";
    //$filter_sql=" title like '%$search%' ";
    $isquery=true;
    
}
if(isset($difficulty)){
  $filter_sql.=" `difficulty`=$difficulty ";
  $isquery=true;
}
if(isset($mark_)){
  $filter_sql.=" `mark`=$mark_ ";
  $isquery=true;
}
if(isset($tag)){
  $filter_sql.=" `source` like '%$tag%'";
  $isquery=true;
}

if(!$isquery)
     $filter_sql="  `problem_id`>='".strval($pstart)."' AND `problem_id`<'".strval($pend)."' ";


if (isset($_SESSION['administrator'])){
	
	$sql="SELECT `problem_id`,`title`,`mark`,`difficulty`,`source`,`accepted`,`submit` FROM `problem`  WHERE ";
  if($filter_sql!="")$sql.=" $filter_sql ";
	
}
else{
	$now=strftime("%Y-%m-%d %H:%M",time());
	$sql="SELECT `problem_id`,`title`,`mark`,`difficulty`,`source`,`accepted`,`submit` FROM `problem` ".
	"WHERE `defunct`='N' AND $filter_sql";
 //  $sql.=" AND `problem_id` NOT IN(
	// 	SELECT `problem_id` FROM `contest_problem` WHERE `contest_id` IN (
	// 		SELECT `contest_id` FROM `contest` WHERE 
	// 		(`end_time`>'$now' or private=1)AND `defunct`='N'
			
	// 	)
	// ) ";
}
$sql.=" ORDER BY `problem_id`";

if(isset($difficulty) || isset($mark_) || isset($search) || isset($tag))$sql.=" LIMIT ".($page-1)*$page_cnt.",$page_cnt ";
// echo "<script>console.log($sql)</script>";
$result=mysqli_query($mysqli,$sql) or die(mysqli_error());

$view_total_page=$cnt+1;
$cnt=0;
$view_problemset=Array();
$i=0;
while ($row=mysqli_fetch_object($result)){
	
	
	$view_problemset[$i]=Array();

  if (isset($sub_arr[$row->problem_id])){
    if (isset($acc_arr[$row->problem_id])) 
      $view_problemset[$i][0]="<span class='btn hard_label btn_ac label-success'>Y</span>";
    else 
        $view_problemset[$i][0]= "<span class='btn hard_label btn_ac label-danger'>N</span>";
  }else{
    $view_problemset[$i][0]= "<span class=none> </span>";
  }

	$view_problemset[$i][1]="<span class='center'>".$row->problem_id."</span>";
    $view_problemset[$i][2]="<span class='left'><a target='_blank' href='/oj/problem".$row->problem_id.".html'>".$row->title."</a></span>";

    /*if ($_SESSION['user_id']=="shiki") {

      if ($row->source!="" || $row->source!=NULL) {
          $view_problemset[$i][3]="<div style='text-align: right;line-height: 30px;'>";
          $cate_row=explode(" ",$row->source);
          foreach ($cate_row as $cat_row) {
            $view_problemset[$i][3].="<a class='center btn hard_label btn-xs' style='margin-right:10px;' href='problemset.php?search=".rawurlencode(htmlentities($cat_row,ENT_QUOTES,'UTF-8'))."'>".$cat_row."</a>";
          }

          $view_problemset[$i][3].="</div>";
      }
      else {
        $view_problemset[$i][3]="";
      }
    }
    else {
    */
    $view_problemset[$i][3]="<a class='center btn hard_label ";
    if($row->mark!=-1){
      $view_problemset[$i][3].=$mark_color[$row->mark];
      $view_problemset[$i][3].=" 'href='/oj/problemset.php?mark=$row->mark'";
    }
    $view_problemset[$i][3].="'>";
    if($row->mark!=-1)
      $view_problemset[$i][3].=$mark_name[$row->mark];
    $view_problemset[$i][3].="</a>";
    /*}*/

    $view_problemset[$i][4]="<a class='center btn hard_label hard_label_2 "; 
    if($row->difficulty!=-1){
      $view_problemset[$i][4].=$difficulty_color[$row->difficulty];
      $view_problemset[$i][4].=" 'href='/oj/problemset.php?difficulty=$row->difficulty'";
    }
    $view_problemset[$i][4].="'>";
    if($row->difficulty!=-1)
      $view_problemset[$i][4].=$difficulty_name[$row->difficulty];
    $view_problemset[$i][4].="</a>";

	$view_problemset[$i][5]="<span class='center'><a href='/oj/status.php?problem_id=".$row->problem_id."&jresult=4'>".$row->accepted."</a>/<a href='/oj/status.php?problem_id=".$row->problem_id."'>".$row->submit."</a></span>";
	
	
	$i++;
}
mysqli_free_result($result);


require("template/".$OJ_TEMPLATE."/problemset.php");
if(file_exists('./include/cache_end.php'))
	require_once('./include/cache_end.php');

/*//静态化
  require_once('include/cache-static_end.php');
//*/

?>
