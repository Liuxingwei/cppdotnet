<?php 
	require_once("./include/my_func.inc.php");
    
	function check_login($user_id,$password){
		$mysqli=$GLOBALS['mysqli'];
		$user_id=mysqli_escape_string($mysqli,$user_id);
		unset($_SESSION['nocheck']);
		session_start();
		
		$sql="SELECT `cpnuser`,`password`,`status` FROM `users_cpn` WHERE `cpnuser`='".$user_id."'";
		$result=mysqli_query($mysqli,$sql);
		$row = mysqli_fetch_array($result);
		if($row['status']==0){
			$_SESSION['nocheck']=1;
			return false;
		}
		if($row && pwCheck($password,$row['password'])){
			$user_id=$row['cpnuser'];
			mysqli_free_result($result);
			return $user_id;
		}
		mysqli_free_result($result);
		return false; 
	}
?>
