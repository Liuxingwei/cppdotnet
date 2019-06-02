<?php
require_once("include/db_info.inc.php");
$view_cid=intval($_GET['cid']);
$sql="SELECT * FROM `contest` WHERE `contest_id`='$cid'";
// echo "<!-- $sql -->";
$result=mysqli_query($mysqli, $sql);
if(mysqli_num_rows($result)==1){
	$row_contest=mysqli_fetch_object($result);
	
	$view_private=$row_contest->private;
	$now=time();
	$start_time=strtotime($row_contest->start_time);
	$end_time=strtotime($row_contest->end_time);
	$view_description=$row_contest->description;
	$view_title= $row_contest->title;
	$view_start_time=$row_contest->start_time;
	$view_end_time=$row_contest->end_time;
}
mysqli_free_result($result);
?>
<link rel="stylesheet" href="template/<?php echo $OJ_TEMPLATE;?>/css/contest.css">
<!-- <div>
    <h1><?php echo $view_title ?></h1>
    <p><?php echo $view_description?></p>
    <br>开始时间: <font color=#993399><?php echo $view_start_time?></font>
    结束时间: <font color=#993399><?php echo $view_end_time?></font><br>
    服务器时间: <font color=#993399><span id=nowdate > <?php echo date("Y-m-d H:i:s")?></span></font>
    状态:<?php
    if ($now>$end_time)
        echo "<span class=red>已结束</span>";
    else if ($now<$start_time)
        echo "<span class=red>等待中</span>";
    else
        echo "<span class=red>进行中</span>";
    ?>&nbsp;&nbsp;
    <?php
    if ($view_private=='0')
        echo "<span class=blue>公开</font>";
    else
        echo "&nbsp;&nbsp;<span class=red>私有</font>";
    ?>
    <br>
    <ul class="breadcrumb text-center" style="background:white;">
        <li <?php if($cactive==0) echo "class='active'";?>><a href='contest<?php echo $view_cid?>.html'>问题</a></li>
        <li <?php if($cactive==1) echo "class='active'";?>><a href='status.php?cid=<?php echo $view_cid?>'>状态</a></li>
        <li <?php if($cactive==2) echo "class='active'";?>><a href='contestrank.php?cid=<?php echo $view_cid?>'>排名</a></li>
        <li <?php if($cactive==3) echo "class='active'";?>><a href='conteststatistics.php?cid=<?php echo $view_cid?>'>统计</a></li>
    </ul>
</div> -->