<?php 
class MunicipioEntity extends Entity{
	protected $id;
	protected $municipio;
	protected $slug;
	protected $latitud;
	protected $longitud;
	protected $provinciaID;

    public function __construct(){
        parent::__construct('municipios');
    }

	public function getId(){
    	return $this->id;
	}

	public function setId($id){
    	$this->id = $id;
	}

	public function getMunicipio(){
    	return $this->municipio;
	}

	public function setMunicipio($municipio){
    	$this->municipio = $municipio;
	}

	public function getSlug(){
    	return $this->slug;
	}

	public function setSlug($slug){
    	$this->slug = $slug;
	}

	public function getLatitud(){
    	return $this->latitud;
	}

	public function setLatitud($latitud){
    	$this->latitud = $latitud;
	}

	public function getLongitud(){
    	return $this->longitud;
	}

	public function setLongitud($longitud){
    	$this->longitud = $longitud;
	}

	public function getProvinciaID(){
    	return $this->provinciaID;
	}

	public function setProvinciaID($provinciaID){
    	$this->provinciaID = $provinciaID;
	}

}
?>