<?php 
class ProvinciaEntity extends Entity{
	protected $id;
	protected $slug;
	protected $provincia;
	protected $comunidadID;
	protected $capitalID;

    public function __construct(){
        parent::__construct('provincias');
    }

	public function getId(){
    	return $this->id;
	}

	public function setId($id){
    	$this->id = $id;
	}

	public function getSlug(){
    	return $this->slug;
	}

	public function setSlug($slug){
    	$this->slug = $slug;
	}

	public function getProvincia(){
    	return $this->provincia;
	}

	public function setProvincia($provincia){
    	$this->provincia = $provincia;
	}

	public function getComunidadID(){
    	return $this->comunidadID;
	}

	public function setComunidadID($comunidadID){
    	$this->comunidadID = $comunidadID;
	}

	public function getCapitalID(){
    	return $this->capitalID;
	}

	public function setCapitalID($capitalID){
    	$this->capitalID = $capitalID;
	}

}
?>