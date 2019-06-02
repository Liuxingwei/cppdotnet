<?php
require_once("./include/db_info.inc.php");
require_once("./include/my_func.inc.php");
require_once("./lang/cn.php");

$err_str="";
$err_cnt=0;
$len;
$compname=trim($_POST['compname']);
$cpnuser=trim($_POST['cpnuser']);
$phone=trim($_POST['phone']);
$address=trim($_POST['address']);
$website=trim($_POST['website']);
$industry=trim($_POST['industry']);

$stage=trim($_POST['stage']);
$size=trim($_POST['size']);
switch ($stage) {
		case 1:
			$stage="初创新星";
			break;
		case 2:
			$stage="正在成长";
			break;
		case 3:
			$stage="成熟发展";
			break;
		case 4:
			$stage="现已上市";
			break;
		default:
			$stage="";
			break;
	}
switch ($size) {
		case 1:
			$size="15人以下";
			break;
		case 2:
			$size="15人-50人";
			break;
		case 3:
			$size="50人-150人";
			break;
		case 4:
			$size="150人-500人";
			break;
		case 5:
			$size="500人-1500人";
			break;
		case 6:
			$size="1500人以上";
			break;
		default:
			$size="";
			break;
	}
$vcode=trim($_POST['vcode']);

if($OJ_VCODE&&($vcode!= $_SESSION["vcode"]||$vcode==""||$vcode==null) ){
	$_SESSION["vcode"]=null;
	$err_str=$err_str."验证码错误!\\n";
	$err_cnt++;
}
if($OJ_LOGIN_MOD!="dotcpp"){
	$err_str=$err_str."系统不支持注册.\\n";
	$err_cnt++;
}


$sql="SELECT `cpnuser` FROM `users_cpn` WHERE `cpnuser` = '".$cpnuser."'";
$result=mysqli_query($mysqli,$sql);
$rows_cnt=mysqli_num_rows($result);
mysqli_free_result($result);
if ($rows_cnt == 1){
	echo "<meta http-equiv='Content-Type' content='text/html'; charset='utf-8'>";
	print "<script charset='utf-8' language='javascript'>\n";
	print "alert('用户名已存在!\\n');\n";
	print "history.go(-1);\n</script>";
	exit(0);
}
if ($err_cnt>0){
	echo "<meta http-equiv='Content-Type' content='text/html'; charset='utf-8'>";
	print "<script charset='utf-8' language='javascript'>\n";
	print "alert('";
	print $err_str;
	print "');\n history.go(-1);\n</script>";
	exit(0);
	
}

$compname=mysqli_real_escape_string($mysqli,htmlentities ($compname,ENT_QUOTES,"UTF-8"));
$phone=mysqli_real_escape_string($mysqli,htmlentities ($phone,ENT_QUOTES,"UTF-8"));
$address=mysqli_real_escape_string($mysqli,htmlentities ($address,ENT_QUOTES,"UTF-8"));
$industry=mysqli_real_escape_string($mysqli,htmlentities ($industry,ENT_QUOTES,"UTF-8"));

$password=pwGen($_POST['password']);
$ip=$_SERVER['REMOTE_ADDR'];
$sql="INSERT INTO `users_cpn`(`compname`,`cpnuser`,`password`,`phone`,`address`,`website`,`industry`,`stage`,`size`,`ip`,`reg_time`,`status`)"
."VALUES('".$compname."','".$cpnuser."','".$password."','".$phone."','".$address."','".$website."','".$industry."','".$stage."','".$size."','".$_SERVER['REMOTE_ADDR']."',NOW(),1)";/*需要审核时，`status`为0*/
mysqli_query($mysqli,$sql); //or die("Insert Error!\n");

if( mysqli_affected_rows($mysqli)==0) {
	echo "<meta http-equiv='Content-Type' content='text/html'; charset='utf-8'>";
    print "<script charset='utf-8' language='javascript'>\n";
	print "alert('用户名非法!\\n');\n";
	print "history.go(-1);\n</script>";
	exit(0);
}


// $sql="INSERT INTO `loginlog` VALUES('$user_id','$password','$ip',NOW())";
// mysqli_query($mysqli,$sql);
echo "<meta http-equiv='Content-Type' content='text/html'; charset='utf-8'>";
echo "<script charset='utf-8' >alert('注册成功!')</script>";/*请等待审核。*/
echo "<script charset='utf-8' language='javascript'>\n";
echo "window.location.href='/';\n";
echo "</script>";
// $view_errors=  "注册成功,去<a href='loginpage.php'>登录</a>.";
// require("template/".$OJ_TEMPLATE."/error.php");
exit(0);


/*
if ($err_cnt>0){
	echo "<meta http-equiv='Content-Type' content='text/html'; charset='utf-8'>";
	print "<script charset='utf-8' language='javascript'>\n";
	print "alert('";
	print $err_str;
	print "');\n history.go(-1);\n</script>";
	exit(0);
	
}

$regtime=time();

$compname=mysqli_real_escape_string($mysqli,htmlentities ($compname,ENT_QUOTES,"UTF-8"));
$loginemail=mysqli_real_escape_string($mysqli,htmlentities ($loginemail,ENT_QUOTES,"UTF-8"));

$token = md5($loginemail.$regtime); //创建用于激活识别码 
$token_exptime = time()+60*60*24;//过期时间为24小时后 

$sql="INSERT INTO `cpn_pending`("
."`compname`,`loginemail`,`ip`,`reg_time`,`token`,`token_exptime`)"
."VALUES('".$compname."','".$loginemail."','".$_SERVER['REMOTE_ADDR']."','".$regtime."','".$token."','".$token_exptime."')";
mysqli_query($mysqli,$sql);// or die("Insert Error!\n");.



$data['loginemail']=$loginemail;
$data['compname']=$compname;
$data['token']=$token;
//fsockopen处理请求
$post = http_build_query($data);
$len = strlen($post);
//发送
$host = "localhost";
$path = "/oj/dosend_cpnreg.php";

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
echo "<script charset='utf-8' >alert('验证邮件已发送至您的邮箱，请登录确认！')</script>";
echo "<script charset='utf-8' language='javascript'>\n";
echo "window.location.href='loginpage_cpn.php';\n";
echo "</script>";

// $sql="INSERT INTO `loginlog` VALUES('$user_id','$password','$ip',NOW())";
// mysqli_query($mysqli,$sql);

// $view_errors=  "注册成功,去<a href='loginpage.php'>登录</a>.";
// require("template/".$OJ_TEMPLATE."/error.php");
exit(0);*/

?>