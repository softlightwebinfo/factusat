<?php 
class MenuEntity extends Entity{
	protected $titulo;
	protected $active;
	protected $position;
	protected $order;
	protected $url;

    public function __construct(){
        parent::__construct('menu');
    }

	public function getTitulo(){
    	return $this->titulo;
	}

	public function setTitulo($titulo){
    	$this->titulo = $titulo;
	}

	public function getActive(){
    	return $this->active;
	}

	public function setActive($active){
    	$this->active = $active;
	}

	public function getPosition(){
    	return $this->position;
	}

	public function setPosition($position){
    	$this->position = $position;
	}

	public function getOrder(){
    	return $this->order;
	}

	public function setOrder($order){
    	$this->order = $order;
	}

	public function getUrl(){
    	return $this->url;
	}

	public function setUrl($url){
    	$this->url = $url;
	}

}
?>