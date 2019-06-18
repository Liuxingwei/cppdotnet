<?php 
$cache_time=10;
$OJ_CACHE_SHARE=false;
require_once('./include/cache_start.php');
require_once('./include/db_info.inc.php');
require_once('./include/setlang.php');
$view_title= "Welcome To Online Judge";
require_once("./include/check_post_key.php");
require_once("./include/my_func.inc.php");

$str_userid=$_SESSION['user_id'];

$err_str="";
$err_cnt=0;
$len;
$user_id=$_SESSION['user_id'];
$email=trim($_POST['email']);
$oemail=trim($_POST['oemail']);
$school=trim($_POST['school']);
$nnick=trim($_POST['nnick']);
$onick=trim($_POST['onick']);
$user_sign=trim($_POST['user_sign']);
$user_intro=trim($_POST['user_intro']);
$age=trim($_POST['age']);
if($age>100 || $age<0) $age=18;
$is_work=intval($_POST['is_work']);
if($is_work>2 || $is_work<0)$is_work=0;
$work_field=trim($_POST['work_field']);
$subject=trim($_POST['subject']);
$phone=trim($_POST['phone']);
$address=trim($_POST['address']);
$alipay_account=trim($_POST['alipay_account']);
$alipay_user=trim($_POST['alipay_user']);

$len=strlen($nnick);
// echo "<script>alert('nick:$nick _ $len');</script>";
if ($len>30){
	$err_str=$err_str."昵称太长!";
	$err_cnt++;
}else if ($len==0){
	$err_str=$err_str."昵称不能为空!";
	$err_cnt++;
}
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
// $len=strlen($_POST['npassword']);
// if ($len<6 && $len>0){
// 	$err_cnt++;
// 	$err_str=$err_str."Password should be Longer than 6!\\n";
// }else if (strcmp($_POST['npassword'],$_POST['rptpassword'])!=0){
// 	$err_str=$err_str."Two Passwords Not Same!";
// 	$err_cnt++;
// }
$len=strlen($school);
if ($len>60){
	$err_str=$err_str."学校太长!";
	$err_cnt++;
}
$len=strlen($email);
if ($len>50){
	$err_str=$err_str."邮箱太长!";
	$err_cnt++;
}
$len=strlen($address);
if($len>100){
	$err_str=$err_str."邮寄地址太长!";
	$err_cnt++;
}
$len=strlen($phone);
if($len>11){
	$err_str=$err_str."电话/手机号太长!";
	$err_cnt++;	
}
$len=strlen($subject);
if($len>30){
	$err_str=$err_str."专业太长!";
	$err_cnt++;	
}
$len=strlen($work_field);
if($len>30){
	$err_str=$err_str."行业太长!";
	$err_cnt++;		
}
$len=strlen($user_sign);
if($len>90){
	$err_str=$err_str."签名太长!";
	$err_cnt++;			
}
$len=strlen($user_intro);
if($len>180){
	$err_str=$err_str."自我简介太长!";
	$err_cnt++;			
}
if (mb_strlen($alipay_account) > 40) {
	$err_str .= "支付宝账号太长";
	$err_cnt++;
}
if (mb_strlen($alipay_user) > 40) {
	$err_str .= "支付宝用户名太长";
	$err_cnt++;
}

// echo "<script>console.log('$onick')</script>";
// echo "<script>console.log('$nnick')</script>";
if($onick!=$nnick){
	$now=strftime("%Y-%m-%d %X",time()-(60*60*24*90));
	$sql="SELECT `last_nick_time` from `users` where `user_id`='$user_id' and last_nick_time>'$now' order by `last_nick_time` desc limit 1";
	$result = mysqli_query($mysqli, $sql);
	if(mysqli_num_rows($result)==1){
		$err_str=$err_str."Can not change nick name within 60s.";
		$err_cnt++;
	}
}
if ($err_cnt>0){
	echo "<meta http-equiv='Content-Type' content='text/html'; charset='utf-8'>";
	print "<script charset='utf-8' language='javascript'>\n";
	echo "alert('";
	echo $err_str;
	print "');\n history.go(-1);\n</script>";
	exit(0);
	
}
$nnick=mysqli_real_escape_string($mysqli,htmlentities ($nnick,ENT_QUOTES,"UTF-8"));
$onick=mysqli_real_escape_string($mysqli,htmlentities ($onick,ENT_QUOTES,"UTF-8"));
$school=mysqli_real_escape_string($mysqli,htmlentities ($school,ENT_QUOTES,"UTF-8"));
$user_sign=mysqli_real_escape_string($mysqli,htmlentities ($user_sign,ENT_QUOTES,"UTF-8"));
$user_intro=mysqli_real_escape_string($mysqli,htmlentities ($user_intro,ENT_QUOTES,"UTF-8"));
$is_work=mysqli_real_escape_string($mysqli,htmlentities ($is_work,ENT_QUOTES,"UTF-8"));
$age=mysqli_real_escape_string($mysqli,htmlentities ($age,ENT_QUOTES,"UTF-8")) ?:0;
$work_field=mysqli_real_escape_string($mysqli,htmlentities ($work_field,ENT_QUOTES,"UTF-8"));
$subject=mysqli_real_escape_string($mysqli,htmlentities ($subject,ENT_QUOTES,"UTF-8"));
$email=mysqli_real_escape_string($mysqli,htmlentities ($email,ENT_QUOTES,"UTF-8"));
$oemail=mysqli_real_escape_string($mysqli,htmlentities ($oemail,ENT_QUOTES,"UTF-8"));
$phone=mysqli_real_escape_string($mysqli,htmlentities ($phone,ENT_QUOTES,"UTF-8"));
$address=mysqli_real_escape_string($mysqli,htmlentities ($address,ENT_QUOTES,"UTF-8"));
$alipay_account=mysqli_real_escape_string($mysqli,htmlentities ($alipay_account,ENT_QUOTES,"UTF-8"));
$alipay_user=mysqli_real_escape_string($mysqli,htmlentities ($alipay_user,ENT_QUOTES,"UTF-8"));
$sql="UPDATE `users` SET"
	."`user_intro`='".($user_intro)."',"
	."`user_sign`='".($user_sign)."',"
	."`age`=".($age).","
	."`is_work`=".($is_work).","
	."`address`='".($address)."',"
	."`phone`='".($phone)."',"
	."`email`='".($email)."',"
	."`alipay_account`='" . $alipay_account . "',"
	."`alipay_user`='" . $alipay_user . "' ";

if($onick!=$nnick){
	$sql.=" , `nick`='$nnick', `last_nick_time`=NOW()";
}
if($is_work==0){
	$sql.=",`school`='$school', `subject`='$subject' ";
}else if($is_work==1){
	$sql.=",`work_field`='$work_field' ";
}
$sql.="WHERE `user_id`='".mysqli_real_escape_string($mysqli,$user_id)."'";
// echo " <script>console.log('$sql')</script>";
// echo $sql;
//exit(0);
mysqli_query($mysqli,$sql) or die("Insert Error!\n");
if($oemail!=$email){
	$sql="UPDATE `users` SET `mail_verify`='N' WHERE `user_id`='$user_id'";
	mysqli_query($mysqli, $sql);
}
if($onick!=$nnick){
	$_SESSION['nick']=$nnick;
}

// unlink( '/var/www/staticfiles/yonghuxinxi_'.$str_userid. '.html'); //删除文件

header("Location: ../");
?>
