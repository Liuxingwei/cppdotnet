<?php 
	$cache_time=10;
	$OJ_CACHE_SHARE=false;
	require_once('./include/cache_start.php');
    require_once('./include/db_info.inc.php');
	require_once('./include/setlang.php');
	$view_title= "Welcome To Online Judge";
	require_once("./include/check_post_key.php");
	require_once("./include/my_func.inc.php");


$err_str="";
$err_cnt=0;
$len;
$user_id=$_SESSION['user_id'];

//$work_field=trim($_POST['work_field']);

$password=$_POST['opassword'];
$sql="SELECT `user_id`,`password` FROM `users` WHERE `user_id`='".$user_id."'";
$result=mysqli_query($mysqli,$sql);
$row=mysqli_fetch_array($result);
if ($row && pwCheck($password,$row['password'])) $rows_cnt = 1;
else $rows_cnt = 0;
mysqli_free_result($result);
if ($rows_cnt==0){
	$err_str=$err_str."请输入正确的密码!";
	$err_cnt++;
}
$len=strlen($_POST['npassword']);
if ($len<6 && $len>0){
	$err_cnt++;
	$err_str=$err_str."新密码不能小于6位!\\n";
}else if ($len>20){
	$err_cnt++;
	$err_str=$err_str."新密码不能大于20位!\\n";
}
else if (strcmp($_POST['npassword'],$_POST['rptpassword'])!=0){
	$err_str=$err_str."两次输入的密码不一致!";
	$err_cnt++;
}

if ($err_cnt>0){
	echo "<meta http-equiv='Content-Type' content='text/html'; charset='utf-8'>";
	print "<script charset='utf-8' language='javascript'>\n";
	echo "alert('";
	echo $err_str;
	print "');\n history.go(-1);\n</script>";
	exit(0);
	
}
// $nick=mysqli_real_escape_string($mysqli,htmlentities ($nick,ENT_QUOTES,"UTF-8"));
$password=pwGen($_POST['npassword']);

$sql="UPDATE `users` SET `password`='$password'WHERE `user_id`='".mysqli_real_escape_string($mysqli,$user_id)."'";
// echo " <script>console.log('$sql')</script>";
echo $sql;
//exit(0);
mysqli_query($mysqli,$sql) or die("Insert Error!\n");
header("Location: ./");
?>
