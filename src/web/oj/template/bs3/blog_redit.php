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
    	<div class="row row_detail mod_blog" style="width: 855px;">
            <div id="banner_detail">
                <h4 class="edit_head">　　重新编辑</h4>
            </div>
            <div class="blog_msg">
        		<form action="<?php echo $url_oj;?>post_blog.php" method="post" onsubmit="return isDismsgEmpty(this);" id="">
        			<div class="form-group">
        				<label for="">标题</label>
        				<input id="input_title" type="text" class="form-control" name="title" value="<?php echo str_replace('"','&quot;',$tmprow['title']);?>">
    				</div>
                    <?php
                        if ($tmprow['problem_id']==0) {}
                        else {
                    ?>
                    <div class="form-group">
                        <label class="control-label">语言</label>
                        <div class="form-group col-lg-2" style="float: none;padding-left: 0px;">
                            <select id="select_lang" name="language" class="form-control" onchange="func_select()">
                                <option value="0">C语言</option>
                                <option value="1">C++</option>
                                <option value="3">Java</option>
                                <option value="6">Python</option>
                                <option value="7">PHP</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <p style="font-size: 16px;"><input type="checkbox" name="hq" value="-1" style="width: 20px;height: 20px;vertical-align: bottom;"> 勾选此项申请成为优质题解</p>
                    </div>
                    <?php } ?>
                    <div>
                    	<label for="">内容</label>
                        <script id="blog_edit" name="content" type="text/plain"><?php echo $tmprow['content'];?></script>
                	</div>
                    <hr style="border:0px;"/>
                    <input name="blog_id" type="text" value="<?php echo $blog_id;?>" hidden>
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
        function func_select(){
            var langval = $('#select_lang').find("option:selected").text();
            $("#input_title").val("题解<?php echo $problem_id;?>：<?php echo str_replace('"','\"',$row->title);?> （"+langval+"描述）");
        }
    </script>

  </body>
</html>