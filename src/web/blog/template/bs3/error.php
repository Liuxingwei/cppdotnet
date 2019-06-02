<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/favicon.ico">

    <title><?php echo "提示 - C语言网"?></title>  
    <?php include("template/$OJ_TEMPLATE/css.php");?>	    


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

<body>
    <div class="wrap" style="background-image: url(/template/bs3/img/simple_bg.jpg);">
    <?php include("template/$OJ_TEMPLATE/nav.php");?>     
      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron" style="background: transparent;">
        <div class="container" id="body">
          <div style="width: 600px;margin: auto;border: 1px solid #c0cdd9;background: #F6F9FF;">
              <div style="padding: 10px 50px;color: #666;text-align: center;border-bottom: 1px solid #c0cdd9;"><p style="font-weight: bold;font-size: 20px;margin: 0;">提　　示</p></div>
              <div style="padding: 50px;min-height: 300px;font-size: 18px;">
                <?php echo $view_errors?>
                
              </div>
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
