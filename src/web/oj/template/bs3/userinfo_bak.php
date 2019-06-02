  <!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title><?php echo "用户信息 - C语言网";?></title>  
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
      <div class="jumbotron">
	
<!-- <script type="text/javascript" src="include/wz_jsgraphics.js"></script> -->
<!-- <script type="text/javascript" src="include/pie.js"></script> -->
<script language="javascript" type="text/javascript" src="include/jquery-latest.js"></script>
<script src="template/<?php echo $OJ_TEMPLATE;?>/flot/jquery.flot.js"></script>
<script src="template/<?php echo $OJ_TEMPLATE;?>/flot/jquery.flot.pie.js"></script>
<center>
<table class="table table-striped" id=statics width=70%>
<caption>
<?php echo $user."--".htmlentities($nick,ENT_QUOTES,"UTF-8")?>
<?php
echo "<a href=mail.php?to_user=$user>$MSG_MAIL</a>";
if(isset($_SESSION['administrator'])){
  require_once('include/set_get_key.php');
  echo " | <a href='userinfo.php?getkey=".$_SESSION['getkey']."&user=$user&defunct=".($defunct?"N":"Y")."'>".($defunct?"解封":"封号")."</a>";
}
?>
</caption>
<tr ><td width=15%><?php echo $MSG_Number?><td width=25% align=center><?php echo $Rank?><td width=70% align=center>解决的题目</tr>
<tr ><td><?php echo $MSG_SOVLED?><td align=center><a href='status.php?user_id=<?php echo $user?>&jresult=4'><?php echo $AC?></a>
<td rowspan=14 align=center>
<script language='javascript'>
function p(id){document.write("<a href=problem.php?id="+id+">"+id+" </a>");}
<?php $sql="SELECT DISTINCT `problem_id` FROM `solution` WHERE `user_id`='$user_mysql' AND `result`=4 ORDER BY `problem_id` ASC";
if (!($result=mysqli_query($mysqli,$sql))) echo mysqli_error();
while ($row=mysqli_fetch_array($result))
echo "p($row[0]);";
mysqli_free_result($result);
?>
</script>
<div id=submission style="width:600px;height:300px" ></div>
</td>
</tr>
<tr ><td><?php echo $MSG_SUBMIT?><td align=center><a href='status.php?user_id=<?php echo $user?>'><?php echo $Submit?></a></tr>
<?php
foreach($view_userstat as $row){
//i++;
echo "<tr ><td>".$jresult[$row[0]]."<td align=center><a href=status.php?user_id=$user&jresult=".$row[0]." >".$row[1]."</a></tr>";
}
//}
echo "<tr id=pie ><td>统计<td><div id='chartCanvas2' style='height:100px;'></div></tr>";
?>
<script>
  function pieHover(event, pos, obj) 
  {
    if (!obj) return;
    percent = parseFloat(obj.series.percent).toFixed(2);
    $("#hover").html('<span style="font-weight: bold; color: '+obj.series.color+'">'+obj.series.label+' ('+percent+'%)</span>');
  }
  var data = [
    { label: "正确",  data: <?php echo $view_summary[4];?>},
    { label: "格式错误",  data: <?php echo $view_summary[5];?>},
    { label: "答案错误",  data: <?php echo $view_summary[6];?>},
    { label: "时间超限",  data: <?php echo $view_summary[7];?>},
    { label: "输出超限",  data: <?php echo $view_summary[9];?>},
    { label: "运行错误",  data: <?php echo $view_summary[10];?>},
    { label: "编译错误",  data: <?php echo $view_summary[11];?>},
  ];
  $.plot($("#chartCanvas2"), data, 
  {
      series: {
          pie: { 
              show: true,
              combine: {
                  threshold: 0.05,
                  label: '其它'
              }
          }
      },
      colors: ["#92cf5c","#f05050","#19a9d5","#847abf","#54596a"],
      grid: {
          hoverable: true
      }
  });
  $("#chartCanvas2").bind("plothover", pieHover);
</script>
<tr ><td>学校:<td align=center><?php echo $school?></tr>
<tr ><td>邮箱:<td align=center><?php echo $email?></tr>
<?php 
if(isset($_SESSION['administrator'])){
 ?>
 <tr><td>注册时间<td><?php echo htmlspecialchars($userinfo_reg_time, ENT_QUOTES);?></tr>
<tr><td>专业<td><?php echo htmlspecialchars($userinfo_subject, ENT_QUOTES);?></tr>
<tr><td>联系电话<td><?php echo htmlspecialchars($userinfo_phone, ENT_QUOTES);?></tr>
<tr><td>邮寄地址<td><?php echo htmlspecialchars($userinfo_address, ENT_QUOTES);?></tr>
<tr><td>年龄<td><?php echo htmlspecialchars($userinfo_age, ENT_QUOTES);?></tr>
<tr><td>行业<td><?php echo htmlspecialchars($userinfo_work_field, ENT_QUOTES);?></tr>
<tr><td>是否工作<td><?php echo htmlspecialchars($userinfo_iswork, ENT_QUOTES);?></tr>
<tr><td>最后昵称修改时间<td><?php echo htmlspecialchars($userinfo_last_nick_time, ENT_QUOTES);?></tr>
 <?php } ?>
</table>
<?php
if(isset($_SESSION['administrator'])){
?><table border=1><tr class=toprow><td>UserID<td>Password<td>IP<td>Time</tr>
<tbody>
<?php
$cnt=0;
foreach($view_userinfo as $row){
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
<?php
}
?>
</center>
      </div>

    </div> <!-- /container -->
    </div>
    <?php require("template/$OJ_TEMPLATE/footer.php") ?>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <?php include("template/$OJ_TEMPLATE/js.php");?>	    
  </body>
</html>
