<?php
/**
 * Created by PhpStorm.
 * User: codeunic
 * Date: 15/07/2017
 * Time: 0:56
 */

class ORM_Statement
{
    private $db = null;
    private $query = null;
    private $num_rows = 0;
    private $last_id = 0;
    private $result = 0;
    private $row = 0;

    public function __construct(Database $database, PDOStatement $query)
    {
        if (is_null($this->db)) {
            $this->db = $database;
        }
        $this->query = $query;
        $this->count();
    }

    private function count()
    {
        $this->query->execute();
        return $this->num_rows = $this->query->rowCount();
    }

    public function row()
    {
        $this->query->execute();
        $this->row = $this->query->rowCount();
        return $this->query->fetch(PDO::FETCH_OBJ);
    }

    public function result()
    {
        $this->query->execute();
        $this->result = $this->query->rowCount();
        return $this->query->fetchAll(PDO::FETCH_OBJ);
    }

    public function num_rows()
    {
        return $this->num_rows;
    }

    public function insert_last_id()
    {
        return $this->last_id = $this->db->lastInsertId();
    }

    public function object($object)
    {
        $this->query->execute();
        $this->result = $this->query->rowCount();
        return $this->query->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $object . "Entity");
    }

    public function objectRow($object, $entity = 'Entity')
    {
        $this->query->execute();
        $this->result = $this->query->rowCount();
        $q = $this->query->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $object . $entity);
        if(sizeof($q)){
            return $q[0];
        }
    }


    public function getQuery()
    {
        return $this->query->queryString;
    }

}