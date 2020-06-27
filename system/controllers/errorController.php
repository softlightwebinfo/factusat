<?php

    class ErrorController extends Controller
    {
        private $_error;

        public function __construct()
        {
            parent::__construct();
        }

        public function index()
        {

            $error = $this->_view->segment(2);
            $this->_view->titulo = "Error";
            $this->_view->blank = true;
            $this->_view->classWrapper = "error-page";
            $this->_view->mensaje = $this->_getError();
            $this->_view->code = $this->_error;
            $this->_view->renderizar("access");
        }

        public function access($codigo)
        {
            $this->_view->titulo = "Error";
            $this->_view->blank = true;
            $this->_view->classWrapper = "error-page";
            $this->_view->mensaje = $this->_getError($codigo);
            $this->_view->code = $this->_error;
            $this->_view->renderizar("access");
        }

        public function danger($codigo)
        {
            $this->_view->titulo = "Error";
            $this->_view->mensaje = $this->_getError($codigo);
            $this->_view->blank = true;
            $this->_view->classWrapper = "error-page";
            $this->_view->code = $this->_error;
            $this->_view->renderizar($codigo);
        }

        private function _getError($codigo = false)
        {
            if ($codigo) {
                $codigo = $this->filtrarInt($codigo);
                if (is_int($codigo)) {
                    $codigo = $codigo;
                }
            } else {
                $codigo = "default";
            }
            $this->_error = $codigo;
            $error["default"] = "Ha occurrido un error y la página no puede mostrarse";
            $errpr['200'] = "Error en el login";
            $error["500"] = "INTERNAL SERVER ERROR.";
            $error["5050"] = "Forbidden access!";
            $error["404"] = "Esta pagina no existe o fue eliminada";
            $error["8080"] = "Tiempo de la sesion agotado!";
            if (array_key_exists($codigo, $error)) {
                return $error[$codigo];
            } else {
                return $error["default"];
            }
        }

    }
