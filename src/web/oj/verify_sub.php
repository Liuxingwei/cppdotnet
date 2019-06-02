<?php 
require_once("./include/db_info.inc.php");
require_once("./include/my_func.inc.php");
require_once("./lang/cn.php");
$err_str="";
$err_cnt=0;
$len;
$compname=trim($_POST['compname']);
$email=trim($_POST['email']);
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


if ($err_cnt>0){
	echo "<meta http-equiv='Content-Type' content='text/html'; charset='utf-8'>";
	print "<script charset='utf-8' language='javascript'>\n";
	print "alert('";
	print $err_str;
	print "');\n history.go(-1);\n</script>";
	exit(0);
	
}

$sql="SELECT `email` FROM `users_cpn` WHERE `email` = '".$email."'";
$result=mysqli_query($mysqli,$sql);
$rows_cnt=mysqli_num_rows($result);
mysqli_free_result($result);
if ($rows_cnt == 1){
	echo "<meta http-equiv='Content-Type' content='text/html'; charset='utf-8'>";
	print "<script charset='utf-8' language='javascript'>\n";
	print "alert('邮箱已存在!\\n');\n";
	print "history.go(-1);\n</script>";
	exit(0);
}
$compname=mysqli_real_escape_string($mysqli,htmlentities ($compname,ENT_QUOTES,"UTF-8"));
$phone=mysqli_real_escape_string($mysqli,htmlentities ($phone,ENT_QUOTES,"UTF-8"));
$address=mysqli_real_escape_string($mysqli,htmlentities ($address,ENT_QUOTES,"UTF-8"));
$industry=mysqli_real_escape_string($mysqli,htmlentities ($industry,ENT_QUOTES,"UTF-8"));

$password=pwGen($_POST['password']);
$ip=$_SERVER['REMOTE_ADDR'];
$sql="INSERT INTO `users_cpn`(`compname`,`email`,`password`,`phone`,`address`,`website`,`industry`,`stage`,`size`,`ip`,`reg_time`,`status`)"
."VALUES('".$compname."','".$email."','".$password."','".$phone."','".$address."','".$website."','".$industry."','".$stage."','".$size."','".$_SERVER['REMOTE_ADDR']."',NOW(),1)";/*需要审核时，`status`为0*/
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
?>