<?php

/**
 * Created by PhpStorm.
 * User: rafa
 * Date: 18/03/2017
 * Time: 12:29
 */
class DatabaseORM extends PDO
{
    public function __construct($host, $dbname, $user, $pass, $char)
    {
        parent::__construct('mysql:host=' . $host . ';dbname=' . $dbname, $user, $pass, array(
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES ' . $char,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_PERSISTENT => true)
        );
        return $this;
    }

    public function create()
    {

    }

    public function update()
    {

    }

    public function delete()
    {

    }

    public function select()
    {

    }
}