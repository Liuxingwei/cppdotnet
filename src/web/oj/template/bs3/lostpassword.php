<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title><?php echo "密码找回 - C语言网";?></title>  
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
      <div class="container">
        <h1 class="text-center">密码找回</h1>
  <form action="lostpassword.php" method="post" class="form-horizontal col-lg-6 col-lg-offset-2" id="form">
    <div class="form-group">
        <label class="col-lg-5 control-label">用户名</label>
        <div class="col-lg-7"><input type="text" class="form-control" placeholder="要找回的用户名" name="user_id"></div>
    </div>
    <div class="form-group">
        <label class="col-lg-5 control-label">邮箱地址</label>
        <div class="col-lg-7"><input type="text" class="form-control" placeholder="绑定的邮箱地址" name="email"></div>
    </div>
    <div class="form-group">
        <label class="col-lg-5 control-label">验证码</label>
        <div class="col-lg-3"><input type="text" class="form-control" placeholder="" name="vcode" id="vcode" onkeydown="input_text_submit(event)"></div>
        <div class="col-lg-4"><img alt="click to change" src=vcode.php id="img_vcode" onclick="this.src='vcode.php?'+Math.random()"></div>
    </div>
    <div class="form-group">
        <div class="col-lg-offset-6 col-lg-4">
            <button type="button" class="btn btn-primary form-control" id="tijiao">提交</button>
        </div> 
    </div>
</form>
      

    </div> <!-- /container -->
    </div>
    <?php require("template/$OJ_TEMPLATE/footer.php") ?>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <?php include("template/$OJ_TEMPLATE/js.php");?>	    
    <script src="template/<?php echo $OJ_TEMPLATE;?>/js/loginpage.js"></script>
  </body>
</html>
