<?php

class DB {

    private $mysqli;

    private $fields;

    private $order;

    private $where;

    private $table;

    private $join;

    private $sql;

    private $params;

    private $count;

    private $pageSize = 25;

    private $page;

    private $totalPages;

    private $group;

    public function __construct()
    {
        $this->mysqli = $GLOBALS['mysqli'];
    }

    /**
     * @return mysqli
     */
    public function db() {
        return $this->mysqli;
    }

    public function fields($fields) {
        $this->fields = $fields;
        return $this;
    }

    public function order($order) {
        $this->order = $order;
        return $this;
    }

    public function where($where, $params = null) {
        if (!is_null($where) && $where !== '' && $where !== false) {
            $this->where = $where;
        } else {
            $this->where = null;
        }
        $this->params = $params;
        return $this;
    }

    public function table($table) {
        $this->table = $table;
        return $this;
    }

    public function join($join) {
        $this->join = $join;
        return $this;
    }

    public function insert($vals) {
        $this->sql = "INSERT INTO `" . $this->table . "` (";
        $fields = array();
        $placeholders = array();
        $values = array();
        foreach ($vals as $field => $value) {
            $fields[] = '`' . $field . '`';
            $placeholders[] = '?';
            $values[$field] = $value;
        }
        $this->sql .= implode(',', $fields) . ') VALUES(' . implode(',', $placeholders) . ')';
        $sth = $this->db()->prepare($this->sql);
        call_user_func_array(array($sth, 'bind_result'), $this->refValues($values));
        $res = $sth->execute();
        if (!$res) {
            return false;
        } else {
            $row = $sth->num_rows;
            if ($row != 1) {
                return false;
            } else {
                return $this->db()->insert_id;
            }
        }
    }

    public function update($vals) {
        $this->sql = "UPDATE `" . $this->table . "` SET";
        $replaces = array();
        $values = array();
        foreach ($vals as $field => $value) {
            $replaces[] = '`' . $field . '` = ?';
            $values[$field] = $value;
        }
        $this->sql .= implode(',', $replaces) . ' WHERE ' . $this->where;
        $sth = $this->db()->prepare($this->sql);
        $values = $values + $this->params;
        call_user_func_array(array($sth, 'bind_result'), $this->refValues($values));
        $res = $sth->execute();
        if (!$res) {
            return false;
        } else {
            $row = $sth->num_rows;
            if ($row >= 1) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function delete() {
        $this->sql = "DELETE FROM `" . $this->table . "`";
        if (!is_null($this->where)) {
            $this->sql .= ' WHERE ' . $this->where;
        }
        $sth = $this->db()->prepare($this->sql);
        $values = $this->params;
        call_user_func_array(array($sth, 'bind_result'), $this->refValues($values));
        $res = $sth->execute();
        if (!$res) {
            return false;
        } else {
            $row = $sth->num_rows;
            if ($row >= 1) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function selectOne() {
        if (is_null($this->fields)) {
            $this->fields = '*';
        }
        $this->sql = 'SELECT ' . $this->fields . ' FROM `' . $this->table . '`';

        if (!is_null($this->join)) {
            $this->sql .= ' ' . $this->join;
        }

        if (!is_null($this->where)) {
            $this->sql .= ' WHERE ' . $this->where;
        }

        $sth = $this->db()->prepare($this->sql);
        $values = $this->params;
        call_user_func_array(array($sth, 'bind_result'), $this->refValues($values));
        $sth->execute();
        $result = $sth->get_result();
        $res = $result->fetch_row();
        return $res;
    }

    public function select() {
        if (is_null($this->fields)) {
            $this->fields = '*';
        }
        $this->sql = 'SELECT ' . $this->fields . ' FROM `' . $this->table . '`';

        if (!is_null($this->join)) {
            $this->sql .= ' ' . $this->join;
        }

        if (!is_null($this->where)) {
            $this->sql .= ' WHERE ' . $this->where;
        }

        if (!is_null($this->group)) {
            $this->sql .= ' GROUP BY ' . $this->group;
        }

        if (!is_null($this->order)) {
            $this->sql .= ' ORDER BY ' . $this->order;
        }

        if (!is_null($this->page)) {
            $start = ($this->page - 1) * $this->pageSize;
            $offset = $this->pageSize;
            $this->sql .= ' LIMIT ' . $start . ',' . $offset;
        }

        $sth = $this->db()->prepare($this->sql);
        $values = $this->params;
        call_user_func_array(array($sth, 'bind_result'), $this->refValues($values));
        $sth->execute();
        $result = $sth->get_result();
        $res = $result->fetch_all();
        return $res;
    }

    public function setPageSize($pageSize) {
        $this->pageSize = $pageSize;
        return $this;
    }

    public function selectPage($page = 1) {
        $this->page = $page;
        $this->count();
        $this->calcPages();
        $result = $this->select();
        return $result;
    }

    public function count() {
        $sql = 'SELECT count(*) FROM `' . $this->table . '`';
        if (!is_null($this->where)) {
            $sql .= ' WHERE ' . $this->where;
        }
        $sth = $this->db()->prepare($sql);
        $values = $this->params;
        call_user_func_array(array($sth, 'bind_result'), $this->refValues($values));
        $sth->execute();
        $result = $sth->get_result();
        $res = $result->fetch_row();
        $this->count = $res[0];
        return $this;
    }

    public function calcPages() {
        $this->totalPages = ceil($this->count / $this->pageSize);
        return $this->totalPages;
    }

    public function totalPages() {
        return $this->totalPages;
    }

    public function page() {
        return $this->page;
    }

    public function totalRows() {
        return $this->count;
    }

    public function pageSize() {
        return $this->pageSize;
    }

    public function prev() {
        if ($this->page == 1) {
            return $this->page;
        } else {
            return $this->page - 1;
        }
    }

    public function next() {
        if ($this->page == $this->totalPages) {
            return $this->page;
        } else {
            return $this->page + 1;
        }
    }

    public function group($group)
    {
        $this->group = $group;
        return $this;
    }

    function refValues($arr){
        if (strnatcmp(phpversion(),'5.3') >= 0) //Reference is required for PHP 5.3+
        {
            $refs = array();
            foreach($arr as $key => $value)
                $refs[$key] = &$arr[$key];
            return $refs;
        }
        return $arr;
    }
}
