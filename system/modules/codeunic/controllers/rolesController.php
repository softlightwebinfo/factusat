<?php

class rolesController extends codeunicController
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
        $rolesModel = new RolesModel();

        $roles = $rolesModel->getAll();

        $this->_view->_listadoRoles = $roles;

        $this->_view->titulo = "Listado de roles | CodeUnic";
        $this->_view->page_title = "Listado de Roles";
        $this->_view->page_subTitle = "Bienvenido al panel del administrador";
        $this->_view->no_header = false;
        $this->_view->meta_descripcion = "";
        $this->_view->renderizar("index", 'code-unic');
    }

}
