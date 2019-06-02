<?php session_start();
//if (!isset($_SESSION['user_id'])){
//	require_once("oj-header.php");
//	echo "<a href='loginpage.php'>$MSG_Login</a>";
//	require_once("oj-footer.php");
//	exit(0);
//}
require_once("include/db_info.inc.php");
require_once("include/const.inc.php");

// echo "<script>console.log('".$_SESSION['prev_page']."')</script>";

if(!isset($_SESSION['user_id'])){
    $view_errors="请<a href=loginpage.php>登录</a>后再提交!";
    require("template/".$OJ_TEMPLATE."/error.php");
    exit(0);
}
$now=strftime("%Y-%m-%d %H:%M",time());
$user_id=$_SESSION['user_id'];
if (isset($_POST['cid'])){
	$pid=intval($_POST['pid']);
	$cid=intval($_POST['cid']);
	$sql="SELECT `problem_id` from `contest_problem` 
				where `num`='$pid' and contest_id=$cid";
}else{
	//VIP提交状态
	if (isset($_POST['class'])) {
		$class=intval($_POST['class']);
		$subject_vip=$_POST['subject'];
	}
	$id=intval($_POST['id']);
	// $sql="SELECT `problem_id` from `problem` where `problem_id`='$id' and problem_id not in (select distinct problem_id from contest_problem where `contest_id` IN (
	// 		SELECT `contest_id` FROM `contest` WHERE 
	// 		(`end_time`>'$now' or private=1)and `defunct`='N'
	// 		))";
	$sql="SELECT `problem_id` FROM `problem` WHERE `problem_id`=$id ";
	if(!isset($_SESSION['administrator']))
		$sql.=" and defunct='N'";
}
//echo $sql;	
// echo $sql;
// exit(0);
$res=mysqli_query($mysqli,$sql);
if ($res&&mysqli_num_rows($res)<1&&!isset($_SESSION['administrator'])&&!((isset($cid)&&$cid<=0)||(isset($id)&&$id<=0))){
		mysqli_free_result($res);
		$view_errors=  "哪找到这个链接的?没有这个题目.<br>";
		require("template/".$OJ_TEMPLATE."/error.php");
		exit(0);
}
mysqli_free_result($res);



$test_run=false;
if (isset($_POST['id'])) {
	$id=intval($_POST['id']);
        $test_run=($id<=0);
}else if (isset($_POST['pid']) && isset($_POST['cid'])&&$_POST['cid']!=0){
	$pid=intval($_POST['pid']);
	$cid=intval($_POST['cid']);
        $test_run=($cid<0);
	if($test_run) $cid=-$cid;
	// check user if private
	$sql="SELECT `private` FROM `contest` WHERE `contest_id`='$cid' AND `start_time`<='$now' AND `end_time`>'$now'";
	$result=mysqli_query($mysqli,$sql);
	$rows_cnt=mysqli_num_rows($result);
	if ($rows_cnt!=1){
		// echo "你不能提交,因为你没资格参加这个私有比赛.!!";
		$view_errors="现在不能提交，因为你没有被邀请或比赛已结束！！";
		mysqli_free_result($result);
		require("template/".$OJ_TEMPLATE."/error.php");
		// require_once("oj-footer.php");
		exit(0);
	}else{
		$row=mysqli_fetch_array($result);
		$isprivate=intval($row[0]);
		mysqli_free_result($result);
		if ($isprivate==1&&!isset($_SESSION['c'.$cid])){
			$sql="SELECT count(*) FROM `privilege` WHERE `user_id`='$user_id' AND `rightstr`='c$cid'";
			$result=mysqli_query($mysqli,$sql) or die (mysqli_error()); 
			$row=mysqli_fetch_array($result);
			$ccnt=intval($row[0]);
			mysqli_free_result($result);
			if ($ccnt==0&&!isset($_SESSION['administrator'])){
				$view_errors= "你不能提交,因为你没资格参加这个私有比赛!\n";
				require("template/".$OJ_TEMPLATE."/error.php");
				exit(0);
			}
		}
	}
	$sql="SELECT `problem_id` FROM `contest_problem` WHERE `contest_id`='$cid' AND `num`='$pid'";
	$result=mysqli_query($mysqli,$sql);
	$rows_cnt=mysqli_num_rows($result);
	if ($rows_cnt!=1){
		$view_errors= "没有这个题目!\n";
		require("template/".$OJ_TEMPLATE."/error.php");
		mysqli_free_result($result);
		exit(0);
	}else{
		$row=mysqli_fetch_object($result);
		$id=intval($row->problem_id);
		if($test_run) $id=-$id;
		mysqli_free_result($result);
	}
}else{
       $id=0;
/*
	$view_errors= "No Such Problem!\n";
	require("template/".$OJ_TEMPLATE."/error.php");
	exit(0);
*/
       $test_run=true;
}
$language=intval($_POST['language']);
if ($language>count($language_name) || $language<0) $language=0;
$language=strval($language);


