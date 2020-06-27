<?php 
class UsuarioLoginEntity extends Entity{
	protected $usuarioID;
	protected $date;
	protected $ip;
	protected $pais;

    public function __construct(){
        parent::__construct('usuarios_login');
    }

	public function getUsuarioID(){
    	return $this->usuarioID;
	}

	public function setUsuarioID($usuarioID){
    	$this->usuarioID = $usuarioID;
	}

	public function getDate(){
    	return $this->date;
	}

	public function setDate($date){
    	$this->date = $date;
	}

	public function getIp(){
    	return $this->ip;
	}

	public function setIp($ip){
    	$this->ip = $ip;
	}

	public function getPais(){
    	return $this->pais;
	}

	public function setPais($pais){
    	$this->pais = $pais;
	}

}
?>