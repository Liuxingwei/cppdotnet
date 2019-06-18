<?php
/**
 * 分销类，暂时做成一个大一统的类，再视功能多寡拆分
 * @author liuxingwei matchless@163.com
 */

class Distribution
{

    const REBATE_SCHEME_TWOLEVEL = 0;
    const REBATE_SCHEME_ALLLEVEL = 1;
    /**
     * @var mysqli link resource
     */
    private $mysqli;

    /**
     * @var array 分销类配置项
     */
    private $options;

    /**
     * @var 配置文件路径
     */
    private $optionsFile = __DIR__ . '/distributions.json';

    private $urls;

    /**
     * 初始化数据库访问链接、初始化数据库访问链接、分销配置
     */
    public function __construct()
    {
        $this->mysqli = $GLOBALS['mysqli'];
        $this->initOptions();
        $this->urls = array(
            'c' => 'http://' . $_SERVER['HTTP_HOST'] . '/vipjoin/1001',
            'cpp' => 'http://' . $_SERVER['HTTP_HOST'] . '/vipjoin/2001',
            'suanfa' => 'http://' . $_SERVER['HTTP_HOST'] . '/vipjoin/3001',
        );
    }


    /**
     * 分销类的权限校验，判别指定id的用户是否有权限使用分销功能
     * @param $userId
     * @return boolean 有权限返回 true，无权限返回 false;
     */
    public function checkPermission($userId)
    {
        if ($this->getIfNeedVip()) {
            $result = $this->mysqli->query("SELECT * FROM users WHERE user_id = '" . $userId . "'");
            $row = $result->fetch_assoc();
            $now = time();
            if (strtotime($row['vip_end']) < $now || strtotime($row['vip_end_cpp']) < $now || strtotime($row['vip_end_suanfa']) < $now) {
                return false;
            }
        }
        if ($this->getMaxLevel() != 0) {
            if ($this->getLevel($userId) > $this->getMaxLevel()) {
                return false;
            }
        }
        if ($this->getState($userId) == 0) {
            return false;
        }
        return true;
    }

    /**
     * 获取用户状态
     * @param $userId
     * @return int|object
     */
    public function getState($userId)
    {
        $result = $this->mysqli->query("SELECT state FROM promotion_code WHERE user_id = '" . $userId . "'");
        if (0 == $result->num_rows) {
            return 1;
        }
        $state = $result->fetch_field();
        return $state;
    }

    /**
     * 获取用户的分销级别
     * @param $userId
     * @return int|object
     */
    public function getLevel($userId)
    {
        $result = $this->mysqli->query("SELECT level FROM promotion_code WHERE user_id = '" . $userId . "'");
        if (0 == $result->num_rows) {
            return 0;
        }
        $level = $result->fetch_field();
        return $level;
    }

    /**
     * 设置是否需要VIP才可以分销
     * @param $need boolean
     */
    public function setIfNeedVip($need)
    {
        $this->options['if_need_vip'] = $need;
        $this->saveOptions();
    }

    /**
     * 获取是否需要VIP才可以分销
     * @return boolean
     */
    public function getIfNeedVip()
    {
        return isset($this->options['if_need_vip']) ? $this->options['if_need_vip'] : 0;
    }

    /**
     * 保存分销配置
     */
    private function saveOptions()
    {
        $content = json_encode($this->options);
        file_put_contents($this->optionsFile, $content);
    }

    /**
     * 获取全部分销配置
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * 初始化分销配置项变量
     */
    private function initOptions()
    {
        if (file_exists($this->optionsFile)) {
            $content = file_get_contents($this->optionsFile);
            $this->options = json_decode($content, true);
        } else {
            $this->options = array();
        }
    }

    /**
     * 设置分销最大级数，如果为0，为不限制级数
     * @param $maxLevel
     */
    public function setMaxLevel($maxLevel)
    {
        $this->options['max_level'] = $maxLevel;
        $this->saveOptions();
    }

    /**
     * 获取分销最大级数
     * @return maxLevel
     */
    public function getMaxLevel()
    {
        return isset($this->options['max_level']) ? $this->options['max_level'] : 0;
    }

    /**
     * 设置分销结算（返利）方案）
     * @param $rebateScheme
     */
    public function setRebateScheme($rebateScheme)
    {
        $this->options['rebate_scheme'] = $rebateScheme;
        $this->saveOptions();
    }

    /**
     * 获取分销结算（返利）方案
     * @return int
     */
    public function getRebateScheme()
    {
        return isset($this->options['rebate_scheme']) ? $this->options['rebate_scheme'] : self::REBATE_SCHEME_TWOLEVEL;
    }

    /**
     * 设置是否需要指定顶级分销商
     * @param int
     */
    public function setIfNeedSpecialTop($need)
    {
        $this->options['if_need_special_top'] = $need;
        $this->saveOptions();
    }

    /**
     * 获取分销最大级数
     * @return int
     */
    public function getIfNeedSpecialTop()
    {
        return isset($this->options['if_need_special_top']) ? $this->options['if_need_special_top'] : 0;
    }

    /**
     * 设置分销返利比例
     * @param $rebateRatio
     */
    public function setRebateRatio($rebateRatio)
    {
        $this->options['rebate_ratio'] = $rebateRatio;
        $this->saveOptions();
    }

    public function getRebateRatio()
    {
        return isset($this->options['rebate_ratio']) ? $this->options['rebate_ratio'] : 0;
    }

