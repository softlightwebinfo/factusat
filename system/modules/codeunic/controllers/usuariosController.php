<?php

class usuariosController extends codeunicController
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
        /* LISTADO DE USUARIOS EN EL SISTEMA */

        /* INSTANCIAMOS EL MODELO */
        $userModel = new UsuariosModel();

        $usuarios = $userModel->getAll();


        if ($usuarios->num_rows() > 0) {
            $this->_view->_listadoUsuarios = $usuarios->result();
        } else {
            $this->_view->_listadoUsuarios = array();
        }


        $this->_view->titulo = "Administración | CodeUnic";
        $this->_view->page_title = "Listado de usuarios";
        $this->_view->page_subTitle = "Bienvenido al panel del administrador";
        $this->_view->no_header = false;
        $this->_view->meta_descripcion = "";
        $this->_view->renderizar("index", 'code-unic');
    }

    public function crearUsuario()
    {
        $this->_view->titulo = "Crear cuenta usuario | CodeUnic";
        $this->_view->page_title = "Crear cuenta para el usuario";
        $this->_view->page_subTitle = "Bienvenido al panel del administrador";
        $this->_view->no_header = false;
        $this->_view->meta_descripcion = "";
        $this->_view->renderizar("crear-usuario", 'crear-usuario');
    }

}
