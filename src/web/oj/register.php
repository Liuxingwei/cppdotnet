<?php 
require_once("./include/db_info.inc.php");
require_once("./include/my_func.inc.php");
require_once("./lang/cn.php");
$err_str="";
$err_cnt=0;
$len;
$user_id=trim($_POST['user_id']);
$len=strlen($user_id);
$email=trim($_POST['email']);
$school=trim($_POST['school']);
$vcode=trim($_POST['vcode']);

/**/
if ($school=='school') {
	exit(0);
}
/**/

if($OJ_VCODE&&($vcode!= $_SESSION["vcode"]||$vcode==""||$vcode==null) ){
	$_SESSION["vcode"]=null;
	$err_str=$err_str."验证码错误!\\n";
	$err_cnt++;
}
if($OJ_LOGIN_MOD!="dotcpp"){
	$err_str=$err_str."系统不支持注册.\\n";
	$err_cnt++;
}

if($len>20){
	$err_str=$err_str."用户名太长!\\n";
	$err_cnt++;
}else if ($len<3){
	$err_str=$err_str."用户名太短!\\n";
	$err_cnt++;
}
if (!is_valid_user_name($user_id)){
	$err_str=$err_str."用户名只能包含字母和数字!\\n";
	$err_cnt++;
}
$nick=trim($_POST['nick']);
$len=strlen($nick);
if ($len>20){
	$err_str=$err_str."昵称太长!\\n";
	$err_cnt++;
}else if ($len==0) $nick=$user_id;
if (strcmp($_POST['password'],$_POST['rptpassword'])!=0){
	$err_str=$err_str."两次输入的密码不一致!\\n";
	$err_cnt++;
}
if (strlen($_POST['password'])<6){
	$err_cnt++;
	$err_str=$err_str."密码长度不能小于6位.!\\n";
}
$len=strlen($_POST['school']);
if ($len>60){
	$err_str=$err_str."学校名太长!\\n";
	$err_cnt++;
}
$len=strlen($_POST['email']);
if ($len>30){
	$err_str=$err_str."邮箱名太长!\\n";
	$err_cnt++;
}
if ($err_cnt>0){
	echo "<meta http-equiv='Content-Type' content='text/html'; charset='utf-8'>";
	print "<script charset='utf-8' language='javascript'>\n";
	print "alert('";
	print $err_str;
	print "');\n history.go(-1);\n</script>";
	exit(0);
	
}
$password=pwGen($_POST['password']);
$sql="SELECT `user_id` FROM `users` WHERE `users`.`user_id` = '".$user_id."'";
$result=mysqli_query($mysqli,$sql);
$rows_cnt=mysqli_num_rows($result);
mysqli_free_result($result);
if ($rows_cnt == 1){
	echo "<meta http-equiv='Content-Type' content='text/html'; charset='utf-8'>";
	print "<script charset='utf-8' language='javascript'>\n";
	print "alert('用户名已存在!\\n');\n";
	print "history.go(-1);\n</script>";
	exit(0);
}
$nick=mysqli_real_escape_string($mysqli,htmlentities ($nick,ENT_QUOTES,"UTF-8"));
$school=mysqli_real_escape_string($mysqli,htmlentities ($school,ENT_QUOTES,"UTF-8"));
$email=mysqli_real_escape_string($mysqli,htmlentities ($email,ENT_QUOTES,"UTF-8"));
$ip=$_SERVER['REMOTE_ADDR'];
$sql="INSERT INTO `users`("
."`user_id`,`email`,`ip`,`accesstime`,`password`,`reg_time`,`nick`,`school`)"
."VALUES('".$user_id."','".$email."','".$_SERVER['REMOTE_ADDR']."',NOW(),'".$password."',NOW(),'".$nick."','".$school."')";
mysqli_query($mysqli,$sql);// or die("Insert Error!\n");

if( mysqli_affected_rows($mysqli)==0) {
	echo "<meta http-equiv='Content-Type' content='text/html'; charset='utf-8'>";
    print "<script charset='utf-8' language='javascript'>\n";
	print "alert('用户名非法!\\n');\n";
	print "history.go(-1);\n</script>";
	exit(0);
}


// $sql="INSERT INTO `loginlog` VALUES('$user_id','$password','$ip',NOW())";
// mysqli_query($mysqli,$sql);
echo "<meta http-equiv='Content-Type' content='text/html'; charset='utf-8'>";
echo "<script charset='utf-8' >alert('注册成功!!去登录吧')</script>";
echo "<script>document.location.href='loginpage.php'</script>";
// $view_errors=  "注册成功,去<a href='loginpage.php'>登录</a>.";
// require("template/".$OJ_TEMPLATE."/error.php");
exit(0);
?>


// $_SESSION['user_id']=$user_id;
// $sql="SELECT nick FROM users WHERE user_id='$user_id'";
		
// $result=mysqli_query($mysqli,$sql);
// $tmprow=mysqli_fetch_object($result);
// $_SESSION['nick']=$tmprow->nick;
// mysqli_free_result($result);

// $sql="SELECT `rightstr` FROM `privilege` WHERE `user_id`='".$_SESSION['user_id']."'";
// //echo $sql."<br />";
// $result=mysqli_query($mysqli,$sql);
// echo mysqli_error();
// while ($row=mysqli_fetch_assoc($result)){
// 	$_SESSION[$row['rightstr']]=true;
// 	//echo $_SESSION[$row['rightstr']]."<br />";
// }
// $_SESSION['ac']=Array();
// $_SESSION['sub']=Array();


