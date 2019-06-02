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
      <div class="col-lg-3">
        <div class="list-group">
          <a href="intro.php" class="list-group-item">网站介绍</a>
          <a href="business.php" class="list-group-item">交流合作</a>
          <a href="contactus.php" class="list-group-item" style="background-color:#1D83FE;color:white;">联系我们</a>
        </div>
      </div>
      <div class="col-lg-9">
        <h1>联系我们</h1>
<p style="font-size: 18px;line-height: 35px;">日常比赛、活动、招聘相关：</p>
<p style="font-size: 18px;line-height: 35px;">QQ：2045302297</p>
 
<p style="font-size: 18px;line-height: 35px;">合作，意见与建议：</p>
<p style="font-size: 18px;line-height: 35px;">QQ：854253552</p>
 
<!-- <p style="font-size: 18px;line-height: 35px;">联系地址:　源代码（大连）科技有限公司</p> -->
 
<p style="font-size: 18px;line-height: 35px;">C语言网 微信公众平台公众号：dotcpp</p>
<p style="font-size: 18px;line-height: 35px;">二维码：</p><img src="template/<?php echo $OJ_TEMPLATE;?>/img/wechat.jpg" alt="QR code" width=200 height=200>

      </div>
     </div> <!-- /container -->
    </div>
    <?php require("template/$OJ_TEMPLATE/footer.php") ?>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <?php include("template/$OJ_TEMPLATE/js.php");?>	    
 <script language="javascript" type="text/javascript" src="include/jquery.flot.js"></script>
  </body>
</html>
