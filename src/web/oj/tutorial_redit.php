<?php
////////////////////////////Common head
$cache_time=2;
$OJ_CACHE_SHARE=false;
require_once('./include/cache_start.php');
require_once('./include/db_info.inc.php');
require_once('./include/setlang.php');
require_once('./include/my_func.inc.php');

if(!isset($_SESSION['user_id'])){
    $_SESSION['prev_page']=curPageURL();
    // echo "<!-- ".$_SESSION['prev_page']." -->";
}

$url_oj="/oj/";
$view_title= "编辑教程 - C语言网";

if(!isset($_SESSION['administrator'])){
    $view_errors="无权操作!";
    require("template/".$OJ_TEMPLATE."/error.php");
    exit(0);
}
if(isset($_POST['class'])){
	$class_id=mysqli_real_escape_string($mysqli,$_POST['class']);
    $order_id=mysqli_real_escape_string($mysqli,$_POST['order_id']);
    $title=mysqli_real_escape_string($mysqli,$_POST['title']);
    $content=mysqli_real_escape_string($mysqli,$_POST['content']);
    $section=mysqli_real_escape_string($mysqli,$_POST['section']);
    $sql="UPDATE `tutorial` SET"
        ."`title`='".$title."',"
        ."`content`='".$content."',"
        ."`order_id`='".$order_id."',"
        ."`section`='".$section."'"
        ."WHERE `class_id`='".$class_id."'";
    mysqli_query($mysqli,$sql) or die("Update Error!\n");
    print "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />\n";
    print "<script>alert('修改成功!!!\\n');";
    print "history.go(-1);\n</script>";
    exit(0);
}
else {
	$class=intval($_GET['class']);
	$sql="SELECT * FROM `tutorial` WHERE `class_id`='".$class."'";
	$result=mysqli_query($mysqli,$sql) or die(mysqli_error());
	$class_data=mysqli_fetch_array($result);
	mysqli_free_result($result);
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
                <h4>
                    编辑教程
                </h4>
            </div>
            <div class="blog_msg">
        		<form action="#" method="post" onsubmit="return isDismsgEmpty(this);" id="">
        			<input name="class" type="text" value="<?php echo $class;?>" hidden>
        			<div class="form-group">
        				<label for="">标题</label>
        				<input id="input_title" type="text" class="form-control" name="title" value="<?php echo str_replace('"','&quot;',$class_data['title']);?>">
    				</div>
                    <div class="form-group">
                        <label for="">编号（C语言：1100+；　C++：2100+）</label>
                        <input id="input_title" type="text" class="form-control" name="order_id" value="<?php echo $class_data['order_id'];?>">
                    </div>
                    <div class="form-group">
                        <label for="">章节（C语言：100+；　C++：200+）</label>
                        <input id="input_title" type="text" class="form-control" name="section" value="<?php echo $class_data['section'];?>">
                    </div>
                    <div>
                    	<label for="">内容</label>
                        <script id="tutorial_edit" name="content" type="text/plain"><?php echo $class_data['content'];?></script>
                	</div>
                    <hr style="border:0px;"/>
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
        UE.Editor.prototype.placeholder = function (justPlainText) {
            var _editor = this;
            _editor.addListener("focus", function () {
                var localHtml = _editor.getPlainTxt();
                if ($.trim(localHtml) === $.trim(justPlainText)) {
                    _editor.setContent(" ");
                }
            });
            _editor.addListener("blur", function () {
                var localHtml = _editor.getContent();
                if (!localHtml) {
                    _editor.setContent(justPlainText);
                }
            });
            _editor.ready(function () {
                _editor.fireEvent("blur");
            });
        };
        var ue = UE.getEditor('tutorial_edit',
        {
            pasteplain:true
        });
    </script>

  </body>
</html>
<?php } ?>