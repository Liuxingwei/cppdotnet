<?php
$cache_time=10;
$OJ_CACHE_SHARE=false;
require_once('./include/cache_start.php');
require_once('./include/db_info.inc.php');
require_once('./include/my_func.inc.php');
require_once('./include/setlang.php');
 
if(isset($OJ_EXAM_CONTEST_ID)&&$OJ_EXAM_CONTEST_ID>0){
	header("Content-type: text/html; charset=utf-8");
	echo $MSG_MAIL_NOT_ALLOWED_FOR_EXAM;
	exit ();
}

$view_title=$MSG_MAIL;
$to_user="";
$title="";
if (isset($_GET['to_user'])){
	$to_user=htmlentities($_GET['to_user'],ENT_QUOTES,"UTF-8");
}
if (isset($_GET['title'])){
	$title=htmlentities($_GET['title'],ENT_QUOTES,"UTF-8");
}
if (isset($_SESSION['user_cpn'])){
	$view_errors="您所在用户组无此权限!";
    require("template/".$OJ_TEMPLATE."/error.php");
    exit(0);
}
if (!isset($_SESSION['user_id'])){
	$view_errors="请<a href=loginpage.php>登录</a>后再发私信!";
    require("template/".$OJ_TEMPLATE."/error.php");
    exit(0);
}
require_once("./include/db_info.inc.php");
require_once("./include/const.inc.php");
if(isset($OJ_LANG)){
		require_once("./lang/$OJ_LANG.php");
		if(file_exists("./faqs.$OJ_LANG.php")){
			$OJ_FAQ_LINK="faqs.$OJ_LANG.php";
		}
}
// echo "<title>$MSG_MAIL</title>";



//view mail
$view_content=false;
if (isset($_GET['vid'])){
	$vid=intval($_GET['vid']);
	$sql="SELECT * FROM `mail` WHERE `mail_id`=".$vid."
								AND (to_user='".$_SESSION['user_id']."' OR to_user='br')";
	$result=mysqli_query($mysqli,$sql);
	$row=mysqli_fetch_object($result);
	$to_user=$row->from_user;
	if($row->to_user=='br')$to_user='br';
	$view_title=$row->title;
	$view_content=$row->content;

	mysqli_free_result($result);
	if(isset($_GET['broadcast']) && 1==$_GET['broadcast'] &&$row->to_user=='br'){
		$sql="SELECT * FROM `broadcast` where `mail_id`=$vid AND `user_id`='".$_SESSION['user_id']."'";
		// echo $sql;
		$result=mysqli_query($mysqli, $sql);
		if(!mysqli_num_rows($result)){
			$sql="INSERT INTO `broadcast` VALUES('$vid','".$_SESSION['user_id']."')";
			mysqli_query($mysqli, $sql);
		}
	}else{
		$sql="update `mail` set new_mail=0 WHERE `mail_id`=".$vid;
		mysqli_query($mysqli,$sql);
	}

}
//send mail page
//send mail
if(isset($_POST['to_user'])){
	$now=strftime("%Y-%m-%d %X",time()-10);
	$sql="SELECT `in_date` FROM `mail` where `from_user`='".$_SESSION['user_id']."' and `in_date`>'$now' order by `in_date` desc limit 1";
	$res=mysqli_query($mysqli,$sql);
	if (mysqli_num_rows($res)==1){
	    echo "<meta http-equiv='Content-Type' content='text/html'; charset='utf-8'>";
	    print "<script charset='utf-8' language='javascript'>\n";
	    print "alert('10秒内只能发送一次邮件!!!\\n');\n";
	    print "window.location.href='mail.php';\n</script>";
	    exit(0);
	}
	$to_user = $_POST ['to_user'];
	$title = $_POST ['title'];
	$content = $_POST ['content'];
	$from_user=$_SESSION['user_id'];
	if (get_magic_quotes_gpc ()) {
		$to_user = stripslashes ( $to_user);
		$title = stripslashes ( $title);
		$content = stripslashes ( $content );
	}
	$title = RemoveXSS( $title);
	$to_user=mysqli_real_escape_string($mysqli,$to_user);
	$title=mysqli_real_escape_string($mysqli,$title);
	$content=mysqli_real_escape_string($mysqli,$content);
	$from_user=mysqli_real_escape_string($mysqli,$from_user);
	$sql="select 1 from users where user_id='$to_user' ";
	$res=mysqli_query($mysqli,$sql);
	if ($res&&mysqli_num_rows($res)<1){
			mysqli_free_result($res);
			$view_title= "找不到指定的用户!";

	}else{
		if($res)mysqli_free_result($res);
		$sql="insert into mail(to_user,from_user,title,content,in_date)
						values('$to_user','$from_user','$title','$content',now())";

		if(!mysqli_query($mysqli,$sql)){
			$view_title=  "发送失败!";
		}else{
			$view_title=  "成功发送!";
		}
	}
}
$sql="SELECT COUNT(1) AS cnt FROM `mail` WHERE `to_user`='".$_SESSION['user_id']."' OR `to_user`='br'";
$result=mysqli_query($mysqli, $sql);
$row=mysqli_fetch_object($result);
$page_total=(int)($row->cnt/10);
if($row->cnt%10){
	$page_total++;
}
//list mail
$page=1;
if(isset($_GET['page']))
	$page=intval($_GET['page']);
$pstart=($page-1)*10;
$sql="SELECT * FROM `mail` WHERE `to_user`='".$_SESSION['user_id']."'
					OR `to_user`='br' ORDER BY mail_id DESC LIMIT $pstart,10 ";
$result=mysqli_query($mysqli,$sql) or die(mysqli_error());
$view_mail=Array();
$i=0;
for (;$row=mysqli_fetch_object($result);){
	$view_mail[$i][0]=$row->mail_id;
	if($row->to_user=='br'){
		$sql="SELECT * FROM `broadcast` WHERE `user_id`='".$_SESSION['user_id']."' AND `mail_id`='$row->mail_id'";
		$tmp_result=mysqli_query($mysqli, $sql);
		if(!mysqli_num_rows($tmp_result))$view_mail[$i][0].= "<span style='color:red'>新</span>";
		$view_mail[$i][1]="系统广播";
		$view_mail[$i][2]="<a href='mail.php?vid=$row->mail_id&broadcast=1'>".$row->title."</a>";
	}else{
		if ($row->new_mail) $view_mail[$i][0].= "<span style='color:red'>新</span>";
		$view_mail[$i][1]="<a href='userinfo.php?user=".$row->from_user."'>".getNickByid($row->from_user)."</a>";
		$view_mail[$i][2]="<a href='mail.php?vid=$row->mail_id'>".$row->title."</a>";
	}
	if($row->from_user=='sy'){
		$view_mail[$i][1]="系统消息";
	}
	$view_mail[$i][3]=$row->in_date;
	$i++;
}
mysqli_free_result($result);


/////////////////////////Template
require("template/".$OJ_TEMPLATE."/mail.php");
/////////////////////////Common foot
if(file_exists('./include/cache_end.php'))
	require_once('./include/cache_end.php');
?>

