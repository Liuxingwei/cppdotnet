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
    <link rel="stylesheet" href="<?php echo $url_oj."template/$OJ_TEMPLATE";?>/css/blog.css">

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
    <div class="container" id="body">
    	<div class="row row_detail mod_blog">
            <div id="banner_detail">
                <h4 class="edit_head">　　发表新文章</h4>
            </div>
            <div class="blog_msg">
        		<form action="<?php echo $url_oj;?>post_blog.php" method="post" onsubmit="return isDismsgEmpty(this);" id="">
        			<div class="form-group">
        				<label for="">标题</label>
        				<input type="text" class="form-control" name="title" value="">
    				</div>
                    <div>
                    	<label for="">内容</label>
                        <script id="blog_edit" name="content" type="text/plain"></script>
                	</div>
                    <hr style="border:0px;"/>
                    <!-- <input name="id" type="text" value="<?php echo $id;?>" hidden> -->
                    <div style="clear:both;">
                       <div class="form-group pull-right"><button class="btn btn-primary">发表</button></div>
                    </div> 
                </form>
            </div>
    	</div> <!-- /row -->
    </div> <!-- /container -->
    </div> <!-- /wrap -->
    <?php require("template/$OJ_TEMPLATE/footer.php") ?>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <?php include("template/$OJ_TEMPLATE/js.php");?>   
    <script type="text/javascript" src="<?php echo $url_oj;?>ueditor/ueditor.config.js"></script>
    <script type="text/javascript" src="<?php echo $url_oj;?>ueditor/ueditor.all.js"></script>
    <script src="<?php echo $url_oj."template/$OJ_TEMPLATE";?>/js/discuss.js"></script>
    <script type="text/javascript">
        var ue = UE.getEditor('blog_edit',
        {
            pasteplain:true
        });
    </script>
  </body>
</html>