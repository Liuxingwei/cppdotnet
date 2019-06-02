<?php 
require_once('./include/db_info.inc.php');
require_once('./include/setlang.php');
$view_title="网站目录 - C语言网"
?>
<!DOCTYPE html>
<html lang="en">
	<head>
	    <meta name="renderer" content="webkit|ie-comp|ie-stand">
	    <meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <meta name="description" content="">
	    <meta name="author" content="">
	    <link rel="icon" href="../../favicon.ico">

	    <title><?php echo $view_title;?></title>   
	    <?php include("template/$OJ_TEMPLATE/css.php");?>   
	    <style type="text/css">
	    	.mod_tag {
	    		border-radius: 0px;
	    		border: 0px;
			    box-shadow: 0 1px 6px #ccc;
			    margin-bottom: 20px;
	    	}
	    	.head_tag {
	    		padding: 0px;
	    		border-bottom: 1px solid #DDD;
	    	}
	    	.head_tag_text {
	    		display: inline-block;
	    		margin: 0px 20px;
	    		padding: 15px 0px;
	    	}
	    	.list_tag_index {
	    		padding: 20px;
	    	}
	    	.list_tag_index a {
	    		margin-right: 10px;
	    	}
	    </style>
	</head>
	<body>
	    <div class="wrap">
	    <?php include("template/$OJ_TEMPLATE/nav.php");?>	    
	      <!-- Main component for a primary marketing message or call to action -->
	    	<div class="container">
	    		<div class="mod_tag">
	        		<div class="head_tag">
	                    <h4 class="head_tag_text">教程</h4>
	                </div>
	        		<div class="list_tag_index">
		                <a href="/course/c/">C语言教程</a>
		                <a href="/course/cpp/">C++教程</a>
		                <a href="/course/videoc/">C语言视频</a>
		                <a href="/course/vc6/">VC6编译器断点调试</a>
		                <a href="/course/bianyiqi/">编译器教程</a>
	                </div>
	        	</div>
	        	<div class="mod_tag">
	        		<div class="head_tag">
	                    <h4 class="head_tag_text">资源</h4>
	                </div>
	        		<div class="list_tag_index">
		                <a href="/wp/pro_life">程序人生</a>
		                <a href="/wp/learn_video">视频资源</a>
		                <a href="/wp/project_code">项目源码</a>
		                <a href="/wp/tech">技术专题</a>
		                <a href="/wp/experience">编程经验</a>
		                <a href="/wp/res_share">资源共享</a>
	                </div>
	        	</div>
	        	<div class="mod_tag">
	        		<div class="head_tag">
	                    <h4 class="head_tag_text">题库</h4>
	                </div>
	        		<div class="list_tag_index">
		                <a href="/oj/bianchenglianxi/">编程题库</a>
		                <a href="/oj/jisuanjierji/">计算机二级题库</a>
		                <a href="/oj/acm/">ACM题库</a>
		                <a href="/oj/oi/">NOIP试题</a>
		                <a href="/oj/pat/">PAT题库</a>
		                <a href="/oj/shujujiegou/">数据结构训练</a>
		                <a href="/oj/lanqiaobei/">蓝桥杯试题</a>
		                <a href="/oj/mingxiao/">名校训练</a>
	                </div>
	        	</div>
	        	<div class="mod_tag">
	        		<div class="head_tag">
	                    <h4 class="head_tag_text">编程比赛</h4>
	                </div>
	        		<div class="list_tag_index">
		        		<a href="/contest/main/">编程竞赛</a>
		                <a href="/contest/diy/">举办编程竞赛</a>
	                </div>
	        	</div>
	        	<div class="mod_tag">
	        		<div class="head_tag">
	                    <h4 class="head_tag_text">求职</h4>
	                </div>
	        		<div class="list_tag_index">
		                <a href="/job/cyuyan/">C语言开发</a>
		                <a href="/job/cpp/">C++开发</a>
		                <a href="/job/java/">Java开发</a>
		                <a href="/job/qianrushi/">嵌入式</a>
		                <a href="/job/jiagoushi/">架构师</a>
		                <a href="/job/suanfa/">算法工程师</a>
		                <a href="/job/qianduan/">前端开发</a>
		                <a href="/job/php/">PHP开发</a>
		                <a href="/job/dotnet/">.NET开发</a>
	                </div>
	        	</div>
	        	<div class="mod_tag">
	        		<div class="head_tag">
	                    <h4 class="head_tag_text">博客题解</h4>
	                </div>
	        		<div class="list_tag_index">
		                <a href="/blog/">个人博客</a>
		                <?php
		                	$sql="SELECT `problem_id`,`title` FROM `problem` WHERE `defunct`='N'";
		                	$result=mysqli_query($mysqli,$sql);
							$tijie_data=Array();
							$i=0;
							while ($row=mysqli_fetch_object($result)){
								$tijie_data[$i]="<a href='/blog/alist".$row->problem_id."/'>".$row->title."题解</a>";
								$i++;
							}
							mysqli_free_result($result);
							foreach ($tijie_data as $row_a) { 
                                echo $row_a;
                        	}
		                ?>
	                </div>
	        	</div>
        	</div>
    	</div>
		<?php require("template/$OJ_TEMPLATE/footer.php");?>
	    <!-- Bootstrap core JavaScript
	    ================================================== -->
	    <!-- Placed at the end of the document so the pages load faster -->
	    <?php include("template/$OJ_TEMPLATE/js.php");?>   
	  </body>
</html>