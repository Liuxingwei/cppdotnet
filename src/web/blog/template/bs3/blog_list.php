<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="C语言|C++|java|C语言入门|编程入门|C语言编程软件|C语言教程|OJ在线评测|编程比赛|学编程|C++教程|java教程|数据结构|蓝桥杯|ACM|算法入门|编程题库|题解博客|dotcpp网|C语言网
">
    <meta name="description" content="在这里，你可以分享你的解题经验，蓝桥杯或者是NOI/ACM的竞赛经验，分享你的程序人生！记录你的点滴成长！">
    <meta name="author" content="">
    <link rel="icon" href="/favicon.ico">

    <title><?php echo $view_title;?></title>  
    <script src="<?php echo "/template/$OJ_TEMPLATE/js/"?>echarts.js"></script>
    <?php include("template/$OJ_TEMPLATE/css.php");?>	    
    <link rel="stylesheet" href="<?php echo "/template/$OJ_TEMPLATE";?>/css/blog.css">

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
        
        <div class="col-lg-9">
            <div id="banner_list" style="width: 100%;">
                <h3 class="list_head">　　<?php 
                        $PID="ABCDEFGHIJKLMNOPQRSTUVWXYZ";
                        $id=$tmprow->problem_id;
                        if($pr_flag)echo "题解 ".$tmprow->problem_id.": ".$tmprow->title;
                        else echo "题解 ".$PID[$pid].": ".$tmprow->title;
                    ?></h3>
                    <br>
                    <span style="margin-left: 20px;line-height: 32px;">来看看其他人写的题解吧！要先自己动手做才会有提高哦！</span>　<br><br>
                    <span style="margin-left: 20px;">
                        <a href="<?php echo $url_oj;?>problem<?php echo $id;?>.html">返回题目</a>　|　<a target='_blank' href="/article/aedit<?php echo $id;?>">我来写题解</a>
                    </span>
            </div>
            <a style="display: block;color: #428bca;width: 100%;margin-bottom: 5px;" class="row mod_blog" href="<?php echo $url_oj_home;?>/vipjoin/">
                C语言网提供<span style="color: #fc596e;font-weight: bold;">「C语言、C++、算法竞赛」</span>在线课程，全部由研发工程师或ACM金牌退役选手亲自授课，以<span style="color: #fc596e;font-weight: bold;">视频+配套题目</span>的学练同步模式教学，强化动手，并提供增值服务！
            </a>
        	<div class="row mod_blog mod_c" style="width: 100%;">
        		<table class='table_list'>
        			<?php
                        foreach ($blog_data as $row_tr) {
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
        <div class="col-lg-3">
            <div class="mod_blog" style="margin-bottom: 20px;">
                <div style="padding: 20px;border-bottom: 1px solid #DDD;">
                    <h4 style="margin: 0px;">其他文章</h4>
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