<?php
require_once("./include/db_info.inc.php");
require_once('./include/PHPMailer-master/class.phpmailer.php');
require_once("./include/PHPMailer-master/class.smtp.php");

$data=$_POST;
$loginemail=$data[loginemail];
$compname=$data[compname];
$token=$data[token];


//******************** 调用发送邮件类 ********************************  
$mail  = new PHPMailer(); 

$mail->CharSet    ="UTF-8";                 //设定邮件编码，默认ISO-8859-1，如果发中文此项必须设置为 UTF-8
$mail->IsSMTP();                            // 设定使用SMTP服务
$mail->SMTPAuth   = true;                   // 启用 SMTP 验证功能
$mail->SMTPSecure = "ssl";                  // SMTP 安全协议
$mail->Host       = "smtp.qq.com";       // SMTP 服务器 TX企业(smtp.exmail.qq.com)
$mail->Port       = 465;                    // SMTP服务器的端口号
$mail->Username   = "2045302297@qq.com";  // SMTP服务器用户名
$mail->Password   = "";        // SMTP服务器密码
$mail->SetFrom('2045302297@qq.com', 'C语言网');    // 设置发件人地址和名称
$mail->AddReplyTo("2045302297@qq.com","C语言网"); 
                                            // 设置邮件回复人地址和名称
$mail->Subject    = 'C语言网企业账号注册';                     // 设置邮件标题
$mail->AltBody    = "为了查看该邮件，请切换到支持 HTML 的邮件客户端"; 
                                            // 可选项，向下兼容考虑
$mail->MsgHTML("<h3>您注册的企业账号——".$compname."状态未激活，请点击以下地址进行激活账号：</h3>
						<p>激活地址：</p>
						<p><a href='http://www.dotcpp.com/oj/verify_useractive.php?vrfcode=".$token."' target='_blank''>http://www.dotcpp.com/oj/verify_useractive.php?vrfcode=".$token."</a></p>
						<br />
						<p style='text-align: right;'>——C语言网(www.dotcpp.com)</p>");                         // 设置邮件内容
$mail->AddAddress($loginemail, $compname);
//$mail->AddAttachment("images/phpmailer.gif"); // 附件 
if(!$mail->Send()) {
    echo "发送失败：" . $mail->ErrorInfo;
} else {
    echo "恭喜，邮件发送成功！";
}

exit(0);
?>