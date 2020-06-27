<?php

    /**
     * Created by PhpStorm.
     * User: rafa
     * Date: 04/02/2017
     * Time: 13:22
     */
    class Dates
    {
        private $date;

        public function __construct($date = "now")
        {
            $this->date = new DateTime($date);
        }

        public function format($format = "Y-m-d")
        {
            return $this->date->format($format);
        }

        public function getDate()
        {
            $date = $this->date;

            return $date;
        }

        private function getObjDate()
        {
            return $this->date;
        }
    }

?>