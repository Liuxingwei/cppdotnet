<?php

require_once('./include/db_info.inc.php');
require_once('./include/setlang.php');


$view_title= "在线编程训练 - C语言网";
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="C语言|C++|java|C语言入门|编程入门|C语言编程软件|C语言教程|OJ在线评测|编程比赛|学编程|C++教程|java教程|数据结构|蓝桥杯|ACM|算法入门|编程题库|题解博客|dotcpp网|C语言网
">
    <meta name="description" content="蓝桥杯ACM训练实时评测系统，看懂教程后来这里训练吧，在线提交，实时评测，边学边练！成就大神之路！">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title><?php echo $view_title;?></title>  
    <?php include("template/$OJ_TEMPLATE/css.php");?>	    

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style type="text/css">
    	.content_box {
			border-radius: 0px;
			background: #FFF;
			border: 0px;
			box-shadow: 0 1px 6px #ccc;
		}
		.content_r {
		    padding: 40px;
		    font-size: 20px;
		    font-weight: bold;
		    line-height: 45px;
		}
		.img_list {
		    width: 100px;
    		margin: 50px;
		}
		a.a_list {
			font-size: 50px;
			font-weight: bold;
			color: #333;
		}
		a.a_list:hover,a.a_list:focus {
			color: #333;
			text-decoration: none;
			font-size: 55px;
		}
    </style>
  </head>

  <body>
    <div class="wrap" style="background-image: url(/oj/template/bs3/img/simple_bg.jpg);">
    <?php include("template/$OJ_TEMPLATE/nav.php");?>	    
      <!-- Main component for a primary marketing message or call to action -->
    <div class="container" id="body">
    	<div class="col-xs-5">
    		<a href="/oj/problemset.html" class="a_list">
        	<div class="content_box">
        		<?php echo "<img class='img_list' src='/oj/template/$OJ_TEMPLATE/img/tiku.png'>";?>
        		训练场
        	</div>
        	</a>
        	<a href="/oj/ranklist.html" class="a_list">
        	<div class="content_box">
        		<?php echo "<img class='img_list' src='/oj/template/$OJ_TEMPLATE/img/paiming.png'>";?>
        		排　名
        	</div>
        	</a>
        	<a href="/oj/status.html" class="a_list">
        	<div class="content_box">
        		<?php echo "<img class='img_list' src='/oj/template/$OJ_TEMPLATE/img/zhuangtai.png'>";?>
        		状　态
        	</div>
        	</a>
    	</div>
    	<div class="col-xs-7">
        	<div class="content_box">
        		<div class="content_r">
        		<p>　　Dotcpp主张学习编程学练同步、知行合一。</p>

				<p>　　除了为大家提供各种文字、<a href="/oj/livelist.html">视频教程</a>之外，还提供包括编程基础、计算机二级、数据结构、ACM、蓝桥杯等各种类型上千道的<a href="/oj/problemset.html">编程题库</a>，支持C、C++、java等语言在线提交，实时评测，给出结果。大家只需要将写好的代码复制黏贴到题目内页的编辑框，点击提交几秒之后就可以看到结果。是目前学习编程非常有效的学习方法。</p>

				<p>　　与此同时，每道题背后还有众多同学贡献的<a href="/blog">解题报告</a>供大家参考借鉴，同时大家也可以慷慨自己的思路，记录自己的学习点滴！</p>
				 
				<p>祝大家学有所成！</p>
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