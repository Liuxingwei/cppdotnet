<?php
////////////////////////////Common head
$cache_time=10;
$OJ_CACHE_SHARE=false;
require_once('./include/cache_start.php');
require_once('./include/db_info.inc.php'); 
require_once('./include/setlang.php');
require_once('./include/my_func.inc.php');
$now =time()-5;
if($now<$_SESSION['last_send_mail']){
	echo "time limit";
	exit(0);
}
if($_POST['type']=='mail_verify'){
echo 'true';
exit(0);
$email=$_POST['mail'];
$_SESSION['verify_mail_key']=getToken(16);
$_SESSION['mail']=mysqli_real_escape_string($mysqli, htmlspecialchars($email, ENT_QUOTES));
require_once "include/email.class.php";
//******************** 配置信息 ********************************
$smtpserver = "smtp.exmail.qq.com";//SMTP服务器
$smtpserverport =25;//SMTP服务器端口
$smtpusermail = "dotcpp@dotcpp.com";//SMTP服务器的用户邮箱
$smtpemailto = $email;//发送给谁
$smtpuser = "dotcpp@dotcpp.com";//SMTP服务器的用户帐号
$smtppass = "123456Aa";//SMTP服务器的用户密码
$mailtitle = "C语言网 - 邮箱验证";//邮件主题
$mailcontent = "$lost_user_id:\n您好！\n您在C语言网选择了邮箱验证服务,为了验证您的身份,请将下面字串输入邮箱验证页面以确认身份:".$_SESSION['verify_mail_key']."\n\n\nC语言网";//邮件内容
$mailtype = "TXT";//邮件格式（HTML/TXT）,TXT为文本邮件
//************************ 配置信息 ****************************
$smtp = new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);//这里面的一个true是表示使用身份验证,否则不使用身份验证.
$smtp->debug =false;//是否显示发送的调试信息
$state = $smtp->sendmail($smtpemailto, $smtpusermail, $mailtitle, $mailcontent, $mailtype);
echo 'true';

}
$_SESSION['last_send_mail']=time();

if(file_exists('./include/cache_end.php'))
        require_once('./include/cache_end.php');
?>
