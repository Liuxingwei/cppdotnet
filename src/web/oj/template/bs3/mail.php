<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>站内信 - C语言网</title>  
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
      <!-- <div class="jumbotron"> -->
	<center>
<?php
if($view_content){
echo "<center>
<table>
<tr>
<td class=blue>".getNickById($to_user).":".htmlentities(str_replace("\n\r","\n",$view_title),ENT_QUOTES,"UTF-8")." </td>
</tr>
<tr><td><pre style='width: 580px;min-height: 100px;'>". ($to_user=='sy'?str_replace("\n\r","\n",$view_content):htmlentities(str_replace("\n\r","\n",$view_content),ENT_QUOTES,"UTF-8"))."</pre>
</td></tr>
</table></center>";
echo "<!-- to_user $to_user -->";
}
?>
<?php 
  if(isset($_POST['to_user'])){
    echo '<label id="hnt" class="text-center" style="color:red;">消息已经送达.</label>';
  }
 ?>
<form action="mail.php" method="post" class="form-inline text-center" id="form">
        <!-- <input type="text" hidden> -->
        <label>收件人用户名</label>
        <input type="text" class="form-control" name="to_user" id="to_user" value="<?php if($to_user!='br')echo $to_user; ?>">
        <label>标题</label>
        <input type="text" class="form-control" name="title" id="to_title" value="<?php echo $title?>">
        <!-- <input type="submit" value="发送" class="btn btn-primary"> -->
        <button type=button class="btn btn-primary" id="tijiao">发送</button>
        <hr style="margin:10px;border-color:white;">
        <textarea name=content id="to_content" rows=10 cols=80 class="input input-xxlarge"></textarea>
</form>
<ul class="pagination pull-right">
   <?php 
        if($page==1){
          echo "<li class='disabled'><span>&laquo;</span></li>";
        }else{
          echo "<li><a href='mail.php?page=".($page-1)."'>&laquo;</a></li>";
        }
        $maxpag=7;
        $page_total=(int)$page_total;
        $midpag=(int)($maxpag/2);
        $starpag=1;
        $endpag=$page_total;
        if($page_total>$maxpag){
          $starpag=$page-$midpag;
          $endpag=$page+$midpag;
          if($starpag<=0){
            $starpag=1;
            $endpag=$maxpag;
          }
          if($endpag>$page_total){
            $endpag=$page_total;
            $startpag=$endpag-$maxpag+1;
          }
        }
        $stardian="<li><a href='mail.php?page=".($starpag-1)."'>...</a></li>";
        $enddian="<li><a href='mail.php?page=".($endpag+1)."'>...</a></li>";
        if($starpag!=1){
          echo $stardian;
        }
        for($i=$starpag;$i<=$endpag;$i++){
          if($i==$page){
            echo "<li class='active'><a href='#'>".$i."</a></li>"; 
          }else{
            echo "<li><a href='mail.php?page=".$i."'>".$i."</a></li>";
          }
        }
        if($endpag!=$page_total){
          echo $enddian;
        }
        echo "<!-- $page/$page_total -->";
        if($page==$page_total){
          echo "<li class='disabled'><span>&raquo;</span></li>";
        }else{
          echo "<li><a href='mail.php?page=".($page+1)."'>&raquo;</a></li>";
        }
     ?>
</ul>
<table class="table table-striped">
<tr style="background-color:#1D84FF;color:white;"><td>邮件号<td>发件人<td>标题<td>日期</tr>
<tbody>
<?php
$cnt=0;
foreach($view_mail as $row){
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
</center> 
      <!-- </div> -->

    </div> <!-- /container -->
  </div>
    <?php require("template/$OJ_TEMPLATE/footer.php") ?>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <?php include("template/$OJ_TEMPLATE/js.php");?>
    <script src="template/<?php echo $OJ_TEMPLATE;?>/js/mail.js"></script>
    
  </body>
</html>
