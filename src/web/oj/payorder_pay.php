<?php
	require_once("../oj/include/db_info.inc.php");
	require_once("../oj/include/my_func.inc.php");
	require_once("../oj/lang/cn.php");

    if(!isset($_SESSION['user_id'])){
        $view_errors="请<a href=/oj/loginpage.php>登录</a>后再进行此操作!";
        require("../oj/template/".$OJ_TEMPLATE."/error.php");
        exit(0);
    }

    $order_id=$_GET['oid'];

    $sql="SELECT * FROM `order_vippay` WHERE `order_id`='$order_id'";
    $result=mysqli_query($mysqli,$sql);
    $row=mysqli_fetch_object($result);
    $user_id=$row->user_id;
    $pay_amount=$row->pay_amount;
    $goods=$row->goods;
    $pay_time=$row->pay_time;
    $status=$row->status;
    mysqli_free_result($result);
    $time_pay_time=strtotime($pay_time);
    $time_now=time();
    if ($status==-1 || $time_now-$time_pay_time>86400) {
    	/*$sql="UPDATE `order_vippay` SET `status`='-1' WHERE `order_id`=$order_id";
    	mysqli_query($mysqli,$sql) or die(mysqli_error());*/
    	$view_errors="该订单已过期或已删除!";
        require("../oj/template/".$OJ_TEMPLATE."/error.php");
        exit(0);
    }
    if ($status==1) {
    	$view_errors="该订单已完成支付!";
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

    <title>订单支付 - C语言网</title>  
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
        		<form name=alipayment action=/payorder/pagepay/pagepay.php method=post>
	                <div class="div_row div_row_first">
	                	<span class="text_head">订单支付</span>
	                	<p style="color: #666;font-size: 20px;font-weight: bold;padding: 20px 0px 0px 20px;">您的订单已提交！请完成支付。</p>
	                </div>
	                <div class="div_row"><span class="text_l">订单编号：</span><input id="WIDout_trade_no" name="WIDout_trade_no" readonly="readonly" /></div>
	                <div class="div_row"><span class="text_l">付费项目：</span><input id="WIDsubject" name="WIDsubject" readonly="readonly" /></div>
	                <div class="div_row"><span class="text_l">付款金额：</span><input id="WIDtotal_amount" name="WIDtotal_amount" readonly="readonly" style="width: 35px;" />元</div>
	                <div class="div_row"><span class="text_l">支付方式：</span><img src="/oj/template/<?php echo $OJ_TEMPLATE;?>/img/alipay_zffs.png">（支持花呗分期）</div>
	                <div class="div_row_last">
	                    <div style="float: right;"><span class="amount">￥<?php echo $pay_amount;?></span>　<button type="submit" class="btn btn-primary">付款</button></div>
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
		function GetDateNow() {
			document.getElementById("WIDout_trade_no").value = "<?php echo $order_id;?>";
			document.getElementById("WIDsubject").value = "<?php echo $goods;?>";
			document.getElementById("WIDtotal_amount").value = "<?php echo $pay_amount;?>";
		}
		GetDateNow();
    </script>  
  </body>
</html>