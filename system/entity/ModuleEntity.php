<?php 
class ModuleEntity extends Entity{
	protected $name;
	protected $active;

    public function __construct(){
        parent::__construct('modules');
    }

	public function getName(){
    	return $this->name;
	}

	public function setName($name){
    	$this->name = $name;
	}

	public function getActive(){
    	return $this->active;
	}

	public function setActive($active){
    	$this->active = $active;
	}

}
?>