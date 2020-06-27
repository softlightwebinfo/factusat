<?php

    /**
     * Created by IntelliJ IDEA.
     * User: rafa
     * Date: 23/01/2017
     * Time: 23:57
     */
    class Mensajes
    {
        private $contenido;
        private $mensaje;

        public function __construct($mensaje = null)
        {
            if (!empty($mensaje)) {
                $this->mensaje = $mensaje;
            }
        }

        /**
         * @return mixed
         */
        public function getContenido($attr)
        {

            if (isset($this->contenido[$attr])) {
                return $this->contenido[$attr];
            }

            return false;
        }

        /**
         * @param mixed $contenido
         */
        public function setContenido($attr, $contenido)
        {
            $this->contenido[$attr] = $contenido;
        }

        /**
         * @return null
         */
        public function getMensaje()
        {
            return $this->mensaje;
        }

        /**
         * @param null $mensaje
         */
        public function setMensaje($mensaje)
        {
            $this->mensaje = $mensaje;
        }

    }

?>