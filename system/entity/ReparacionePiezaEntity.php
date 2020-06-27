<?php 
class ReparacionePiezaEntity extends Entity{
	protected $fk_reparacion;
	protected $fk_piezas;
	protected $fecha_creacion;
	protected $cantidad;
	protected $precio;
	protected $id;

    public function __construct(){
        parent::__construct('reparaciones_piezas');
    }

	public function getFk_reparacion(){
    	return $this->fk_reparacion;
	}

	public function setFk_reparacion($fk_reparacion){
    	$this->fk_reparacion = $fk_reparacion;
	}

	public function getFk_piezas(){
    	return $this->fk_piezas;
	}

	public function setFk_piezas($fk_piezas){
    	$this->fk_piezas = $fk_piezas;
	}

	public function getFecha_creacion(){
    	return $this->fecha_creacion;
	}

	public function setFecha_creacion($fecha_creacion){
    	$this->fecha_creacion = $fecha_creacion;
	}

	public function getCantidad(){
    	return $this->cantidad;
	}

	public function setCantidad($cantidad){
    	$this->cantidad = $cantidad;
	}

	public function getPrecio(){
    	return $this->precio;
	}

	public function setPrecio($precio){
    	$this->precio = $precio;
	}

	public function getId(){
    	return $this->id;
	}

	public function setId($id){
    	$this->id = $id;
	}

}
?>