<?php 
    require_once("./include/db_info.inc.php");
    $prev_page="";
    $prev_page=$_SESSION['prev_page'];
    $vcode="";
    if(isset($_POST['vcode']))	$vcode=trim($_POST['vcode']);
    if($OJ_VCODE&&($vcode!= $_SESSION["vcode"]||$vcode==""||$vcode==null) ){
    	echo "<meta http-equiv='Content-Type' content='text/html'; charset='utf-8'>";
		echo "<script  charset='utf-8' language='javascript'>\n";
		echo "alert('验证码错误!!!');\n";
		echo "history.go(-1);\n";
		echo "</script>";
		exit(0);
    }
	require_once("./include/login-cpn.php");
    $user_id=$_POST['cpnuser'];
	$password=$_POST['password'];
   if (get_magic_quotes_gpc ()) {
        $user_id= stripslashes ( $user_id);
        $password= stripslashes ( $password);
   }

    $login=check_login($user_id,$password);
    if(isset($_SESSION['nocheck'])){
    	echo "<meta http-equiv='Content-Type' content='text/html'; charset='utf-8'>";
		echo "<script charset='utf-8' language='javascript'>\n";
		echo "alert('该帐号尚未通过审核!');\n";
		echo "window.location.href='loginpage_cpn.php';\n";
		echo "</script>";
		exit(0);
    }

	if ($login)
    {
		$_SESSION['user_cpn']=$login;
		
		$sql="SELECT nick FROM users WHERE user_id='$user_id'";
		// echo $sql;
		/*$result=mysqli_query($mysqli,$sql);
		$tmprow=mysqli_fetch_object($result);
		$_SESSION['nick']=$tmprow->nick;*/

		// echo " <script>console.log($tmprow->nick)</script>";
		// echo "<script>console.log('".$_SESSION['prev_page']."')</script>";
		if(!empty($prev_page)){
			echo "<script>location.href='$prev_page';</script>";
		}else{
			echo "<script language='javascript'>\n";
			echo "history.go(-2);\n";
			echo "</script>";
		}
	}else{
		echo "<meta http-equiv='Content-Type' content='text/html'; charset='utf-8'>";
		echo "<script charset='utf-8' language='javascript'>\n";
		echo "alert('用户名或者密码错误!');\n";
		echo "history.go(-1);\n";
		echo "</script>";
	}
?>
