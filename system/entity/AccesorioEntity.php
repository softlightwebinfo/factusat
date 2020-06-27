<?php 
class AccesorioEntity extends Entity{
	protected $id;
	protected $nombre;
	protected $orden;
	protected $activo;

    public function __construct(){
        parent::__construct('accesorios');
    }

	public function getId(){
    	return $this->id;
	}

	public function setId($id){
    	$this->id = $id;
	}

	public function getNombre(){
    	return $this->nombre;
	}

	public function setNombre($nombre){
    	$this->nombre = $nombre;
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