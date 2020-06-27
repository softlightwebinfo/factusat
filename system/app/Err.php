<?php

    /**
     * Created by PhpStorm.
     * User: rafa
     * Date: 21/01/2017
     * Time: 15:01
     */
    class Err
    {
        private $error;

        public function __construct($code = null)
        {
            if (is_null($code)) {
                redirect("/");
            } else {
                if (!empty($code)) {
                    $this->error = $code;
                } else {
                    redirect("error/access");
                }
            }
        }

        public function build()
        {
            redirect("error/access/{$this->error}");
        }
    }

?>