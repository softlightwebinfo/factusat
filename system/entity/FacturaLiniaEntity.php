<?php 
class FacturaLiniaEntity extends Entity{
	protected $id_factura;
	protected $linia;
	protected $id_producto;
	protected $cantidad;
	protected $precio;

    public function __construct(){
        parent::__construct('facturas_linias');
    }

	public function getId_factura(){
    	return $this->id_factura;
	}

	public function setId_factura($id_factura){
    	$this->id_factura = $id_factura;
	}

	public function getLinia(){
    	return $this->linia;
	}

	public function setLinia($linia){
    	$this->linia = $linia;
	}

	public function getId_producto(){
    	return $this->id_producto;
	}

	public function setId_producto($id_producto){
    	$this->id_producto = $id_producto;
	}

	public function getCantidad(){
    	return $this->cantidad;
	}

	public function setCantidad($cantidad){
    	$this->cantidad = $cantidad;
	}

	public function getPrecio(){
    	return $this->precio;
	}

	public function setPrecio($precio){
    	$this->precio = $precio;
	}

}
?>