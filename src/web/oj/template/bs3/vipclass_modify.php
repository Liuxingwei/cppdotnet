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
    	
    		<div class="div_box_body1">
    		<p>添加课程</p>
    		</div>
    		<form style="width: 80%;" method="post" class="form-horizontal col-lg-8 col-lg-offset-2 job_release">
    			<div class="form-group" hidden>
			          <label for="" class="col-lg-2 control-label">编号</label>
			          <div class="col-lg-5"><input type="text" name="class" class="form-control" maxlength="15" value="<?php echo $class_id;?>"></div>
			    </div>
    			<div class="form-group">
			          <label for="" class="col-lg-2 control-label">编号</label>
			          <div class="col-lg-5"><input type="text" name="lock_id" class="form-control" maxlength="15" value="<?php echo $lock_id;?>"></div>
			    </div>
          <div class="form-group">
                <label for="" class="col-lg-2 control-label">章节</label>
                <div class="col-lg-5"><input type="text" name="section" class="form-control" maxlength="15" value="<?php echo $section;?>"></div>
          </div>
			    <div class="form-group">
			          <label for="" class="col-lg-2 control-label">标题</label>
			          <div class="col-lg-5"><input type="text" name="title" class="form-control" maxlength="30" value="<?php echo $title;?>"></div>
			    </div>
			    <div class="form-group">
			          <label for="" class="col-lg-2 control-label">视频地址</label>
			          <div class="col-lg-5"><input type="text" name="video" class="form-control" value="<?php echo $video;?>"></div>
			    </div>
			    <div class="form-group">
			          <label for="" class="col-lg-2 control-label">本课描述</label>
			          <div class="col-lg-5"><textarea class="form-control" rows="6" name="descrp"><?php echo htmlentities($descrp,ENT_QUOTES,"UTF-8");?></textarea></div>
			    </div>
			    <div class="form-group">
			          <label for="" class="col-lg-2 control-label">本课习题</label>
			          <div class="col-lg-5"><input type="text" name="problem" class="form-control" value="<?php echo $str_problem;?>"></div>
			    </div>
			    <div class="form-group">
			          <button class="btn btn-primary col-lg-offset-6 light_blue" type="submit">提交</button>
			    </div>
    		</form>
    	
	</div> <!-- /container -->
    </div> <!-- /wrap -->
<?php require("template/$OJ_TEMPLATE/footer.php");?>
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<?php include("template/$OJ_TEMPLATE/js.php");?>
  </body>
</html>