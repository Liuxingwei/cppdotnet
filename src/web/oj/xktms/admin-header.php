<?php @session_start();?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel=stylesheet href='../include/hoj.css' type='text/css'>
<script src="../template/bs3/js/jquery.min.js"></script>
<script>
$("document").ready(function (){
  $("form").append("<div id='csrf' />");
  $("#csrf").load("../csrf.php");
});

</script>
<?php if (!(isset($_SESSION['administrator']) || isset($_SESSION['problem_editor']) || isset($_SESSION['lowlevel_admin']))){
	echo "<a href='../loginpage.php'>先にログインしてください!</a>";
	exit(1);
}
require_once("../include/db_info.inc.php");