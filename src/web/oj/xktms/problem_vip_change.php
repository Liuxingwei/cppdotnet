<?php require_once("admin-header.php");
require_once("../include/check_get_key.php");
if (!(isset($_SESSION['administrator']))){
	echo "<a href='../loginpage.php'>Please Login First!</a>";
	exit(1);
}
?>
<?php $id=intval($_GET['id']);
$sql="SELECT `vip` FROM `problem` WHERE `problem_id`=$id";
$result=mysqli_query($mysqli,$sql);
$row=mysqli_fetch_row($result);
$vip=$row[0];
echo $vip;
mysqli_free_result($result);
if ($vip==1) $sql="update `problem` set `vip`=0 where `problem_id`=$id";
else $sql="update `problem` set `vip`=1 where `problem_id`=$id";
mysqli_query($mysqli,$sql) or die(mysqli_error());
?>
<script language=javascript>
	history.go(-1);
</script>
