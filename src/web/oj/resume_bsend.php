<?php
	$cache_time=10;
	$OJ_CACHE_SHARE=false;
	require_once('./include/cache_start.php');
    require_once('./include/db_info.inc.php');
	require_once('./include/setlang.php');

    if(!isset($_SESSION['user_id'])){ 
        echo "<meta http-equiv='Content-Type' content='text/html'; charset='utf-8'>";
        echo "<script charset='utf-8' >alert('请登录后进行此操作！')</script>";
        echo "<script charset='utf-8' language='javascript'>\n";
        echo "history.go(-1);\n";
        echo "</script>";
        exit(0);
    }
    $view_title="简历发送";
    $id=$_GET['id'];
    $user_id=$_SESSION['user_id'];
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
    <style type="text/css">
      #body h2 {
        text-align: center;
        padding: 5px;
      }
      #body p.p_info {
        font-size: 16px;
        padding-left: 50px;
        padding-top: 50px;
        margin: 50px;
      }
      .a_btn {
        margin: 20px;
      }
      div .div_button {
        text-align: center;
      }
    </style>
    <title><?php echo $view_title?></title>  
    <?php include("template/$OJ_TEMPLATE/css.php");?>
    <body>
    <div class="wrap" style="background-color:#E9EAEC;">
    <?php include("template/$OJ_TEMPLATE/nav.php");?>       
      <!-- Main component for a primary marketing message or call to action -->
    <div class="container" id="body">
        <div style="margin: auto;width: 700px;min-height: 300px;border: 1px solid #CCC;background: #FFF">
            <h2>提示</h2>
            <p class="p_info">若需查看或编辑简历，请点击下方“查看编辑简历”再尝试发送。</p>
            <div class="div_button">
                <a class="a_btn" href=resume.php?user_id=<?php echo $user_id;?>><button class="btn btn-primary light_blue">查看编辑简历</button></a>
                <a class="a_btn" href=resume_send.php?id=<?php echo $id;?>><button class="btn btn-primary light_blue">直接发送简历</button></a>
            </div>
          </div>
    </div>
    </div>
    <?php require("template/$OJ_TEMPLATE/footer.php") ?>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <?php include("template/$OJ_TEMPLATE/js.php");?>
  </body>
</html>