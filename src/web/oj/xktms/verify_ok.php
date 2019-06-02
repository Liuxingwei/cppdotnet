<?php 
require_once("admin-header.php");

$email=$_GET['id'];

$sql="SELECT `compname` FROM `users_cpn` WHERE `email`='$email'";
$result=mysqli_query($mysqli,$sql) or die(mysqli_error());
$row=mysqli_fetch_object($result);
$compname=$row->compname;
mysqli_free_result($result);

$data['email'] = $email;
$data['compname'] = $compname;

//fsockopen处理请求
$post = http_build_query($data);
$len = strlen($post);
//发送
$host = "localhost";
$path = "/oj/xktms/dosend_verifyok.php";

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

echo "操作成功！已发送过审邮件提示，若发送成功，该用户状态将激活。";
require("../oj-footer.php");
?>