<?php
////////////////////////////Common head
$cache_time=10;
$OJ_CACHE_SHARE=false;
require_once('./include/cache_start.php');
require_once('./include/db_info.inc.php');
require_once('./include/setlang.php');
$view_title= "编辑比赛";
	
///////////////////////////MAIN	
if(!isset($_SESSION['user_id'])){
    $view_errors="请<a href=loginpage.php>登录</a>后再管理比赛!";
    require("template/".$OJ_TEMPLATE."/error.php");
    exit(0);
}
$cid=intval($_GET['cid']);
if(!(isset($_SESSION["m$cid"])||isset($_SESSION['administrator']))){
	$view_errors="你没有权限编辑这个比赛!!!请联系管理员!";
    require("template/".$OJ_TEMPLATE."/error.php");
	exit(0);
}
$user_id=$_SESSION['user_id'];
if (isset($_POST['syear']))
{
	
	$starttime=intval($_POST['syear'])."-".intval($_POST['smonth'])."-".intval($_POST['sday'])." ".intval($_POST['shour']).":".intval($_POST['sminute']).":00";
	$endtime=intval($_POST['eyear'])."-".intval($_POST['emonth'])."-".intval($_POST['eday'])." ".intval($_POST['ehour']).":".intval($_POST['eminute']).":00";
//	echo $starttime;
//	echo $endtime;
	 
    $title=mysqli_real_escape_string($mysqli,$_POST['title']);
    $password=mysqli_real_escape_string($mysqli,$_POST['password']);
    $description=mysqli_real_escape_string($mysqli,$_POST['description']);
    $private=intval(mysqli_real_escape_string($mysqli,$_POST['private']));
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
    if (get_magic_quotes_gpc ()) {
  		  $title = stripslashes ( $title);
          $password = stripslashes ( $password);
    //$description = stripslashes ( $description);
    }

   $lang=$_POST['lang'];
   $langmask=0;
   foreach($lang as $t){
			$langmask+=1<<$t;
	} 
	$langmask=((1<<count($language_ext))-1)&(~$langmask);
	// echo $langmask;	

	$cid=intval($_POST['cid']);
	if(!(isset($_SESSION["m$cid"])||isset($_SESSION['administrator']))) exit();
	$sql="UPDATE `contest` set `title`='$title',description='$description',`start_time`='$starttime',`end_time`='$endtime',`private`='$private',`langmask`=$langmask  ,password='$password' WHERE `contest_id`=$cid";
	//echo $sql;
	mysqli_query($mysqli,$sql) or die(mysqli_error());
	$sql="DELETE FROM `contest_problem` WHERE `contest_id`=$cid";
	mysqli_query($mysqli,$sql);
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
	// echo $plist."<br />";
	// exit(0);
	if (count($pieces)>0 && strlen($pieces[0])>0){
		$sql_1="INSERT INTO `contest_problem`(`contest_id`,`problem_id`,`num`) 
			VALUES ('$cid','$pieces[0]',0)";
		for ($i=1;$i<count($pieces);$i++)
			if(isset($pieces[$i]) && $pieces[$i]!='')
				$sql_1=$sql_1.",('$cid','$pieces[$i]',$i)";
		// echo $sql_1."<br />";
		// exit(0);
		mysqli_query($mysqli,"update solution set num=-1 where contest_id=$cid");
		for ($i=0;$i<count($pieces);$i++){
			$sql_2="update solution set num='$i' where contest_id='$cid' and problem_id='$pieces[$i]';";
			mysqli_query($mysqli,$sql_2);
		}
		//echo $sql_1;
		
		mysqli_query($mysqli,$sql_1) or die(mysqli_error());
		$sql="update `problem` set defunct='N' where `problem_id` in ($plist)";
		mysqli_query($mysqli,$sql) or die(mysqli_error());
	
	}
	
	/*$sql="DELETE FROM `privilege` WHERE `rightstr`='c$cid'";
	mysqli_query($mysqli,$sql);
	$pieces = explode("\n", trim($_POST['ulist']));
	if (count($pieces)>0 && strlen($pieces[0])>0){
		$sql_1="INSERT INTO `privilege`(`user_id`,`rightstr`) 
			VALUES ('".trim($pieces[0])."','c$cid')";
		for ($i=1;$i<count($pieces);$i++)
			$sql_1=$sql_1.",('".trim($pieces[$i])."','c$cid')";
		//echo $sql_1;
		mysqli_query($mysqli,$sql_1) or die(mysqli_error());
	}*/
	
	echo "<script>window.location.href=\"contest_manage.php\";</script>";
	exit();
}else{
	$cid=intval($_GET['cid']);
	$sql="SELECT * FROM `contest` WHERE `contest_id`=$cid";
	$result=mysqli_query($mysqli,$sql);
	if (mysqli_num_rows($result)!=1){
		mysqli_free_result($result);
		echo "找不到对应的比赛!";
		exit(0);
	}
	$row=mysqli_fetch_assoc($result);
	$starttime=$row['start_time'];
	$endtime=$row['end_time'];
	$private=$row['private'];
	$password=$row['password'];
	$langmask=$row['langmask'];
	$description=$row['description'];
	$title=htmlentities($row['title'],ENT_QUOTES,"UTF-8");
	mysqli_free_result($result);
	$plist="";
	$sql="SELECT `problem_id` FROM `contest_problem` WHERE `contest_id`=$cid ORDER BY `num`";
	$result=mysqli_query($mysqli,$sql) or die(mysqli_error());
	for ($i=mysqli_num_rows($result);$i>0;$i--){
		$row=mysqli_fetch_row($result);
		$plist=$plist.$row[0];
		if ($i>1) $plist=$plist.',';
	}
	$ulist="";
	$sql="SELECT `user_id` FROM `privilege` WHERE `rightstr`='c$cid' order by user_id";
	$result=mysqli_query($mysqli,$sql) or die(mysqli_error());
	for ($i=mysqli_num_rows($result);$i>0;$i--){
		$row=mysqli_fetch_row($result);
		$ulist=$ulist.$row[0];
		if ($i>1) $ulist=$ulist."\n";
	}
}


if(function_exists('apc_cache_info')){
	 $_apc_cache_info = apc_cache_info(); 
		$view_apc_info =_apc_cache_info;
}

/////////////////////////Template
require("template/".$OJ_TEMPLATE."/contest_edit.php");
/////////////////////////Common foot
if(file_exists('./include/cache_end.php'))
	require_once('./include/cache_end.php');
?>
