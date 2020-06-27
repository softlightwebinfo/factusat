<?php

class municipiosController extends codeunicController
{

    private $_model;

    public function __construct()
    {
        parent::__construct();

        $this->_acl->sessionRol('Administrador');
        $this->_view->setTemplate('codeunic');
    }

    public function index()
    {
        $municipiosModel = new MunicipiosModel();
        $municipios = $municipiosModel->getAll();

        $this->_view->_listadoMunicipios = $municipios;

        $this->_view->titulo = "Provincias | CodeUnic";
        $this->_view->page_title = "Provincias";
        $this->_view->page_subTitle = "Bienvenido al panel del administrador";
        $this->_view->no_header = false;
        $this->_view->meta_descripcion = "";
        $this->_view->renderizar("index", 'code-unic');
    }
}
