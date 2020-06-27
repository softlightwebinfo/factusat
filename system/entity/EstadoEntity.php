<?php 
class EstadoEntity extends Entity{
	protected $estado;

    public function __construct(){
        parent::__construct('estados');
    }

	public function getEstado(){
    	return $this->estado;
	}

	public function setEstado($estado){
    	$this->estado = $estado;
	}

}
?>