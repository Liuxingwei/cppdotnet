<?php require_once("admin-header.php");
require_once("../include/check_get_key.php");
if (!(isset($_SESSION['administrator']))){
	echo "<a href='../loginpage.php'>Please Login First!</a>";
	exit(1);
}
?>
<?php $user_id=$_GET['user_id'];
$sql="SELECT `defunct` FROM `users` WHERE `user_id`='$user_id'";
$result=mysqli_query($mysqli,$sql);
$row=mysqli_fetch_row($result);
$defunct=$row[0];
mysqli_free_result($result);
if ($defunct=='Y') {
	$sql="update `users` set `defunct`='N' where `user_id`='$user_id'";
	$r="用户[".$user_id."]已解封。";
}
else {
	$sql="update `users` set `defunct`='Y' where `user_id`='$user_id'";
	$r="用户[".$user_id."]已封禁。";
}
mysqli_query($mysqli,$sql) or die(mysqli_error());
?>
<script language=javascript>
	alert('<?php echo $r; ?>');
	history.go(-1);
</script>
