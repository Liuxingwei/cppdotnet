<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/favicon.ico">

    <title><?php echo $view_title;?></title>  
    <meta name="keywords" content="C语言|C++|java|C语言入门|编程入门|C语言编程软件|C语言教程|OJ在线评测|编程比赛|学编程|C++教程|java教程|数据结构|蓝桥杯|ACM|算法入门|编程题库|题解博客|dotcpp网|C语言网
">
    <meta name="description" content="在这里，你可以分享你的解题经验，蓝桥杯或者是NOI/ACM的竞赛经验，分享你的程序人生！记录你的点滴成长！">
    <?php include("template/$OJ_TEMPLATE/css.php");?>	    
    <link rel="stylesheet" href="<?php echo "/template/$OJ_TEMPLATE";?>/css/blog.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
    	.mod_blogindex {
    		border-radius: 0px;
    		border: 0px;
		    box-shadow: 0 1px 6px #ccc;
    	}
    	.head_blogindex {
    		padding: 0px;
    		border-bottom: 1px solid #DDD;
    	}
    	.head_blogindex_text {
    		display: inline-block;
    		margin: 0px 20px;
    		padding: 15px 0px;
    		border-bottom: 4px solid #4071FD;
    	}
    	.list_title_index {
    		font-size: 18px;
    	}
    	.list_box_index {
    		padding: 20px;
    	}
    </style>
  </head>

  <body>
    <div class="wrap">
    <?php include("template/$OJ_TEMPLATE/nav.php");?>	    
      <!-- Main component for a primary marketing message or call to action -->
    <div class="container">
        
        <div class="col-lg-8">
        	<div class="mod_blog mod_blogindex" style="width: 100%;">
        		<img src="/template/bs3/img/blog_head_02.jpg">
        	</div>
        	<div class="mod_blog mod_blogindex" style="width: 100%;">
        		<div class="head_blogindex">
                    <h4 class="head_blogindex_text">最新文章</h4>
                    <a target='_blank' style="float: right;margin: 15px;" href="/article/edit">去写文章</a>
                </div>
        		<table class='table_list'>
        			<?php
                        foreach ($ablog_data as $row_tr) {
                            echo "<tr>";
                            foreach ($row_tr as $row_td) {
                                
                                echo $row_td;
                                
                            }
                        echo "</tr>";
                        }
                    ?>
        		</table>
                <div class="head_blogindex" style="height: 54px;">
                    <a target='_blank' style="float: right;margin: 15px;" href="/article/list">更多文章</a>
                </div>
        	</div>
        	<div class="mod_blog mod_blogindex" style="width: 100%;">
        		<div class="head_blogindex">
                    <h4 class="head_blogindex_text">最新题解</h4>
                    <a target='_blank' style="float: right;margin: 15px;" href="<?php echo $url_oj;?>problemset.html">前往题库</a>
                </div>
        		<table class='table_list'>
        			<?php
                        foreach ($pblog_data as $row_tr) {
                            echo "<tr>";
                            foreach ($row_tr as $row_td) {
                                
                                echo $row_td;
                                
                            }
                        echo "</tr>";
                        }
                    ?>
        		</table>
        	</div>
        </div>
        <div class="col-lg-4">
            <div class="mod_blog mod_blogindex" style="margin-bottom: 20px;">
                <div class="head_blogindex">
                    <h4 class="head_blogindex_text">博主排名</h4>
                </div>
                <div class="row" style="width: 100%;">
                <table class='table_list'>
                    <?php
                        foreach ($blog_data_u as $row_tr) {
                            echo "<tr>";

                                echo $row_tr;

                        echo "</tr>";
                        }
                    ?>
                </table>
                </div>
            </div>
            <div class="mod_blog mod_blogindex" style="margin-bottom: 20px;">
                <div class="head_blogindex">
                    <h4 class="head_blogindex_text">本周热门</h4>
                </div>
                <div class="row" style="width: 100%;">
                <table class='table_list'>
                    <?php
                        foreach ($blog_data_r as $row_tr) {
                            echo "<tr>";
                            foreach ($row_tr as $row_td) {
                                
                                echo $row_td;
                                
                            }
                        echo "</tr>";
                        }
                    ?>
                </table>
                </div>
            </div>
            <div class="mod_blog mod_blogindex" style="margin-bottom: 20px;">
                <div class="head_blogindex">
                    <h4 class="head_blogindex_text">其他推荐</h4>
                </div>
                <div class="row" style="width: 100%;">
                <table class='table_list'>
                    <?php
                        foreach ($blog_data_ran as $row_tr) {
                            echo "<tr>";
                            foreach ($row_tr as $row_td) {
                                
                                echo $row_td;
                                
                            }
                        echo "</tr>";
                        }
                    ?>
                </table>
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
    <script src="<?php echo "/template/$OJ_TEMPLATE";?>/js/discuss.js"></script>

  </body>
</html>