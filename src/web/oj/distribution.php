<?php
$cache_time = 10;
$OJ_CACHE_SHARE = false;
require_once('./include/cache_start.php');
require_once('./include/db_info.inc.php');
require_once('./include/setlang.php');
require_once __DIR__ . '/include/mysqli.php';
require_once __DIR__ . '/include/distribution.class.php';
$view_title = "个人简历 - C语言网";

$user_id = $_GET['user_id'];

if (!isset($_SESSION['user_cpn']) && !isset($_SESSION['user_id'])) {
    $view_errors = "您尚未登录，请先<a href=loginpage.php>登录</a>！";
    require("template/" . $OJ_TEMPLATE . "/error.php");
    exit(0);
}
if (isset($_SESSION['user_cpn']) && $user_id == "") {
    $view_errors = "您所在用户组错误！";
    require("template/" . $OJ_TEMPLATE . "/error.php");
    exit(0);
}
if (isset($_SESSION['user_id']) && $user_id != $_SESSION['user_id'] && !isset($_SESSION['administrator'])) {
    $view_errors = "无权查看！";
    require("template/" . $OJ_TEMPLATE . "/error.php");
    exit(0);
}

$where = 'distribution_amount.user_id = ?';
$params = array('user_id' => $user_id);
if (isset($_POST['start_date']) && !empty($_POST['start_date'])) {
    $where .= ' and distribution_amount.order_time >= ?';
    $params['start_date'] = $_POST['start_date'] . ' 0:0:0';
}
if (isset($_POST['end_date']) && !empty($_POST['end_date'])) {
    $where .= ' and distribution_amount.order_time <= ?';
    $params['end_date'] = $_POST['end_date'] . ' 23:59:59';
}
$distributionDb = new DB();
$distributionDb->table('distribution_amount');
$distributionDb->fields('distribution_amount.*, order_vippay.goods');
$distributionDb->join('inner join order_vippay on distribution_amount.order_id = order_vippay.order_id');
$distributionDb->where($where, $params);
$distributionDb->order('settle_state asc');
$amounts = $distributionDb->select();

$total = 0;
$settled = 0;
$unsettle = 0;

$distribution = new Distribution();
$promotionCode = $distribution->generatePromotionCode($user_id);

$distributionDb = new DB();
$distributionDb->table('promotion_code');
$distributionDb->where('parent_code=?', array('parent_code' => $promotionCode));
$distributionDb->fields('count(*) distributors');
$res = $distributionDb->selectOne();
$distributors = $res['distributors'];
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

    <title><?php echo $view_title ?></title>
    <?php include("template/$OJ_TEMPLATE/css.php"); ?>
    <!-- <link rel="stylesheet" href="<?php echo $path_fix . "template/$OJ_TEMPLATE/css/" ?>job_detail.css"> -->
    <style type="text/css">
        .wrap {
            background: #FAFAFA;
        }

        .container .jumbotron {
            background: #FFF;
            padding: 0px;
            border-radius: 0px;
            border: 1px solid #DDD;
        }

        .head1 {
            font-size: 20px;
            line-height: 30px;
            margin: 0px;
            padding: 5px 15px;
            border-top: 1px solid #DDD;
            border-bottom: 1px solid #DDD;
            background: #E5ECF9;
            /*background: -webkit-linear-gradient(bottom, #F9F9F9 0%, #EDEDED 100%);
            background: -o-linear-gradient(bottom, #F9F9F9 0%, #EDEDED 100%);
            background: linear-gradient(to top, #F9F9F9 0%, #EDEDED 100%);
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=#F9F9F9,endColorstr=#EDEDED,GradientType=0);*/
        }

        .head1 span {
            font-size: 14px;
            float: right;
        }

        .head1_top {
            border-top: 0px;
        }

        .mod_detail {
            padding: 20px 30px;
            font-size: 16px;
            line-height: 45px;
        }
        .div-n-1 {
            padding-top: 10px;
            clear: both;
        }
        #table-list {
            width: 100%;
        }
    </style>
</head>
<body>
<div class="wrap">
    <?php include("template/$OJ_TEMPLATE/nav.php"); ?>
    <!-- Main component for a primary marketing message or call to action -->
    <div class="container" id="body">
        <div class="jumbotron">

            <div class="head1 head1_top">
                分销统计
            </div>
            <div class="mod_detail">
                <form method="post" id="search_form">
                    <label for="start_date">开始时间：</label><input id="start_date" type="date" name="start_date" value="<?=$_POST['start_date']?>" placeholder="请输入开始时间">
                    <label for="end_date">结束时间：</label><input id="end_date" type="date" name="end_date" value="<?=$_POST['end_date']?>" placeholder="请输入结束时间">
                    &nbsp;&nbsp;<button class="btn btn-primary">确定</button>&nbsp;&nbsp;<input type="button" id="clear_form" class="btn btn-default" value="清除">
                </form>
            </div>

            <div class="head1">
            </div>
            <div class="mod_detail">
                <table class="table-bordered table-condensed table-striped table-hover" id="table-list">
                    <thead>
                        <tr>
                            <th>订单号</th>
                            <th>分销收入（元）</th>
                            <th>订单金额（元）</th>
                            <th>下单人</th>
                            <th>下单时间</th>
                            <th>分销级数</th>
                            <th>结算状态</th>
                            <th>结算时间</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach($amounts as $amount) :
                        $total += $amount['amount'];
                        if (1 == $amount['settle_state']) {
                            $settled += $amount['amount'];
                        } else {
                            $unsettle += $amount['amount'];
                        }
                    ?>
                        <tr>
                            <td><?=$amount['order_id']?></td>
                            <td><?=$amount['amount']?></td>
                            <td><?=$amount['order_amount']?></td>
                            <td><?=$amount['pay_user_id']?></td>
                            <td><?=$amount['order_time']?></td>
                            <td><?=$amount['distribution_level']?></td>
                            <td><?=$amount['settle_state'] == 0 ? '未结算' : '已结算'?></td>
                            <td><?=$amount['settle_time']?></td>
                        </tr>
                    <?php
                    endforeach;
                    ?>
                    </tbody>
                </table>
            </div>
            <div class="head1 head1_top">
                汇总
            </div>
            <div class="mod_detail">
                <div class="div-n-1">
                    下级分销商：<?=$distributors?>（人）&nbsp;&nbsp;&nbsp;&nbsp;总收益：<?=$total?> （元）&nbsp;&nbsp;&nbsp;&nbsp;已结算收益：<?=$settled?>（元）&nbsp;&nbsp;&nbsp;&nbsp;待结算收益：<?=$unsettle?>（元）
                </div>
            </div>
        </div>
    </div>
</div>
<?php require("template/$OJ_TEMPLATE/footer.php") ?>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<?php include("template/$OJ_TEMPLATE/js.php"); ?>
<script>
    $(function () {
        $('#clear_form').click(function () {
            $('#start_date').val('');
            $('#end_date').val('');
            return false;
        })
    })
</script>
</body>
</html>