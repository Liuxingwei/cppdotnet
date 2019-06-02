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
          <a href="intro.php" class="list-group-item"  style="background-color:#1D83FE;color:white;">网站介绍</a>
          <a href="business.php" class="list-group-item">交流合作</a>
          <a href="contactus.php" class="list-group-item">联系我们</a>
        </div>
      </div>
      <div class="col-lg-9">
        <h1>网站介绍</h1>
<p style="font-size: 18px;line-height: 35px;">C语言网（www.dotcpp.com）是专注于C语言入门、提高及训练的综合性平台。旨在新互联网时代，重新树立C语言的经典地位，让C语言深入人心！</p>
 
<p style="font-size: 18px;line-height: 35px;">在这里，我们提供C语言相关的学习资料、教程、相关资源及经验交流；通过在线课堂为广大同学提供在线教学服务，在训练场供您训练且提供比赛服务，让您提升C语言的编程功底;最后还为您准备了C语言相关的职位招聘信息，对有志投身软件开发的朋友们提供优质的工作机会！</p>
 
<p style="font-size: 18px;line-height: 35px;">C语言网的主旨：</p>
<p style="font-size: 18px;line-height: 35px;">“专注C语言。让C语言，深入人心！”</p>
 
<p style="font-size: 18px;line-height: 35px;">C语言网的目标：</p>
<p style="font-size: 18px;line-height: 35px;">普及和推广C语言，让更多的人学习C语言并理解C语言的哲学。让C语言，深入人心！</p>
 
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
