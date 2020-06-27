<?php

/**
 * Created by PhpStorm.
 * User: codeunic
 * Date: 15/07/2017
 * Time: 15:27
 */
interface SQL_model
{
    public function get($id);

    public function remove();

    public function update();

    public function create();

    public function getAll($datos);

    public function truncate();
}