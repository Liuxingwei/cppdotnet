<?php
////////////////////////////Common head
$cache_time=10;
$OJ_CACHE_SHARE=false;
require_once('./include/cache_start.php');
require_once('./include/db_info.inc.php');
require_once("./include/const.inc.php");
require_once('./include/setlang.php');

if(!isset($_SESSION['user_id'])){
    $view_errors="请<a href=loginpage.php>登录</a>后再创建比赛!";
    require("template/".$OJ_TEMPLATE."/error.php");
    exit(0);
}

$ctype="main";
if (isset($_GET['ctype'])) {
 	$ctype=$_GET['ctype'];
}
if ($ctype=="diy") {
	$view_title= "创建自主比赛";
	/*新用户限制*/
	$user_id=$_SESSION['user_id'];
	$sql="SELECT `user_lvl` FROM `users` WHERE `user_id`='$user_id'";
	$result=mysqli_query($mysqli, $sql);
	$row=mysqli_fetch_object($result);
	$user_lvl=$row->user_lvl;
	if ($user_lvl<2) {
		$view_errors="您的账号等级太低无法创建比赛，请达到P2等级(EXP>100)再来吧！";
	    require("template/".$OJ_TEMPLATE."/error.php");
		exit(0);
	}
	
}
else {
	$view_title= "创建比赛";
		
	///////////////////////////MAIN	
	if(!isset($_SESSION['contest_creator']) && !isset($_SESSION['administrator'])){
		$view_errors="你没有权限创建比赛!!!请联系管理员!";
	    require("template/".$OJ_TEMPLATE."/error.php");
		exit(0);
	}
}
$description="";
 if (isset($_POST['syear']))
{
	$starttime=intval($_POST['syear'])."-".intval($_POST['smonth'])."-".intval($_POST['sday'])." ".intval($_POST['shour']).":".intval($_POST['sminute']).":00";
	$endtime=intval($_POST['eyear'])."-".intval($_POST['emonth'])."-".intval($_POST['eday'])." ".intval($_POST['ehour']).":".intval($_POST['eminute']).":00";
	//	echo $starttime;
	//	echo $endtime;

	$ctype=$_POST['ctype'];

    $title=$_POST['title'];
    $private=$_POST['private'];
    $password=$_POST['password'];
    $description=$_POST['description'];
    if (get_magic_quotes_gpc ()){
            $title = stripslashes ($title);
            $private = stripslashes ($private);
            $password = stripslashes ($password);
            $description = stripslashes ($description);
    }

    $title=mysqli_real_escape_string($mysqli,$title);
    $private=intval(mysqli_real_escape_string($mysqli,$private));
    $password=mysqli_real_escape_string($mysqli,$password);
    $description=mysqli_real_escape_string($mysqli,$description);
    $err_cnt=0;


	if (!preg_match("/^[\x{4e00}-\x{9fa5}A-Za-z0-9_]+$/u", $title)) {
	 
	    $err_str=$err_str."标题仅支持输入汉字英文数字及下划线!\\n";
		$err_cnt++;
	 
	}

    $len=strlen($title);
    if($len<4){
    	$err_str=$err_str."标题太短!\\n";
		$err_cnt++;
    }
    if($len>90){
    	$err_str=$err_str."标题太长!\\n";
		$err_cnt++;	
    }
    $len=strlen($password);
    if($private==1) {
    
    if($len<3){
    	$err_str=$err_str."密码太短!\\n";
		$err_cnt++;
    }
    if($len>16){
    	$err_str=$err_str."密码太长!\\n";
		$err_cnt++;
    }

    }
    $len=strlen($description);
    if($len>65535){
    	$err_str=$err_str."描述太长!\\n";
		$err_cnt++;		
    }
    if(strtotime($starttime)>=strtotime($endtime)){
    	$err_str=$err_str."请正确填写时间!\\n";
		$err_cnt++;		
    }
    if(strtotime($endtime)-strtotime($starttime)>=60*60*24*30){
    	$err_str=$err_str."  比赛时长不得超过30天!\\n";
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
    $lang=$_POST['lang'];
    $langmask=0;
    foreach($lang as $t){
			$langmask+=1<<$t;
	} 
	$langmask=((1<<count($language_ext))-1)&(~$langmask);
	//echo $langmask;	
	
    $sql="INSERT INTO `contest`(`ctype`,`title`,`start_time`,`end_time`,`private`,`langmask`,`description`,`password`)
                VALUES('$ctype','$title','$starttime','$endtime','$private',$langmask,'$description','$password')";
	// echo $sql;
	mysqli_query($mysqli,$sql) or die(mysqli_error());
	$cid=mysqli_insert_id($mysqli);
	// echo "Add Contest ".$cid;
	$sql="DELETE FROM `contest_problem` WHERE `contest_id`=$cid";
	$plist=trim($_POST['cproblem']);
	if(substr($plist,-1)==',')$plist=substr($plist,0,-1);
	$plist=preg_replace("/[^0-9,]/",'',$plist);
	$plist=preg_replace("/,,+/",',',$plist);
	$sql="SELECT MAX(`problem_id`) AS mmx FROM problem";
	$result=mysqli_query($mysqli, $sql);
	$row=mysqli_fetch_object($result);
	$pmax=$row->mmx;
	mysqli_free_result($result);
	$pieces = explode(',', $plist);
	$cnt=count($pieces);
	if($cnt>30){
		$view_errors=  "题目不能超过30个!!!";
		require("template/".$OJ_TEMPLATE."/error.php");
		exit(0);
	}
	for($i=0;$i<$cnt;$i++){
		$pieces[$i]=intval($pieces[$i]);
		if($pieces[$i]<1000 || $pieces[$i]>$pmax)$pieces[$i]=";";
	}
	$plist=implode(",",$pieces);
	$plist=preg_replace("/[^0-9,]/",'',$plist);
	$plist=preg_replace("/,,+/",',',$plist);
	$plist=preg_replace("/,0/",'',$plist);
	if(substr($plist,-1)==',')$plist=substr($plist,0,-1);
	if(substr($plist,0,1)==',')$plist=substr($plist,1);
	$pieces = explode(',', $plist);
	if (count($pieces)>0 && strlen($pieces[0])>0){
		$sql_1="INSERT INTO `contest_problem`(`contest_id`,`problem_id`,`num`) 
			VALUES ('$cid','$pieces[0]',0)";
		for ($i=1;$i<count($pieces);$i++)
			if(isset($pieces[$i]) && $pieces[$i]!='')
				$sql_1=$sql_1.",('$cid','$pieces[$i]',$i)";
		// echo $sql_1;
		mysqli_query($mysqli,$sql_1) or die(mysqli_error());
		/*$sql="update `problem` set defunct='N' where `problem_id` in ($plist)";
		mysqli_query($mysqli,$sql) or die(mysqli_error());*/
	}
	$sql="DELETE FROM `privilege` WHERE `rightstr`='c$cid'";
	mysqli_query($mysqli,$sql);
	$sql="insert into `privilege` (`user_id`,`rightstr`)  values('".$_SESSION['user_id']."','m$cid')";
	mysqli_query($mysqli,$sql);
	$_SESSION["m$cid"]=true;

	//remove user list
	// $pieces = explode("\n", trim($_POST['ulist']));
	// if (count($pieces)>0 && strlen($pieces[0])>0){
	// 	$sql_1="INSERT INTO `privilege`(`user_id`,`rightstr`) 
	// 		VALUES ('".trim($pieces[0])."','c$cid')";
	// 	for ($i=1;$i<count($pieces);$i++)
	// 		$sql_1=$sql_1.",('".trim($pieces[$i])."','c$cid')";
	// 	//echo $sql_1;
	// 	mysqli_query($mysqli,$sql_1) or die(mysqli_error());
	// }
	echo "<script>window.location.href=\"contest_manage.php\";</script>";
	exit(0);
}
if(isset($_GET['p_selected']) && $_GET['p_selected']!=''){
     $plist="";
     //echo $_POST['pid'];
     $strs=Array();
     $src=substr($_GET['p_selected'],0,-1);
     $strs=explode(",", $src);
     $len=count($strs);
     for($i=0;$i<$len;$i++)
        $strs[$i]=intval($strs[$i]);
     sort($strs);
     $plist=implode(",",$strs);
     // echo " <script>console.log('"+$plist+"')</script> ";
     // echo $plist;
     // exit(0);
}

if(function_exists('apc_cache_info')){
	 $_apc_cache_info = apc_cache_info(); 
		$view_apc_info =_apc_cache_info;
}

/////////////////////////Template
require("template/".$OJ_TEMPLATE."/contest_add2.php");
/////////////////////////Common foot
if(file_exists('./include/cache_end.php'))
	require_once('./include/cache_end.php');
?>
