<?php 
require_once("./include/db_info.inc.php");
require_once("./include/my_func.inc.php");
require_once("./lang/cn.php");

$view_title = "企业信息编辑 - C语言网";

if(isset($_SESSION['user_id'])){
        $view_errors="无权操作！";
        require("template/".$OJ_TEMPLATE."/error.php");
        exit(0);
    }
if(!isset($_SESSION['user_cpn'])){
    $view_errors="企业用户<a href=loginpage_cpn.php>登录</a>后才能编辑信息!";
    require("template/".$OJ_TEMPLATE."/error.php");
    exit(0);
}

$cpnuser = $_SESSION['user_cpn'];
$sql="SELECT compname,phone,address,website,industry,stage,size FROM users_cpn where `cpnuser`='$cpnuser'";
$result=mysqli_query($mysqli,$sql) or die(mysqli_error());
$row = mysqli_fetch_array($result);

$compname = $row['compname'];
$phone = $row['phone'];
$address = $row['address'];
$website = $row['website'];
$industry = $row['industry'];
$stage = $row['stage'];
$size = $row['size'];

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

    <title><?php echo $view_title?></title>  
    <?php include("template/$OJ_TEMPLATE/css.php");
        echo "<link rel='stylesheet' href='template/$OJ_TEMPLATE/css/login.css'>";
    ?>      


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
        <div class="col-lg-3">
            <div class="content_box">
                <ul class="nav nav-stacked nav-pills text-center">
                    <li><p style="text-align: left;padding: 10px 15px;margin: 0;line-height: 30px;font-size: 16px;font-weight: bold;">公司信息管理</p></li>
                    <li><a href="/job/cpn">公司基本信息</a></li>
                    <li><a href="/oj/cpn_modify.php">编辑公司信息</a></li>
                    <li><a href="/oj/job_release.php">发布招聘信息</a></li>
                </ul>
            </div>
        </div>
        <div class="col-lg-9">
            <div class="content_box">

            <div class="div-login div-reg">
                <h1 class="text-center">企业信息编辑</h1>
                <br>    
                <form action="cpn_modify_sub.php" method="post" class="form-horizontal col-lg-8 col-lg-offset-2" id="form">
                    <div class="form-group">
                        <label for="" class="col-lg-3 col-lg-3-reg control-label">企业名称</label>
                         <div class="col-lg-5 col-lg-5-reg"><input type="text" name="compname" id="compname" class="form-control" value="<?php echo $compname?>"></div>
                         <label for="" class="col-lg-4 col-lg-4-reg" id="compname_xx"></label>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-lg-3 col-lg-3-reg control-label">联系电话</label>
                        <div class="col-lg-5 col-lg-5-reg"><input type="text" class="form-control" maxlength="30" placeholder="必填　座机请加上区号" name="phone" id="phone" value="<?php echo $phone?>"></div>
                        <label for="" class="col-lg-4 col-lg-4-reg" id="phone_xx"></label>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-lg-3 col-lg-3-reg control-label">公司地址</label>
                        <div class="col-lg-5 col-lg-5-reg"><input type="text" class="form-control" maxlength="50" placeholder="必填　具体至区县即可" name="address" id="address" value="<?php echo $address?>"></div>
                        <label for="" class="col-lg-4 col-lg-4-reg" id="address_xx"></label>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-lg-3 col-lg-3-reg control-label">官网地址</label>
                        <div class="col-lg-5 col-lg-5-reg"><input type="text" class="form-control" maxlength="30" name="website" id="website" value="<?php echo $website?>"></div>
                        <label for="" class="col-lg-4 col-lg-4-reg" id="website_xx"></label>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-lg-3 col-lg-3-reg control-label">所属行业</label>
                        <div class="col-lg-5 col-lg-5-reg"><input type="text" class="form-control" maxlength="30" placeholder="必填" name="industry" id="industry" value="<?php echo $industry?>"></div>
                        <label for="" class="col-lg-4 col-lg-4-reg" id="industry_xx"></label>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-lg-3 col-lg-3-reg control-label">发展阶段</label>
                        <div class="col-lg-5 col-lg-5-reg">
                        <select name="stage" id="stage">
                            <option value="0">请选择</option>
                            <option value="1" <?php if ($stage=="初创新星") echo "selected";?>>初创新星</option>
                            <option value="2" <?php if ($stage=="正在成长") echo "selected";?>>正在成长</option>
                            <option value="3" <?php if ($stage=="成熟发展") echo "selected";?>>成熟发展</option>
                            <option value="4" <?php if ($stage=="现已上市") echo "selected";?>>现已上市</option>
                        </select>
                        </div>
                        <label for="" class="col-lg-4 col-lg-4-reg" id="stage_xx"></label>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-lg-3 col-lg-3-reg control-label">企业规模</label>
                        <div class="col-lg-5 col-lg-5-reg">
                        <select name="size" id="size">
                            <option value="0" selected>请选择</option>
                            <option value="1" <?php if ($size=="15人以下") echo "selected";?>>15人以下</option>
                            <option value="2" <?php if ($size=="15人-50人") echo "selected";?>>15人-50人</option>
                            <option value="3" <?php if ($size=="50人-150人") echo "selected";?>>50人-150人</option>
                            <option value="4" <?php if ($size=="150人-500人") echo "selected";?>>150人-500人</option>
                            <option value="5" <?php if ($size=="500人-1500人") echo "selected";?>>500人-1500人</option>
                            <option value="6" <?php if ($size=="1500人以上") echo "selected";?>>1500人以上</option>
                        </select>
                        </div>
                        <label for="" class="col-lg-4 col-lg-4-reg" id="size_xx"></label>
                    </div>
                    <?php if($OJ_VCODE){ ?>
                    <div class="form-group">
                        <label for="" class="col-lg-3 col-lg-3-reg control-label">验 证 码</label>
                        <div class="col-lg-3 vcode-reg"><input type="text" class="form-control" id="vcode" name="vcode" maxlength="4"></div>
                        <img alt="换一张" id="img_vcode" src="vcode.php" onclick="this.src='vcode.php?+'+Math.random()" class="col-lg-2" height=30>
                    </div>
                    <?php }?>
                    <div class="form-group button-reg">
                        <button type="button" id="tijiao" class="btn btn-primary col-lg-offset-4 light_blue">提　　交</button>
                        <button id="chongzhi" class="btn btn-default" type="reset" value="Reset" name="reset">重　　置</button>
                    </div>
                </form>
            </div>
        </div>
        <br>

        </div>
    </div> <!-- /container -->
    </div> <!-- /wrap -->
    <?php require("template/$OJ_TEMPLATE/footer.php");?>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <?php include("template/$OJ_TEMPLATE/js.php");?>        
   <script src="template/<?php echo $OJ_TEMPLATE;?>/js/cpn_modify.js"></script>
  </body>
</html>