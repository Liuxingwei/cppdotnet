<?php
require_once("../include/db_info.inc.php");
require_once('../include/PHPMailer-master/class.phpmailer.php');
require_once("../include/PHPMailer-master/class.smtp.php");

$data=$_POST;
$email=$data[email];
$compname=$data[compname];
//******************** 调用发送邮件类 ******************************** 
$mail  = new PHPMailer(); 

$mail->CharSet    ="UTF-8";                 //设定邮件编码，默认ISO-8859-1，如果发中文此项必须设置为 UTF-8
$mail->IsSMTP();                            // 设定使用SMTP服务
$mail->SMTPAuth   = true;                   // 启用 SMTP 验证功能
$mail->SMTPSecure = "ssl";                  // SMTP 安全协议
$mail->Host       = "smtp.qq.com";       // SMTP 服务器
$mail->Port       = 465;                    // SMTP服务器的端口号
$mail->Username   = "2045302297@qq.com";  // SMTP服务器用户名
$mail->Password   = "";        // SMTP服务器密码
$mail->SetFrom('2045302297@qq.com','C语言网');    // 设置发件人地址和名称
$mail->AddReplyTo("2045302297@qq.com","C语言网"); 
                                            // 设置邮件回复人地址和名称
$mail->Subject    = 'C语言网企业账号审核通过';                     // 设置邮件标题
$mail->AltBody    = "为了查看该邮件，请切换到支持 HTML 的邮件客户端"; 
                                            // 可选项，向下兼容考虑
$mail->MsgHTML("<p>您为【".$compname."】注册的企业账号——【".$email."】已通过审核，可访问C语言网登录（注意通过企业入口登录，非一般用户入口）：</p>
						<h3><a href='http://www.dotcpp.com' target='_blank''>C语言网</a></h3>
						<br />
						<p style='text-align: right;'>——C语言网(www.dotcpp.com)</p>");                         // 设置邮件内容
$mail->AddAddress($email, $compname);
//$mail->AddAttachment("images/phpmailer.gif"); // 附件 
if($mail->Send()) {
    $sql="UPDATE `users_cpn` set `status`=1 WHERE `email`='$email'";
	@mysqli_query($mysqli,$sql) or die(mysqli_error());
}
////////////////////////////////////////////////////////////////////////////////////
?>