<?php


class distributor
{
    private $mysqli;

    private function setMysqli()
    {
        $this->mysqli = $GLOBALS['mysqli'];
    }

    /**
     * @return mysqli
     */
    public function getMysqli()
    {
        return $this->mysqli;
    }

    public function __construct()
    {
        $this->setMysqli();
    }

    public function getTopDistributors() {
        $sql = "SELECT * FROM promotion_code WHERE level = 1";
        $result = $this->getMysqli()->query($sql);

    }

}