<?php session_start();
require_once("include/db_info.inc.php");
require_once("include/memcache.php");
require_once("include/const.inc.php");
$now=strftime("%Y-%m-%d %H:%M",time());
//if (!isset($_SESSION['user_id'])){
//	require_once("oj-header.php");
//	echo "<a href='loginpage.php'>$MSG_Login</a>";
//	require_once("oj-footer.php");
//	exit(0);
//}

$user_id="Compiler_OL_dotcpp";
$id=0;
$test_run=true;

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
/*$now=strftime("%Y-%m-%d %X",time()-10);
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
}*/


if((~$OJ_LANGMASK)&(1<<$language)){

	$sql="INSERT INTO solution(problem_id,user_id,in_date,language,ip,code_length)
		VALUES('$id','$user_id',NOW(),'$language','$ip','$len')";
	
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
    

                echo $insert_id;


?>
