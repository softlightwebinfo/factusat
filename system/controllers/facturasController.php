<?php

use Dompdf\Adapter\PDFLib;
use Dompdf\Dompdf;

class facturasController extends Controller
{
    /**
     * indexController constructor.
     */
    public function __construct()
    {
        parent::__construct();

    }

    public function index()
    {
        $this->_view->titulo = $this->_view->getConfigure()->title;
        $this->_view->meta_descripcion = "Sistema Perreras";
        $this->_view->titulo_page = "Panel principal";
        $this->_view->renderizar("index", 'index');
    }

    public function getFacturas($token)
    {
        $User = $this->_getUserToken($token);

        $datos = array();
        $Facturas = new FacturaEntity();
        $Cliente = new ClienteEntity();
        $PagoEstado = new PagoEstadoEntity();
        $Pago = new PagoEntity();
        ORM::select('f.total,f.id,f.id_usuario,f.id_cliente,f.numero_factura,f.fecha_factura,f.pago,f.estado_pago,
        c.nombre,c.telefono,c.email,
        g.nombre as estado,e.nombre as pago_estado');
        ORM::from($Facturas->getTable(true) . ' f');
        ORM::join($Cliente->getTable(true) . ' c', 'f.id_cliente=c.id');
        ORM::join($PagoEstado->getTable(true) . ' e', 'f.estado_pago=e.id');
        ORM::join($Pago->getTable(true) . ' g', 'f.pago=g.id');
        ORM::where('f.id_usuario', $User->getId());
        $get = ORM::build();

        $facturas = array();
        $Linias = new FacturaLiniaEntity();
        foreach ($get->result() as $key => $row) {
            ORM::select('l.*,l.linia as ky');
            ORM::from($Linias->getTable(true) . ' l');
            ORM::where('l.id_factura', $row->id);
            $linias = ORM::build();
            $data = array_merge((array)$row, array('linias' => $linias->result()));

            array_push($facturas, $data);
        }
        $datos['facturas'] = $facturas;

        die(json_encode($datos));

    }

    public function getMetodosPagos($token)
    {
        $User = $this->_getUserToken($token);
        $datos = array();

        $Pago = new PagoEntity();
        ORM::select('*');
        ORM::from($Pago->getTable(true));

        $get = ORM::build();

        $datos['metodosPagos'] = $get->result();

        die(json_encode($datos));
    }

    public function getEstadosPagos($token)
    {
        $User = $this->_getUserToken($token);
        $datos = array();

        $Pago = new PagoEstadoEntity();
        ORM::select('*');
        ORM::from($Pago->getTable(true));

        $get = ORM::build();

        $datos['estadosPagos'] = $get->result();

        die(json_encode($datos));
    }

    public function createFactura($token)
    {
        $User = $this->_getUserToken($token);
        $post = $this->axios();
        $datos = array(
            'success' => false,
            'factura' => array()
        );

        try {
            $Factura = new FacturaEntity();
            $Factura->setId_usuario($User->getId());
            $Factura->setEstado_pago($post['estado']);
            $Factura->setPago($post['pago']);
            $Factura->setId_cliente($post['cliente']);
            $Factura->save();

            foreach ($post['productos'] as $key => $row) {
                $row = (object)$row;
                $Linia = new FacturaLiniaEntity();
                $Linia->setId_factura($Factura->getId());
                $Linia->setLinia($row->key);
                $Linia->setId_producto($row->id);
                $Linia->setCantidad($row->cantidad);
                $Linia->setPrecio($row->precio);
                $Linia->save();
            }
            $datos['success'] = true;
        } catch (Exception $exception) {
            $datos['success'] = false;
        }
        $Cliente = new ClienteEntity();
        $PagoEstado = new PagoEstadoEntity();
        $Pago = new PagoEntity();

        ORM::select('f.total,f.id,f.id_usuario,f.id_cliente,f.numero_factura,f.fecha_factura,f.pago,f.estado_pago,
        c.nombre,c.telefono,c.email,
        g.nombre as estado,e.nombre as pago_estado');
        ORM::from($Factura->getTable(true) . ' f');
        ORM::join($Cliente->getTable(true) . ' c', 'f.id_cliente=c.id');
        ORM::join($PagoEstado->getTable(true) . ' e', 'f.estado_pago=e.id');
        ORM::join($Pago->getTable(true) . ' g', 'f.pago=g.id');
        ORM::where('f.id_usuario', $User->getId());
        ORM::where('f.id', $Factura->getId());
        $get = ORM::build();
        $factura = $get->row();

        $datos['factura'] = $factura;
        die(json_encode($datos));
    }

    public function imprimirFactura($token, $id, $imprimir = false)
    {
        $filename = 'out.pdf';

        $User = $this->_getUserToken($token);
        $ruta = 'system/libs/pdfs/autoload.inc.php';
        require $ruta;

        $Config = new ConfigEntity();
        $Config->buscar(array('id_usuario=' => $User->getId()));

        $Factura = new FacturaEntity();
        $Factura->buscar(array(
            'id_usuario=' => $User->getId(),
            'and id=' => $id
        ));
        $Cliente = new ClienteEntity();
        $Cliente->buscar(array(
            'id_usuario=' => $User->getId(),
            'and id=' => $Factura->getId_cliente()
        ));
        $Linias = new FacturaLiniaEntity();
        $Linias = $Linias->buscarTodos(null, null, array(
            'id_factura=' => $Factura->getId()
        ));
        $facturasLinias = array();
        $subtotal = 0;
        foreach ($Linias as $key => $row) {
            $Producto = new ProductoEntity();
            $Producto->buscar(array(
                'id_usuario=' => $User->getId(),
                'and id=' => $row->getId_producto()
            ));
            $subtotal += number_format($row->getCantidad() * $row->getPrecio(), 2);
            array_push($facturasLinias, (object)array(
                'id_factura' => $row->getId_factura(),
                'id_linia' => $row->getLinia(),
                'cantidad' => $row->getCantidad(),
                'precio' => number_format($row->getPrecio(), 2),
                'total' => number_format($row->getCantidad() * $row->getPrecio(), 2),
                'producto' => $Producto
            ));
        }
        $this->_view->numero = $Factura->getNumero_factura();
        $this->_view->subtotal = number_format($subtotal, 2);
        $this->_view->iva = 21;
        $this->_view->subtotalIva = number_format((($subtotal * $this->_view->iva) / 100), 2);
        $this->_view->total = number_format($subtotal + $this->_view->subtotalIva, 2);
        $this->_view->liniasFactura = $facturasLinias;
        $this->_view->logo = "public/usuario/{$User->getId()}/{$Config->getLogo()}";
        $this->_view->companyName = $User->getUsuario();
        $this->_view->companyDirection = $Config->getDireccion();
        $this->_view->companyLocalidad = '';
        $this->_view->companyPhone = $Config->getTelefono();
        $this->_view->companyEmail = $Config->getEmail();
        $this->_view->clientName = $Cliente->getNombre();
        $this->_view->clientDirection = $Cliente->getDireccion();
        $this->_view->clientEmail = $Cliente->getEmail();
        $this->_view->clientDate = date('d/m/Y');
        $this->_view->clientDateDue = date('d/m/Y');
        $this->_view->clientProyect = 'Construir Web';
        $dompdf = new Dompdf();
        $dompdf->loadHtml($this->_view->load_view('facturas/imprimir', null, true));
        $dompdf->setPaper('A4');

        $dompdf->render();
        if ($imprimir == 'false') {
            $imprimir = false;
        }
        $dompdf->stream($filename, array("Attachment" => $imprimir));

        exit(0);
    }

    public function eliminarFactura($token)
    {
        $User = $this->_getUserToken($token);
        $datos = array('success' => false);
        $post = $this->axios();

        $Factu = new FacturaEntity();
        ORM::$_db->deleteRows($Factu->getTable(), "id_usuario='{$User->getId()}' and id='{$post['id']}'");
        $datos['success'] = true;
        die(json_encode($datos));
    }
}

?>