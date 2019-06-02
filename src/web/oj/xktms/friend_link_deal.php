<?php require("admin-header.php");
require_once("../include/check_get_key.php");
if (!(isset($_SESSION['administrator']))){
	echo "<a href='../loginpage.php'>Please Login First!</a>";
	exit(1);
}
$sql="SELECT MAX(`link_id`) as max FROM `friend_link`";
$result=mysqli_query($mysqli, $sql);
$row=mysqli_fetch_object($result);
$max=$row->max;
$id=intval($_GET['id']);
if(isset($_GET['up'])){
	if($id>1){
		$sql="UPDATE `friend_link` SET `link_id`=65535 WHERE `link_id`=$id";
		echo "$sql";
		mysqli_query($mysqli, $sql);
		$sql="UPDATE `friend_link` SET `link_id`=$id WHERE `link_id`=".($id-1);
		mysqli_query($mysqli, $sql);
		$id--;
		$sql="UPDATE `friend_link` SET `link_id`=$id WHERE `link_id`=65535";
		mysqli_query($mysqli, $sql);
		echo "<script>history.go(-1)</script>";
		// exit(0);
	}
}
if(isset($_GET['down'])){
	if($id<$max){
		$sql="UPDATE `friend_link` SET `link_id`=65535 WHERE `link_id`=$id";
		echo "$sql";
		mysqli_query($mysqli, $sql);
		$sql="UPDATE `friend_link` SET `link_id`=$id WHERE `link_id`=".($id+1);
		mysqli_query($mysqli, $sql);
		$id++;
		$sql="UPDATE `friend_link` SET `link_id`=$id WHERE `link_id`=65535";
		mysqli_query($mysqli, $sql);
		echo "<script>history.go(-1)</script>";
		// exit(0);
	}
}
if(isset($_GET['title'])){
	$title=mysqli_real_escape_string($mysqli, htmlspecialchars($_GET['title'], ENT_QUOTES));
	$url=mysqli_real_escape_string($mysqli, htmlspecialchars($_GET['url'], ENT_QUOTES));
}
if(isset($_GET['new'])){
	$sql="INSERT INTO `friend_link` VALUES(".($max+1).",'$url','$title')";
}
if(isset($_GET['modify'])){
	$sql="UPDATE `friend_link` SET `title`='$title',`url`='$url' WHERE `link_id`=$id";
}
if(isset($_GET['title'])){
	mysqli_query($mysqli, $sql);
	echo "<script>history.go(-1)</script>";
}
if(isset($_GET['delete'])){
	$sql="DELETE FROM `friend_link` WHERE `link_id`=$id";
	mysqli_query($mysqli, $sql);
	$sql="UPDATE `friend_link` SET `link_id`=`link_id`-1 WHERE `link_id`>$id";
	mysqli_query($mysqli, $sql);
	echo "<script>history.go(-1)</script>";
}
?>

<?php
echo "</table></center>";
require("../oj-footer.php");
?>
