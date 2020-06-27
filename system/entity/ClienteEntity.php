<?php 
class ClienteEntity extends Entity{
	protected $id;
	protected $nombre;
	protected $dni;
	protected $email;
	protected $whatsapp;
	protected $telefono;
	protected $id_usuario;
	protected $direccion;
	protected $fecha_creacion;
	protected $estado;
	protected $eliminado;

    public function __construct(){
        parent::__construct('clientes');
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

	public function getDni(){
    	return $this->dni;
	}

	public function setDni($dni){
    	$this->dni = $dni;
	}

	public function getEmail(){
    	return $this->email;
	}

	public function setEmail($email){
    	$this->email = $email;
	}

	public function getWhatsapp(){
    	return $this->whatsapp;
	}

	public function setWhatsapp($whatsapp){
    	$this->whatsapp = $whatsapp;
	}

	public function getTelefono(){
    	return $this->telefono;
	}

	public function setTelefono($telefono){
    	$this->telefono = $telefono;
	}

	public function getId_usuario(){
    	return $this->id_usuario;
	}

	public function setId_usuario($id_usuario){
    	$this->id_usuario = $id_usuario;
	}

	public function getDireccion(){
    	return $this->direccion;
	}

	public function setDireccion($direccion){
    	$this->direccion = $direccion;
	}

	public function getFecha_creacion(){
    	return $this->fecha_creacion;
	}

	public function setFecha_creacion($fecha_creacion){
    	$this->fecha_creacion = $fecha_creacion;
	}

	public function getEstado(){
    	return $this->estado;
	}

	public function setEstado($estado){
    	$this->estado = $estado;
	}

	public function getEliminado(){
    	return $this->eliminado;
	}

	public function setEliminado($eliminado){
    	$this->eliminado = $eliminado;
	}

}
?>