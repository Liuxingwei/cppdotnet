<?php
////////////////////////////Common head
	$cache_time=10;
	$OJ_CACHE_SHARE=false;
	require_once('./include/cache_start.php');
    require_once('./include/db_info.inc.php');
	require_once('./include/setlang.php');
	$view_title= "邮箱验证 - C语言网";
	
///////////////////////////MAIN	
if(!isset($_SESSION['administrator'])){
	
	echo "<script>document.location.href='../'</script>";
	exit(0);
}
$user_id=$_SESSION['user_id'];
if(isset($_POST['mail'])){
	$mail=$_SESSION['mail'];
	$verify_mail_key=$_POST['ckcode'];
	if($verify_mail_key==$_SESSION['verify_mail_key']){
		$sql="UPDATE `users` SET `email`='$mail',`mail_verify`='Y' WHERE `user_id`='$user_id'";
		mysqli_query($mysqli, $sql) or die('error');
		echo "<meta http-equiv='Content-Type' content='text/html'; charset='utf-8'>";
		print "<script charset='utf-8' language='javascript'>\n";
		print 'alert("验证成功!")</script>';
		echo '<script>window.location.href="modifypage.php"</script>';
		exit(0);
	}else{
		echo "<meta http-equiv='Content-Type' content='text/html'; charset='utf-8'>";
		print "<script charset='utf-8' language='javascript'>\n";
		print 'alert("校验码错误!!!")</script>';
		echo '<script>history.go(-1)</script>';
		exit(0);
	}
}
if(isset($_GET['mail'])){
	$mail=$_GET['mail'];
}
$view_apc_info="";
$sql="SELECT `email` FROM `users` WHERE `user_id`='$user_id'";
$result=mysqli_query($mysqli, $sql);
$row=mysqli_fetch_object($result);
$user_mail=$row->email;

if(function_exists('apc_cache_info')){
	 $_apc_cache_info = apc_cache_info(); 
		$view_apc_info =_apc_cache_info;
}

/////////////////////////Template
require("template/".$OJ_TEMPLATE."/verifymail.php");
/////////////////////////Common foot
if(file_exists('./include/cache_end.php'))
	require_once('./include/cache_end.php');
?>
