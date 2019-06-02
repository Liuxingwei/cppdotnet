<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title><?php echo "比赛排名 - C语言网";?></title>  
    <?php include("template/$OJ_TEMPLATE/css.php");?>	    


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="wrap">
    <?php include("template/$OJ_TEMPLATE/nav.php");?>	    
      <!-- Main component for a primary marketing message or call to action -->
    <div class="container">
<?php
$rank=1;
?>
<center>
<?php 
$cactive=2;
require_once("template/$OJ_TEMPLATE/contestnav.php");
?>
<h3>排行榜</h3>
<a href="contestrank.xls.php?cid=<?php echo $cid?>" >下载</a>
<?php
if($OJ_MEMCACHE){
  ?>
<a href="contestrank2.php?cid=<?php echo $cid?>" >Replay</a>

<?php
}
 ?>
</center>
<style>
th{
    text-align:center;
}
</style>
<table id=rank class="table table-striped"><thead><tr class=toprow align=center><th class="{sorter:'false'}" width=5%>名次</th><th width=10%>用户名</th><th width=10%>昵称</th><th width=5%>解决</th><th width=5%>罚时</th>
<?php
for ($i=0;$i<$pid_cnt;$i++)
echo "<th><a style='color:white;' href=contest".$cid."_problem".$i.".html>$PID[$i]</a></th>";
echo "</tr></thead>\n<tbody>";

for ($i=0;$i<$user_cnt;$i++){
    if ($i&1) echo "<tr class=oddrow align=center>\n";
    else echo "<tr class=evenrow align=center>\n";
    echo "<td>";
    $uuid=$U[$i]->user_id;
    $nick=$U[$i]->nick;
    if($nick[0]!="*"){
        if(1==$rank)echo "王者";
        else echo $rank;
        $rank++;
    }else
        echo "*";
    $usolved=$U[$i]->solved;
    if(isset($_GET['user_id'])&&$uuid==$_GET['user_id']) echo "<td bgcolor=#ffff77>";
    else echo"<td>";
    echo "<a name=\"$uuid\" href=userinfo.php?user=$uuid>$uuid</a>";
    echo "<td><a href=userinfo.php?user=$uuid>".htmlentities($U[$i]->nick,ENT_QUOTES,"UTF-8")."</a>";
    echo "<td><a href=status.php?user_id=$uuid&cid=$cid>$usolved</a>";
    echo "<td>".sec2str($U[$i]->time);
    for ($j=0;$j<$pid_cnt;$j++){
        $bg_color="eeeeee";
        if (isset($U[$i]->p_ac_sec[$j])&&$U[$i]->p_ac_sec[$j]>0){
            $aa=0x33+$U[$i]->p_wa_num[$j]*32;
            $aa=$aa>0xaa?0xaa:$aa;
            $aa=dechex($aa);
            $bg_color="$aa"."ff"."$aa";
            //$bg_color="aaffaa";
            if($uuid==$first_blood[$j]){
                $bg_color="aaaaff";
            }
        }else if(isset($U[$i]->p_wa_num[$j])&&$U[$i]->p_wa_num[$j]>0) {
            $aa=0xaa-$U[$i]->p_wa_num[$j]*10;
            $aa=$aa>16?$aa:16;
            $aa=dechex($aa);
            $bg_color="ff$aa$aa";
        }
        echo "<td>";
        if(isset($U[$i])){
            if (isset($U[$i]->p_ac_sec[$j])&&$U[$i]->p_ac_sec[$j]>0)
                echo sec2str($U[$i]->p_ac_sec[$j]);
            if (isset($U[$i]->p_wa_num[$j])&&$U[$i]->p_wa_num[$j]>0)
                echo "(-".$U[$i]->p_wa_num[$j].")";
        }
    }
    echo "</tr>\n";
}
echo "</tbody></table>";
?>

    </div> <!-- /container -->
    </div>
    <?php require("template/$OJ_TEMPLATE/footer.php") ?>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <?php include("template/$OJ_TEMPLATE/js.php");?>	    

<script>
function getTotal(rows){
var total=0;
for(var i=0;i<rows.length&&total==0;i++){
try{
total=parseInt(rows[rows.length-i].cells[0].innerHTML);
if(isNaN(total)) total=0;
}catch(e){
}
}
return total;
}
function metal(){
var tb=window.document.getElementById('rank');
var rows=tb.rows;
try{
var total=getTotal(rows);
//alert(total);
for(var i=1;i<rows.length;i++){
var cell=rows[i].cells[0];
var acc=rows[i].cells[3];
var ac=parseInt(acc.innerText);
if (isNaN(ac)) ac=parseInt(acc.textContent);
if(cell.innerHTML!="*"&&ac>0){
var r=parseInt(cell.innerHTML);
if(r==1){
cell.innerHTML="Winner";
//cell.style.cssText="background-color:gold;color:red";
//cell.className="badge btn-warning";
}
if(r>1&&r<=total*.05+1)
//cell.className="badge btn-warning";
if(r>total*.05+1&&r<=total*.20+1)
//cell.className="badge";
if(r>total*.20+1&&r<=total*.45+1)
//cell.className="badge btn-danger";
if(r>total*.45+1&&ac>0)
//cell.className="badge badge-info";
}
}
}catch(e){
//alert(e);
}
}
metal();
</script>
<style>
.well{
   background-image:none;
   padding:1px;
}
td{
   white-space:nowrap;

}
</style>
  </body>
</html>
