<?php 
class FacturaEntity extends Entity{
	protected $id;
	protected $id_usuario;
	protected $id_cliente;
	protected $numero_factura;
	protected $fecha_factura;
	protected $pago;
	protected $estado_pago;
	protected $total;

    public function __construct(){
        parent::__construct('facturas');
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

	public function getId_cliente(){
    	return $this->id_cliente;
	}

	public function setId_cliente($id_cliente){
    	$this->id_cliente = $id_cliente;
	}

	public function getNumero_factura(){
    	return $this->numero_factura;
	}

	public function setNumero_factura($numero_factura){
    	$this->numero_factura = $numero_factura;
	}

	public function getFecha_factura(){
    	return $this->fecha_factura;
	}

	public function setFecha_factura($fecha_factura){
    	$this->fecha_factura = $fecha_factura;
	}

	public function getPago(){
    	return $this->pago;
	}

	public function setPago($pago){
    	$this->pago = $pago;
	}

	public function getEstado_pago(){
    	return $this->estado_pago;
	}

	public function setEstado_pago($estado_pago){
    	$this->estado_pago = $estado_pago;
	}

	public function getTotal(){
    	return $this->total;
	}

	public function setTotal($total){
    	$this->total = $total;
	}

}
?>