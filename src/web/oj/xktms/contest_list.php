<?php require("admin-header.php");


        if(isset($OJ_LANG)){
                require_once("../lang/$OJ_LANG.php");
        }


echo "<title>Problem List</title>";
echo "<center><h2>Contest List</h2></center>";
require_once("../include/set_get_key.php");
$sql="SELECT max(`contest_id`) as upid, min(`contest_id`) as btid  FROM `contest`";
$page_cnt=50;
$result=mysqli_query($mysqli,$sql);
echo mysqli_error();
$row=mysqli_fetch_object($result);
$base=intval($row->btid);
$cnt=intval($row->upid)-$base;
$cnt=intval($cnt/$page_cnt)+(($cnt%$page_cnt)>0?1:0);
if (isset($_GET['page'])){
        $page=intval($_GET['page']);
}else $page=$cnt;
$pstart=$base+$page_cnt*intval($page-1);
$pend=$pstart+$page_cnt;
for ($i=1;$i<=$cnt;$i++){
        if ($i>1) echo '&nbsp;';
        if ($i==$page) echo "<span class=red>$i</span>";
        else echo "<a href='contest_list.php?page=".$i."'>".$i."</a>";
}
$sql="select `contest_id`,`title`,`start_time`,`end_time`,`private`,`defunct` FROM `contest` where contest_id>=$pstart and contest_id <=$pend order by `contest_id` desc";
$keyword=$_GET['keyword'];
$keyword=mysqli_real_escape_string($mysqli,$keyword);
if($keyword) $sql="select `contest_id`,`title`,`start_time`,`end_time`,`private`,`defunct` FROM `contest` where title like '%$keyword%' ";
$result=mysqli_query($mysqli,$sql) or die(mysqli_error());

$now=time();


?>
<form action=contest_list.php class=center><input name=keyword><input type=submit value="<?php echo $MSG_SEARCH?>" ></form>


<?php
echo "<center><table class='table table-striped' width=90% border=1>";
echo "<tr><td>ContestID<td>Title<td>Sendmail<td>StartTime<td>EndTime<td>Private<td>Status<td>Edit<td>Copy<td>Export<td>Logs";
echo "</tr>";
for (;$row=mysqli_fetch_object($result);){
        $sql_order="SELECT * FROM `users` WHERE find_in_set('".$row->contest_id."',order_contest)";
        $result_order=mysqli_query($mysqli, $sql_order);
        $num=mysqli_num_rows($result_order);
        mysqli_free_result($result_order);

        echo "<tr>";
        echo "<td>".$row->contest_id;
        echo "<td><a href='../contest.php?cid=$row->contest_id'>".$row->title."</a>";

        $start_time=strtotime($row->start_time);
        $end_time=strtotime($row->end_time);
        $contest_date=date("Y-m-d",$start_time);
        $order_time=strtotime($contest_date)-25200;
        if ($now<$order_time) {
            echo "<td>共".$num."人预约-<a href='checkemail.php?contest_id=".$row->contest_id."'>Waiting</a>";
                   
        }
        else if ($now>$start_time) {
            echo "<td>共".$num."人预约";
        }
        else {
            echo "<td>共".$num."人预约-<a href='sendmail.php?contest_id=".$row->contest_id."'>Send</a>"; 
        }

        echo "<td>".$row->start_time;
        echo "<td>".$row->end_time;
        $cid=$row->contest_id;
        if(isset($_SESSION['administrator'])||isset($_SESSION["m$cid"])){
                echo "<td><a href=contest_pr_change.php?cid=$row->contest_id&getkey=".$_SESSION['getkey'].">".($row->private=="0"?"<span class=green>Public</span>":"<span class=red>Private<span>")."</a>";
                echo "<td><a href=contest_df_change.php?cid=$row->contest_id&getkey=".$_SESSION['getkey'].">".($row->defunct=="N"?"<span class=green>Available</span>":"<span class=red>Reserved</span>")."</a>";
                echo "<td><a href=contest_edit.php?cid=$row->contest_id>Edit</a>";
                echo "<td><a href=contest_add.php?cid=$row->contest_id>Copy</a>";
                if(isset($_SESSION['administrator'])){
                        echo "<td><a href=\"problem_export_xml.php?cid=$row->contest_id&getkey=".$_SESSION['getkey']."\">Export</a>";
                }else{
                  echo "<td>";
                }
     echo "<td> <a href=\"../export_contest_code.php?cid=$row->contest_id&getkey=".$_SESSION['getkey']."\">Logs</a>";
        }else{
                echo "<td colspan=5 align=right><a href=contest_add.php?cid=$row->contest_id>Copy</a><td>";

        }

        echo "</tr>";
}
echo "</table></center>";
require("../oj-footer.php");
?>
