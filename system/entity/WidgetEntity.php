<?php 
class WidgetEntity extends Entity{
	protected $nombre;
	protected $activo;
	protected $view;
	protected $datos;
	protected $position;
	protected $show;
	protected $hide;

    public function __construct(){
        parent::__construct('widgets');
    }

	public function getNombre(){
    	return $this->nombre;
	}

	public function setNombre($nombre){
    	$this->nombre = $nombre;
	}

	public function getActivo(){
    	return $this->activo;
	}

	public function setActivo($activo){
    	$this->activo = $activo;
	}

	public function getView(){
    	return $this->view;
	}

	public function setView($view){
    	$this->view = $view;
	}

	public function getDatos(){
    	return $this->datos;
	}

	public function setDatos($datos){
    	$this->datos = $datos;
	}

	public function getPosition(){
    	return $this->position;
	}

	public function setPosition($position){
    	$this->position = $position;
	}

	public function getShow(){
    	return $this->show;
	}

	public function setShow($show){
    	$this->show = $show;
	}

	public function getHide(){
    	return $this->hide;
	}

	public function setHide($hide){
    	$this->hide = $hide;
	}

}
?>