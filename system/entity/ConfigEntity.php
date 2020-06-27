<?php 
class ConfigEntity extends Entity{
	protected $id;
	protected $title;
	protected $email;
	protected $privacidad;
	protected $num_repair;
	protected $horario;
	protected $direccion;
	protected $telefono;
	protected $whatsapp;
	protected $correo;
	protected $facebook;
	protected $logo;
	protected $nombreHojaReparacion;
	protected $datosInteres;
	protected $datosResponsable;
	protected $imprimirHojas;
	protected $id_usuario;
	protected $reparacionActual;

    public function __construct(){
        parent::__construct('config');
    }

	public function getId(){
    	return $this->id;
	}

	public function setId($id){
    	$this->id = $id;
	}

	public function getTitle(){
    	return $this->title;
	}

	public function setTitle($title){
    	$this->title = $title;
	}

	public function getEmail(){
    	return $this->email;
	}

	public function setEmail($email){
    	$this->email = $email;
	}

	public function getPrivacidad(){
    	return $this->privacidad;
	}

	public function setPrivacidad($privacidad){
    	$this->privacidad = $privacidad;
	}

	public function getNum_repair(){
    	return $this->num_repair;
	}

	public function setNum_repair($num_repair){
    	$this->num_repair = $num_repair;
	}

	public function getHorario(){
    	return $this->horario;
	}

	public function setHorario($horario){
    	$this->horario = $horario;
	}

	public function getDireccion(){
    	return $this->direccion;
	}

	public function setDireccion($direccion){
    	$this->direccion = $direccion;
	}

	public function getTelefono(){
    	return $this->telefono;
	}

	public function setTelefono($telefono){
    	$this->telefono = $telefono;
	}

	public function getWhatsapp(){
    	return $this->whatsapp;
	}

	public function setWhatsapp($whatsapp){
    	$this->whatsapp = $whatsapp;
	}

	public function getCorreo(){
    	return $this->correo;
	}

	public function setCorreo($correo){
    	$this->correo = $correo;
	}

	public function getFacebook(){
    	return $this->facebook;
	}

	public function setFacebook($facebook){
    	$this->facebook = $facebook;
	}

	public function getLogo(){
    	return $this->logo;
	}

	public function setLogo($logo){
    	$this->logo = $logo;
	}

	public function getNombreHojaReparacion(){
    	return $this->nombreHojaReparacion;
	}

	public function setNombreHojaReparacion($nombreHojaReparacion){
    	$this->nombreHojaReparacion = $nombreHojaReparacion;
	}

	public function getDatosInteres(){
    	return $this->datosInteres;
	}

	public function setDatosInteres($datosInteres){
    	$this->datosInteres = $datosInteres;
	}

	public function getDatosResponsable(){
    	return $this->datosResponsable;
	}

	public function setDatosResponsable($datosResponsable){
    	$this->datosResponsable = $datosResponsable;
	}

	public function getImprimirHojas(){
    	return $this->imprimirHojas;
	}

	public function setImprimirHojas($imprimirHojas){
    	$this->imprimirHojas = $imprimirHojas;
	}

	public function getId_usuario(){
    	return $this->id_usuario;
	}

	public function setId_usuario($id_usuario){
    	$this->id_usuario = $id_usuario;
	}

	public function getReparacionActual(){
    	return $this->reparacionActual;
	}

	public function setReparacionActual($reparacionActual){
    	$this->reparacionActual = $reparacionActual;
	}

}
?>