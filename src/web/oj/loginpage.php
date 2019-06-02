<?php
$cache_time=1;
require_once('./include/cache_start.php');
    require_once("./include/db_info.inc.php");
	require_once("./include/setlang.php");
	$view_title= "用户登录 - C语言网";

	if (isset($_SESSION['user_id']) || isset($_SESSION['user_cpn'])){
		echo "<script charset='utf-8' language='javascript'>\n";
		echo "history.go(-1);\n";
		echo "</script>";
		exit(1);
	}
echo "<script>console.log('".$_SESSION['prev_page']."')</script>";
/////////////////////////Template
require("template/".$OJ_TEMPLATE."/loginpage.php");
/////////////////////////Common foot
if(file_exists('./include/cache_end.php'))
	require_once('./include/cache_end.php');
?>