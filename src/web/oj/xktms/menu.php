<?php require_once("admin-header.php");

	if(isset($OJ_LANG)){
		require_once("../lang/$OJ_LANG.php");
	}
	

?>
<html>
<head>
<title><?php echo $MSG_ADMIN?></title>
<style>
	ol>li{
		height:25px;
		line-height:25px;
		margin-bottom:5px;
	}
</style>
</head>

<body>
<hr>
<h4>
<ol>
	<li>
		<a class='btn btn-primary' href="watch.php" target="main"><b><?php echo $MSG_SEEOJ?></b></a>
<?php if (isset($_SESSION['administrator'])||isset($_SESSION['lowlevel_admin'])){
	?>
	<!-- <li>
		<a class='btn btn-primary' href="news_add_page.php" target="main"><b><?php echo $MSG_ADD.$MSG_NEWS?></b></a>
	<li>
		<a class='btn btn-primary' href="news_list.php" target="main"><b><?php echo $MSG_NEWS.$MSG_LIST?></b></a> -->
	<li>
		<a class='btn btn-primary' href="statistics.php" target="main"><b>统计数据</b></a>
<?php }
if (isset($_SESSION['administrator'])||isset($_SESSION['problem_editor'])){
?>
	<li>
		<a class='btn btn-primary' href="problem_add_page.php" target="main"><b><?php echo $MSG_ADD.$MSG_PROBLEM?></b></a>
<?php }
if (isset($_SESSION['administrator'])||isset($_SESSION['contest_creator'])||isset($_SESSION['problem_editor'])){
?>
	<li>
		<a class='btn btn-primary' href="problem_list.php" target="main"><b><?php echo $MSG_PROBLEM.$MSG_LIST?></b></a>
<?php }
if (isset($_SESSION['administrator'])||isset($_SESSION['contest_creator'])||isset($_SESSION['problem_editor'])){
?>
	<li>
		<a class='btn btn-primary' href="problem_list_tagedit.php" target="main"><b>批量编辑题目</b></a>
<?php }
if (isset($_SESSION['administrator'])){
?>
	<li>
		<a class="btn btn-primary" href="mark_edit.php" target="main"><b>标签编辑</b></a>
<?php }
if (isset($_SESSION['administrator'])||isset($_SESSION['contest_creator'])){
?>		
<li>
	<a class='btn btn-primary' href="contest_add.php" target="main"><b><?php echo $MSG_ADD.$MSG_CONTEST?></b></a>
<?php }
if (isset($_SESSION['administrator'])||isset($_SESSION['contest_creator'])){
?>
<li>
	<a class='btn btn-primary' href="contest_list.php" target="main"><b><?php echo $MSG_CONTEST.$MSG_LIST?></b></a>
<?php }
if (isset($_SESSION['administrator'])){
?>
<li>
	<a class='btn btn-primary' href="team_generate.php" target="main"><b><?php echo $MSG_TEAMGENERATOR?></b></a>
<li>
	<a class='btn btn-primary' href="setmsg.php" target="main"><b><?php echo $MSG_SETMESSAGE?></b></a>
<li>
	<a class='btn btn-primary' href="broadcast_page.php" target="main"><b>站内信广播</b></a>
<li>
	<a class='btn btn-primary' href="dis_com_mgn.php" target="main"><b>评论与讨论管理</b></a>
<?php }
if (isset($_SESSION['administrator'])||isset($_SESSION['lowlevel_admin'])){?>
<li>
	<a class='btn btn-primary' href="blog_mgn.php" target="main"><b>文章及评论管理</b></a>
<?php }
if (isset($_SESSION['administrator'])){?>
<li>
	<a class='btn btn-primary' href="friend_link_mgn.php" target="main"><b>友链管理</b></a>
<?php }
if (isset($_SESSION['administrator'])||isset( $_SESSION['password_setter'] )){
?><li>
	<a class='btn btn-primary' href="changepass.php" target="main"><b><?php echo $MSG_SETPASSWORD?></b></a>
<?php }
if (isset($_SESSION['administrator'])){
?><li>
	<a class='btn btn-primary' href="rejudge.php" target="main"><b><?php echo $MSG_REJUDGE?></b></a>
<?php }
if (isset($_SESSION['administrator'])){
?><li>
	<a class='btn btn-primary' href="privilege_add.php" target="main"><b><?php echo $MSG_ADD.$MSG_PRIVILEGE?></b></a>
<?php }
if (isset($_SESSION['administrator'])){
?><li>
	<a class='btn btn-primary' href="privilege_list.php" target="main"><b><?php echo $MSG_PRIVILEGE.$MSG_LIST?></b></a>
<?php }
if (isset($_SESSION['administrator'])){
?><li>
	<a class='btn btn-primary' href="source_give.php" target="main"><b><?php echo $MSG_GIVESOURCE?></b></a>
<?php }
if (isset($_SESSION['administrator'])){
?><li>
	<a class='btn btn-primary' href="problem_export.php" target="main"><b><?php echo $MSG_EXPORT.$MSG_PROBLEM?></b></a>
<?php }
if (isset($_SESSION['administrator'])){
?><li>
	<a class='btn btn-primary' href="problem_import.php" target="main"><b><?php echo $MSG_IMPORT.$MSG_PROBLEM?></b></a>
<?php }
if (isset($_SESSION['administrator'])){
?>
<!-- <li>
	<a class='btn btn-primary' href="update_db.php" target="main"><b><?php echo $MSG_UPDATE_DATABASE?></b></a> -->
<?php }
if (isset($_SESSION['administrator'])) {
?>
    <li>
        <a class='btn btn-primary' href="distribution_setting.php" target="main"><b>分销设定</b></a>
    </li>
<?php }
if (isset($_SESSION['administrator'])) {
?>
    <li>
        <a class='btn btn-primary' href="distribution_statistics.php" target="main"><b>分销排行</b></a>
    </li>
<?php
}
if (isset($OJ_ONLINE)&&$OJ_ONLINE && isset($_SESSION['administrator'])){
?><li>
	<a class='btn btn-primary' href="../online.php" target="main"><b>在线统计</b></a>
<?php }
if (isset($_SESSION['administrator'])&&!$OJ_SAE){
?>
<li>
	<a class='btn btn-primary' href="problem_copy.php" target="main" title="只抄题目,没有数据.">抄题目</a>
<li>
	<a class='btn btn-primary' href="problem_changeid.php" target="main" title="危险!慎用">题目编号修改</a>
<?php }
?>
<?php if (isset($_SESSION['administrator']) || isset($_SESSION['lowlevel_admin'])){
	?>
	<!-- <li>
		<a class='btn btn-primary' href="cpn_list_1.php" target="main"><b>企业用户审核</b></a> -->
	<li>
		<a class='btn btn-primary' href="job_rel_0.php" target="main"><b>发布招聘审核</b></a>

<?php }
?>

</ol>
<h4>
</body>
</html>
