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
require_once dirname(__DIR__) . '/include/distribution.class.php';
$distribution = new Distribution();

if (isset($_POST['setting']) && $_POST['setting'] != '') {
    $distribution->setIfNeedVip($_POST['if_need_vip']);
    $distribution->setMaxLevel($_POST['max_level']);
    $distribution->setIfNeedSpecialTop($_POST['if_need_special_top']);
    $distribution->setRebateScheme($_POST['rebate_scheme']);
    $distribution->setRebateRatio($_POST['rebate_ratio']);
    $distribution->setDistributionPath($_POST['distribution_path']);
    $saveStatus = '分销设定保存成功';
}
require_once '../include/mysqli.php';

if (isset($_POST['deny_post']) && $_POST['deny_post'] == '1') {
    $denyDb = new DB();
    $denyDb->table('promotion_code');
    $denyDb->where('user_id = ?', array('user_id' => $_POST['user_id']));
    $denyDb->update(array('state' => 0));
}

if (isset($_POST['deny_post']) && $_POST['deny_post'] == '3') {
    $denyDb = new DB();
    $denyDb->table('promotion_code');
    $denyDb->where('user_id = ?', array('user_id' => $_POST['user_id']));
    $denyDb->update(array('state' => 1));
}

if (isset($_POST['deny_post']) && $_POST['deny_post'] == '2') {
    $promotionDb = new DB();
    $promotionDb->table('promotion_code');
    $promotionDb->where('user_id = ?', array('user_id' => $_POST['user_id']));
    $promotionCodes = $promotionDb->select();
    $deleteDb = new DB();
    $deleteDb->table('promotion_code');
    $deleteDb->where('user_id = ?', array('user_id' => $_POST['user_id']));
    $deleteDb->delete();

    foreach ($promotionCodes as $proCode) {
        if (!is_null($proCode['promotion_code'])) {
            removeDistributor($proCode['promotion_code'], $proCode['subject']);
        }
    }
}

if (isset($_POST['append_post'])) {
    $appendDb = new DB();
    $appendDb->table('promotion_code');
    $appendDb->insert(
        array(
            'user_id' => $_POST['user_id'],
            'create_time' => date('Y-m-d H:i:s')
        )
    );
}

$candidateDb = new DB();
$candidateDb->table('users');
$candidateWhere = 'NOT EXISTS (SELECT user_id FROM promotion_code WHERE users.user_id = promotion_code.user_id)';
if ($distribution->getIfNeedVip() == 1) {
    $candidateWhere .= " AND (users.vip_end >= '" . date('Y-m-d') . "' OR users.vip_end_cpp >= '" . date('Y-m-d') . "' OR users.vip_end_suanfa >= '" . date('Y-m-d') . "')";
}
$candidateParam = array();
if ($_GET['c_user_id']) {
    $candidateWhere .= " AND users.user_id like ?";
    $candidateParam['user_id'] = '%' . $_GET['c_user_id'] . '%';
}
$candidateDb->where($candidateWhere, $candidateParam);
$candidateDb->setPageLabel('p');
$candidates = $candidateDb->selectPage();

$db = new DB();
$db->table('promotion_code');
$db->where('level = ?', array('level' => 1));
$db->join('INNER JOIN users ON promotion_code.user_id = users.user_id');
$db->fields('promotion_code.*, users.nick, users.phone, users.email, users.reg_time');
$users = $db->selectPage();

function removeDistributor($promotionCode, $subject) {
    $selectDb = new DB();
    $selectDb->table('promotion_code');
    $selectDb->where('parent_code = ? AND subject =?', array('parent_code' => $promotionCode, 'subject' => $subject));
    $rows = $selectDb->select();
    if (count($rows) == 0) {
        return ;
    }
    foreach ($rows as $row) {
        $updateDb = new DB();
        $updateDb->table('promotion_code');
        $updateDb->where('parent_code = ? AND subject = ?', array('parent_code' => $promotionCode, 'subject' => $subject));
        $updateDb->update(array('level' => $row['level'] - 1));
        removeDistributor($row['promotion_code'], $subject);
    }
}

require_once 'distribution_setting.tpl.php';