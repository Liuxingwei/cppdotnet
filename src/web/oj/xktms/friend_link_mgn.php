<?php require("admin-header.php");
require_once("../include/set_get_key.php");
if (!(isset($_SESSION['administrator']))){
	echo "<a href='../loginpage.php'>Please Login First!</a>";
	exit(1);
}
$sql="SELECT `link_id`,`title`,`url` FROM `friend_link` ORDER BY `link_id`";
$result=mysqli_query($mysqli, $sql);
$cnt=0;
while($row=mysqli_fetch_object($result)){
	$view_friend_link[$cnt]['link_id']=$row->link_id;
	$view_friend_link[$cnt]['url']=$row->url;
	$view_friend_link[$cnt]['title']=$row->title;
	$cnt++;
}
$last_one=$cnt;
if(isset($_GET['id'])){
	$id=$_GET['id'];
	$title=$_GET['title'];
	$url=$_GET['url'];
}
?>
<h1>友链管理</h1>
<table class="table">
	<thead>
		<tr>
			<th>序号</th>
			<th>网站名称</th>
			<th>地址</th>
			<th>操作</th>
			<th>编辑</th>
		</tr>
	</thead>
	<tbody>
		<?php 
			foreach($view_friend_link as $row){
				echo "<tr><td>".$row['link_id']."</td><td>".$row['title']."</td><td>".$row['url']."</td><td><a href='friend_link_deal.php?id=".$row['link_id']."&up=1&getkey=".$_SESSION['getkey']."'>".($row['link_id']!='1'?'上升':'')."</a> <a href='friend_link_deal.php?id=".$row['link_id']."&down=1&getkey=".$_SESSION['getkey']."'>".($row['link_id']!=$last_one?"下降":'')."</a> <a href='friend_link_deal.php?id=".$row['link_id']."&delete=1&getkey=".$_SESSION['getkey']."'>删除</a></td><td><a href='friend_link_mgn.php?id=".$row['link_id']."&url=".$row['url']."&title=".$row['title']."'>编辑</a></td></tr>";
			}
		 ?>
	</tbody>
</table>
<h2 style="color:black;">添加友链</h2>
<form action="friend_link_deal.php" id="form1">
<input type="text" name="new" style="display:none;">
<input type="text" style="display:none;" name="getkey" value="<?php echo $_SESSION['getkey']; ?>">
网站名称:<input type="text" name="title" id="title1">
地址:<input type="text" name="url" style="width:500px;" id="url1">
<button id="addF">添加</button>
</form>
<h2 style="color:black;">友链编辑</h2>
<form action="friend_link_deal.php" id="form2">
<input type="text" name="modify" style="display:none;">
<input type="text" name="id" style="display:none;" value="<?php echo $id;?>">
<input type="text" style="display:none;" name="getkey" value="<?php echo $_SESSION['getkey']; ?>">
网站名称:<input type="text" name="title" id="title2" value="<?php echo $title;?>">
地址:<input type="text" name="url" style="width:500px;" id="url2" value="<?php echo $url;?>">
<button id="saveF">保存</button>
<script>
	$("#saveF").click(function(){
		if($("#title2").val().length==0){
			alert('哥,你网站名称没写呢.');
			return false;
		}
		if($("#url2").val().length==0){
			alert('哥,你地址没写呢.');
			return false;
		}
		$("#form2").submit();
		// $("#url2").val('');
		// $("#title2").val('');
	});
	$("#addF").click(function(){
		if($("#title1").val().length==0){
			alert('哥,你网站名称没写呢.');
			return false;
		}
		if($("#url1").val().length==0){
			alert('哥,你地址没写呢.');
			return false;
		}
		$("#form1").submit();
		// $("#url1").val('');
		// $("#title1").val('');
	})
</script>
</form>
<?php
echo "</table></center>";
require("../oj-footer.php");
?>
