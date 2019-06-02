<?php 
require_once("./include/db_info.inc.php");
require_once("./include/my_func.inc.php");
require_once("./lang/cn.php");

$view_title = "C语言网-完善审核信息";
$vrfcode = stripslashes(trim($_GET['vrfcode'])); 
$nowtime = time(); 
$sql="SELECT compname,loginemail,token,token_exptime FROM cpn_pending where `token`='$vrfcode'";
$result=mysqli_query($mysqli,$sql) or die(mysqli_error());
$row = mysqli_fetch_array($result);

if($nowtime>$row['token_exptime']){ //24hour 
		echo "<meta http-equiv='Content-Type' content='text/html'; charset='utf-8'>";
        echo "<script charset='utf-8' >alert('您的激活有效期已过，请重新申请再次激活！')</script>";
		echo "<script>document.location.href='registerpage_cpn.php'</script>";
        exit(0);
    }
$compname = $row['compname'];
$loginemail = $row['loginemail'];

//检查是否存在邮箱账号
$email=$row['loginemail'];
$sql_cnt="SELECT email FROM users_cpn where `email`='$email'";
$result_cnt=mysqli_query($mysqli,$sql_cnt);
$rows_cnt=mysqli_num_rows($result_cnt);
if ($rows_cnt>0) {
    echo "已完成信息完善，请勿重复操作。";
    echo "<script charset='utf-8' language='javascript'>\n";
    echo "history.go(-1);\n";
    echo "</script>";
    exit(1);
}

require("template/".$OJ_TEMPLATE."/verify_sub.php");
/*if($row){ 
    if($nowtime>$row['token_exptime']){ //24hour 
        $msg = '您的激活有效期已过，请重新申请再次激活。'; 
        exit(0);
    }else{ 
        $sql="INSERT INTO `users_cpn`(`compname`,`email`,`ip`,`password`,`reg_time`,`token`,`status`) VALUES('".$compname."','".$loginemail."','".$_SERVER['REMOTE_ADDR']."','".$pwd."','".$nowtime."','".$token."',0)";
        $result=mysqli_query($mysqli,$sql) or die(mysqli_error());
        $msg = '激活成功！'; 
    } 
}else{ 
    $msg = '服务器忙稍后再试。';     
}

$view_errors = $msg;
require("template/".$OJ_TEMPLATE."/error.php");*/


?>