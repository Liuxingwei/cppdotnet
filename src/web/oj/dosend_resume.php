<?php
require_once("./include/db_info.inc.php");
require_once('./include/PHPMailer-master/class.phpmailer.php');
require_once("./include/PHPMailer-master/class.smtp.php");

$data=$_POST;
$user_id=$data[user_id];
$id=$data[id];

$sql="SELECT `cpnuser`,`email`,`compname`,`position` FROM `job_list` WHERE `id`=".$id;
$result=mysqli_query($mysqli,$sql) or die(mysqli_error());

$row=mysqli_fetch_object($result);

if ($row->email!="") {
	$cpnemail=$row->email;
}
else {
	$cpnemail=$row->cpnuser;
}
	
	$compname=$row->compname;
	$position=$row->position;

mysqli_free_result($result);



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
$mail->Subject    = 'C语言网简历管理';                     // 设置邮件标题
$mail->AltBody    = "为了查看该邮件，请切换到支持 HTML 的邮件客户端"; 
                                            // 可选项，向下兼容考虑
$mail->MsgHTML("<h3>您好！".$compname."。</h3>
						<p>C语言网的用户".$user_id."对您发布的招聘职位——<a href='http://www.dotcpp.com/job/".$id.".html'>".$position."</a>有意向，以下是TA的简历：</p>
						<p><a href='http://www.dotcpp.com/oj/resume.php?user_id=".$user_id."'>".$user_id."的简历</a></p>
						<br />
						<p style='text-align: right;'>——C语言网(www.dotcpp.com)</p>");                         // 设置邮件内容
$mail->AddAddress($cpnemail, $compname);
//$mail->AddAttachment("images/phpmailer.gif"); // 附件 
if($mail->Send()) {
    $sql="INSERT INTO `resume_send`(`user_id`,`job_id`,`send_time`,`status`)"
		."VALUES('".$user_id."','".$id."',NOW(),1)";
		mysqli_query($mysqli,$sql); //or die("Insert Error!\n");
}
/*if(!$mail->Send()) {
    echo "发送失败：" . $mail->ErrorInfo;
} else {
    echo "恭喜，邮件发送成功！";
}*/


/*		$smtpserver = "smtp.exmail.qq.com";//SMTP服务器 
		$smtpserverport =25;//SMTP服务器端口 
		$smtpusermail = "dotcpp@dotcpp.com";//SMTP服务器的用户邮箱 
		$smtpemailto = $cpnemail;//发送给谁 
		$smtpuser = "dotcpp@dotcpp.com";//SMTP服务器的用户帐号 
		$smtppass = "123456Aa";//SMTP服务器的用户密码 
		$mailtitle = "C语言网简历管理";//邮件主题 
		$mailcontent = "<h3>您好！".$compname."。</h3>
						<p>C语言网的用户".$user_id."对您发布的招聘职位——<a href='http://www.dotcpp.com/job/".$id.".html'>".$position."</a>有意向，以下是TA的简历：</p>
						<p><a href='http://www.dotcpp.com/oj/resume.php?user_id=".$user_id."'>".$user_id."的简历</a></p>
						<br />
						<p style='text-align: right;'>——C语言网(www.dotcpp.com)</p>";//邮件内容 
		$mailtype = "HTML";//邮件格式（HTML/TXT）,TXT为文本邮件 
		//************************ 配置信息 **************************** 
		$smtp = new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);//这里面的一个true是表示使用身份验证,否则不使用身份验证. 
		$smtp->debug = false;//是否显示发送的调试信息 
		$state = $smtp->sendmail($smtpemailto, $smtpusermail, $mailtitle, $mailcontent, $mailtype);

		/*echo "<meta http-equiv='Content-Type' content='text/html'; charset='utf-8'>";
		if($state==""){ 
			echo "<script charset='utf-8' >alert('邮件发送失败!重新尝试一下？')</script>";
			echo "<script charset='utf-8' language='javascript'>\n";
			echo "history.go(-1);\n";
			echo "</script>";
		}
		else{
			echo "<script charset='utf-8' >alert('简历成功发送至该企业的邮箱！')</script>";
			echo "<script charset='utf-8' language='javascript'>\n";
			echo "history.go(-1);\n";
			echo "</script>";
		}*/
		/*if ($state!="") {
			# code...
		}*/

exit(0);
?>