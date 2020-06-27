<?php

class razasController extends codeunicController
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
        $TipoAnimal = new TipoAnimalEntity();
        $this->_view->_tipos = $TipoAnimal->buscarTodos();
        $this->_view->titulo = "Administración | CodeUnic";
        $this->_view->page_title = "Dashboard";
        $this->_view->page_subTitle = "Bienvenido al panel del administrador";
        $this->_view->no_header = false;
        $this->_view->meta_descripcion = "";
        $this->_view->renderizar("index", 'code-unic');
    }

    public function tipo($tipoAnimal)
    {
        $razasModel = new RazasModel();

        $this->_view->_tipoAnimal = $tipoAnimal;
        $this->_view->_razas = $razasModel->getAllTipo($tipoAnimal);
        $this->_view->titulo = "Administración | CodeUnic";
        $this->_view->page_title = "Dashboard";
        $this->_view->page_subTitle = "Bienvenido al panel del administrador";
        $this->_view->no_header = false;
        $this->_view->meta_descripcion = "";
        $this->_view->renderizar("listado-razas-tipo", 'code-unic');
    }

    public function nuevoTipo()
    {
        if ($this->post('nombre')) {
            $this->createTipo($this->post('nombre'), 'codeunic/razas/');
            exit;
        }
        $this->_view->titulo = "Administración | CodeUnic";
        $this->_view->page_title = "Dashboard";
        $this->_view->page_subTitle = "Bienvenido al panel del administrador";
        $this->_view->no_header = false;
        $this->_view->meta_descripcion = "";
        $this->_view->renderizar("nuevo-tipo", 'code-unic');
    }

    public function nuevaRaza($tipoAnimal)
    {
        if ($this->post('nombre')) {
            $this->createRaza($this->post('nombre'), $tipoAnimal, 'codeunic/razas/tipo/' . $tipoAnimal);
            exit;
        }
        $this->_view->_tipoAnimal = $tipoAnimal;
        $this->_view->titulo = "Administración | CodeUnic";
        $this->_view->page_title = "Dashboard";
        $this->_view->page_subTitle = "Bienvenido al panel del administrador";
        $this->_view->no_header = false;
        $this->_view->meta_descripcion = "";
        $this->_view->renderizar("nueva-raza", 'code-unic');
    }

    private function createRaza($animal, $tipoAnimal, $ruta)
    {
        if ($this->post('nombre')) {
            $Raza = new RazaAnimalEntity();
            $Raza->setRaza(trim($animal));
            $Raza->setTipo(trim(ucfirst($tipoAnimal)));

            if ($Raza->save()) {
                $this->redireccionar($ruta);
            } else {
                $this->redireccionar($ruta);
            }
        } else {
            $this->redireccionar('');
        }
        return;
    }

    private function createTipo($tipoAnimal, $ruta)
    {
        if ($this->post('nombre')) {
            $tipo = new TipoAnimalEntity();
            $tipo->setTipo(trim($tipoAnimal));
            if ($tipo->save()) {
                $this->redireccionar($ruta);
            } else {
                $this->redireccionar($ruta);
            }
        } else {
            $this->redireccionar('');
        }
        return;
    }
}
