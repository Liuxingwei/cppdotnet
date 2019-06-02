<?php require("admin-header.php");

        if(isset($OJ_LANG)){
                require_once("../lang/$OJ_LANG.php");
        }


require_once("../include/set_get_key.php");
if(isset($_GET['keyword']))
	$keyword=$_GET['keyword'];
else
	$keyword="";
$keyword=mysqli_real_escape_string($mysqli,$keyword);
$sql="SELECT max(`problem_id`) as upid FROM `problem`";
$page_cnt=100;
$result=mysqli_query($mysqli,$sql);
echo mysqli_error($mysqli);
$row=mysqli_fetch_object($result);
$cnt=intval($row->upid)-1000;
$cnt=intval($cnt/$page_cnt)+(($cnt%$page_cnt)>0?1:0);
if (isset($_GET['page'])){
        $page=intval($_GET['page']);
}else $page=$cnt;
$pstart=1000+$page_cnt*intval($page-1);
$pend=$pstart+$page_cnt;

$difficulty_name=Array("入门题", "普及题", "提高题", "难题");
if(!isset($_SESSION['mark_name'])){
    $sql = "SELECT attr_value FROM others WHERE attr_name LIKE 'mark%' ORDER BY attr_name";
    $result=mysqli_query($mysqli, $sql);
    $tmpcnt=0;
    while($row = mysqli_fetch_object($result)){
        $mark_name[$tmpcnt]=$row->attr_value;
        $tmpcnt++;
    }
    $_SESSION['mark_name']=$mark_name;
}else $mark_name=$_SESSION['mark_name'];
$mark_color=Array("btn-success", "btn-info", "btn-warning", "btn-danger","btn-primary", "btn-light_purple","btn-unknow_color","btn-pink");
$difficulty_color=Array("btn-success", "btn-info", "btn-warning", "btn-danger");

echo "<title>Problem List</title>";
echo "<center><h2>Problem List</h2></center>";

echo "<form action=problem_list_tagedit.php>";
echo "<select class='input-mini' onchange=\"location.href='problem_list_tagedit.php?page='+this.value;\">";
for ($i=1;$i<=$cnt;$i++){
        if ($i>1) echo '&nbsp;';
        if ($i==$page) echo "<option value='$i' selected>";
        else  echo "<option value='$i'>";
        echo $i+9;
        echo "**</option>";
}
echo "</select>";

$sql="select `problem_id`,`title`,`in_date`,`defunct`,`difficulty`,`mark` FROM `problem` where problem_id>=$pstart and problem_id<=$pend order by `problem_id` desc";
//echo $sql;
if($keyword) $sql="select `problem_id`,`title`,`in_date`,`defunct`,`difficulty`,`mark` FROM `problem` where title like '%$keyword%' or source like '%$keyword%'";
$result=mysqli_query($mysqli,$sql) or die(mysqli_error());
?>
<form action=problem_list_tagedit.php><input name=keyword><input type=submit value="<?php echo $MSG_SEARCH?>" ></form>

<form method=post action=problem_tagedit.php>
<style type="text/css">
    input[type='checkbox'][name='pid[]'] {
        height: 2em;
        width: 2em;
    }
    .table td {
        padding: 2px;
        vertical-align: middle;
    }
</style>
<?php
echo "<table class='table table-striped' width=90% border=1>";
echo "<tr><td colspan=9>
        <input type='button' name='selectAll' value='全选'>  
        <input type='button' name='disSelectAll' value='全不选'>  
        <input type='button' name='reverseSelect' value='反选'>  ";
