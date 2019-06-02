<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title><?php echo "预约提示 - C语言网"?></title>  
    <?php include("template/$OJ_TEMPLATE/css.php");?>	    

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
    <div class="wrap" style="background-color:#E9EAEC;">
    <?php include("template/$OJ_TEMPLATE/nav.php");?>	    
      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron" style="background-color:#E9EAEC;">
        <div class="container" id="body">
          <div style="margin: auto;width: 600px;height: 400px;border: 10px solid #CCC;background: #C0C0C0">
            <p style="padding: 80px 30px 30px;line-height: 50px;">　　<?php echo $view_errors?></p>
            
          </div>
        </div>

    </div> <!-- /container -->
    </div> <!-- /wrap -->
     <?php require("template/$OJ_TEMPLATE/footer.php") ?>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <?php include("template/$OJ_TEMPLATE/js.php");?>	    
  </body>
</html>