<?php

/**
 * Created by PhpStorm.
 * User: codeunic
 * Date: 13/07/2017
 * Time: 22:57
 */
abstract class Entity extends ORM
{

    public function __construct($table)
    {
        parent::__construct(new Database(DB_HOST, DB_NAME, DB_USER, DB_PASS, DB_CHAR), $table);
    }


    protected function rellenarLeft($string, int $character = 10)
    {
        $rellenar = str_pad($string, $character, 0, STR_PAD_LEFT);

        return $rellenar;
    }
}