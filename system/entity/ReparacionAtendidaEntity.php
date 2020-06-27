<?php 
class ReparacionAtendidaEntity extends Entity{
	protected $id;
	protected $fk_reparacion;
	protected $averia;
	protected $solucion;
	protected $notas_internas;
	protected $fk_cliente;
	protected $horas;
	protected $precio_sat;
	protected $precio_total;

    public function __construct(){
        parent::__construct('reparacion_atendida');
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

	public function getAveria(){
    	return $this->averia;
	}

	public function setAveria($averia){
    	$this->averia = $averia;
	}

	public function getSolucion(){
    	return $this->solucion;
	}

	public function setSolucion($solucion){
    	$this->solucion = $solucion;
	}

	public function getNotas_internas(){
    	return $this->notas_internas;
	}

	public function setNotas_internas($notas_internas){
    	$this->notas_internas = $notas_internas;
	}

	public function getFk_cliente(){
    	return $this->fk_cliente;
	}

	public function setFk_cliente($fk_cliente){
    	$this->fk_cliente = $fk_cliente;
	}

	public function getHoras(){
    	return $this->horas;
	}

	public function setHoras($horas){
    	$this->horas = $horas;
	}

	public function getPrecio_sat(){
    	return $this->precio_sat;
	}

	public function setPrecio_sat($precio_sat){
    	$this->precio_sat = $precio_sat;
	}

	public function getPrecio_total(){
    	return $this->precio_total;
	}

	public function setPrecio_total($precio_total){
    	$this->precio_total = $precio_total;
	}

}
?>