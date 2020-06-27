<?php

class provinciasController extends codeunicController
{

    private $_model;

    public function __construct()
    {
        parent::__construct();
//        if (!Session::get('autenticado')) {
//            $this->redireccionar('code-unic/login/');
//        }
        $this->_acl->sessionRol('Administrador');
        $this->_view->setTemplate('codeunic');
    }

    public function index()
    {
        $provinciasModel = new ProvinciasModel();
        $provincias = $provinciasModel->getAll();

        $this->_view->_listadoProvincias = $provincias;

        $this->_view->titulo = "Provincias | CodeUnic";
        $this->_view->page_title = "Provincias";
        $this->_view->page_subTitle = "Bienvenido al panel del administrador";
        $this->_view->no_header = false;
        $this->_view->meta_descripcion = "";
        $this->_view->renderizar("index", 'code-unic');
    }
}
