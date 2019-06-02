<?php require_once("admin-header.php");
if (!(isset($_SESSION['administrator']))){
	echo "<a href='../loginpage.php'>Please Login First!</a>";
	exit(1);
}
if(isset($_POST['do'])){
	require_once("../include/check_post_key.php");
	$fp=fopen($OJ_SAE?"saestor://web/msg.txt":"msg.txt","w");
	fputs($fp, stripslashes($_POST['msg']));
	fclose($fp);

	$fp=fopen($OJ_SAE?"saestor://web/study_msg.txt":"study_msg.txt","w");
	fputs($fp, stripslashes($_POST['study_msg']));
	fclose($fp);

	echo "Update At ".date('Y-m-d h:i:s');
}



$msg=file_get_contents($OJ_SAE?"saestor://web/msg.txt":"msg.txt");
$study_msg=file_get_contents($OJ_SAE?"saestor://web/study_msg.txt":"study_msg.txt");

?>
	
	<form action='setmsg.php' method='post'>
		<b>导航滚动信息</b>
		<textarea name='msg' rows=25 class="input input-xxlarge" ><?php echo $msg?></textarea><br>
		<b>VIP学习系统信息</b>
		<textarea name='study_msg' rows=15 class="input input-xxlarge" ><?php echo $study_msg?></textarea><br>
		<input type='hidden' name='do' value='do'>
		<input type='submit' value='change'>
		<?php require_once("../include/set_post_key.php");?>
	</form>
	<br>


<?php require_once('../oj-footer.php');
?>
