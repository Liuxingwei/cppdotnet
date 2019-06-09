<?php
require_once("../oj/include/db_info.inc.php");
require_once("../oj/include/my_func.inc.php");
require_once("../oj/lang/cn.php");

if (!isset($_SESSION['user_id'])) {
    $view_errors = "请<a href=/oj/loginpage.php>登录</a>后再进行此操作!";
    require("../oj/template/" . $OJ_TEMPLATE . "/error.php");
    exit(0);
}
$user_id = $_SESSION['user_id'];

if (isset($_POST['vip_size'])) {

    $vip_size = $_POST['vip_size'];

    $today_start = date('Y-m-d H:i:s', mktime(0, 0, 0, date("m"), date("d"), date("Y")));
    $today_end = date('Y-m-d H:i:s', mktime(23, 59, 59, date("m"), date("d"), date("Y")));
    $sql = "SELECT COUNT(1) AS today_count FROM `order_vippay` WHERE `pay_time`>='$today_start' AND `pay_time`<='$today_end'";
    $result = mysqli_query($mysqli, $sql);
    $row = mysqli_fetch_object($result);
    $today_count = $row->today_count;
    mysqli_free_result($result);
    $order_count = $today_count + 1001;
    $sNow_year = substr((string)date("Y"), 1);
    $sNow_month = (string)date("m");
    $sNow_date = (string)date("d");
    $sNow .= $sNow_year . $sNow_month . $sNow_date;

    $promotion_code = $_POST['promotion_code'];
    $pay_time = date('Y-m-d H:i:s', time());

    switch ($vip_size) {
        case 'c-1m':
            $pay_amount = "89";
            $goods = "VIP学习系统-C语言课程1个月";
            $goods_id = "100101";
            $order_id_sub = "1001";
            break;
        case 'c-6m':
            $pay_amount = "379";
            $goods = "VIP学习系统-C语言课程6个月";
            $goods_id = "100106";
            $order_id_sub = "1001";
            break;
        case 'c-12m':
            $pay_amount = "539";
            $goods = "VIP学习系统-C语言课程12个月";
            $goods_id = "100112";
            $order_id_sub = "1001";
            break;
        case 'cpp-1m':
            $pay_amount = "139";
            $goods = "VIP学习系统-C++课程1个月";
            $goods_id = "200101";
            $order_id_sub = "2001";
            break;
        case 'cpp-6m':
            $pay_amount = "589";
            $goods = "VIP学习系统-C++课程6个月";
            $goods_id = "200106";
            $order_id_sub = "2001";
            break;
        case 'cpp-12m':
            $pay_amount = "839";
            $goods = "VIP学习系统-C++课程12个月";
            $goods_id = "200112";
            $order_id_sub = "2001";
            break;
        case 'suanfa-1m':
            $pay_amount = "189";
            $goods = "VIP学习系统-算法课程1个月";
            $goods_id = "300101";
            $order_id_sub = "3001";
            break;
        case 'suanfa-6m':
            $pay_amount = "799";
            $goods = "VIP学习系统-算法课程6个月";
            $goods_id = "300106";
            $order_id_sub = "3001";
            break;
        case 'suanfa-12m':
            $pay_amount = "1139";
            $goods = "VIP学习系统-算法课程12个月";
            $goods_id = "300112";
            $order_id_sub = "3001";
            break;
        default:
            # code...
            break;
    }

    $order_id = $order_id_sub . $sNow . (string)$order_count;

    $sql = "SELECT COUNT(1) AS same_id FROM `order_vippay` WHERE `order_id`='$order_id'";
    $result = mysqli_query($mysqli, $sql);
    $row = mysqli_fetch_object($result);
    $same_id = $row->same_id;
    mysqli_free_result($result);
    if ($same_id != 0) {
        echo("<script type=\"text/javascript\">");
        echo("window.location.reload();");
        echo("</script>");
        /*$view_errors="非常抱歉，订单查询发现重复，请重试!".$order_id."数量".$same_id;
        require("../oj/template/".$OJ_TEMPLATE."/error.php");
        exit(0);*/

    }

    $sql = "INSERT INTO `order_vippay`(`order_id`,`user_id`,`pay_time`,`pay_amount`,`goods`,`goods_id`,`promotion_code`) VALUES('$order_id','$user_id','$pay_time','$pay_amount','$goods','$goods_id','$promotion_code')";
    $insert_result = mysqli_query($mysqli, $sql);
    if ($insert_result != 1) {
        echo("<script type=\"text/javascript\">");
        echo("window.location.reload();");
        echo("</script>");
        /*$view_errors="非常抱歉，订单插入出现错误，请重试!".$order_id;
        require("../oj/template/".$OJ_TEMPLATE."/error.php");
        exit(0);*/
    }

    header("location:/vipmb/order_pay/$order_id");
} else {
    $view_errors = "订单错误！请重新提交！";
    require("../oj/template/" . $OJ_TEMPLATE . "/error.php");
    exit(0);
}
?>