<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title><?php echo "密码修改 - C语言网";?></title>  
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
	<!-- <form action="modify.php" method="post"> -->
<br><br>
<h1 class="text-center">个人资料</h1>
<form action="changepwd.php" method="post" class="form-horizontal col-lg-8 col-lg-offset-2">
    <div class="form-group">
          <label for="" class="col-lg-3 control-label">用户名</label>
          <div class="col-lg-5"><input type="text" class="form-control" value="<?php echo $_SESSION['user_id']?>" disabled></div>
          <label for="" class="col-lg-4" id="user_id_xx"></label>
          <?php require_once('./include/set_post_key.php');?>
    </div>
    <div class="form-group">
          <label for="" class="col-lg-3 control-label">旧密码</label>
          <div class="col-lg-5"><input type="password" class="form-control" placeholder="" name="opassword" maxlength="20"></div>
          <label for="" class="col-lg-4" id="opswd_xx"></label>
    </div>
    <div class="form-group">
          <label for="" class="col-lg-3 control-label">新密码</label>
          <div class="col-lg-5"><input type="password" class="form-control" placeholder="" id="npswd" name="npassword" maxlength="20"></div>
          <label for="" class="col-lg-4" id="npswd_xx"></label>
    </div>
    <div class="form-group">
          <label for="" class="col-lg-3 control-label">重复密码</label>
          <div class="col-lg-5"><input type="password" class="form-control" placeholder="" id="rpswd" name="rptpassword" maxlength="20"></div>
          <label for="" class="col-lg-4" id="rpswd_xx"></label>
    </div>
    <div class="form-group">
          <button class="btn btn-primary col-lg-offset-5 light_blue" type="submit">保存</button>
    </div>
    </form>

<!-- <tr><td>Old Password:
<td><input name="opassword" size=20 type=password>
</tr>
<tr><td>New Password:
<td><input name="npassword" size=20 type=password>
</tr>
<tr><td>Repeat New Password::
<td><input name="rptpassword" size=20 type=password>
</tr> -->
    </div> <!-- /container -->
    </div>
    <?php require("template/$OJ_TEMPLATE/footer.php") ?>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <?php include("template/$OJ_TEMPLATE/js.php");?>
    <script src="template/<?php echo $OJ_TEMPLATE;?>/js/changepassword.js"></script>
  </body>
</html>
