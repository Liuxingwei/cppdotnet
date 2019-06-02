<?php 
require("admin-header.php");

if (isset($_GET['contest_id'])){
	$contest_id = htmlentities($_GET['contest_id']);

	$data['contest_id'] = $contest_id;
	//fsockopen处理请求
	$post = http_build_query($data);
	$len = strlen($post);
	//发送
	$host = "localhost";
	$path = "/oj/xktms/dosend_contest.php";

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

	echo "操作成功，详情请查看日志。";

	require("../oj-footer.php");

}
?>