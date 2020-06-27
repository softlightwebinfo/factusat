<?php 
class TarifaEntity extends Entity{
	protected $id;
	protected $descripción;
	protected $precio;

    public function __construct(){
        parent::__construct('tarifas');
    }

	public function getId(){
    	return $this->id;
	}

	public function setId($id){
    	$this->id = $id;
	}

	public function getDescripción(){
    	return $this->descripción;
	}

	public function setDescripción($descripción){
    	$this->descripción = $descripción;
	}

	public function getPrecio(){
    	return $this->precio;
	}

	public function setPrecio($precio){
    	$this->precio = $precio;
	}

}
?>