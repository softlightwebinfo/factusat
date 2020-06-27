<?php

class caracteristicasController extends codeunicController
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
        $caracteristicasEntity = new CaracteristicaEntity();
        $caracteristicas = $caracteristicasEntity->buscarTodos();
        $this->_view->_caracteristicas = $caracteristicas;
        $this->_view->titulo = "Administración | CodeUnic";
        $this->_view->page_title = "Dashboard";
        $this->_view->page_subTitle = "Bienvenido al panel del administrador";
        $this->_view->no_header = false;
        $this->_view->meta_descripcion = "";
        $this->_view->renderizar("index", 'code-unic');
    }

    public function nueva()
    {
        $this->_view->titulo = "Administración | CodeUnic";
        $this->_view->page_title = "Dashboard";
        $this->_view->page_subTitle = "Bienvenido al panel del administrador";
        $this->_view->no_header = false;
        $this->_view->meta_descripcion = "";
        $this->_view->renderizar("nuevo", 'code-unic');
    }

    public function createCaracteristica()
    {
        if ($this->is_post()) {
            $nombre = $this->post('nombre');
            if ($this->post('slug') == "") {
                $slug = str_replace(' ', '-', $this->post('nombre'));
            } else {
                $slug = str_replace(' ', '-', $this->post('slug'));
            }
            $caracteristicas = new CaracteristicaEntity();
            $caracteristicas->setNombre($nombre);
            $caracteristicas->setSlug($slug);
            $caracteristicas->save();
            $this->redireccionar('codeunic/caracteristicas/');
        }
    }
}
