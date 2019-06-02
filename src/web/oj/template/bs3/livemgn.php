<?php 
if(!isset($_SESSION['administrator']))
{
	echo '<script>
			  window.location.href="../";
		  </script>';
}

?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<title>直播后台管理</title>
	<?php include("template/$OJ_TEMPLATE/css.php");?>   
	<style type="text/css">
		*{margin: 0px auto;padding: 0px;}
		#center{width: 1200px;}
		h2{font-family: "微软雅黑";}
		table{width: 1200px;}
		.add_th, .update_th{width: 45%;}
		select{width: 100px;background: lightpink;}
		p{font-family: "微软雅黑";font-size: 18px;color: red;}
		span{color: red;}
	</style>
	
</head>
<body>
	<div id="center">
		<h2>选择操作:</h2><br />
		<a class="btn btn-primary" href="livemgn.php?op=add" >添加直播</a>&nbsp;&nbsp;
		<a class="btn btn-danger" href="livemgn.php?op=delete">删除直播</a>&nbsp;&nbsp;
		<a class="btn btn-warning" href="livemgn.php?op=update">修改视频信息</a>&nbsp;&nbsp;
		<a class="btn btn-success" href="livelist.php">返回直播列表</a>&nbsp;&nbsp;
		<a class="btn btn-default" href="../">返回C语言网主页</a><br /><br /><br />
		<form action="livehandle.php" method="post"  onsubmit="return checkInput();">	
			<table>
		<?php 
			$op=isset($_GET['op'])?$_GET['op']:'';
			if($op=='add'){
		?>
				<tr><p>你选择的是添加操作！！</p></tr>
				<tr><td><hr/></td></tr>
				<tr><th>状态</th><th>内容</th><th>老师</th><th>日期</th><th class='add_th'>优酷链接<span>(若添加直播请无视我)</span></th></tr>
				<tr><td><select name='state'><option value='直播'>直播</option><option value='录像'>录像</option></select></td>
				<td><input type='text' name='content' placeholder='请输入直播简介' class='form-control' autofocus /></td>
				<td><input type='text' name='teacher' placeholder='请输入老师名' class='form-control' /></td>
				<td><input type='date' name='date' placeholder='请输入直播时间' class='form-control' /></td>
				<td><input type='text' name='url' placeholder='请输入录像地址' class='form-control' /></td></tr>
				<tr><td><hr></td></tr>
				<tr><td><input type='submit' name='submit' class='btn btn-success' value='添加' />&nbsp;&nbsp;&nbsp;&nbsp;<input type='reset' name='reset' class='btn btn-info' value="重置" /></td></tr>
		<?php
			}
			else if($op=='delete'){
		?>
				<tr><p>你选择的是删除操作！！</p></tr>
				<tr><td><hr/></td></tr>
				<tr><th>编号</th></tr>
				<tr><td><input type='text' name='id' placeholder='请输入视频编号以删除' class='form-control' autofocus /></td></tr>
				<tr><td><hr></td></tr>
				<tr><td><input type='submit' name='submit' class='btn btn-success' value='删除' />&nbsp;&nbsp;&nbsp;&nbsp;<input type='reset' name='reset' class='btn btn-info' value="重置" /></td></tr>
		<?php
			}
			else if($op=='update'){
		?>
				<tr><p>你选择的是更改操作！！</p></tr>
				<tr><td><hr/></td></tr>
				<tr><th>编号</th><th>状态</th><th>内容</th><th>老师</th><th>日期</th><th class='update_th'>优酷链接(若添加直播请无视我)</th></tr>
				<tr><td><input type='text' id="id" name='id' placeholder='要更改的视频编号' class='form-control' autofocus /></td>
				<td><select name='state' id="state"><option value='直播'>直播</option><option selected="selected" value='录像'>录像</option></select></td>
				<td><input type='text' id="content" name='content' placeholder='请输入直播简介' class='form-control' /></td>
				<td><input type='text' id="teacher" name='teacher' placeholder='请输入老师名' class='form-control' /></td>
				<td><input type='date' id="date" name='date' placeholder='请输入直播时间' class='form-control' /></td>
				<td><input type='text' id="url" name='url' placeholder='请输入录像地址' class='form-control' /></td></tr>
				<tr><td><hr/></td></tr>
				<tr><td><input type='submit' name='submit' class='btn btn-success' value='更改' />&nbsp;&nbsp;&nbsp;<input type='reset' name='reset' class='btn btn-info' value="重置" /></td></tr>
		<?php
			}
		?>
	</table>
		</form>
	</div>
	<?php include("template/$OJ_TEMPLATE/js.php");?>
	<script type="text/javascript" src="template/<?php echo $OJ_TEMPLATE;?>/livedir/checkInput.js"></script>
</body>
</html>


<!--<input type='text' name='state' placeholder='请输入直播或录播' class='form-control' />-->