<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">
    <meta name="keywords" content="编程比赛 ACM比赛 DIY比赛列表">
    <meta name="description" content="在这里可以参加包括ACM、NOI在内的各种C/C++/java程序比赛，也可以举办各类程序作业">
    <title><?php echo $view_title?></title>  
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
    <div class="container" id="body">
        <h1 class="text-center">比赛列表</h1>
<div class="text-right">服务器时间:<span id=nowdate></span></div>
<table class='table table-striped'>
<thead>
<tr class=toprow><th width=10%>编号<th width=40%>比赛名称<th width=30%>状态<th width=10%>私有<th>举办者</tr>
</thead>
<tbody>
<?php
$cnt=0;
foreach($view_contest as $row){
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
</table></center>
    <hr style="border:0px;" />
    <?php 
    if(isset($_SESSION['contest_creator']) || isset($_SESSION['administrator']))
        echo '<div class="text-center"><a href="contest_add.php" class="btn btn-link">创建比赛</a><a href="contest_manage.php" class="btn btn-link">管理比赛</a></div>';
     ?>
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
 </body>
</html>
