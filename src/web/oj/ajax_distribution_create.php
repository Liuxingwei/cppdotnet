<?php
/**
 * 生成分销链接
 */
session_start();
require_once('./include/db_info.inc.php');
require_once('./include/setlang.php');
require_once(__DIR__ . '/include/distribution.class.php');
$distribution = new Distribution();
if (!isset($_SESSION['user_id']) || $_SESSION['user_id'] =='') {
    $res = array(
        'code' => '1001',
        'message' => '未登录',
        'data' => null
    );
} else if (!isset($_GET['subject']) || '' == $_GET['subject']) {
    $res = array(
        'code' => '1002',
        'message' => '未指定科目',
        'data' => null
    );
} else if (!$distribution->checkPermission($_SESSION['user_id'])) {
    $res = array(
        'code' => '1003',
        'message' => '没有分销权限',
        'data' => null
    );
} else {
    if ($promotionInfo = $distribution->getPromotionCode($_SESSION['user_id'], $_GET['subject'])) {
        $res = array(
            'code' => '0',
            'message' => 'success',
            'data' => array(
                'url' => $distribution->createPromotionUrl($promotionInfo['promotion_code'], $_GET['subject'])
            )
        );
    } else if (isset($_GET['ptcode']) && $_GET['ptcode'] != '' && ($parentPromotion = $distribution->getParentPromotion($_GET['ptcode'], $_GET['subject']))) {
        $ptcode = $distribution->appendPromotion($_SESSION['user_id'], $_GET['ptcode'], $_GET['subject'], $parentPromotion['level'] + 1);
        $res = $res = array(
            'code' => '0',
            'message' => 'success',
            'data' => array(
                'url' => $distribution->createPromotionUrl($ptcode, $_GET['subject'])
            )
        );
    } else if ($distribution->getEmptyPromotion($_SESSION['user_id'])) {
        $ptcode = $distribution->updateEmptyPromotion($_SESSION['user_id'], $_GET['subject']);
        $res = $res = array(
            'code' => '0',
            'message' => 'success',
            'data' => array(
                'url' => $distribution->createPromotionUrl($ptcode, $_GET['subject'])
            )
        );
    } else {
        $ptcode = $distribution->appendPromotion($_SESSION['user_id'], '', $_GET['subject'], 1);
        $res = $res = array(
            'code' => '0',
            'message' => 'success',
            'data' => array(
                'url' => $distribution->createPromotionUrl($ptcode, $_GET['subject'])
            )
        );
    }
}
echo json_encode($res, JSON_UNESCAPED_UNICODE);