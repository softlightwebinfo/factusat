<?php

class generarPojosController extends codeunicController
{

    private $_model;

    public function __construct()
    {
        parent::__construct();
//        if (!Session::get('autenticado')) {
//            $this->redireccionar('code-unic/login/');
//        }
//        $this->_acl->sessionRol('Administrador');
        $this->_view->setTemplate('codeunic');
    }

    public function index()
    {
        $orm = ORM::generarPojos();
        echo "Pojos generados perfectamente";
    }
}
