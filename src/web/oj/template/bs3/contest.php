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

    <title><?php echo $view_title." - C语言网"?></title>  
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
    <?php require_once("template/$OJ_TEMPLATE/contestnav.php");?>
      <!-- Main component for a primary marketing message or call to action -->
    <div class="container">
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
<?php
$cactive=0;
/*require_once("template/$OJ_TEMPLATE/contestnav.php");*/
?>
<table id='problemset' class='table table-striped table_style_new table_style_contest'>
    <thead>
        <tr align=left class='toprow'>
            <th width='4%'></th>
            <th style="cursor:hand" onclick="sortTable('problemset', 1, 'int');" width='17%'><?php echo $MSG_PROBLEM_ID?></th>
            <th><?php echo $MSG_TITLE?></th>
            <th><?php echo $MSG_SOURCE?></th>
            <th style="cursor:hand" onclick="sortTable('problemset', 4, 'int');" width='7%'><?php echo $MSG_AC?></th>
            <th style="cursor:hand" onclick="sortTable('problemset', 5, 'int');" width='7%'><?php echo $MSG_SUBMIT?></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $cnt=0;
        foreach($view_problemset as $row){
            if ($cnt)
                echo "<tr class='oddrow'>";
            else
                echo "<tr class='evenrow'>";
            foreach($row as $table_cell){
                echo "<td>";
                echo "\t".$table_cell;
                echo "</td>";
            }
            echo "</tr>";
            $cnt=1-$cnt;
        }
        ?>
    </tbody>
</table>
            </div>
        </div>
        <div class="col-lg-3">
            <!-- <div class="content_box">
              <div><p class="div_box_head_2">服务器时间</p></div>
              <div class="div_box_body1">
                <p style="font-size: 36px;color: #333;text-align: center;" id=nowtime></p>
                　<span style="font-size: 14px;color: #666;float: right;" id=nowdate></span>
              </div>
            </div> -->
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
                        <li><a style="border-left: 6px solid #4071FD;font-weight: bolder;" href='contest<?php echo $view_cid?>.html'>题目列表</a></li>
                        <li><a href='status.php?cid=<?php echo $view_cid?>'>提交状态</a></li>
                        <li><a href='contestrank.php?cid=<?php echo $view_cid?>'>比赛排名</a></li>
                        <li><a href='contestrank-oi.php?cid=<?php echo $view_cid?>'>OI赛制排名</a></li>
                        <li><a href='conteststatistics.php?cid=<?php echo $view_cid?>'>综合统计</a></li>
                    </ul>
            </div>
        </div>
    </div> <!-- /container -->
    </div> <!-- /wrap -->
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
<script src="include/sortTable.js"></script>
  </body>
</html>
