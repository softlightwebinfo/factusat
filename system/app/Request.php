<?php

    /**
     * Created by PhpStorm.
     * User: rafa
     * Date: 10/09/2016
     * Time: 11:00
     */
    class Request
    {

        private $_modulo;
        private $_controlador;
        private $_metodo;
        private $_argumentos;
        private $_modules;
        private $_GET;

        public function __construct()
        {
            $modules = new Modules();
            $modules->_LoadModules();
            if (isset($_GET['url'])) {
                $url = filter_input(INPUT_GET, "url", FILTER_SANITIZE_URL);
                $url = explode("/", $url);
                # Todos los elementos que no sean validos en el array los va a eliminar
                $url = array_filter($url);

                # Preparacion de la aplicacion para modulos
                //1. modulo/controlador/metodo/argumentos
                //2. controlador/metodo/argumentos
                $this->_modules = $modules->getModules();
                $this->_modulo = strtolower(array_shift($url));

                if (!$this->_modulo) {
                    $this->_modulo = false;
                } else {
                    if (count($this->_modules)) {
                        if (!$modules->search($this->_modulo)) {
                            $this->_controlador = $this->_modulo;
                            $this->_modulo = false;
                        } else {
                            # El array_shift extrae el primer elemento y me lo devuelve
                            $this->_controlador = strtolower(array_shift($url));
                            if (!$this->_controlador) {
                                $this->_controlador = "index";
                            }
                        }
                    } else {
                        $this->_controlador = $this->_modulo;
                        $this->_modulo = false;
                    }
                }

                $metodo = strtolower(array_shift($url));
                $this->_metodo = str_replace("-", "", $metodo);

                $this->_argumentos = $url;
            }
            if (count($_GET) > 1) {
                foreach ($_GET as $key => $row) {
                    $url = filter_input(INPUT_GET, $key, FILTER_SANITIZE_URL);
                    if ($key == "url") {
                        continue;
                    }
                    $this->_GET[$key] = $url;
                }
            }
            if (!$this->_controlador) {
                $this->_controlador = DEFAULT_CONTROLLER;
            }
            if (!$this->_metodo) {
                $this->_metodo = "index";
            }
            if (!$this->_argumentos) {
                $this->_argumentos = array();
            }
        }

        public function getModulo()
        {
            return $this->_modulo;
        }

        public function get_controlador()
        {
            return $this->_controlador;
        }

        public function get_metodo()
        {
            return $this->_metodo;
        }

        public function get_argumentos()
        {
            return $this->_argumentos;
        }

        public function get($nombre)
        {
            if (isset($this->_GET[$nombre])) return $this->_GET[$nombre];
            return false;
        }

    }

?>
