<?php
require_once("./include/db_info.inc.php");
require_once("./include/my_func.inc.php");
require_once("./lang/cn.php");

if(!isset($_SESSION['user_id'])){ 
	echo "<meta http-equiv='Content-Type' content='text/html'; charset='utf-8'>";
	echo "<script charset='utf-8' >alert('请登录后进行此操作！')</script>";
	echo "<script charset='utf-8' language='javascript'>\n";
	echo "history.go(-1);\n";
	echo "</script>";
	exit(0);
}
$user_id = $_SESSION['user_id'];
$id = $_GET['id'];

$sql="SELECT `send_time` FROM `resume_send` WHERE `job_id`=$id AND `user_id`='$user_id' ORDER BY `send_time` DESC LIMIT 1";
$result=mysqli_query($mysqli,$sql);
$row=mysqli_fetch_object($result);
$last_send_time=$row->send_time;
if ($last_send_time) {
	$last_send_time=strtotime($last_send_time);
	$rtime=$last_send_time+60*60*24*7;
	$now=time();
	if ($now<$rtime) {
		echo "<meta http-equiv='Content-Type' content='text/html'; charset='utf-8'>";
		echo "<script charset='utf-8' >alert('7天内不可对同一职位重复投递！')</script>";
		echo "<script charset='utf-8' language='javascript'>\n";
		echo "history.go(-1);\n";
		echo "</script>";
		exit(0);
	}
}


$data['user_id'] = $user_id;
$data['id'] = $id;

//fsockopen处理请求
$post = http_build_query($data);
$len = strlen($post);
//发送
$host = "localhost";
$path = "/oj/dosend_resume.php";

$fp = fsockopen( $host , 80, $errno, $errstr, 30);
if (!$fp) {
    echo "$errstr ($errno)\n";
} else {
	
    $out = "POST $path HTTP/1.1\r\n";
    $out .= "Host: $host\r\n";
	$out .= "Content-type: application/x-www-form-urlencoded\r\n";
    $out .= "Connection: Close\r\n";
	$out .= "Content-Length: $len\r\n";
	$out .= "\r\n";
	$out .= $post."\r\n";
	// echo($out);
    fwrite($fp, $out);
	
	//实现异步把下面去掉
	// $receive = '';
    // while (!feof($fp)) {
        // $receive .= fgets($fp, 128);
    // }
	// echo "<br />".$receive;
	//实现异步把上面去掉
	
    fclose($fp);
}

echo "<meta http-equiv='Content-Type' content='text/html'; charset='utf-8'>";
echo "<script charset='utf-8' >alert('简历邮件已发送！')</script>";
echo "<script charset='utf-8' language='javascript'>\n";
echo "history.go(-2);\n";
echo "</script>";

?>