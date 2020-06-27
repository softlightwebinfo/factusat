<?php 
class PermisoEntity extends Entity{
	protected $ky;
	protected $active;

    public function __construct(){
        parent::__construct('permisos');
    }

	public function getKy(){
    	return $this->ky;
	}

	public function setKy($ky){
    	$this->ky = $ky;
	}

	public function getActive(){
    	return $this->active;
	}

	public function setActive($active){
    	$this->active = $active;
	}

}
?>