<?php
    require_once("../oj/include/db_info.inc.php");
    require_once("../oj/include/my_func.inc.php");
    require_once("../oj/lang/cn.php");

    if(!isset($_SESSION['user_id'])){
        $view_errors="请<a href=/oj/loginpage.php>登录</a>后再进行此操作!";
        require("../oj/template/".$OJ_TEMPLATE."/error.php");
        exit(0);
    }

    $user_id=$_SESSION['user_id'];

    if (isset($_POST['paykey'])) {
        $paykey=$_POST['paykey'];
        //过滤特殊字符
        $paykey=$_POST['paykey'];
        $paykey=mysqli_real_escape_string($mysqli,$paykey);

        function replaceSpecialChar($strParam){
         $regex = "/\ |\/|\~|\!|\@|\#|\\$|\%|\^|\&|\*|\(|\)|\_|\+|\{|\}|\:|\<|\>|\?|\[|\]|\,|\.|\/|\;|\'|\`|\-|\=|\\\|\|/";
         return preg_replace($regex,"",$strParam);
        }
        $paykey = replaceSpecialChar($paykey);
        //
        $sql="SELECT * FROM `vip_paykey` WHERE `paykey`='$paykey'";
        $result=mysqli_query($mysqli,$sql);
        $row=mysqli_fetch_object($result);
        $row_cnt=mysqli_num_rows($result);
        mysqli_free_result($result);

        $end_time=$row->end_time;
        $status=$row->status;
        $amount=$row->amount;
        $type=$row->type;

        $now=date('Y-m-d H:i:s',time());

        if ($row_cnt==0 || $now>$end_time || $status!=1) {
            $view_errors="您输入的充值码无效或已被使用! <br> <h4 style='text-align: center;margin-top: 80px;'><a href='javascript:history.back()'><button class='btn btn-primary'>返回</button></a></h4>";
            require("../oj/template/".$OJ_TEMPLATE."/error.php");
            exit(0);
        }

        //VIP判断
        $now=time();

        switch ($type) {
            case 'c':
                $class_type="C语言VIP课程";
                $sql="SELECT `vip_end` FROM `users` WHERE `user_id`='$user_id'";
                break;
            case 'cpp':
                $class_type="C++VIP课程";
                $sql="SELECT `vip_end_cpp` FROM `users` WHERE `user_id`='$user_id'";
                break;
            case 'suanfa':
                $class_type="算法VIP课程";
                $sql="SELECT `vip_end_suanfa` FROM `users` WHERE `user_id`='$user_id'";
                break;
            
            default:
                # code...
                break;
        }
        $result=mysqli_query($mysqli,$sql);
        $row=mysqli_fetch_array($result);
        $vip_end=strtotime($row[0]);
        mysqli_free_result($result);

        $vip_addtime=$amount*2592000;
        
        if ($vip_end<$now) {
            $vip_end_new=date('Y-m-d H:i:s',($now+$vip_addtime));
        }
        else {
            $vip_end_new=date('Y-m-d H:i:s',($vip_end+$vip_addtime));
        }
        switch ($type) {
            case 'c':
                $sql="UPDATE `users` SET `vip_end` ='$vip_end_new' WHERE user_id='$user_id'";
                break;
            case 'cpp':
                $sql="UPDATE `users` SET `vip_end_cpp` ='$vip_end_new' WHERE user_id='$user_id'";
                break;
            case 'suanfa':
                $sql="UPDATE `users` SET `vip_end_suanfa` ='$vip_end_new' WHERE user_id='$user_id'";
                break;
            default:
                # code...
                break;
        }
        mysqli_query($mysqli,$sql) or die("未响应，请重试!\n");

        $sql="UPDATE `vip_paykey` SET `status`=0 WHERE `paykey`='".$paykey."'";
        mysqli_query($mysqli,$sql);
    }
    else {
        $view_errors="您输入的充值码无效或已被使用! <br> <h4 style='text-align: center;margin-top: 80px;'><a href='javascript:history.back()'><button class='btn btn-primary'>返回</button></a></h4>";
        require("../oj/template/".$OJ_TEMPLATE."/error.php");
        exit(0);
    }


?>
<!DOCTYPE html>
<html>
  <head>
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>会员充值码 - C语言网</title>  
    <?php include("template/$OJ_TEMPLATE/css.php");?>       
    <link rel="stylesheet" type="text/css" href="/oj/template/<?php echo $OJ_TEMPLATE; ?>/css/payorder.css">

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
            <div class="content_order">
                
                    <div class="div_row div_row_first">
                        <span class="text_head">会员充值码</span>
                        <p style="color: #666;font-size: 20px;font-weight: bold;padding: 20px 0px 0px 20px;">开通/续期成功。</p>
                    </div>
                    <div class="div_row"><span class="text_l">项　　目：</span><input value="<?php echo $class_type;?>" readonly="readonly" /></div>
                    <div class="div_row"><span class="text_l">会员期限：</span><input value="<?php echo $amount;?>个月" readonly="readonly" /></div>
                    <div class="div_row"><span class="text_l">到期时间：</span><input value="<?php echo $vip_end_new;?>" readonly="readonly" /></div>
                    <div class="div_row_last">
                        <div style="float: right;"><a href='/vipjoin/'><button type="button" class="btn btn-primary">确定</button></div>
                    </div>
                
            </div>
        </div><!-- /container -->
    </div> <!-- /wrap -->
     <?php require("template/$OJ_TEMPLATE/footer.php") ?>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <?php include("template/$OJ_TEMPLATE/js.php");?>      
  </body>
</html>