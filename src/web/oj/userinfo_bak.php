<?php
 $cache_time=10; 
 $OJ_CACHE_SHARE=false;
require_once('./include/cache_start.php');
require_once('./include/db_info.inc.php');
require_once('./include/setlang.php');
require_once("./include/const.inc.php");
require_once("./include/my_func.inc.php");

/*//静态化
if (isset($_GET['user'])) {
  $str_user="_".htmlentities($_GET['user']);
}
else {
  $str_user="";
}

$statis_file = "../staticfiles/yonghuxinxi".$str_user.".html";//对应静态页文件

require_once('include/cache-static_start.php');

//*/

if(!isset($_SESSION['user_id']))if(isset($_SESSION['prev_page']))unset($_SESSION['prev_page']);

 // check user
$user=$_GET['user'];
if (!is_valid_user_name($user)){
	echo "找不到这个用户!";
	exit(0);
}
$view_title=$user ."@".$OJ_NAME;
$user_mysql=mysqli_real_escape_string($mysqli,$user);
$sql="SELECT `school`,`email`,`nick` FROM `users` WHERE `user_id`='$user_mysql'";
$result=mysqli_query($mysqli,$sql);
$row_cnt=mysqli_num_rows($result);
if ($row_cnt==0){ 
	$view_errors= "找不到这个用户!";
	require("template/".$OJ_TEMPLATE."/error.php");
	exit(0);
}

$row=mysqli_fetch_object($result);
$school=$row->school;
$email=$row->email;
$nick=$row->nick;
mysqli_free_result($result);

if(isset($_GET['defunct'])){
	require_once('include/check_get_key.php');
	$defunct=$_GET['defunct']=='Y'?'Y':'N';
	$sql="UPDATE `users` SET `defunct`='$defunct'";
	mysqli_query($mysqli, $sql);
}
//defunct?
$sql="SELECT `defunct` FROM `users` WHERE `user_id`='$user'";
// echo "<!-- $sql -->";
$result=mysqli_query($mysqli, $sql);
$row=mysqli_fetch_object($result);
$defunct=$row->defunct=='Y'?true:false;
// count solved
$sql="SELECT count(DISTINCT problem_id) as `ac` FROM `solution` WHERE `user_id`='".$user_mysql."' AND `result`=4";
$result=mysqli_query($mysqli,$sql) or die(mysqli_error());
$row=mysqli_fetch_object($result);
$AC=$row->ac;
mysqli_free_result($result);
// count submission
$sql="SELECT count(solution_id) as `Submit` FROM `solution` WHERE `user_id`='".$user_mysql."'";
$result=mysqli_query($mysqli,$sql) or die(mysqli_error());
$row=mysqli_fetch_object($result);
$Submit=$row->Submit;
mysqli_free_result($result);
// update solved 
$sql="UPDATE `users` SET `solved`='".strval($AC)."',`submit`='".strval($Submit)."' WHERE `user_id`='".$user_mysql."'";
$result=mysqli_query($mysqli,$sql);
$sql="SELECT count(*) as `Rank` FROM `users` WHERE `solved`>$AC";
$result=mysqli_query($mysqli,$sql);
$row=mysqli_fetch_array($result);
$Rank=intval($row[0])+1;

 if (isset($_SESSION['administrator'])){
$sql="SELECT * FROM `loginlog` WHERE `user_id`='$user_mysql' order by `time` desc LIMIT 0,10";
$result=mysqli_query($mysqli,$sql) or die(mysqli_error());
$view_userinfo=array();
$i=0;
for (;$row=mysqli_fetch_row($result);){
	$view_userinfo[$i]=$row;
	$i++;
}
echo "</table>";
mysqli_free_result($result);
}
$sql="SELECT result,count(1) as cnt FROM solution WHERE `user_id`='$user_mysql'  AND result>=4 group by result order by result";
	$result=mysqli_query($mysqli,$sql);
	$view_userstat=array();
	$i=0;
	$view_summary[4]=$view_summary[5]=$view_summary[6]=$view_summary[7]=$view_summary[9]=$view_summary[10]=$view_summary[11]=0;
	while($row=mysqli_fetch_array($result)){
		$view_userstat[$i++]=$row;
		$view_summary[intval($row[0])]=intval($row[1]);
	}
	mysqli_free_result($result);

$sql=	"SELECT UNIX_TIMESTAMP(date(in_date))*1000 md,count(1) c FROM `solution` where  `user_id`='$user_mysql'   group by md order by md desc ";
	$result=mysqli_query($mysqli,$sql);//mysql_escape_string($sql));
	$chart_data_all= array();
//echo $sql;
    
	while ($row=mysqli_fetch_array($result)){
		$chart_data_all[$row['md']]=$row['c'];
    }
    
$sql=	"SELECT UNIX_TIMESTAMP(date(in_date))*1000 md,count(1) c FROM `solution` where  `user_id`='$user_mysql' and result=4 group by md order by md desc ";
	$result=mysqli_query($mysqli,$sql);//mysql_escape_string($sql));
	$chart_data_ac= array();
//echo $sql;
    
	while ($row=mysqli_fetch_array($result)){
		$chart_data_ac[$row['md']]=$row['c'];
    }
  
  mysqli_free_result($result);
$sql="SELECT * FROM `users` WHERE `user_id`='$user'";
$result=mysqli_query($mysqli, $sql);
if($row=mysqli_fetch_object($result)){
	$userinfo_reg_time=$row->reg_time;
	$userinfo_subject=$row->subject;
	$userinfo_phone=$row->phone;
	$userinfo_address=$row->address;
	$userinfo_age=intval($row->age);
	$userinfo_work_field=$row->field;
	if($row->is_work=='0'){
		$userinfo_iswork='学生';
	}else if($row->is_work=='1'){
		$userinfo_iswork='在职';
	}else{
		$userinfo_iswork='待业';
	}
	$userinfo_last_nick_time=$row->last_nick_time;
}
/////////////////////////Template
require("template/".$OJ_TEMPLATE."/userinfo.php");
/////////////////////////Common foot
if(file_exists('./include/cache_end.php'))
	require_once('./include/cache_end.php');

/*//静态化
  require_once('include/cache-static_end.php');
//*/

?>

