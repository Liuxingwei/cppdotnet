<?php 
require_once("./include/db_info.inc.php");
require_once("./include/my_func.inc.php");
$vcode=trim($_GET['vcode']);
// echo $vcode."\n".$_SESSION["vcode"];

if($OJ_VCODE&&($vcode!= $_SESSION["vcode"]||$vcode==""||$vcode==null) ){
	$_SESSION["vcode"]=null;
	print 0;
}
?>
