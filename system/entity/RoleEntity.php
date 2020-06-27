<?php 
class RoleEntity extends Entity{
	protected $role;
	protected $active;

    public function __construct(){
        parent::__construct('roles');
    }

	public function getRole(){
    	return $this->role;
	}

	public function setRole($role){
    	$this->role = $role;
	}

	public function getActive(){
    	return $this->active;
	}

	public function setActive($active){
    	$this->active = $active;
	}

}
?>