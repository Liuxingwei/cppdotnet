<?php
	$cache_time=1;
	$OJ_CACHE_SHARE=false;
    require_once('./include/cache_start.php');
    require_once('./include/db_info.inc.php');
    require_once('./include/const.inc.php');
	require_once('./include/setlang.php');
	$view_title="Dotcpp在线编译器，在线解释器，在线编程，在线写代码";

$view_src="";
 
if(!$view_src){
	if(isset($_COOKIE['lastlang'])) 
		$lastlang=intval($_COOKIE['lastlang']);
	else 
		$lastlang=0;
   $template_file="$OJ_DATA/$problem_id/template.".$language_ext[$lastlang];
   if(file_exists($template_file)){
	$view_src=file_get_contents($template_file);
   }

}
/*返回提示调整*/
$MSG_Pending="编译中";

/////////////////////////Template
require("template/".$OJ_TEMPLATE."/compiler_ol.php");
/////////////////////////Common foot
if(file_exists('./include/cache_end.php'))
	require_once('./include/cache_end.php');
?>