echo "<tr><td>PID<td>Title<td>Date<td>diff<td>mark";
if(isset($_SESSION['administrator'])||isset($_SESSION['problem_editor'])){
        if(isset($_SESSION['administrator']))   echo "<td>Status<td>Delete";
        echo "<td>Edit<td>TestData</tr>";
}
for (;$row=mysqli_fetch_object($result);){
        echo "<tr>";
        echo "<td>".$row->problem_id;
        echo "<input type=checkbox name='pid[]' value='$row->problem_id'>";
        echo "<td><a href='../problem.php?id=$row->problem_id'>".$row->title."</a>";
        echo "<td>".$row->in_date;
        echo "<td><a class='center btn hard_label ".$difficulty_color[$row->difficulty]."'>".$difficulty_name[$row->difficulty]."</a>";
        echo "<td><a class='center btn hard_label ".$mark_color[$row->mark]."'>".$mark_name[$row->mark]."</a>";
        if(isset($_SESSION['administrator'])||isset($_SESSION['problem_editor'])){
                if(isset($_SESSION['administrator'])){
                        echo "<td><a href=problem_df_change.php?id=$row->problem_id&getkey=".$_SESSION['getkey'].">"
                        .($row->defunct=="N"?"<span titlc='click to reserve it' class=green>Available</span>":"<span class=red title='click to be available'>Reserved</span>")."</a><td>";
                        if($OJ_SAE||function_exists("system")){
                              ?>
                              <a href=# onclick='javascript:if(confirm("Delete?")) location.href="problem_del.php?id=<?php echo $row->problem_id?>&getkey=<?php echo $_SESSION['getkey']?>";'>
                              Delete</a>
                              <?php
                        }
                }
                if(isset($_SESSION['administrator'])||isset($_SESSION["p".$row->problem_id])){
                        echo "<td><a href=problem_edit.php?id=$row->problem_id&getkey=".$_SESSION['getkey'].">Edit</a>";
                        echo "<td><a href=quixplorer/index.php?action=list&dir=$row->problem_id&order=name&srt=yes>TestData</a>";
                }
        }
        echo "</tr>";
}
echo "<tr><td colspan=9>
        <input type='button' name='selectAll' value='全选'>  
        <input type='button' name='disSelectAll' value='全不选'>  
        <input type='button' name='reverseSelect' value='反选'>  ";
echo "</table>";

include_once("kindeditor.php") ;
?>

<p>Hint:<br>
<textarea class="kindeditor" rows=13 name="hint" cols=120>auto</textarea></p>
</p>
<p>Source(tag)(多个标签之间空格分开):<br><textarea name="source" rows=1 cols=70>auto</textarea></p>
<p>Difficulty: <select name="difficulty">
    <option value="auto" selected>auto</option>
    <option value="0"><?php echo $difficulty_name[0];?></option>
    <option value="1"><?php echo $difficulty_name[1];?></option>
    <option value="2"><?php echo $difficulty_name[2];?></option>
    <option value="3"><?php echo $difficulty_name[3];?></option>
</select> </p>
<p>Mark: <select name="mark_">
    <option value="auto" selected>auto</option>
    <option value="0"><?php echo $mark_name[0];?></option>
    <option value="1"><?php echo $mark_name[1];?></option>
    <option value="2"><?php echo $mark_name[2];?></option>
    <option value="3"><?php echo $mark_name[3];?></option>
    <option value="4"><?php echo $mark_name[4];?></option>
    <option value="5"><?php echo $mark_name[5];?></option>
    <option value="6"><?php echo $mark_name[6];?></option>
    <option value="7"><?php echo $mark_name[7];?></option>
    </select>
</p>
<div align=center>
<?php require_once("../include/set_post_key.php");?>
<input type=submit name='pro_tagedit' value='批量编辑'>
</div>
</form>
<script type="text/javascript">  
$(document).ready(function()
{
    $(function(){  
        $("input[type='button'][name='selectAll']").click(function(){  
            $("input[type='checkbox'][name='pid[]']").each(function(){  
                $(this).prop("checked", true); 
            });  
        });  
        $("input[type='button'][name='disSelectAll']").click(function(){  
            $("input[type='checkbox'][name='pid[]']").each(function(){  
                $(this).prop("checked", false);   
            });  
        });  
        $("input[type='button'][name='reverseSelect']").click(function(){  
            $("input[type='checkbox'][name='pid[]']").each(function(){  
                $(this).prop("checked", !$(this).prop("checked")); 
            });  
        });  
    });  
/*    //全选  
    $("#selectAll").click(function () {
         $("#list :checkbox,#all").prop("checked", true);  
    });  
    //全不选
    $("#unSelect").click(function () {  
         $("#list :checkbox,#all").prop("checked", false);  
    });  
    //反选 
    $("#reverse").click(function () { 
         $("#list :checkbox").each(function () {  
              $(this).prop("checked", !$(this).prop("checked"));  
         });
         allchk();
    });*/
});
</script>
<?php
require("../oj-footer.php");
?>
