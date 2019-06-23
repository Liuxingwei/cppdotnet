<?php
session_start();
if (!(isset($_SESSION['administrator']) || isset($_SESSION['problem_editor']) || isset($_SESSION['lowlevel_admin']))){
    echo "<a href='../loginpage.php'>先にログインしてください!</a>";
    exit(1);
}

require_once("../include/db_info.inc.php");

if (isset($OJ_LANG)) {
    require_once("../lang/$OJ_LANG.php");
}

require_once dirname(__DIR__) . '/include/mysqli.php';

$distributionDb = new DB();
$distributionDb->table('distribution_amount');
$distributionDb->fields('distribution_amount.*, goods.name_goods');
$where = "distribution_amount.user_id = ? and order_vippay.status = ?";
$distributionDb->join("inner join goods on distribution_amount.goods_id = goods.id_goods inner join order_vippay on distribution_amount.order_id = order_vippay.order_id");
$param = array('user_id' => $_GET['user_id'], 'status' => 1);
if ('unsettle' == $_GET['state']) {
    $where .= " and distribution_amount.settle_state = ?";
    $param['settle_state'] = 0;
} else if ('settled' == $_GET['state']) {
    $where .= " and distribution_amount.settle_state = ?";
    $param['settle_state'] = 1;
}
$distributionDb->where($where, $param);
$distributionList = $distributionDb->select();
?>
<?php
foreach($distributionList as $distribution):
?>
<tr>
    <td><?=$distribution['order_id']?></td>
    <td><?=$distribution['pay_user_id']?></td>
    <td><?=$distribution['order_amount']?></td>
    <td><?=$distribution['amount']?></td>
    <td><?=$distribution['name_goods']?></td>
    <td><?=$distribution['order_time']?></td>
    <td><?=$distribution['settle_state'] == 0 ? '未结算' : '已结算'?></td>
    <td><?=$distribution['settle_time']?></td>
</tr>
<?php
endforeach;