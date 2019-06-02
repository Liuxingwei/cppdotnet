<?php
require_once('./include/db_info.inc.php');
require_once('./include/setlang.php');
$view_title= "密码找回 - C语言网";

require_once("./include/const.inc.php");
require_once("./include/my_func.inc.php");

if (isset($_SESSION['user_id'])){
    echo '<script>window.location.href="../"</script>';
    exit(1);
}

if(!isset($_POST['user_id'])){
  require("template/".$OJ_TEMPLATE."/lostpassword.php");
  $_SESSION['prev_page']="/";
  exit(0);
}
$lost_user_id=$_POST['user_id'];
$lost_email=$_POST['email'];
  $vcode=trim($_POST['vcode']);
  if($lost_user_id&&($vcode!= $_SESSION["vcode"]||$vcode==""||$vcode==null) ){
      echo "<meta http-equiv='Content-Type' content='text/html'; charset='utf-8'>";
      print "<script charset='utf-8' language='javascript'>\n";
      echo "alert('验证码错误!!!');\n";
      echo "history.go(-1);\n";
      echo "</script>";
      exit(0);
  }
if(get_magic_quotes_gpc()){
      $lost_user_id=stripslashes($lost_user_id);
      $lost_email=stripslashes($lost_email);
}
$sql="SELECT `email` FROM `users` WHERE `user_id`='".mysqli_real_escape_string($mysqli,$lost_user_id)."'";
              $result=mysqli_query($mysqli,$sql);
              $row = mysqli_fetch_array($result);
if($row && $row['email']==$lost_email&&strpos($lost_email,'@')){
   $_SESSION['lost_user_id']=$lost_user_id;
   $_SESSION['lost_key']=getToken(16);

  
	require_once "include/email.class.php";
	//******************** 配置信息 ********************************
	$smtpserver = "smtp.exmail.qq.com";//SMTP服务器
	$smtpserverport =25;//SMTP服务器端口
	$smtpusermail = "dotcpp@dotcpp.com";//SMTP服务器的用户邮箱
	$smtpemailto = $row['email'];//发送给谁
	$smtpuser = "dotcpp@dotcpp.com";//SMTP服务器的用户帐号
	$smtppass = "123456Aa";//SMTP服务器的用户密码
	$mailtitle = "C语言网 - 密码找回";//邮件主题
	$mailcontent = "$lost_user_id:\n您好！\n您在C语言网选择了找回密码服务,为了验证您的身份,请将下面字串输入口令重置页面以确认身份:".$_SESSION['lost_key']."\n\n\nC语言网";//邮件内容
	$mailtype = "TXT";//邮件格式（HTML/TXT）,TXT为文本邮件
	//************************ 配置信息 ****************************
	$smtp = new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);//这里面的一个true是表示使用身份验证,否则不使用身份验证.
	$smtp->debug =false;//是否显示发送的调试信息
	$state = $smtp->sendmail($smtpemailto, $smtpusermail, $mailtitle, $mailcontent, $mailtype);
        require("template/".$OJ_TEMPLATE."/lostpassword2.php");

 }else{

/////////////////////////Template
   require("template/".$OJ_TEMPLATE."/lostpassword2.php");

}
/////////////////////////Common foot
?>
