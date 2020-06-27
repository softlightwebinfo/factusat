<?php

/**
 * Created by PhpStorm.
 * User: rafa
 * Date: 05/03/2017
 * Time: 15:46
 */
class Weather
{
    const API_ID = "athbrvpa8334";
    const API = "http://api.tiempo.com/index.phtml?api_lang=es&affiliate_id=" . self::API_ID;

    public function __construct()
    {
        echo self::API;
    }
}