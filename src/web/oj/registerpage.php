<?php
////////////////////////////Common head
	$cache_time=10;
	$OJ_CACHE_SHARE=false;
	require_once('./include/cache_start.php');
    require_once('./include/db_info.inc.php');
	require_once('./include/setlang.php');
	$view_title= "用户注册 - C语言网";
	
///////////////////////////MAIN	

if(!isset($_SESSION['user_id']))$_SESSION['prev_page']="/";

if (isset($_SESSION['user_id']) || isset($_SESSION['user_cpn'])){
	echo "<script charset='utf-8' language='javascript'>\n";
	echo "history.go(-1);\n";
	echo "</script>";
	exit(1);
}
$view_news="";
$sql=	"SELECT * "
		."FROM `news` "
		."WHERE `defunct`!='Y'"
		."ORDER BY `importance` ASC,`time` DESC "
		."LIMIT 5";
$result=mysqli_query($mysqli,$sql);//mysql_escape_string($sql));
if (!$result){
	$view_news= "<h3>No News Now!</h3>";
	$view_news.= mysqli_error();
}else{
	$view_news.= "<table width=96%>";
	
	while ($row=mysqli_fetch_object($result)){
		$view_news.= "<tr><td><td><big><b>".$row->title."</b></big>-<small>[".$row->user_id."]</small></tr>";
		$view_news.= "<tr><td><td>".$row->content."</tr>";
	}
	mysqli_free_result($result);
	$view_news.= "<tr><td width=20%><td>This <a href=http://cm.baylor.edu/welcome.icpc>ACM/ICPC</a></tr>";
	$view_news.= "</table>";
}
$view_apc_info="";

if(function_exists('apc_cache_info')){
	 $_apc_cache_info = apc_cache_info(); 
		$view_apc_info =_apc_cache_info;
}

/////////////////////////Template
require("template/".$OJ_TEMPLATE."/registerpage.php");
/////////////////////////Common foot
if(file_exists('./include/cache_end.php'))
	require_once('./include/cache_end.php');
?>
