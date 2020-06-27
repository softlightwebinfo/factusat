<?php

/*
 * -------------------------------------
 * www.smartyhelpers.com
 * Framework 1.0.0 CWeb
 * Database.php
 * -------------------------------------
 */

class Database extends PDO
{

    public function __construct($host, $dbname, $user, $pass, $char)
    {
        $dato = array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES ' . $char,
            PDO::ATTR_PERSISTENT => true,
        );
//            $dato[PDO::ATTR_AUTOCOMMIT] = false;
        if (DEVELOPER) {
//            $dato[PDO::ATTR_ERRMODE] = PDO::ERRMODE_SILENT;
        }

        parent::__construct('mysql:host=' . $host . ';dbname=' . $dbname, $user, $pass, $dato);
        $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    /**
     * select
     * @param string $sql An SQL string
     * @param array $array Paramters to bind
     * @param constant $fetchMode A PDO Fetch mode
     * @return mixed
     */
    public function select($sql, $array = array(), $fetchMode = PDO::FETCH_ASSOC)
    {
        $sth = $this->prepare($sql);
        foreach ($array as $key => $value) {
            $sth->bindValue("$key", $value);
        }

        $sth->execute();
        return $sth->fetchAll($fetchMode);
    }

    /**
     * insert
     * @param string $table A name of table to insert into
     * @param array $data An associative array
     */
    public function insert($table, array $data)
    {
        ksort($data);

        $fieldNames = implode('`, `', array_keys($data));
        $fieldValues = ':' . implode(', :', array_keys($data));
        $sql = "INSERT INTO $table (`$fieldNames`) VALUES ($fieldValues)";

        $sth = $this->prepare($sql);
        foreach ($data as $key => $value) {
            $sth->bindValue(":$key", $value);
        }
        try {
            $r = $sth->execute();
        } catch (PDOException $e) {
            $r = $e->getMessage();
        }
        return $this->lastInsertId();
    }

    /**
     * update
     * @param string $table A name of table to insert into
     * @param string $data An associative array
     * @param string $where the WHERE query part
     */
    public function update(string $table, array $data, $where)
    {
        ksort($data);
        $fieldDetails = NULL;
        foreach ($data as $key => $value) {
            $fieldDetails .= "$key=:$key,";
        }
        $fieldDetails = rtrim($fieldDetails, ',');
        $sql = "UPDATE $table SET $fieldDetails WHERE $where";
        $sth = $this->prepare($sql);
        foreach ($data as $key => $value) {
            $sth->bindValue(":$key", $value);
        }
        try {
            $r = $sth->execute();
        } catch (PDOException $e) {
            $r = $e->getMessage();
        }
        return $r;
    }

    /**
     * delete
     *
     * @param string $table
     * @param string $where
     * @param integer $limit
     * @return integer Affected Rows
     */
    public function delete($table, $where, $limit = 1)
    {
        $sql = "DELETE FROM $table WHERE $where LIMIT $limit";
        return $this->exec($sql);
    }

    public function deleteAll($table, $where)
    {
        $sql = "DELETE FROM $table WHERE $where";
        return $this->exec($sql);
    }

    public function eliminar($table, $where, $limit = 1)
    {
        if ($this->query("UPDATE {$table} SET eliminado=1 WHERE {$where} LIMIT $limit")) {
            return true;
        } else {
            return false;
        }
    }

    public function getId($table, $id, $attr = "id", $select = "*")
    {
        try {
            $sql = "SELECT {$select} FROM {$table} WHERE {$attr}=?";
            $query = $this->prepare($sql);
            $query->execute(
                array($id)
            );
            $row = $query->fetch(PDO::FETCH_OBJ);
            return $row;
        } catch (PDOException $exception) {
            return array();
        }
    }

