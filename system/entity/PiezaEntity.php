<?php 
class PiezaEntity extends Entity{
	protected $id;
	protected $nombre;
	protected $precio;

    public function __construct(){
        parent::__construct('piezas');
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

	public function getPrecio(){
    	return $this->precio;
	}

	public function setPrecio($precio){
    	$this->precio = $precio;
	}

}
?>