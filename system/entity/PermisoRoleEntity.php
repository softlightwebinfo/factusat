<?php 
class PermisoRoleEntity extends Entity{
	protected $role;
	protected $permiso;
	protected $valor;

    public function __construct(){
        parent::__construct('permisos_roles');
    }

	public function getRole(){
    	return $this->role;
	}

	public function setRole($role){
    	$this->role = $role;
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