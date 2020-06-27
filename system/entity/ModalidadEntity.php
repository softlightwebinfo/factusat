<?php 
class ModalidadEntity extends Entity{
	protected $id;
	protected $name;
	protected $orden;
	protected $activo;

    public function __construct(){
        parent::__construct('modalidad');
    }

	public function getId(){
    	return $this->id;
	}

	public function setId($id){
    	$this->id = $id;
	}

	public function getName(){
    	return $this->name;
	}

	public function setName($name){
    	$this->name = $name;
	}

	public function getOrden(){
    	return $this->orden;
	}

	public function setOrden($orden){
    	$this->orden = $orden;
	}

	public function getActivo(){
    	return $this->activo;
	}

	public function setActivo($activo){
    	$this->activo = $activo;
	}

}
?>