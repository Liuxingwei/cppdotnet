<?php require_once("admin-header.php");

if(isset($OJ_LANG)){
        require_once("../lang/$OJ_LANG.php");
}

if (!(isset($_SESSION['administrator']))){
	echo "<a href='../loginpage.php'>Please Login First!</a>";
	exit(1);
}

$vip_addtime=2592000;
$now=time();

if (isset($_POST['user_id'])) {
	$user_id=$_POST['user_id'];
	$goods_sub=$_POST['goods_sub'];

	if ($goods_sub=="c") {
		$sql="SELECT `vip_end` FROM `users` WHERE `user_id`='$user_id'";
		$result=mysqli_query($mysqli,$sql);
		$row=mysqli_fetch_object($result);
		$vip_end=strtotime($row->vip_end);
		mysqli_free_result($result);

		if ($vip_end<$now) {
			$vip_end_new=date('Y-m-d H:i:s',($now+$vip_addtime));
		    $sql="UPDATE users SET vip_end='$vip_end_new' WHERE user_id='".$user_id."'";
		    mysqli_query($mysqli,$sql) or die("未响应，请重试!\n");
		}
		else {
			$vip_end_new=date('Y-m-d H:i:s',($vip_end+$vip_addtime));
		    $sql="UPDATE users SET vip_end='$vip_end_new' WHERE user_id='".$user_id."'";
		    mysqli_query($mysqli,$sql) or die("未响应，请重试!\n");
		}
	}
	if ($goods_sub=="cpp") {
		$sql="SELECT `vip_end_cpp` FROM `users` WHERE `user_id`='$user_id'";
		$result=mysqli_query($mysqli,$sql);
		$row=mysqli_fetch_object($result);
		$vip_end=strtotime($row->vip_end_cpp);
		mysqli_free_result($result);

		if ($vip_end<$now) {
			$vip_end_new=date('Y-m-d H:i:s',($now+$vip_addtime));
		    $sql="UPDATE users SET vip_end_cpp='$vip_end_new' WHERE user_id='".$user_id."'";
		    mysqli_query($mysqli,$sql) or die("未响应，请重试!\n");
		}
		else {
			$vip_end_new=date('Y-m-d H:i:s',($vip_end+$vip_addtime));
		    $sql="UPDATE users SET vip_end_cpp='$vip_end_new' WHERE user_id='".$user_id."'";
		    mysqli_query($mysqli,$sql) or die("未响应，请重试!\n");
		}
	}
	if ($goods_sub=="suanfa") {
		$sql="SELECT `vip_end_suanfa` FROM `users` WHERE `user_id`='$user_id'";
		$result=mysqli_query($mysqli,$sql);
		$row=mysqli_fetch_object($result);
		$vip_end=strtotime($row->vip_end_suanfa);
		mysqli_free_result($result);

		if ($vip_end<$now) {
			$vip_end_new=date('Y-m-d H:i:s',($now+$vip_addtime));
		    $sql="UPDATE users SET vip_end_suanfa='$vip_end_new' WHERE user_id='".$user_id."'";
		    mysqli_query($mysqli,$sql) or die("未响应，请重试!\n");
		}
		else {
			$vip_end_new=date('Y-m-d H:i:s',($vip_end+$vip_addtime));
		    $sql="UPDATE users SET vip_end_suanfa='$vip_end_new' WHERE user_id='".$user_id."'";
		    mysqli_query($mysqli,$sql) or die("未响应，请重试!\n");
		}
	}

	echo "<meta http-equiv='Content-Type' content='text/html'; charset='utf-8'>";
	echo "<script charset='utf-8' language='javascript'>\n";
	echo "alert('操作成功!');\n";
	echo "history.go(-1);\n";
	echo "</script>";
}

$now=time();
$date_now=date('Y-m-d H:i:s',$now);
$sql="SELECT `user_id`,`nick`,`vip_end`,`vip_end_cpp`,`vip_end_suanfa`,`reg_time` FROM `users` WHERE `vip_end`>'$date_now' OR `vip_end_cpp`>'$date_now' OR `vip_end_suanfa`>'$date_now'";
$result=mysqli_query($mysqli,$sql);
$cnt=0;
$user_arr=Array();
while ($row=mysqli_fetch_object($result)){
	$user_arr[$cnt][1]=$row->user_id ;
	$user_arr[$cnt][2]=$row->nick ;
	$user_arr[$cnt][3]=$row->vip_end ;
	$user_arr[$cnt][4]=$row->vip_end_cpp ;
	$user_arr[$cnt][5]=$row->vip_end_suanfa ;
	$user_arr[$cnt][6]=$row->reg_time ;
	$cnt++;
}
mysqli_free_result($result);

?>



<table class='table table-striped'>
	<thead>
	    <tr align=left class='toprow'>
	        <th>用户名</th>
	        <th>昵称</th>
	        <th>C语言到期时间</th>
	        <th>C++到期时间</th>
	        <th>算法课程到期时间</th>
	        <th>注册时间</th>
	    </tr>
	</thead>

	<tbody>
	    <?php
	    $cnt=0;
	    $cnt_time=0;
	    foreach($user_arr as $row){
	        if ($cnt)
	            echo "<tr class='oddrow'>";
	        else
	            echo "<tr class='evenrow'>";
	        
	        foreach($row as $table_cell){
	            echo "<td>";
	            echo "\t".$table_cell;
	            echo "</td>";
	        }
	        echo "</tr>";
	        $cnt=1-$cnt;
	    }
	    ?>
	</tbody>
</table>
<form style="width: 80%;" method="post" action="#">
    			<div class="form-group">
					<label for="" class="col-lg-2 control-label">VIP赠送用户（月卡）：</label>
					<div class="col-lg-5"><input type="text" name="user_id" class="form-control"></div>
			    </div>
			    <div class="form-group">
				    <select name="goods_sub" class="form-control">
						<option value="c" selected="selected">C语言</option>
						<option value="cpp">C++</option>
						<option value="suanfa">算法课程</option>
					</select>
				</div>
			    <div class="form-group">
					<button class="btn btn-primary col-lg-offset-6 light_blue" type="submit">确认</button>
			    </div>
    		</form>
<?php 
	require("../oj-footer.php");
?>