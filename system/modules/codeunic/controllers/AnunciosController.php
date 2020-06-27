<?php

class AnunciosController extends codeunicController
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
        $Anuncio = new AnimalesModel();
        $listadoAnuncios = $Anuncio->getAll();

        $this->_view->
        $this->_view->titulo = "Administración | CodeUnic";
        $this->_view->page_title = "Dashboard";
        $this->_view->page_subTitle = "Bienvenido al panel del administrador";
        $this->_view->no_header = false;
        $this->_view->meta_descripcion = "";
        $this->_view->renderizar("index", 'code-unic');
    }

    public function pendientes()
    {
        $this->_view->titulo = "Administración | CodeUnic";
        $this->_view->page_title = "Dashboard";
        $this->_view->page_subTitle = "Bienvenido al panel del administrador";
        $this->_view->no_header = false;
        $this->_view->meta_descripcion = "";
        $this->_view->renderizar("pendientes", 'code-unic');
    }

    public function eliminados()
    {
        $this->_view->titulo = "Administración | CodeUnic";
        $this->_view->page_title = "Dashboard";
        $this->_view->page_subTitle = "Bienvenido al panel del administrador";
        $this->_view->no_header = false;
        $this->_view->meta_descripcion = "";
        $this->_view->renderizar("eliminados", 'code-unic');
    }

}
