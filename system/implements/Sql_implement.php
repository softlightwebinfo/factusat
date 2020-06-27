<?php

/**
 * Created by PhpStorm.
 * User: rafa
 * Date: 12/03/2017
 * Time: 11:14
 */
interface Sql_implement
{
    public function create();

    public function update();

    public function get();

    public function delete();
}