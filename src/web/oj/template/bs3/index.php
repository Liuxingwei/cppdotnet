<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title><?php echo $view_title?></title>  
    <?php include("template/$OJ_TEMPLATE/css.php");?>	    


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <!-- <div class="container"> -->
    <div class="wrap">
    <?php include("template/$OJ_TEMPLATE/nav.php");?>	    
      <!-- Main component for a primary marketing message or call to action -->
     <div class="container" id="body">
      <div class="jumbotron">
        <p>
<center>
  <h3>提交统计</h3>
<div id=submission style="width:80%;height:300px" ></div>
</center>
        </p>
      </div>

     </div> <!-- /container -->
    </div>
    <?php require("template/$OJ_TEMPLATE/footer.php") ?>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <?php include("template/$OJ_TEMPLATE/js.php");?>	    
 <script language="javascript" type="text/javascript" src="include/jquery.flot.js"></script>
<script type="text/javascript">
$(function () {
  var d1 = [];
  var d2 = [];
  <?php
  foreach($chart_data_all as $k=>$d){
  ?>
    d1.push([<?php echo $k?>, <?php echo $d?>]);
  <?php }?>
  <?php
  foreach($chart_data_ac as $k=>$d){
  ?>
    d2.push([<?php echo $k?>, <?php echo $d?>]);
  <?php }?>
  //var d2 = [[0, 3], [4, 8], [8, 5], [9, 13]];
  // a null signifies separate line segments
  var d3 = [[0, 12], [7, 12], null, [7, 2.5], [12, 2.5]];
  $.plot($("#submission"),[
  {label:"<?php echo $MSG_SUBMIT?>",data:d1,lines: { show: true }},
  {label:"<?php echo $MSG_AC?>",data:d2,bars:{show:true}} ],{
  grid: {
  backgroundColor: { colors: ["#fff", "#eee"] }
  },
  xaxis: {
  mode: "time",
  max:(new Date()).getTime(),
  min:(new Date()).getTime()-100*24*3600*1000
  }
  });
});
//alert((new Date()).getTime());
</script>
  </body>
</html>
