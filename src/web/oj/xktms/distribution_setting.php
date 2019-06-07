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
    $saveStatus = '分销设定保存成功';
}

require_once 'distribution_setting.tpl.php';