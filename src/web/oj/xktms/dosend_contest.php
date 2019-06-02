<?php

require_once("../include/db_info.inc.php");
require_once('../include/PHPMailer-master/class.phpmailer.php');
require_once("../include/PHPMailer-master/class.smtp.php");

$now = date("Y-m-d",time());

$data=$_POST;

$contest_id=$data[contest_id];

$sql="SELECT `title`,`start_time` FROM `contest` WHERE `contest_id`='".$contest_id."'";
$result=mysqli_query($mysqli, $sql);
$contest_message=mysqli_fetch_object($result);
mysqli_free_result($result);

$sql="SELECT `email` FROM `users` WHERE find_in_set('".$contest_id."',order_contest)";
$result=mysqli_query($mysqli, $sql);
$i=0;
$k=0;

while ($toemail=mysqli_fetch_row($result)) {

	$j=$i+1;

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
	$mail->Subject    = 'C语言网比赛提醒';                     // 设置邮件标题
	$mail->AltBody    = "为了查看该邮件，请切换到支持 HTML 的邮件客户端"; 
	                                            // 可选项，向下兼容考虑
	$mail->MsgHTML("<h3>您预约的比赛——".$contest_message->title."，将在明天".$contest_message->start_time."开始，记得准时参加哦！</h3>
					<p>比赛地址：</p>
					<p><a href='http://www.dotcpp.com/oj/contest.html'>http://www.dotcpp.com/oj/contest.html</a></p>
					<br />
					<p style='text-align: right;'>——C语言研究中心(www.dotcpp.com)</p>");                         // 设置邮件内容
	$mail->AddAddress($toemail[0]);
	//$mail->AddAttachment("images/phpmailer.gif"); // 附件 
	if(!$mail->Send()) {
		$k++;
	}

 	/*//******************** 配置信息 ******************************** 
	$smtpserver = "smtp.qq.com";//SMTP服务器 
	$smtpserverport =25;//SMTP服务器端口 
	$smtpusermail = "2045302297@qq.com";//SMTP服务器的用户邮箱 
	$smtpemailto = $toemail[0];//发送给谁 
	$smtpuser = "2045302297@qq.com";//SMTP服务器的用户帐号 
	$smtppass = "";//SMTP服务器的用户密码 
	$mailtitle = "C语言网比赛提醒";//邮件主题 
	$mailcontent = "<h3>您预约的比赛——".$contest_message->title."，将在明天".$contest_message->start_time."开始，记得准时参加哦！</h3>
					<p>比赛地址：</p>
					<p><a href='http://www.dotcpp.com/oj/contest.html'>http://www.dotcpp.com/oj/contest.html</a></p>
					<br />
					<p style='text-align: right;'>——C语言研究中心(www.dotcpp.com)</p>";//邮件内容 
	$mailtype = "HTML";//邮件格式（HTML/TXT）,TXT为文本邮件 
	//************************ 配置信息 **************************** 
	$smtp = new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);//这里面的一个true是表示使用身份验证,否则不使用身份验证. 
	$smtp->debug = false;//是否显示发送的调试信息 
	$state = $smtp->sendmail($smtpemailto, $smtpusermail, $mailtitle, $mailcontent, $mailtype);
	/*echo "<div style='width:900px; margin:10px auto;'>"; 
	echo "发送第".$j."封邮件……";
	if($state==""){ 
		$k++;
		fopen('/var/www/'$now.'比赛邮件发送信息.txt',"a+"); 
	}
	else{
		fopen('/var/www/'$now.'恭喜！邮件发送成功！！NO.'.$data[contest_id],"a+");
	}
	echo "</div>";*/
	$i++;
 }
 $seccess_cnt=$i-$k;
 $str = "共".$i."个邮件，成功发送".$seccess_cnt."个邮件,".$k."个邮件发送失败。\n";
 $sendlog = fopen('/var/www/sendlog/'.$now.'sendlog.txt',"a+");
 fwrite($sendlog, $str);
 fclose($sendlog);

mysqli_free_result($result);

?>