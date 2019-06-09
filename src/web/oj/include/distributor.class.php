<?php


class distributor
{

    public function getTopDistributors() {
        $sql = "SELECT * FROM promotion_code WHERE level = 1";
        $result = $this->getMysqli()->query($sql);
        return $result;
    }

}