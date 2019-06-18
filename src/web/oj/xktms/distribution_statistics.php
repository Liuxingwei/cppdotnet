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

if (isset($_POST['post_settle']) && 1 == $_POST['post_settle']) {
    $settleDb = new DB();
    $settleDb->table('distribution_amount');
    $userIdArr = array();
    foreach($_POST['settle'] as $id) {
        $userIdArr[] = $id;
    }
    $userIds = "'" . implode("','", $userIdArr) . "'";
    $settleDb->where('user_id in (' . $userIds . ')', array());
    $settleDb->update(array('settle_state' => 1, 'settle_time' => date('Y-m-d H:i:s')));
}

$where = "order_vippay.status = 1";
$param = array();

if ($_GET['start_date'] != '') {
    $where .= " and order_time >= ?";
    $param['start_date'] = $_GET['start_date'];
}
if ($_GET['end_date'] != '') {
    $where .= " and order_time <= ?";
    $param['end_time'] = $_GET['end_date'];
}
/**
 * 总排行
 */
$totalDb = new DB();
$totalDb->table('distribution_amount');
$totalDb->group("distribution_amount.user_id");
$totalDb->order("total desc");
$totalDb->fields("distribution_amount.user_id, sum(amount) total");
$totalDb->join("inner join order_vippay on order_vippay.order_id = distribution_amount.order_id");
$totalDb->where($where, $param);
$totalDb->setPageLabel('tpage');
$totalList = $totalDb->selectPage();


/**
 * 未结算排行
 */
$unsettleDb = new DB();
$unsettleDb->table('distribution_amount');
$unsettleDb->group("distribution_amount.user_id");
$unsettleDb->order("total desc");
$unsettleDb->fields("distribution_amount.user_id, sum(amount) total");
$unsettleDb->join("inner join order_vippay on order_vippay.order_id = distribution_amount.order_id");
$unsettleWhere = $where . ' and settle_state = 0';
$unsettleDb->where($unsettleWhere, $param);
$unsettleDb->setPageLabel('upage');
$unsettleList = $unsettleDb->selectPage();

/**
 * 已结算排行
 */
$settledDb = new DB();
$settledDb->table('distribution_amount');
$settledDb->group("distribution_amount.user_id");
$settledDb->order("total desc");
$settledDb->fields("distribution_amount.user_id, sum(amount) total");
$settledDb->join("inner join order_vippay on order_vippay.order_id = distribution_amount.order_id");
$settledWhere = $where . ' and settle_state = 1';
$settledDb->where($settledWhere, $param);
$settledDb->setPageLabel('spage');
$settledList = $settledDb->selectPage();

/**
 * 一级分销商
 */
$distributorsDb = new DB();
$distributorsDb->table('promotion_code');
$distributorsDb->fields('distinct user_id, level');
$distributorsDb->where('level = ?', array('level' => 1));
$distributorsDb->count();
$distributors = $distributorsDb->totalRows();


require_once 'distribution_statistics.tpl.php';
