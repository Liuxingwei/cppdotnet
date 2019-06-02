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
	require_once("./include/login-".$OJ_LOGIN_MOD.".php");
    $user_id=$_POST['user_id'];
	$password=$_POST['password'];
   if (get_magic_quotes_gpc ()) {
        $user_id= stripslashes ( $user_id);
        $password= stripslashes ( $password);
   }
    $sql="SELECT `rightstr` FROM `privilege` WHERE `user_id`='".mysqli_real_escape_string($mysqli,$user_id)."'";
    $login=check_login($user_id,$password);
    if(isset($_SESSION['defunct'])){
    	echo "<meta http-equiv='Content-Type' content='text/html'; charset='utf-8'>";
		echo "<script charset='utf-8' language='javascript'>\n";
		echo "alert('该帐号已经被封禁, 如果误封请看页面最底下的\'联系我们\'与管理取得联系.!');\n";
		echo "window.location.href='loginpage.php';\n";
		echo "</script>";
		exit(0);
    }
	if ($login)
    {
		$_SESSION['user_id']=$login;
		$result=mysqli_query($mysqli,$sql);

		while ($result&&$row=mysqli_fetch_assoc($result))
			$_SESSION[$row['rightstr']]=true;
		$sql="SELECT nick FROM users WHERE user_id='$user_id'";
		// echo $sql;
		$result=mysqli_query($mysqli,$sql);
		$tmprow=mysqli_fetch_object($result);
		$_SESSION['nick']=$tmprow->nick;

		//统计文章总数

	    $sql="SELECT count(1) AS blog_cnt FROM blog WHERE user_id='$user_id'";
	    $result=mysqli_query($mysqli,$sql);
	    $arr_blog_cnt=mysqli_fetch_object($result);
	    $blog_cnt=$arr_blog_cnt->blog_cnt;

	    $sql="UPDATE `users` SET `blog_cnt`='$blog_cnt' WHERE `user_id`='$user_id'";
	    $result=mysqli_query($mysqli,$sql);

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
