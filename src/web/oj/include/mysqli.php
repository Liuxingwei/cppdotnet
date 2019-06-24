<?php

class DB
{

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

    private $pageLabel = 'page';

    public function __construct()
    {
        $this->mysqli = $GLOBALS['mysqli'];
    }

    /**
     * @return mysqli
     */
    public function db()
    {
        return $this->mysqli;
    }

    /**
     * @param $fields string
     * @return $this
     */
    public function fields($fields)
    {
        $this->fields = $fields;
        return $this;
    }

    public function order($order)
    {
        $this->order = $order;
        return $this;
    }

    public function where($where, $params = null)
    {
        if (!is_null($where) && $where !== '' && $where !== false && !(is_array($where) && count($where) == 0)) {
            $this->where = $where;
        } else {
            $this->where = null;
        }
        $this->params = $params;
        return $this;
    }

    public function table($table)
    {
        $this->table = $table;
        return $this;
    }

    public function join($join)
    {
        $this->join = $join;
        return $this;
    }

    public function insert($vals)
    {
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
        if (!is_null($values) && count($values) != 0) {
            call_user_func_array(array($sth, 'bind_param'), $this->refValues($values));
        }
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

    public function update($vals)
    {
        $this->sql = "UPDATE `" . $this->table . "` SET ";
        $replaces = array();
        $values = array();
        foreach ($vals as $field => $value) {
            $replaces[] = '`' . $field . '` = ?';
            $values[$field] = $value;
        }
        $this->sql .= implode(',', $replaces) . ' WHERE ' . $this->where;
        $sth = $this->db()->prepare($this->sql);
        $values = $values + $this->params;
        if (!is_null($values) && count($values) != 0) {
            call_user_func_array(array($sth, 'bind_param'), $this->refValues($values));
        }
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

    public function delete()
    {
        $this->sql = "DELETE FROM `" . $this->table . "`";
        if (!is_null($this->where)) {
            $this->sql .= ' WHERE ' . $this->where;
        }
        $sth = $this->db()->prepare($this->sql);
        $values = $this->params;
        if (!is_null($values) && count($values) != 0) {
            call_user_func_array(array($sth, 'bind_param'), $this->refValues($values));
        }
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

    public function selectOne()
    {
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
        if (!is_null($values) && count($values) != 0) {
            call_user_func_array(array($sth, 'bind_param'), $this->refValues($values));
        }
        $sth->execute();
        $result = $sth->get_result();
        $res = $result->fetch_assoc();
        return $res;
    }

    public function select()
    {
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
        if (!is_null($values) && count($values) != 0) {
            call_user_func_array(array($sth, 'bind_param'), $this->refValues($values));
        }
        $sth->execute();
        $result = $sth->get_result();
        $res = array();
        while ($row = $result->fetch_assoc()) {
            $res[] = $row;
        };
        return $res;
    }

    public function setPageSize($pageSize)
    {
        $this->pageSize = $pageSize;
        return $this;
    }

    public function selectPage($page = null)
    {
        $this->page = !is_null($page) ? $page : isset($_GET[$this->getPageLabel()]) ?: 1;
        $this->count();
        $this->calcPages();
        $result = $this->select();
        return $result;
    }

    public function count()
    {
        $sql = 'SELECT count(*) total FROM `' . $this->table . '`';
        if (!is_null($this->join)) {
            $sql .= ' ' . $this->join;
        }

        if (!is_null($this->where)) {
            $sql .= ' WHERE ' . $this->where;
        }

        if (!is_null($this->group)) {
            $sql .= ' GROUP BY ' . $this->group;
        }
        $sth = $this->db()->prepare($sql);
        $values = $this->params;
        if (!is_null($values) && count($values) != 0) {
            call_user_func_array(array($sth, 'bind_param'), $this->refValues($values));
        }
        $sth->execute();
        $result = $sth->get_result();
        $this->count = 0;
        while ($row = $result->fetch_assoc()) {
            $this->count += $row['total'];
        }
        return $this;
    }

    public function calcPages()
    {
        $this->totalPages = (int)ceil($this->count / $this->pageSize);
        return $this->totalPages;
    }

    public function totalPages()
    {
        return $this->totalPages;
    }

    public function page()
    {
        return $this->page;
    }

    public function totalRows()
    {
        return $this->count;
    }

    public function pageSize()
    {
        return $this->pageSize;
    }

    public function prev()
    {
        if ($this->page == 1) {
            return $this->page;
        } else {
            return $this->page - 1;
        }
    }

    public function next()
    {
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

    private function refValues($arr)
    {
        if (is_null($arr)) {
            return null;
        }
        $refs = array();
        $i = 1;
        $refs[0] = '';
        foreach ($arr as $key => $value) {
            switch (gettype($value)) {
                case 'integer':
                    $refs[0] .= 'i';
                    break;
                case 'double':
                    $refs[0] .= 'd';
                    break;
                default:
                    $refs[0] .= 's';
            }
            $refs[$i] = &$arr[$key];
            $i++;
        }
        return $refs;
    }

    public function prevUrl()
    {
        return $this->pageUrl($this->prev());
    }

    public function nextUrl()
    {
        return $this->pageUrl($this->next());
    }

    public function pageUrl($page)
    {
        $protocol = strpos(strtolower($_SERVER['SERVER_PROTOCOL']), 'https') === false ? 'http' : 'https';
        $url = $protocol . '://';
        $url .= $_SERVER['HTTP_HOST'];
        $url .= $_SERVER['PHP_SELF'];
        $queryString = $_SERVER['QUERY_STRING'];
        $queryString = preg_replace('/&{0,1}page=[0-9]+/', '', $queryString);
        if ($queryString != '') {
            $queryString .= '&' . $this->getPageLabel() . '=' . $page;
        } else {
            $queryString = $this->getPageLabel() . '=' . $page;
        }
        $url .= '?' . $queryString;
        return $url;
    }

    public function setPageLabel($pageLabel)
    {
        $this->pageLabel = $pageLabel;
    }

    public function getPageLabel()
    {
        return $this->pageLabel;
    }

    public function pageFregment()
    {
        $fregment = '';
        if ($this->totalPages() > 1) {
            $fregment = '<div class="pagination"><ul><li><a href="' . $this->prevUrl() . '">&laquo;</a></li>';
            for ($i = 1; $i <= $this->totalPages(); $i++) {

                $fregment .= '<li' . ($_GET[$this->getPageLabel()] == $i ? ' class="active"' : '') . '><a href="' . $this->pageUrl($i) . '">' . $i . '</a></li>';
            }
            $fregment .= '<li><a href="' . $this->nextUrl() . '">&raquo;</a></li></ul></div>';
        }
        return $fregment;
    }
}
