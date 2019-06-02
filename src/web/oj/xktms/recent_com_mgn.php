<?php require("admin-header.php");
require_once("../include/my_func.inc.php");
if (!isset($_SESSION['administrator'])){
	echo "<a href='../loginpage.php'>Please Login First!</a>";
	exit(1);
}
//delete
if(isset($_GET['delete']) && isset($_GET['cid'])){
	// echo "<!-- receive did:$did -->";
	require_once("../include/check_get_key.php");
	$cid=intval($_GET['cid']);
	$sql="DELETE FROM `comment` WHERE `comment_id`='$cid'";
	// echo "<!-- $sql -->";
	mysqli_query($mysqli, $sql);
}

require_once("../include/set_get_key.php");

$sql="SELECT COUNT(1) AS cnt FROM `comment`";
$result=mysqli_query($mysqli, $sql);
$row=mysqli_fetch_object($result);
$total_page=(int)($row->cnt/20);
if($row->cnt%20!=0){
	$total_page++;
}
if($total_page>10){
	$total_page=10;
}
$page=1;
if(isset($_GET['page'])){
	$page=intval($_GET['page']);
}
$pstart=($page-1)*20;
//list
$sql="SELECT comment.comment_id,comment.content,comment.user_id,discuss.problem_id,discuss.discuss_id FROM `comment` INNER JOIN `discuss` WHERE comment.discuss_id=discuss.discuss_id ORDER BY comment.post_time DESC LIMIT $pstart,20 ";
$result=mysqli_query($mysqli, $sql);
$cnt=0;
while($row=mysqli_fetch_object($result)){
	$view_dis[$cnt]['pid']=$row->problem_id;
	$view_dis[$cnt]['did']=$row->discuss_id;
	$view_dis[$cnt]['cid']=$row->comment_id;
	$view_dis[$cnt]['content']=$row->content;
	$view_dis[$cnt]['user_id']=$row->user_id;
	$cnt++;
}
?>
<a href="dis_com_mgn.php">最近的讨论</a>
<a href="recent_com_mgn.php">最近的评论</a>
<a href="com_inform_deal.php">评论举报处理</a>
<a href="dis_inform_deal.php">讨论举报处理</a>
<div style="text-align:center;">
	<?php 
	for($i=1;$i<=$total_page;$i++){
	 	echo "<a href='recent_com_mgn.php?page=$i'>$i</a>";
	 }
	 ?>
</div>
<table class="table">
	<thead>
		<tr>
			<th>讨论ID</th>
			<th width="60%">内容</th>
			<th>操作</th>
			<th>发布者</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		foreach($view_dis as $row){
		 ?>
		 	<tr>
		 		<td><a target="_blank" href="../discuss<?php echo $row['pid'].'.html#'.$row['did'];?>"><?php echo $row['cid']; ?></a></td>
		 		<td><?php echo htmlspecialchars($row['content'], ENT_QUOTES); ?></td>
		 		<td><a href="recent_com_mgn.php?delete=1&getkey=<?php echo $_SESSION['getkey'] ?>&cid=<?php echo $row['cid']; ?>">删除</a></td>
		 		<td><a href="../userinfo.php?user=<?php echo $row['user_id']; ?>"><?php echo getNickByid($row['user_id']);?></a></td>
		 	</tr>
		<?php } ?>
	</tbody>
</table>
<?php
require("../oj-footer.php");
?>
