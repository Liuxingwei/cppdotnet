<?php 
require_once("./include/db_info.inc.php");
require_once("./include/my_func.inc.php");
require_once("./lang/cn.php");

if(!isset($_SESSION['user_id'])){
    $view_errors="请<a href=/oj/loginpage.php>登录</a>后再进行此操作!";
    require("template/".$OJ_TEMPLATE."/error.php");
    exit(0);
}
$user_id=$_SESSION['user_id'];

?>
<html>
  <head>
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>我的订单 - C语言网</title>  
    <?php include("template/$OJ_TEMPLATE/css.php");?>       
    <link rel="stylesheet" type="text/css" href="/oj/template/<?php echo $OJ_TEMPLATE; ?>/css/payorder.css">
    <style type="text/css">
        .radio {
            font-size: 15px;
            border: 2px solid #DDD;
            width: 320px;
            margin: 10px;
            display: inline-block;
        }
        .radio label {
            width: 100%;
            padding: 10px;
            font-weight: bold;
            color: #666;
        }
        .radio_selected {
            border: 2px solid #3061FD;
        }
        .radio_amount {
            color: #DDD;
            font-weight: bold;
            float: right;
        }
        .radio_selected .radio_amount {
            color: #3061FD;
        }
        .text_l {
            width: 15%;
        }
        .img_tuijian {
            height: 35px;
            position: absolute;
            top: 3px;
            right: 60px;
            z-index: -1;
        }

        .radio_payway {
            float: left;
            width: 45%;
            height: 64px;
            margin: 0px 25px;
            padding: 20px;
            text-align: center;
            font-size: 16px;
            font-weight: bolder;
            color: #999;
            border: 1px solid #EEE;
            cursor: pointer;
        }
        .radio_way_selected {
            font-size: 20px;
            line-height: 22px;
            color: #555;
            box-shadow: 0px 0px 20px 1px #CCC;
        }
    </style>
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
                <div class="div_row div_row_first"><span class="text_head">订单确认</span></div>
                <div class="div_row">
                    <h4 style="font-weight: bold;color: #555">VIP学习系统福利</h4>
                    <p class="text_descrp">
                        1.不断更新的优质课程及题库优先学习；<br>
                        2.基于大数据分析的精准学习建议；<br>
                        3.一线工程师一对一精准答疑解惑；<br>
                        4.BAT级企业内推及就业指导；<br>
                        5.年报会员支持免费重修学会为止，立刻报名有额外福利，联系QQ854253552 Jarvis老师。
                    </p>
                </div>

                <div class="div_row" style="height: 105px">
                    <div id="radio_payway1" class="radio_payway">
                        在 线 支 付
                    </div>
                    <div id="radio_payway2" class="radio_payway">
                        使用充值码
                    </div>
                </div>

                <form id="paykey" name="paykey_check" action="/oj/paykey_success.php" method="post">
                    <div class="div_row" style="height: 75px;">
                        <span class="text_l" style="padding-top: 7px;float: left;">充 值 码：</span>
                        <input type="text" name="paykey" class="form-control" style="border: 1px solid #ccc;float: left;width: 50%;" />
                    </div>
                    <div class="div_row"><span class="text_l">购买用户：</span><?php echo $user_id; ?></div>
                    <div class="div_row_last">
                        <div style="float: right;"><button type="submit" class="btn btn-primary">确定</button></div>
                    </div>
                </form>

                <form id="payol" name="payorder_check" action="/vipmb/order_create/" method="post">
                <input type="hidden" name="promotion_code" value="<?=isset($_GET['ptcode'])?$_GET['ptcode']:''?>">
                <div class="div_row">
                    <span class="text_l">购买单价：</span>
                    <!-- <del style="color: #999;">原价￥199/月</del>　　　　 -->
                    <span style="font-weight: bold;color: #666">C语言：￥89/月　　　C++：￥139/月　　　算法课程：￥189/月</span>
                </div>
                <div class="div_row">
                    <?php
                    if (isset($_GET['subject']) && 'c' == $_GET['subject']) :
                    ?>
                    <div><span class="text_l">C语言课程：</span></div>
                    <!-- <div class="radio radio_selected">
                        <label>
                            <input style="display:none;" type="radio" name="vip_size" value="1m" checked>C语言网VIP会员1个月　<span class="radio_amount">￥149</span>
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input style="display:none;" type="radio" name="vip_size" value="3m">C语言网VIP会员3个月　(9折)<span class="radio_amount">￥399</span>
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input style="display:none;" type="radio" name="vip_size" value="6m">C语言网VIP会员6个月　(8折)<span class="radio_amount">￥719</span>
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input style="display:none;" type="radio" name="vip_size" value="12m">C语言网VIP会员12个月　(7折)<span class="radio_amount">￥1259</span>
                        </label>
                    </div> -->


                    <div class="radio">
                        <img class="img_tuijian" src="/oj/template/<?php echo $OJ_TEMPLATE; ?>/img/tuijian.gif">
                        <label>
                            <input type="hidden" name="vip_size" value="c-12m">C语言课程12个月　(5折)<span class="radio_amount">￥539</span>
                        </label>
                    </div>
                    <?php
                    elseif (isset($_GET['subject']) && 'cpp' == $_GET['subject']) :
                    ?>
                    <div><span class="text_l">C++课程：</span></div>
                    <div class="radio">
                        <img class="img_tuijian" src="/oj/template/<?php echo $OJ_TEMPLATE; ?>/img/tuijian.gif">
                        <label>
                            <input type="hidden" name="vip_size" value="cpp-12m">C++课程12个月　(5折)<span class="radio_amount">￥839</span>
                        </label>
                    </div>
                    <?php
                    elseif (isset($_GET['subject']) && 'suanfa' == $_GET['subject']) :
                    ?>
                    <div><span class="text_l">算法课程：</span></div>
                    <div class="radio">
                        <img class="img_tuijian" src="/oj/template/<?php echo $OJ_TEMPLATE; ?>/img/tuijian.gif">
                        <label>
                            <input type="hidden" name="vip_size" value="suanfa-12m">算法课程12个月　(5折)<span class="radio_amount">￥1139</span>
                        </label>
                    </div>
                    <?php
                    endif;
                    ?>
                </div>
                <div class="div_row"><span class="text_l">购买用户：</span><?php echo $user_id; ?></div>
                <div class="div_row_last">
                    <div style="float: right;"><!-- <span class="amount">￥90</span> -->
                        <input type="hidden" name="prom_subject" value="<?=$_GET['prom_subject']?>">
                        <button type="submit" class="btn btn-primary">提交订单</button>
                    </div>
                </div>
                </form>

            </div>
        </div><!-- /container -->
    </div> <!-- /wrap -->
     <?php require("template/$OJ_TEMPLATE/footer.php") ?>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <?php include("template/$OJ_TEMPLATE/js.php");?> 
    <script type="text/javascript">
        $(function(){
            $(".radio input").change(function(){
                $(":checked").parent().parent().addClass("radio_selected").siblings().removeClass("radio_selected");
            });
            $('.radio input').parent().parent().addClass('radio_selected');
            $("#payol").attr("hidden",false);
            $("#paykey").attr("hidden",true);
            $("#radio_payway1").addClass("radio_way_selected");
            $("#radio_payway1").click(function(){
                $("#radio_payway1").addClass("radio_way_selected");
                $("#radio_payway2").removeClass("radio_way_selected");
                $("#payol").attr("hidden",false);
                $("#paykey").attr("hidden",true);
            });
            $("#radio_payway2").click(function(){
                $("#radio_payway2").addClass("radio_way_selected");
                $("#radio_payway1").removeClass("radio_way_selected");
                $("#payol").attr("hidden",true);
                $("#paykey").attr("hidden",false);
            });
        });
    </script>      
  </body>
</html>