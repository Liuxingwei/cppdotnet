<?php 
require("admin-header.php");

require_once ("../include/email_class.php"); 


if (isset($_GET['contest_id'])){
	$contest_id = htmlentities($_GET['contest_id']);

	$sql="SELECT `email` FROM `users` WHERE find_in_set('".$contest_id."',order_contest)";
	$result=mysqli_query($mysqli, $sql);
	$i=0;

	while ($toemail=mysqli_fetch_row($result)) {
		echo "<div style='width:900px; margin:10px auto;'>"; 
		echo "邮箱地址：".$toemail[0]; 
		echo "</div>";
		$i++;
	}
	 echo "共获取".$i."个邮件。";
	mysqli_free_result($result);

require("../oj-footer.php");

}
?>