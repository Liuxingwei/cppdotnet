<?php
/* *
 * 功能：支付宝服务器异步通知页面
 * 版本：2.0
 * 修改日期：2017-05-01
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。

 *************************页面功能说明*************************
 * 创建该页面文件时，请留心该页面文件中无任何HTML代码及空格。
 * 该页面不能在本机电脑测试，请到服务器上做测试。请确保外部可以访问该页面。
 * 如果没有收到该页面返回的 success 信息，支付宝会在24小时内按一定的时间策略重发通知
 */

require_once 'config.php';
require_once 'pagepay/service/AlipayTradeService.php';

$arr=$_POST;
$alipaySevice = new AlipayTradeService($config); 
$alipaySevice->writeLog(var_export($_POST,true));
$result = $alipaySevice->check($arr);

/* 实际验证过程建议商户添加以下校验。
1、商户需要验证该通知数据中的out_trade_no是否为商户系统中创建的订单号，
2、判断total_amount是否确实为该订单的实际金额（即商户订单创建时的金额），
3、校验通知中的seller_id（或者seller_email) 是否为out_trade_no这笔单据的对应的操作方（有的时候，一个商户可能有多个seller_id/seller_email）
4、验证app_id是否为该商户本身。
*/

$out_trade_no =$_POST['out_trade_no'];
$total_amount =$_POST['total_amount'];

require_once("../oj/include/db_info.inc.php");
require_once("../oj/include/my_func.inc.php");
require_once("../oj/lang/cn.php");

$sql="SELECT * FROM `order_vippay` WHERE `order_id`='$out_trade_no'";
$result_oj=mysqli_query($mysqli,$sql);
$row=mysqli_fetch_object($result_oj);
$goods_id=$row->goods_id;
mysqli_free_result($result_oj);

$sql="SELECT * FROM `goods` WHERE `id_goods`='$goods_id'";
$result_oj=mysqli_query($mysqli,$sql);
$row=mysqli_fetch_object($result_oj);
$amount=$row->amount;
mysqli_free_result($result_oj);

if ($total_amount==$amount) {
	$ok=1;
}
else {
	$ok=0;
}