    /**
     * 生成用户推广码
     * @param $userId
     * @return string
     */
    function generatePromotionCode($userId)
    {
        $md5 = md5($userId, true);
        $candidateChar = '0123456789ABCDEFGHIJKLMNOPQRSTUV';
        $promotionCode = '';
        for ($position = 0; $position < 8; $position++) {
            $front = ord($md5[$position]);
            $promotionCode .= $candidateChar[($front ^ ord($md5[$position + 8])) - $front & 0x1F];
        }
        return $promotionCode;
    }

    /**
     * 将推广码存入session
     */
    public function sentPromotionCodeToSession()
    {
        $ptcodeDb = new DB();
        $ptcodeDb->table('promotion_code');
        $ptcodeDb->where('promotion_code = ? AND state = 1', array('promotion_code' => $_GET['ptcode']));
        $ptcode = $ptcodeDb->selectOne();
        if ($ptcode) {
            $_SESSION['promotion_code'] = $ptcode['promotion_code'];
        }
    }

    /**
     * 获取指定用户指定科目的推广码
     * @param $userId 用户id
     * @param $subject 科目
     * @return array|bool|nullΩ
     */
    public function getPromotionCode($userId, $subject)
    {
        $db = new DB();
        $db->table('promotion_code');
        $db->where('user_id = ? AND subject = ?', array('user_id' => $userId, 'subject' => $subject));
        $row = $db->selectOne();
        if ($row) {
            return $row;
        } else {
            return false;
        }
    }

    /**
     * 创建推广链接
     * @param $promotionCode 推广码
     * @param $subject 科目
     * @return string 推广链接
     */
    public function createPromotionUrl($promotionCode, $subject)
    {
        $url = $this->urls[$subject] . '/' . $promotionCode;
        return $url;
    }

    /**
     * 获取指定科目、推广码
     * @param $promotionCode
     * @param $subject
     * @return array|bool|null
     */
    public function getParentPromotion($promotionCode, $subject)
    {
        $db = new DB();
        $db->table('promotion_code');
        $db->where('promotion_code = ? AND subject = ?', array('promotion_code' => $promotionCode, 'subject' => $subject));
        $row = $db->selectOne();
        if ($row) {
            return $row;
        } else {
            return false;
        }
    }

    /**
     * 获取空推广码的用户推广信息
     * @param $userId
     * @return array|bool|null
     */
    public function getEmptyPromotion($userId) {
        $db = new DB();
        $db->table('promotion_code');
        $db->where('user_id = ? AND promotion_code IS NULL', array('user_id' => $userId));
        $row = $db->selectOne();
        if ($row) {
            return $row;
        } else {
            return false;
        }
    }

    /**
     * 使用指定用户指定科目更新其空的推广码信息
     * @param $userId
     * @param $subject
     * @return string
     */
    public function updateEmptyPromotion($userId, $subject) {
        $db = new DB();
        $promotionCode = $this->generatePromotionCode($userId);
        $db->table('promotion_code');
        $db->where('user_id = ? AND promotion_code IS NULL', array('user_id' => $userId));
        $db->update(array('promotion_code' => $promotionCode, 'subject' => $subject));
        return $promotionCode;
    }

    /**
     * 追加推广信息
     * @param $userId
     * @param $parentPromotionCode
     * @param $subject
     * @param $level
     * @return string
     */
    public function appendPromotion($userId, $parentPromotionCode, $subject, $level) {
        $db = new DB();
        $db->table('promotion_code');
        $promotionCode = $this->generatePromotionCode($userId);
        $db->insert(array(
            'user_id' => $userId,
            'promotion_code' => $promotionCode,
            'parent_code' => $parentPromotionCode,
            'subject' => $subject,
            'level' => $level,
            'create_time' => date('Y-m-d H:i:s')
        ));
        return $promotionCode;
    }

    /**
     * 计算分销收益
     * @param $orderId
     * @param $amount
     * @param $payUserId
     * @param $promotionCode
     * @param $goodsId
     * @param $times int 递归次数，不设置则为1
     * @return bool
     */
    public function calaPromotionProfit($orderId, $amount, $payUserId, $promotionCode, $goodsId, $times = 1){
        $goodsSubjectDb = new DB();
        $goodsSubjectDb->table('goods_subject');
        $goodsSubjectDb->where('goods_id = ?', array('goods_id' => $goodsId));
        $goodsSubject = $goodsSubjectDb->selectOne();
        if (is_null($goodsSubject)) {
            return false;
        }
        $promotionDb = new DB();
        $promotionDb->table('promotion_code');
        $promotionDb->where('promotion_code = ? AND subject = ?', array('promotion_code' => $promotionCode, 'subject' => $goodsSubject['subject']));
        $promotion = $promotionDb->selectOne();
        if (is_null($promotion)) {
            return true;
        }
        $distributionAmountDb = new DB();
        $distributionAmountDb->table('distribution_amount');
        $distributionAmountDb->insert(array(
            'user_id' => $promotion['user_id'],
            'order_id' => $orderId,
            'order_amount' => $amount,
            'pay_user_id' => $payUserId,
            'amount' => (int) $amount * $this->getRebateRatio(),
            'distribution_level' => $promotion['level'],
            'goods_id' => $goodsId,
            'order_time' => date('Y-m-d H:i:s')
        ));
        if (($this->getRebateScheme() == self::REBATE_SCHEME_TWOLEVEL && 2 == $times) || is_null($promotion['parent_code']) || empty($promotion['promotion_code']) ) {
            return true;
        }
        return $this->calaPromotionProfit($orderId, $amount, $payUserId, $promotion['parent_code'], $goodsId, $times + 1);
    }
}