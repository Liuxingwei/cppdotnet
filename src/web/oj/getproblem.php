<?php
////////////////////////////Common head
$cache_time=10;
$OJ_CACHE_SHARE=false;
require_once('./include/cache_start.php');
require_once('./include/db_info.inc.php');
require_once('./include/setlang.php');
$view_title= "Welcome To Online Judge";
	
///////////////////////////MAIN	
if(!isset($_GET['pstart']))exit(0);

$pstart=intval($_GET['pstart']);
if($pstart<1000)$pstart=1000;
// echo "<script>console.log('".$pstart."')</script>";
$pend=$pstart+99;
$sql="SELECT `title` FROM `problem` WHERE `problem_id`>= $pstart AND `problem_id`<=$pend AND `defunct`='N' AND `vip`='0' ORDER BY `problem_id`";
$result=mysqli_query($mysqli, $sql);
while($row=mysqli_fetch_object($result)){
	echo "|".$row->title."\n";
}

/////////////////////////Template
// require("template/".$OJ_TEMPLATE."/index.php");
/////////////////////////Common foot
if(file_exists('./include/cache_end.php'))
	require_once('./include/cache_end.php');
?>