$source=$_POST['source'];
$input_text=$_POST['input_text'];
if(get_magic_quotes_gpc()){
	$source=stripslashes($source);
	$input_text=stripslashes($input_text);

}
$input_text=preg_replace ( "(\r\n)", "\n", $input_text );
$source=mysqli_real_escape_string($mysqli,$source);
$input_text=mysqli_real_escape_string($mysqli,$input_text);
$source_user=$source;
if($test_run) $id=-$id;
//use append Main code
$prepend_file="$OJ_DATA/$id/prepend.$language_ext[$language]";
if(isset($OJ_APPENDCODE)&&$OJ_APPENDCODE&&file_exists($prepend_file)){
     $source=mysqli_real_escape_string($mysqli,file_get_contents($prepend_file)."\n").$source;
}
$append_file="$OJ_DATA/$id/append.$language_ext[$language]";
if(isset($OJ_APPENDCODE)&&$OJ_APPENDCODE&&file_exists($append_file)){
     $source.=mysqli_real_escape_string($mysqli,"\n".file_get_contents($append_file));
}
//end of append 

if($test_run) $id=0;

$len=strlen($source);
//echo $source;




setcookie('lastlang',$language,time()+360000);

$ip=$_SERVER['REMOTE_ADDR'];

if ($len<2){
	$view_errors="代码太短!<br>";
	require("template/".$OJ_TEMPLATE."/error.php");
	exit(0);
}
if ($len>65536){
	$view_errors="代码太长!<br>";
	require("template/".$OJ_TEMPLATE."/error.php");
	exit(0);
}

// last submit
$now=strftime("%Y-%m-%d %X",time()-10);
$sql="SELECT `in_date` from `solution` where `user_id`='$user_id' and in_date>'$now' order by `in_date` desc limit 1";
$res=mysqli_query($mysqli,$sql);
if (mysqli_num_rows($res)==1){
	//$row=mysqli_fetch_row($res);
	//$last=strtotime($row[0]);
	//$cur=time();
	//if ($cur-$last<10){
		$view_errors="10s内只能提交一次代码.....<a style='cursor:pointer' onclick='history.go(-1)'>返回</a><br>";
		require("template/".$OJ_TEMPLATE."/error.php");
		exit(0);
	//}
}


if((~$OJ_LANGMASK)&(1<<$language)){
$store_id=0;
if(isset($_SESSION['store_id'])) $store_id=$_SESSION['store_id'];

	if (!isset($pid)){
	$sql="INSERT INTO solution(problem_id,user_id,in_date,language,ip,code_length)
		VALUES('$id','$user_id',NOW(),'$language','$ip','$len')";
	}else{
	$sql="INSERT INTO solution(problem_id,user_id,in_date,language,ip,code_length,contest_id,num)
		VALUES('$id','$user_id',NOW(),'$language','$ip','$len','$cid','$pid')";
	}
	mysqli_query($mysqli,$sql);
	$insert_id=mysqli_insert_id($mysqli);
	$sql="INSERT INTO `source_code_user`(`solution_id`,`source`)VALUES('$insert_id','$source_user')";
	mysqli_query($mysqli,$sql);

	$sql="INSERT INTO `source_code`(`solution_id`,`source`)VALUES('$insert_id','$source')";
	mysqli_query($mysqli,$sql);

	if($test_run){
		$sql="INSERT INTO `custominput`(`solution_id`,`input_text`)VALUES('$insert_id','$input_text')";
		mysqli_query($mysqli,$sql);
	}
	//echo $sql;
}


	 $statusURI=strstr($_SERVER['REQUEST_URI'],"submit",true)."status.php";
	 if (isset($cid)) 
	    $statusURI.="?cid=$cid";
	    
        $sid="";
        if (isset($_SESSION['user_id'])){
                $sid.=session_id().$_SERVER['REMOTE_ADDR'];
        }
        if (isset($_SERVER["REQUEST_URI"])){
                $sid.=$statusURI;
        }
   // echo $statusURI."<br>";
  
        $sid=md5($sid);
        $file = "cache/cache_$sid.html";
    //echo $file;  
    if($OJ_MEMCACHE){
		$mem = new Memcache;
                if($OJ_SAE)
                        $mem=memcache_init();
                else{
                        $mem->connect($OJ_MEMSERVER,  $OJ_MEMPORT);
                }
        $mem->delete($file,0);
    }
	else if(file_exists($file)) 
	     unlink($file);
    //echo $file;
    
  $statusURI="status.php?user_id=".$_SESSION['user_id'];
  //VIP提交状态
  if (isset($class))
	    $statusURI.="&class=".$class."&subject=".$subject_vip."&id=".$id;

  if (isset($cid))
	    $statusURI.="&cid=$cid";
	 
   if(!$test_run)	
	header("Location: $statusURI");
   else{
   	if(isset($_GET['ajax'])){
                echo $insert_id;
        }else{
		?><script>window.parent.setTimeout("fresh_result('<?php echo $insert_id;?>')",1000);</script><?php
        }
   }
?>
