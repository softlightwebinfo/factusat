<?php 
class PermisoUsuarioEntity extends Entity{
	protected $usuarioID;
	protected $permiso;
	protected $valor;

    public function __construct(){
        parent::__construct('permisos_usuarios');
    }

	public function getUsuarioID(){
    	return $this->usuarioID;
	}

	public function setUsuarioID($usuarioID){
    	$this->usuarioID = $usuarioID;
	}

	public function getPermiso(){
    	return $this->permiso;
	}

	public function setPermiso($permiso){
    	$this->permiso = $permiso;
	}

	public function getValor(){
    	return $this->valor;
	}

	public function setValor($valor){
    	$this->valor = $valor;
	}

}
?>