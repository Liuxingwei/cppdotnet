<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title><?php echo "修改资料 - C语言网";?></title>  
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
<form style="width: 80%;" action="modify.php" method="post" class="form-horizontal col-lg-8 col-lg-offset-2 modyfy-form" onsubmit="return nick_change_check()" id="form">
    <div class="form-group">
          <label for="" class="col-lg-2 control-label">用户名</label>
          <div class="col-lg-5"><input type="text" class="form-control" value="<?php echo $_SESSION['user_id']?>" disabled></div>
          <?php require_once('./include/set_post_key.php');?>
    </div>
<!--      <div class="form-group">
        <label for="" class="control-label col-lg-offset-4" style="color:orange">提示:昵称三个月内仅可修改一次.</label>
    </div>
    <?php if(!$nick_change){?>
      <div class="form-group">
        <label for="" class="control-label col-lg-offset-4" style="color:orange">下次改修改昵称的时间:<?php echo $next_nick_time;?>.</label>
      </div>
    <?php } ?> -->
    <div class="form-group">
          <label for="" class="col-lg-2 control-label">昵称</label>
          <div class="col-lg-5"><input type="text" <?php if(!$nick_change) echo 'readonly';?> id="nnick" name="nnick" class="form-control" value="<?php echo htmlentities($row->nick,ENT_QUOTES,"UTF-8")?>" placeholder="10字以下" maxlength="10"></div>
          <label for="" class="col-lg-4" id="nick_xx" style="color:orange;width: 36%;">提示:昵称三个月内仅可修改一次.
            <?php if(!$nick_change){?>
            <br/>下次改修改昵称的时间:<?php echo $next_nick_time;?>.
            <?php } ?></label>
    </div>
    <div class="form-group" hidden>
          <label for="" class="col-lg-2 control-label">昵称</label>
          <div class="col-lg-5"><input type="text" id="onick" name="onick" class="form-control" value="<?php echo htmlentities($row->nick,ENT_QUOTES,"UTF-8")?>" placeholder="10字以下" maxlength="10"></div>
          <label for="" class="col-lg-4 col-lg-4-reg" id="nick_xx"></label>
    </div>
    <!-- <div class="form-group">
          <label for="" class="col-lg-2 control-label">一句话简介</label>
          <div class="col-lg-5"><input type="text" name="oneword" class="form-control" placeholder="10字以下" size="10"></div>
    </div> -->
    <div class="form-group">
          <label for="" class="col-lg-2 control-label">签名</label>
          <div class="col-lg-5"><input type="text" name="user_sign" class="form-control" value="<?php echo htmlentities($row->user_sign,ENT_QUOTES,"UTF-8")?>" placeholder="30字以下" maxlength="90"></div>
    </div>
    <div class="form-group">
          <label for="" class="col-lg-2 control-label">自我简介</label>
          <div class="col-lg-5"><textarea class="form-control" rows="3" name="user_intro" placeholder="200字以下" maxlength="220"><?php echo htmlentities($row->user_intro,ENT_QUOTES,"UTF-8")?></textarea></div>
    </div>
    <div class="form-group">
          <label for="" class="col-lg-2 control-label">年龄</label>
          <div class="col-lg-5"><input type="text" class="form-control" placeholder="18" value="<?php echo $row->age;?>" name="age" maxlength="2"></div>
    </div>
    <div class="form-group">
          <label for="" class="col-lg-2 control-label">在职情况</label>
          <div class="col-lg-5">
            <select name="is_work" id="is_work" class="form-control">
              <option value="0" <?php if($row->is_work==0) echo 'selected';?>>学生</option>
              <option value="1" <?php if($row->is_work==1) echo 'selected';?>>在职</option>
              <option value="2" <?php if($row->is_work==2) echo 'selected';?>>待业</option>
            </select>
          </div>
    </div>
    <div class="form-group work_expand" hidden>
          <label for="" class="col-lg-2 control-label">行业</label>
          <div class="col-lg-5"><input type="text" name="work_field" value="<?php echo htmlentities($row->work_field,ENT_QUOTES,"UTF-8")?>" class="form-control" maxlength="20"></div>
    </div>
    <div class="form-group stu_expand">
          <label for="" class="col-lg-2 control-label">学校</label>
          <div class="col-lg-5"><input type="text" name="school" class="form-control" maxlength="20" value="<?php echo htmlentities($row->school,ENT_QUOTES,"UTF-8")?>"></div>
    </div>
    <div class="form-group stu_expand">
          <label for="" class="col-lg-2 control-label">专业</label>
          <div class="col-lg-5"><input type="text" name="subject" class="form-control" value="<?php echo htmlentities($row->subject,ENT_QUOTES,"UTF-8")?>" maxlength="15"></div>
    </div>
    <div class="form-group">
          <label for="" class="col-lg-2 control-label">邮箱</label>
          <div class="col-lg-5">
            <input type="text" name="oemail" id="oemail" value="<?php echo htmlentities($row->email,ENT_QUOTES,"UTF-8")?>" hidden>
            <input type="text" class="form-control" placeholder="30字以下" id="email" name="email" maxlength="30" value="<?php echo htmlentities($row->email,ENT_QUOTES,"UTF-8")?>">
            <?php if(isset($_SESSION['administrator'])) {
                if($row->mail_verify=='Y'){
              ?>
            <a href="#" class="btn btn-success" id="goverify" style="position:absolute;top:0px;left:75%;">已验证</a>
          <?php }else{ ?>
            <a href="verifymail.php" id="goverify" class="btn btn-warning" style="position:absolute;top:0px;left:75%;">去验证</a>
            <?php }} ?>
          </div>
          
    </div>
    <div class="form-group">
          <label for="" class="col-lg-2 control-label">电话/手机</label>
          <div class="col-lg-5"><input type="text" class="form-control" placeholder="" value="<?php echo htmlentities($row->phone,ENT_QUOTES,"UTF-8")?>" name="phone" maxlength="11"></div>
    </div>
    <div class="form-group">
          <label for="" class="col-lg-2 control-label">邮寄地址</label>
          <div class="col-lg-5"><input type="text" class="form-control" placeholder="用于邮寄比赛奖品" name="address" maxlength="90" value="<?php echo htmlentities($row->address,ENT_QUOTES,"UTF-8")?>"></div>
    </div>
    <div class="form-group">
        <label for="" class="col-lg-2 control-label">支付宝账号</label>
        <div class="col-lg-5"><input type="text" class="form-control" placeholder="输入支付宝账号" name="alipay_account" maxlength="20" value="<?=$row->alipay_account?>"></div>
        <label for="" class="col-lg-4" id="nick_xx" style="color:orange;width: 36%;line-height: 30px;">提示:用于分销收入提现。</label>
    </div>
    <div class="form-group">
        <label for="" class="col-lg-2 control-label">支付宝用户名</label>
        <div class="col-lg-5"><input type="text" class="form-control" placeholder="输入支付宝用户名" name="alipay_user" maxlength="20" value="<?=$row->alipay_user?>"></div>
        <label for="" class="col-lg-4" id="nick_xx" style="color:orange;width: 36%;line-height: 30px;">提示:用于分销收入提现。</label>
    </div>
    <div class="form-group">
          <label for="" class="col-lg-2 control-label">密码</label>
          <div class="col-lg-5"><input type="password" class="form-control" placeholder="输入当前密码" name="opassword" maxlength="20"></div>
          <label for="" class="col-lg-4" id="nick_xx" style="color:orange;width: 36%;line-height: 30px;">提示:请输入用户当前密码再保存信息.</label>
    </div>
    <div class="form-group">
          <button id="tijiao" class="btn btn-primary col-lg-offset-6 light_blue" type="button">保存</button>
    </div>
    </form>      
    </div> <!-- /container -->
    </div>
    <?php require("template/$OJ_TEMPLATE/footer.php") ?>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <?php include("template/$OJ_TEMPLATE/js.php");?>
    <script src="template/<?php echo $OJ_TEMPLATE;?>/js/modifypage2.js"></script>
  </body>
</html>
