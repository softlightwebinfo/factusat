<?php 
class ReparacioneDatoEntity extends Entity{
	protected $id;
	protected $fk_reparacion;
	protected $fk_modalidad;
	protected $modelo;
	protected $estado;
	protected $serie;
	protected $patron;
	protected $dispositivo;

    public function __construct(){
        parent::__construct('reparaciones_datos');
    }

	public function getId(){
    	return $this->id;
	}

	public function setId($id){
    	$this->id = $id;
	}

	public function getFk_reparacion(){
    	return $this->fk_reparacion;
	}

	public function setFk_reparacion($fk_reparacion){
    	$this->fk_reparacion = $fk_reparacion;
	}

	public function getFk_modalidad(){
    	return $this->fk_modalidad;
	}

	public function setFk_modalidad($fk_modalidad){
    	$this->fk_modalidad = $fk_modalidad;
	}

	public function getModelo(){
    	return $this->modelo;
	}

	public function setModelo($modelo){
    	$this->modelo = $modelo;
	}

	public function getEstado(){
    	return $this->estado;
	}

	public function setEstado($estado){
    	$this->estado = $estado;
	}

	public function getSerie(){
    	return $this->serie;
	}

	public function setSerie($serie){
    	$this->serie = $serie;
	}

	public function getPatron(){
    	return $this->patron;
	}

	public function setPatron($patron){
    	$this->patron = $patron;
	}

	public function getDispositivo(){
    	return $this->dispositivo;
	}

	public function setDispositivo($dispositivo){
    	$this->dispositivo = $dispositivo;
	}

}
?>