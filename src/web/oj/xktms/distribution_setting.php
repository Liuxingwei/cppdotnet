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

require_once 'distribution_setting.tpl.php';