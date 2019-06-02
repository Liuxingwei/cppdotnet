<?php require("admin-header.php");
require_once("../include/my_func.inc.php");

$url_blog="https://blog.dotcpp.com";

if (!(isset($_SESSION['administrator']) || isset($_SESSION['lowlevel_admin']))){
	echo "<a href='../loginpage.php'>Please Login First!</a>";
	exit(1);
}
//delete
if(isset($_GET['delete']) && isset($_GET['blog_id'])){
	// echo "<!-- receive blog_id:$blog_id -->";
	require_once("../include/check_get_key.php");
	$blog_id=intval($_GET['blog_id']);
	$sql="UPDATE `blog` SET"
    ."`status`='0'"
    ."WHERE `blog_id`='".$blog_id."'";
	mysqli_query($mysqli,$sql) or die("Update Error!\n");
}
require_once("../include/set_get_key.php");

$sql="SELECT COUNT(1) AS cnt FROM `blog` WHERE `status`=1";
$result=mysqli_query($mysqli, $sql);
$row=mysqli_fetch_object($result);
$total_page=(int)($row->cnt/20);
$blog_cnt=$row->cnt;
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
$cnt=0;

$sql="SELECT * FROM `blog` WHERE `status`=1 ORDER BY `hq`=-1 DESC,`post_time` DESC LIMIT $pstart,20 ";
$result=mysqli_query($mysqli, $sql);
while($row=mysqli_fetch_object($result)){
	$sql_discnt="SELECT count(1) FROM blog_discuss WHERE blog_id='$row->blog_id'";
	$result_discnt=mysqli_query($mysqli,$sql_discnt);
	$row_discnt=mysqli_fetch_array($result_discnt);
	$disc_cnt=$row_discnt[0];
	$view_dis[$cnt]['blog_id']=$row->blog_id;

	$sql_hq="SELECT hq FROM blog WHERE blog_id='$row->blog_id'";
    $result_hq=mysqli_query($mysqli,$sql_hq);
    $row_hq=mysqli_fetch_array($result_hq);
    mysqli_free_result($result_hq);
	if ($row_hq[0]==-1) {
		$view_dis[$cnt]['title']="<span style='color: red;font-weight: bold;'>申请优质</span> ".$row->title;
	}
	else {
		$view_dis[$cnt]['title']=$row->title;
	}
	$view_dis[$cnt]['problem_id']=$row->problem_id;
	$view_dis[$cnt]['user_id']=$row->user_id;
	$view_dis[$cnt]['disc_cnt']=$disc_cnt;
	$cnt++;
}

?>
<h3>博客文章管理</h3>
<p>全站共<?php echo $blog_cnt;?>篇文章</p>

<p><a href="blog_mgn_1.php">时间排序</a></p>

<div style="text-align:center;">
	<?php 
	for($i=1;$i<=$total_page;$i++){
	 	echo "<a href='blog_mgn.php?page=$i'>$i</a>";
	 }
	 ?>
</div>
<table class="table">
	<thead>
		<tr>
			<th>文章ID</th>
			<th width="60%">标题</th>
			<th>题号</th>
			<th>操作</th>
			<th>发布者</th>
			<th>评论数</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		foreach($view_dis as $row){
		 ?>
		 	<tr>
		 		<td><?php echo $row['blog_id']; ?></td>
		 		<td><a target='_blank' href="<?php echo $url_blog;?>/<?php echo $row['user_id'];?>/<?php echo $row['blog_id'];?>"><?php echo $row['title']; ?></a></td>
		 		<td><?php echo $row['problem_id']; ?></td>
		 		<td>
		 		<?php if (isset($_SESSION['administrator'])){ ?>
		 			<a onclick="confirm_blog_del(<?php echo $row['blog_id']; ?>)">删除</a>
	 			<?php } ?>
	 			</td>
		 		<td><a href="/home/<?php echo $row['user_id']; ?>"><?php echo getNickByid($row['user_id']);?></a></td>
		 		<td><?php echo $row['disc_cnt']; ?></td>
		 	</tr>
		<?php } ?>
	</tbody>
</table>
<script type="text/javascript">
function confirm_blog_del(blog_id)
{
	var confirm_del=confirm("确定删除吗？");
	if (confirm_del==true)
		window.location = "blog_mgn.php?delete=1&getkey=<?php echo $_SESSION['getkey'] ?>&blog_id="+blog_id;
}
</script>
<?php
require("../oj-footer.php");
?>
