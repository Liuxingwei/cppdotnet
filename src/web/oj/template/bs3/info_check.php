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
      #body table {
        width: 100%;
        border-collapse:collapse;
        border: 0;
      }
      #body td {
        text-align: center;
        font-size: 16px;
        line-height: 40px;
      }
      #body tr {
        background: #F5F5F5;
        border-bottom: : 1px solid #CCCCCC;
      }
      #body tr.tr_color {
        background: #E5E5E5;
      }

      #body h2 {
        text-align: center;
        padding: 5px;
      }
      #body p.p_info {
        color: red;
        font-size: 16px;
        padding-left: 10px;
      }
    </style>

    <title><?php echo "预约信息确认 - C语言网"?></title>  
    <?php include("template/$OJ_TEMPLATE/css.php");?>	    

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
    <div class="wrap" style="background-color:#E9EAEC;">
    <?php include("template/$OJ_TEMPLATE/nav.php");?>	    
      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron" style="background-color:#E9EAEC;">
        <div class="container" id="body">
          <div style="margin: auto;width: 700px;height: 580px;border: 5px solid #CCC;background: #FFF">
            <h2>个人信息确认</h2>
            <table>
              <tr class="tr_color"><td>用户名</td><td><?php echo htmlspecialchars($userid, ENT_QUOTES);?></td></tr>
              <tr><td>昵称</td><td><?php echo htmlspecialchars($nick, ENT_QUOTES);?></td></tr>
              <tr class="tr_color"><td>年龄</td><td><?php echo htmlspecialchars($age, ENT_QUOTES);?></td></tr>
              <tr><td>学校</td><td><?php echo htmlspecialchars($school, ENT_QUOTES);?></td></tr>
              <tr class="tr_color"><td>专业</td><td><?php echo htmlspecialchars($subject, ENT_QUOTES);?></td></tr>
              <tr><td>在职情况</td><td><?php echo htmlspecialchars($iswork, ENT_QUOTES);?></td></tr>
              <tr class="tr_color"><td>联系电话</td><td><?php echo htmlspecialchars($phone, ENT_QUOTES);?></td></tr>
              <tr><td>电子邮箱</td><td><?php echo htmlspecialchars($email, ENT_QUOTES);?></td></tr>
              <tr class="tr_color"><td>邮寄地址</td><td><?php echo htmlspecialchars($address, ENT_QUOTES);?></td></tr>
            </table>
            <p style="padding-top: 10px;" class="p_info">请检查个人信息的真实性和正确性，以免出现接收不到提醒邮件或比赛奖品等情况。</p><p class="p_info">若需修改信息请点击下面的按钮，修改后再尝试预约，信息没有问题则点击完成预约。</p>
            <div class="form-group">
                <a href="order.php?contest_id=<?php echo $contest_id ?>"><button type="button" id="tijiao" class="btn btn-primary col-lg-offset-4 light_blue">完成预约</button></a>
                <a href="modifypage.php"><button class="btn btn-default" type="reset" value="Reset" name="reset">修改信息</button></a>
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
  </body>
</html>