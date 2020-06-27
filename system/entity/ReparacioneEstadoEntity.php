<?php 
class ReparacioneEstadoEntity extends Entity{
	protected $fk_reparacion;
	protected $fk_estado;
	protected $fecha;

    public function __construct(){
        parent::__construct('reparaciones_estado');
    }

	public function getFk_reparacion(){
    	return $this->fk_reparacion;
	}

	public function setFk_reparacion($fk_reparacion){
    	$this->fk_reparacion = $fk_reparacion;
	}

	public function getFk_estado(){
    	return $this->fk_estado;
	}

	public function setFk_estado($fk_estado){
    	$this->fk_estado = $fk_estado;
	}

	public function getFecha(){
    	return $this->fecha;
	}

	public function setFecha($fecha){
    	$this->fecha = $fecha;
	}

}
?>