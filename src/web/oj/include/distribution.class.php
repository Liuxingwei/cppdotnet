<?php
/**
 * 分销类，暂时做成一个大一统的类，再视功能多寡拆分
 * @author liuxingwei matchless@163.com
 */

class Distribution
{
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

    /**
     * 初始化数据库访问链接、初始化数据库访问链接、分销配置
     */
    public function __construct() {
        $this->mysqli = $GLOBALS['mysqli'];
        $this->initOptions();
    }



    /**
     * 分销类的权限校验，判别指定id的用户是否有权限使用分销功能
     * @param $userId
     * @return boolean 有权限返回 true，无权限返回 false;
     */
    public function checkPermission ($userId) {
        if ($this->getIfNeedVip()) {
            $result = $this->mysqli->query("SELECT * FROM users WHERE user_id = '" + $userId + "'");
            $row = $result->fetch_assoc();
            $now = time();
            if (strtotime($row['vip_end']) < $now || strtotime($row['vip_end_cpp']) < $now ||strtotime($row['vip_end_suanfa']) < $now) {
                return false;
            }
        }
        if ($this->getMaxLevel() != 0) {
            if ($this->getLevel($userId) > $this->getMaxLevel()) {
                return false;
            }
        }
        return true;
    }

    /**
     * 获取用户的分销级别
     * @param $userId
     * @return int|object
     */
    public function getLevel($userId) {
        $result = $this->mysqli->query("SELECT level FROM promotion_code WHERE user_id = '" + $userId + "'");
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
    public function setIfNeedVip($need) {
        $this->options['if_need_vip'] = $need;
        $this->saveOptions();
    }

    /**
     * 获取是否需要VIP才可以分销
     * @return boolean
     */
    public function getIfNeedVip() {
        return isset($this->options['if_need_vip']) ? $this->options['if_need_vip'] : 0;
    }

    /**
     * 保存分销配置
     */
    private function saveOptions() {
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
    private function initOptions() {
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
    public function setMaxLevel($maxLevel) {
        $this->options['max_level'] = $maxLevel;
        $this->saveOptions();
    }

    /**
     * 获取分销最大级数
     * @return maxLevel
     */
    public function getMaxLevel() {
        return isset($this->options['max_level']) ? $this->options['max_level'] : 0;
    }

    /**
     * 设置分销结算（返利）方案）
     * @param $rebateScheme
     */
    public function setRebateScheme($rebateScheme) {
        $this->options['rebate_scheme'] = $rebateScheme;
        $this->saveOptions();
    }

    /**
     * 获取分销结算（返利）方案
     * @return rebate_scheme
     */
    public function getRebateScheme() {
        return isset($this->options['rebate_scheme']) ? $this->options['rebate_scheme'] : 0;
    }

    /**
     * 设置是否需要指定顶级分销商
     * @param $maxLevel
     */
    public function setIfNeedSpecialTop($need) {
        $this->options['if_need_special_top'] = $need;
        $this->saveOptions();
    }

    /**
     * 获取分销最大级数
     * @return if_need_special_top
     */
    public function getIfNeedSpecialTop() {
        return isset($this->options['if_need_special_top']) ? $this->options['if_need_special_top'] : 0;
    }

    /**
     * 设置分销返利比例
     * @param $rebateRatio
     */
    public function setRebateRatio($rebateRatio) {
        $this->options['rebate_ratio'] = $rebateRatio;
        $this->saveOptions();
    }

    public function getRebateRatio() {
        return isset($this->options['rebate_ratio']) ? $this->options['rebate_ratio'] : 0;
    }

    /**
     * 生成用户推广码
     * @param $userId
     * @return string
     */
    function generatePromotionCode($userId) {
        $md5 = md5($userId, true);
        $candidateChar = '0123456789ABCDEFGHIJKLMNOPQRSTUV';
        $promotionCode = '';
        for($position = 0; $position < 8; $position++) {
            $front = ord($md5[$position]);
            $promotionCode .= $candidateChar[($front ^ ord($md5[$position + 8])) - $front & 0x1F];
        }
        return $promotionCode;
    }

}