    public function selectAll($table, $where = array(), $order = array())
    {
        $attr = "";
        $orde = "";
        foreach ($where as $key => $row) {
            $con = $row->con ?? "=";
            $attr .= "({$key}{$con}'{$row->value}')";
        }
        foreach ($order as $key => $row) {
            $orde .= "{$key} {$row},";
        }
        $orde = trim($orde, ",");
        if (!empty($order)) {
            $orde = "ORDER BY {$orde}";
        } else {
            $orde = "";
        }
        if (count($where) > 0) {
            $sql = "SELECT * FROM {$table} WHERE {$attr} {$orde}";
            $query = $this->prepare($sql);
        } else {
            $sql = "SELECT * FROM {$table} {$orde}";
            $query = $this->prepare($sql);
        }
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function obtenerAll($table, $where = array(), $order = array())
    {
        $attr = "";
        $orde = "";
        foreach ($where as $key => $row) {
            $attr .= "({$key}'{$row}')";
        }
        foreach ($order as $key => $row) {
            $orde .= "$key {$row},";
        }
        $orde = trim($orde, ",");
        if (!empty($order)) {
            $orde = "ORDER BY {$orde}";
        } else {
            $orde = "";
        }
        if (count($where) > 0) {
            $sql = "SELECT * FROM {$table} WHERE {$attr} {$orde}";
            $query = $this->prepare($sql);
        } else {
            $sql = "SELECT * FROM {$table} {$orde}";
            $query = $this->prepare($sql);
        }
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function get($table, $where = array(), $orden = "and")
    {
        $attr = "";
        $orde = "";
        foreach ($where as $key => $row) {
            $attr .= "({$key}'{$row}') {$orden} ";
        }
        $attr = trim($attr, " {$orden} ");

        if (count($where) > 0) {
            $sql = "SELECT * FROM {$table} WHERE {$attr}";
            $query = $this->prepare($sql);
        } else {
            $sql = "SELECT * FROM {$table} LIMIT 1";
            $query = $this->prepare($sql);
        }
        $query->execute();
        $datos = $query->fetch(PDO::FETCH_OBJ);
        if (empty($datos)) {
            $datos = array();
        }
        return $datos;
    }

    public function insertRow($_table, $insertar)
    {
        ksort($insertar);
        $fieldNames = implode(', ', array_keys($insertar));
        $fieldValues = ':' . implode(', :', array_keys($insertar));
        $sql = "INSERT INTO $_table($fieldNames) VALUES ($fieldValues)";
        $sth = $this->prepare($sql);
        foreach ($insertar as $key => $value) {
            $sth->bindValue(":$key", $value);
        }
        try {
            $r = $sth->execute();
        } catch (PDOException $e) {
            $r = $e->getMessage();
            print_pre($e);
        }
        return $this->lastInsertId();
    }

    public function updateRows($_table, array $actualizar, array $filtro = array())
    {
        ksort($actualizar);
        $fieldDetails = NULL;
        $filtroDetails = NULL;
        foreach ($actualizar as $key => $value) {
            $fieldDetails .= "$key=:$key,";
        }
        $fieldDetails = rtrim($fieldDetails, ',');
        foreach ($filtro as $key => $value) {
            $filtroDetails .= " $key=:$key AND";
        }
        $filtroDetails = rtrim($filtroDetails, 'AND');
        if (!is_null($filtroDetails)) {
            $where = "WHERE " . $filtroDetails;
        } else {
            $where = null;
        }
        $sql = "UPDATE $_table SET $fieldDetails {$where}";
        $sth = $this->prepare($sql);
        foreach ($actualizar as $key => $value) {
            $sth->bindValue(":$key", $value);
        }
        foreach ($filtro as $key => $value) {
            $sth->bindValue(":$key", $value);
        }
        try {
            $r = $sth->execute();
        } catch (PDOException $e) {
            $r = $e->getMessage();
        }
        return $r;
    }

    public function deleteRows($table, $filtro)
    {
        if ($this->query("DELETE FROM {$table} WHERE {$filtro}")) {
            return true;
        } else {
            return false;
        }

    }

    public function truncateTable($table)
    {
        return $this->query("TRUNCATE {$table}");
    }
}

?>
