<?php 
class StateEntity extends Entity{
	protected $id;
	protected $name;
	protected $orden;
	protected $active;
	protected $colour;
	protected $background;
	protected $disminutive;

    public function __construct(){
        parent::__construct('state');
    }

	public function getId(){
    	return $this->id;
	}

	public function setId($id){
    	$this->id = $id;
	}

	public function getName(){
    	return $this->name;
	}

	public function setName($name){
    	$this->name = $name;
	}

	public function getOrden(){
    	return $this->orden;
	}

	public function setOrden($orden){
    	$this->orden = $orden;
	}

	public function getActive(){
    	return $this->active;
	}

	public function setActive($active){
    	$this->active = $active;
	}

	public function getColour(){
    	return $this->colour;
	}

	public function setColour($colour){
    	$this->colour = $colour;
	}

	public function getBackground(){
    	return $this->background;
	}

	public function setBackground($background){
    	$this->background = $background;
	}

	public function getDisminutive(){
    	return $this->disminutive;
	}

	public function setDisminutive($disminutive){
    	$this->disminutive = $disminutive;
	}

}
?>