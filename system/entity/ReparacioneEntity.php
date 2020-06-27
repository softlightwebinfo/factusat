<?php 
class ReparacioneEntity extends Entity{
	protected $id;
	protected $averia;
	protected $fecha_creacion;
	protected $fecha_modificacion;
	protected $notas;
	protected $password;
	protected $fk_cliente;
	protected $fk_tecnico;
	protected $fk_modalidad;
	protected $num_averia;
	protected $estado;
	protected $state;
	protected $modalidad_otros;
	protected $accesorios_otros;
	protected $id_usuario;

    public function __construct(){
        parent::__construct('reparaciones');
    }

	public function getId(){
    	return $this->id;
	}

	public function setId($id){
    	$this->id = $id;
	}

	public function getAveria(){
    	return $this->averia;
	}

	public function setAveria($averia){
    	$this->averia = $averia;
	}

	public function getFecha_creacion(){
    	return $this->fecha_creacion;
	}

	public function setFecha_creacion($fecha_creacion){
    	$this->fecha_creacion = $fecha_creacion;
	}

	public function getFecha_modificacion(){
    	return $this->fecha_modificacion;
	}

	public function setFecha_modificacion($fecha_modificacion){
    	$this->fecha_modificacion = $fecha_modificacion;
	}

	public function getNotas(){
    	return $this->notas;
	}

	public function setNotas($notas){
    	$this->notas = $notas;
	}

	public function getPassword(){
    	return $this->password;
	}

	public function setPassword($password){
    	$this->password = $password;
	}

	public function getFk_cliente(){
    	return $this->fk_cliente;
	}

	public function setFk_cliente($fk_cliente){
    	$this->fk_cliente = $fk_cliente;
	}

	public function getFk_tecnico(){
    	return $this->fk_tecnico;
	}

	public function setFk_tecnico($fk_tecnico){
    	$this->fk_tecnico = $fk_tecnico;
	}

	public function getFk_modalidad(){
    	return $this->fk_modalidad;
	}

	public function setFk_modalidad($fk_modalidad){
    	$this->fk_modalidad = $fk_modalidad;
	}

	public function getNum_averia(){
    	return $this->num_averia;
	}

	public function setNum_averia($num_averia){
    	$this->num_averia = $num_averia;
	}

	public function getEstado(){
    	return $this->estado;
	}

	public function setEstado($estado){
    	$this->estado = $estado;
	}

	public function getState(){
    	return $this->state;
	}

	public function setState($state){
    	$this->state = $state;
	}

	public function getModalidad_otros(){
    	return $this->modalidad_otros;
	}

	public function setModalidad_otros($modalidad_otros){
    	$this->modalidad_otros = $modalidad_otros;
	}

	public function getAccesorios_otros(){
    	return $this->accesorios_otros;
	}

	public function setAccesorios_otros($accesorios_otros){
    	$this->accesorios_otros = $accesorios_otros;
	}

	public function getId_usuario(){
    	return $this->id_usuario;
	}

	public function setId_usuario($id_usuario){
    	$this->id_usuario = $id_usuario;
	}

}
?>