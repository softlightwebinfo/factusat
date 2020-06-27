<?php 
class PagoEstadoEntity extends Entity{
	protected $id;
	protected $nombre;

    public function __construct(){
        parent::__construct('pago_estado');
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

}
?>