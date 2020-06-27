<?php 
class NacionalidadEntity extends Entity{
	protected $nacionalidad;
	protected $pais;

    public function __construct(){
        parent::__construct('nacionalidad');
    }

	public function getNacionalidad(){
    	return $this->nacionalidad;
	}

	public function setNacionalidad($nacionalidad){
    	$this->nacionalidad = $nacionalidad;
	}

	public function getPais(){
    	return $this->pais;
	}

	public function setPais($pais){
    	$this->pais = $pais;
	}

}
?>