if($result&&$ok==1) {//验证成功
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//请在这里加上商户的业务逻辑程序代

	
	//——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
	
    //获取支付宝的通知返回参数，可参考技术文档中服务器异步通知参数列表
	
	//商户订单号

	$out_trade_no = $_POST['out_trade_no'];

	//支付宝交易号

	$trade_no = $_POST['trade_no'];

	//交易状态
	$trade_status = $_POST['trade_status'];


    if($_POST['trade_status'] == 'TRADE_FINISHED') {

		//判断该笔订单是否在商户网站中已经做过处理
			//如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
			//请务必判断请求时的total_amount与通知时获取的total_fee为一致的
			//如果有做过处理，不执行商户的业务程序
				
		//注意：
		//退款日期超过可退款期限后（如三个月可退款），支付宝系统发送该交易状态通知
    }
    else if ($_POST['trade_status'] == 'TRADE_SUCCESS') {
		//判断该笔订单是否在商户网站中已经做过处理
			//如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
			//请务必判断请求时的total_amount与通知时获取的total_fee为一致的
			//如果有做过处理，不执行商户的业务程序			
		//注意：
		//付款完成后，支付宝系统发送该交易状态通知

    	//异步脚本测试
		

		$sql="SELECT * FROM `order_vippay` WHERE `order_id`='$out_trade_no'";
		$result=mysqli_query($mysqli,$sql);
		$row=mysqli_fetch_object($result);
		$user_id=$row->user_id;
		$goods_id=$row->goods_id;
		mysqli_free_result($result);
		$sql="UPDATE `order_vippay` SET `status`='1' WHERE `order_id`='$out_trade_no'";
		mysqli_query($mysqli,$sql) or die(mysqli_error());



		switch ($goods_id) {
			case '100101':
				$vip_addtime=2592000;
				$goods_sub="c";
				break;
			case '100106':
				$vip_addtime=15552000;
				$goods_sub="c";
				break;
			case '100112':
				$vip_addtime=31104000;
				$goods_sub="c";
				break;
			case '200101':
				$vip_addtime=2592000;
				$goods_sub="cpp";
				break;
			case '200106':
				$vip_addtime=15552000;
				$goods_sub="cpp";
				break;
			case '200112':
				$vip_addtime=31104000;
				$goods_sub="cpp";
				break;
			case '300101':
				$vip_addtime=2592000;
				$goods_sub="suanfa";
				break;
			case '300106':
				$vip_addtime=15552000;
				$goods_sub="suanfa";
				break;
			case '300112':
				$vip_addtime=31104000;
				$goods_sub="suanfa";
				break;
			default:
				# code...
				break;
		}
		//VIP判断
		$now=time();

		if ($goods_sub=="c") {
			$sql="SELECT `vip_end` FROM `users` WHERE `user_id`='$user_id'";
			$result=mysqli_query($mysqli,$sql);
			$row=mysqli_fetch_object($result);
			$vip_end=strtotime($row->vip_end);
			mysqli_free_result($result);

			if ($vip_end<$now) {
				$vip_end_new=date('Y-m-d H:i:s',($now+$vip_addtime));
			    $sql="UPDATE users SET vip_end='$vip_end_new' WHERE user_id='".$user_id."'";
			    mysqli_query($mysqli,$sql) or die("未响应，请重试!\n");
			}
			else {
				$vip_end_new=date('Y-m-d H:i:s',($vip_end+$vip_addtime));
			    $sql="UPDATE users SET vip_end='$vip_end_new' WHERE user_id='".$user_id."'";
			    mysqli_query($mysqli,$sql) or die("未响应，请重试!\n");
			}
		}
		if ($goods_sub=="cpp") {
			$sql="SELECT `vip_end_cpp` FROM `users` WHERE `user_id`='$user_id'";
			$result=mysqli_query($mysqli,$sql);
			$row=mysqli_fetch_object($result);
			$vip_end=strtotime($row->vip_end_cpp);
			mysqli_free_result($result);

			if ($vip_end<$now) {
				$vip_end_new=date('Y-m-d H:i:s',($now+$vip_addtime));
			    $sql="UPDATE users SET vip_end_cpp='$vip_end_new' WHERE user_id='".$user_id."'";
			    mysqli_query($mysqli,$sql) or die("未响应，请重试!\n");
			}
			else {
				$vip_end_new=date('Y-m-d H:i:s',($vip_end+$vip_addtime));
			    $sql="UPDATE users SET vip_end_cpp='$vip_end_new' WHERE user_id='".$user_id."'";
			    mysqli_query($mysqli,$sql) or die("未响应，请重试!\n");
			}
		}
		if ($goods_sub=="suanfa") {
			$sql="SELECT `vip_end_suanfa` FROM `users` WHERE `user_id`='$user_id'";
			$result=mysqli_query($mysqli,$sql);
			$row=mysqli_fetch_object($result);
			$vip_end=strtotime($row->vip_end_suanfa);
			mysqli_free_result($result);

			if ($vip_end<$now) {
				$vip_end_new=date('Y-m-d H:i:s',($now+$vip_addtime));
			    $sql="UPDATE users SET vip_end_suanfa='$vip_end_new' WHERE user_id='".$user_id."'";
			    mysqli_query($mysqli,$sql) or die("未响应，请重试!\n");
			}
			else {
				$vip_end_new=date('Y-m-d H:i:s',($vip_end+$vip_addtime));
			    $sql="UPDATE users SET vip_end_suanfa='$vip_end_new' WHERE user_id='".$user_id."'";
			    mysqli_query($mysqli,$sql) or die("未响应，请重试!\n");
			}
		}
    }
	//——请根据您的业务逻辑来编写程序（以上代码仅作参考）——
	echo "success";	//请不要修改或删除
}else {
    //验证失败
    echo "fail";

}
?>