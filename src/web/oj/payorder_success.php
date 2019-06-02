<?php
	require_once("../oj/include/db_info.inc.php");
	require_once("../oj/include/my_func.inc.php");
	require_once("../oj/lang/cn.php");
    $pay=$_GET['pay'];

    if ($pay==0) {
        $view_errors="支付错误！请重试！";
        require("../oj/template/".$OJ_TEMPLATE."/error.php");
        exit(0);
    }
    else {
            if (isset($_GET['oid'])) {
            
                $order_id=$_GET['oid'];

                $sql="SELECT * FROM `order_vippay` WHERE `order_id`='$order_id'";
                $result=mysqli_query($mysqli,$sql);
                $row=mysqli_fetch_object($result);
                $user_id=$row->user_id;
                $goods=$row->goods;
                mysqli_free_result($result);
                $view_errors="支付成功！为用户".$user_id."成功开通：<br>".$goods."。<br><h4 style='text-align: center;margin-top: 140px;'><a href='/vipjoin/'>进入VIP学习系统</a>　　　　<a href='/'>返回首页</a></h4>";
                require("../oj/template/".$OJ_TEMPLATE."/error.php");
                exit(0);
            }
    }

?>