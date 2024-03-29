<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Database extends PDO {

    public $db;
    public $bind;
    protected $_fetchMode = PDO::FETCH_ASSOC;

    public function __construct() {
        try {
            parent::__construct("oci:dbname=" . DB_TNS, DB_USER, DB_PASS);
        } catch (PDOException $e) {
            echo "Tidak dapat menghubungi basis data.";
        }
    }

    public function select($sql, $array = array()) {
        $sth = $this->prepare($sql);
        foreach ($array as $key => $value) {
            $sth->bindValue("$key", $value);
        }
        $sth->execute();
        return $sth->fetchAll($this->_fetchMode);
    }

    public function update($table, $data, $where) {

        ksort($data);

        //var_dump($data);

        $field = null;
        foreach ($data as $key => $value) {
            $field .= "$key = :$key,";
        }

        $field = rtrim($field, ',');

        $wheres = null;
        if (is_array($where)) {
            $wheres = implode(' AND ', $where);
        } else {
            $wheres = $where;
        }

        $sql = "UPDATE $table SET $field WHERE $wheres";

        //echo $sql;
        $sth = $this->prepare($sql);

        foreach ($data as $key => $value) {
            $sth->bindValue(":$key", $value);
        }

        $sth->execute();
        $sth = $this->prepare("commit;");
        $sth->execute();

        return true;
    }

    public function insert($table, $data) {

        ksort($data);

        $fieldName = implode(',', array_keys($data));
        $fieldValue = implode(',:', array_keys($data));
        $fieldValue = ':' . $fieldValue;

        $sql = "INSERT INTO $table($fieldName) VALUES ($fieldValue)";

        $sth = $this->prepare($sql);
        //var_dump($sql);
        foreach ($data as $key => $value) {
            $sth->bindValue(":$key", $value);
        }

        $sth->execute();
        $sth = $this->prepare("commit;");
        $sth->execute();

        return true;
    }

    public function insert2($sql, $array = array()) {
        $sth = $this->prepare($sql);
        foreach ($array as $key => $value) {
            $sth->bindValue("$key", $value);
        }
        $sth->execute();
        $sth = $this->prepare("commit;");
        $sth->execute();
        return true;
    }

    public function delete($table, $where) {

        $sql = "DELETE FROM $table WHERE $where";

        $sth = $this->prepare($sql);
        $sth->execute();

        return true;
    }

    public function countRow($table) {
        $sql = "SELECT * FROM " . $table;
        $sth = $this->prepare($sql);
        $sth->execute();
        $return = count($sth->fetchAll($this->_fetchMode));
        return $return;
    }

    public function get_column_table($table) {
        $sql = "SHOW COLUMNS FROM " . $table;
        $data = $this->select($sql);
        return $data;
    }

}
