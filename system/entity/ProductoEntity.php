<?php 
class ProductoEntity extends Entity{
	protected $id;
	protected $ref_producto;
	protected $nombre;
	protected $estado;
	protected $fecha_creacion;
	protected $fecha_modificacion;
	protected $precio;
	protected $id_usuario;
	protected $eliminado;

    public function __construct(){
        parent::__construct('productos');
    }

	public function getId(){
    	return $this->id;
	}

	public function setId($id){
    	$this->id = $id;
	}

	public function getRef_producto(){
    	return $this->ref_producto;
	}

	public function setRef_producto($ref_producto){
    	$this->ref_producto = $ref_producto;
	}

	public function getNombre(){
    	return $this->nombre;
	}

	public function setNombre($nombre){
    	$this->nombre = $nombre;
	}

	public function getEstado(){
    	return $this->estado;
	}

	public function setEstado($estado){
    	$this->estado = $estado;
	}

	public function getFecha_creacion(){
    	return $this->fecha_creacion;
	}

	public function setFecha_creacion($fecha_creacion){
    	$this->fecha_creacion = $fecha_creacion;
	}

	public function getFecha_modificacion(){
    	return $this->fecha_modificacion;
	}

	public function setFecha_modificacion($fecha_modificacion){
    	$this->fecha_modificacion = $fecha_modificacion;
	}

	public function getPrecio(){
    	return $this->precio;
	}

	public function setPrecio($precio){
    	$this->precio = $precio;
	}

	public function getId_usuario(){
    	return $this->id_usuario;
	}

	public function setId_usuario($id_usuario){
    	$this->id_usuario = $id_usuario;
	}

	public function getEliminado(){
    	return $this->eliminado;
	}

	public function setEliminado($eliminado){
    	$this->eliminado = $eliminado;
	}

}
?>