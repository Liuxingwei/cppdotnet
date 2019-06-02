<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="C语言|C++|java|C语言入门|编程入门|C语言编程软件|C语言教程|OJ在线评测|编程比赛|学编程|C++教程|java教程|数据结构|蓝桥杯|ACM|算法入门|编程题库|题解博客|dotcpp网|C语言网
">
    <meta name="description" content="在这里可以参加包括ACM、NOI在内的各种C/C++/java程序比赛，也可以DIY举办各类程序比赛活动！">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title><?php echo "比赛排名 - C语言网";?></title>  
    <?php include("template/$OJ_TEMPLATE/css.php");?>	    


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
        table.table_style_contest>thead>tr>th {
            text-align: center;
        }
    </style>
  </head>

  <body>

    <div class="wrap">
    <?php include("template/$OJ_TEMPLATE/nav.php");?>	    
    <?php require_once("template/$OJ_TEMPLATE/contestnav.php");?>
      <!-- Main component for a primary marketing message or call to action -->
    <div class="container">
<?php
$rank=1;
?>

        <div class="col-lg-9">
            <div class="content_box">
                <div class="div_box_body1">
                    <div class="contest_msg_title"><p><?php echo $view_title?></p></div>
                    <font>【状态:
                        　<?php
                        if ($view_private=='0')
                            echo "<span class=blue>公开</span>";
                        else
                            echo "&nbsp;&nbsp;<span class=red>私有</span>";
                        ?>
                        　<?php
                        if ($now>$end_time)
                            echo "<span class=red>已结束</span>";
                        else if ($now<$start_time)
                            echo "<span class=red>等待中</span>";
                        else
                            echo "<span class=red>进行中</span>";
                        ?>】
                    </font>
                <!-- </div>
                <div class="div_box_body1"> -->
                <div class="contest_msg_status">
                    
                    <!-- 　　 -->
                    开始时间: <font color=#993399><?php echo $view_start_time?></font>
                    　　
                    结束时间: <font color=#993399><?php echo $view_end_time?></font>
                    　　
                    <div style="display: inline-block;float: right;width: 210px;">服务器时间: <font id=nowdate></font></div>
                </div>
                </div>
            <!-- </div>
            <div class="content_box"> -->
<table id=rank class="table table-striped table_style_new table_style_contest"><thead><tr class=toprow align=center><th class="{sorter:'false'}">名次</th><th>用户名</th><th>昵称</th><th>解决</th><th>罚时</th>
<?php
/*for ($i=0;$i<$pid_cnt;$i++)
echo "<th><a style='color:white;' href=contest".$cid."_problem".$i.".html>$PID[$i]</a></th>";*/
echo "</tr></thead>\n<tbody>";

for ($i=0;$i<$user_cnt;$i++){
    if ($i&1) echo "<tr class=oddrow align=center>\n";
    else echo "<tr class=evenrow align=center>\n";
    $uuid=$U[$i]->user_id;
    $nick=$U[$i]->nick;
    if ($isorder=1) {
        echo "<td";
        if($no_ord_mark[$i]!==0){
            if(1==$rank)echo ">王者";
            else echo ">".$rank;
            $rank++;
        }else
            echo " style='color: red;'>未预约";
    }
    else {
        echo "<td>";
        if($nick[0]!="*"){
            if(1==$rank)echo "王者";
            else echo $rank;
            $rank++;
        }else
            echo "*";
    }
    
    $usolved=$U[$i]->solved;
    if(isset($_GET['user_id'])&&$uuid==$_GET['user_id']) echo "<td bgcolor=#ffff77>";
    else echo"<td>";
    echo "<a name=\"$uuid\" href=userinfo.php?user=$uuid>$uuid</a>";
    echo "<td><a href=userinfo.php?user=$uuid>".htmlentities($U[$i]->nick,ENT_QUOTES,"UTF-8")."</a>";
    echo "<td><a href=status.php?user_id=$uuid&cid=$cid>$usolved</a>";
    echo "<td>".sec2str($U[$i]->time);
    /*for ($j=0;$j<$pid_cnt;$j++){
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
    }*/
    echo "</tr>\n";
}
echo "</tbody></table>";
?>

            </div>
        </div>
        <div class="col-lg-3">
            <div class="content_box div_contest_descrp">
                <div><p class="div_box_head_2">比赛公告</p></div>
                <div class="div_box_body2">
                    <div class="contest_msg_descrp">
                        <?php 
                        if ($view_description!="") {
                            echo $view_description;
                        }
                        else {
                            echo "暂无……";
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="content_box">
                <div><p class="div_box_head_2">比赛状况</p></div>
                <ul class="nav nav-stacked nav-pills text-center">
                    <li><a href='contest<?php echo $view_cid?>.html'>题目列表</a></li>
                    <li><a href='status.php?cid=<?php echo $view_cid?>'>提交状态</a></li>
                    <li><a style="border-left: 6px solid #4071FD;font-weight: bolder;" href='contestrank.php?cid=<?php echo $view_cid?>'>比赛排名</a></li>
                    <li><a href='contestrank-oi.php?cid=<?php echo $view_cid?>'>OI赛制排名</a></li>
                    <li><a href='conteststatistics.php?cid=<?php echo $view_cid?>'>综合统计</a></li>
                </ul>
            </div>
        </div>
    </div> <!-- /container -->
    </div>
    <?php require("template/$OJ_TEMPLATE/footer.php") ?>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <?php include("template/$OJ_TEMPLATE/js.php");?>	    
<script>
var diff=new Date("<?php echo date("Y/m/d H:i:s")?>").getTime()-new Date().getTime();
//alert(diff);
function clock()
{
var x,h,m,s,n,xingqi,y,mon,d;
var x = new Date(new Date().getTime()+diff);
y = x.getYear()+1900;
if (y>3000) y-=1900;
mon = x.getMonth()+1;
d = x.getDate();
xingqi = x.getDay();
h=x.getHours();
m=x.getMinutes();
s=x.getSeconds();
n=y+"-"+mon+"-"+d+" "+(h>=10?h:"0"+h)+":"+(m>=10?m:"0"+m)+":"+(s>=10?s:"0"+s);
//alert(n);
document.getElementById('nowdate').innerHTML=n;
setTimeout("clock()",1000);
}
clock();
</script>  
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
