<?php 
class ReparacioneAccesorioEntity extends Entity{
	protected $fk_reparacion;
	protected $fk_accesorio;
	protected $fecha_creacion;

    public function __construct(){
        parent::__construct('reparaciones_accesorios');
    }

	public function getFk_reparacion(){
    	return $this->fk_reparacion;
	}

	public function setFk_reparacion($fk_reparacion){
    	$this->fk_reparacion = $fk_reparacion;
	}

	public function getFk_accesorio(){
    	return $this->fk_accesorio;
	}

	public function setFk_accesorio($fk_accesorio){
    	$this->fk_accesorio = $fk_accesorio;
	}

	public function getFecha_creacion(){
    	return $this->fecha_creacion;
	}

	public function setFecha_creacion($fecha_creacion){
    	$this->fecha_creacion = $fecha_creacion;
	}

}
?>