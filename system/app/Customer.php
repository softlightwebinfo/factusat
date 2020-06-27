<?php

/**
 * Created by PhpStorm.
 * User: rafagonzalez
 * Date: 30/11/16
 * Time: 20:12
 */
class Customer
{
    private $_registry;
    private $_db;

    public function __construct()
    {
        $this->_registry = Registry::getInstancia();
        $this->_db = $this->_registry->_db;
    }
}