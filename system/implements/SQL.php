<?php

/**
 * Created by PhpStorm.
 * User: rafa
 * Date: 15/03/2017
 * Time: 22:25
 */
interface SQL
{
    public function getAll($datos=null);

    public function get(int $id);

    public function remove();

    public function update();

    public function create();

    public function getAllSelect();
}