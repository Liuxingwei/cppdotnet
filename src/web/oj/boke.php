<?php 
require_once('./include/db_info.inc.php');
require_once('./include/setlang.php');
$view_title="网站目录 - C语言网";

if (isset($_GET['sub'])) {
	$sub = $_GET['sub'];
}

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
	    <?php include("./template/$OJ_TEMPLATE/css.php");?>   
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
	    		word-wrap: break-word;
	    	}
	    	.list_tag_index a {
	    		margin-right: 10px;
	    	}
	    </style>
	</head>
	<body>
	    <div class="wrap">
	    <?php include("./template/$OJ_TEMPLATE/nav.php");?>	    
	      <!-- Main component for a primary marketing message or call to action -->
	    	<div class="container">

	    		<div class="mod_tag">
	    			<?php if ($sub == "normal") { 
	    				$sql="SELECT `blog_id`,`title` FROM `blog` WHERE `problem_id`=0 AND `status`=1 ORDER BY `post_time` DESC";
						$result=mysqli_query($mysqli,$sql) or die(mysqli_error());
						$blog_data=Array();
						$i=0;
						while ($row=mysqli_fetch_object($result)){
							$blog_data[$i]="<a href='/blog/".$row->blog_id.".html'>".$row->title."</a>";
							$i++;
						}
						mysqli_free_result($result);
    				?>
	        		<div class="head_tag">
	                    <h4 class="head_tag_text">个人博客</h4>
	                </div>
	        		<div class="list_tag_index">
	        		<?php
                        foreach ($blog_data as $row_a) { 
                                echo $row_a;
                        }
                    ?>
	                </div>
	                <?php } ?>

	        	</div>

	    	</div>
    	</div>
		<?php require("./template/$OJ_TEMPLATE/footer.php");?>
	    <!-- Bootstrap core JavaScript
	    ================================================== -->
	    <!-- Placed at the end of the document so the pages load faster -->
	    <?php include("./template/$OJ_TEMPLATE/js.php");?>   
	  </body>
</html>