<?php require("admin-header.php");
if (!isset($_SESSION['administrator'])){
	echo "<a href='../loginpage.php'>Please Login First!</a>";
	exit(1);
}


 // if(isset($_POST['title'])){
 //    echo '<label id="hnt" class="text-center" style="color:red;">消息已经送达.</label>';
 // }
$sql="SELECT COUNT(1) AS cnt FROM `mail` WHERE `to_user`='br'";
$result=mysqli_query($mysqli, $sql);
$row=mysqli_fetch_object($result);
$total_page=$row->cnt/20;
if($row->cnt%20!=0){
    $total_page++;
}
$sql="SELECT * FROM `mail` WHERE `to_user`='br' ORDER BY `in_date` DESC";
if(isset($_GET['page'])){
    $page=intval($_GET['page']);
    $start=($page-1)*20;
    $sql.=" LIMIT $start,20";
}
// echo $sql;
// exit(0);
$result=mysqli_query($mysqli, $sql);
$cnt=0;
while($row=mysqli_fetch_object($result)){
    $view_mlist[$cnt]['mail_id']=$row->mail_id;
    $view_mlist[$cnt]['author']=$row->from_user;
    $view_mlist[$cnt]['title']=$row->title;
    $sql="SELECT COUNT(1) AS cnt FROM `broadcast` WHERE `mail_id`=$row->mail_id";
    $tmp_result=mysqli_query($mysqli, $sql);
    $tmp_row=mysqli_fetch_object($tmp_result);
    $view_mlist[$cnt]['read_cnt']=$tmp_row->cnt;
    $view_mlist[$cnt++]['date']=$row->in_date;
}
if(isset($_GET['vid'])){
    $vid=intval($_GET['vid']);
    $sql="SELECT * FROM `mail` WHERE `mail_id`=$vid";
    $result=mysqli_query($mysqli, $sql);
    if(mysqli_num_rows($result)){
        $row=mysqli_fetch_object($result);
        $view_content=$row->content;
    }
}
 ?>
<?php if(isset($_GET['vid']))echo htmlspecialchars($view_content, ENT_QUOTES);?>
<form action="broadcast.php" method="post" class="form-inline text-center" id="form">
<!-- <input type="text" hidden> -->
    <label>标题</label>
    <?php require_once("../include/set_post_key.php");?>
    <input type="text" name="to_user" value="br" id="to_user" style="display:none">
    <input type="text" style="width:300px;" class="form-control" name="title" id="to_title" value="<?php echo $title?>">
    <!-- <input type="submit" value="发送" class="btn btn-primary"> -->
    <button type=button class="btn btn-primary" id="tijiao">发送</button>
    <hr style="margin:10px;border-color:white;">
    <textarea name=content id="to_content" rows=10 cols=80 class="input input-xxlarge"></textarea>
</form>
<center>
<?php 
    for($i=1;$i<=$total_page;$i++)echo "<a href='broadcast_page.php?page=$i'> $i </a>";
 ?>
</center>
<table class="table">
    <thead>
        <tr>
            <th>邮件号</th>
            <th width="50%">标题</th>
            <th>阅读量</th>
            <th>发送者</th>
            <th>日期</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        foreach($view_mlist as $row) {
            echo "<tr>";
            echo "<td>".$row['mail_id']."</td>";
            echo "<td><a href='broadcast_page.php?vid=".$row['mail_id']."'>".$row['title']."</a></td>";
            echo "<td>".$row['read_cnt']."</td>";
            echo "<td>".$row['author']."</td>";
            echo "<td>".$row['date']."</td>";
            echo "</tr>";
        
        }
         ?>
    </tbody>
</table>
<script src="../template/<?php echo $OJ_TEMPLATE;?>/js/mail.js"></script>
<?php
require("../oj-footer.php");
?>
