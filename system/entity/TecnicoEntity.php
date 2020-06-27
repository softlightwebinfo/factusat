<?php 
class TecnicoEntity extends Entity{
	protected $id;
	protected $id_usuario;
	protected $nombre;
	protected $activo;

    public function __construct(){
        parent::__construct('tecnicos');
    }

	public function getId(){
    	return $this->id;
	}

	public function setId($id){
    	$this->id = $id;
	}

	public function getId_usuario(){
    	return $this->id_usuario;
	}

	public function setId_usuario($id_usuario){
    	$this->id_usuario = $id_usuario;
	}

	public function getNombre(){
    	return $this->nombre;
	}

	public function setNombre($nombre){
    	$this->nombre = $nombre;
	}

	public function getActivo(){
    	return $this->activo;
	}

	public function setActivo($activo){
    	$this->activo = $activo;
	}

}
?>