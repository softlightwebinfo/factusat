<?php

class productosController extends Controller
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

    public function getProductos($token)
    {
        $post = $this->axios();
        $datos = array();
        $usuario = $this->_getUserToken($token);
        $Productos = new ProductoEntity();
        ORM::select('*');
        ORM::from($Productos->getTable(true));
        ORM::where('id_usuario', $usuario->getId());
        ORM::where('eliminado IS NULL');
        ORM::order_by('ref_producto');
        $sq = ORM::build();

        $datos['productos'] = $sq->result();

        die(json_encode($datos));
    }

    public function createProduct($token)
    {
        $post = $this->axios();
        $User = $this->_getUserToken($token);

        $Product = new ProductoEntity();
        $Product->setNombre($post['nombre']);
        $Product->setEstado($post['estado']);
        $Product->setPrecio($post['precio']);
        $Product->setRef_producto($post['codigo']);
        $Product->setId_usuario($User->getId());
        $Product->save();
        $Product->buscarPorPk();

        die(json_encode(array(
            'id' => $Product->getId(),
            'ref_producto' => $Product->getRef_producto(),
            'nombre' => $Product->getNombre(),
            'estado' => $Product->getEstado(),
            'fecha_creacion' => $Product->getFecha_creacion(),
            'fecha_modificacion' => $Product->getFecha_modificacion(),
            'precio' => $Product->getPrecio(),
            'id_usuario' => $Product->getId_usuario()
        )));
    }

    public function eliminarProducto($token)
    {
        $post = $this->axios();
        $datos = array('success' => false);

        $User = $this->_getUserToken($token);
        $Producto = new ProductoEntity();
        ORM::$_db->updateRows($Producto->getTable(), array(
            'eliminado' => date('Y-m-d H:i:s')
        ),
            array(
                'id_usuario' => $User->getId(),
                'id' => $post['id']
            )
        );
        $datos['success'] = true;

        die(json_encode($datos));
    }

    public function actualizarProducto($token)
    {
        $User = $this->_getUserToken($token);
        $datos = array('success' => false);
        $post = $this->axios();
        $Prod = new ProductoEntity();
        ORM::$_db->updateRows($Prod->getTable(), array(
            'ref_producto' => $post['codigo'],
            'nombre' => $post['nombre'],
            'estado' => $post['estado'],
            'precio' => $post['precio']
        ), array(
            'id_usuario' => $User->getId(),
            'id' => $post['id']
        ));
        ORM::select('*');
        ORM::from($Prod->getTable(true));
        ORM::where('id_usuario', $User->getId());
        ORM::where('id', $post['id']);
        $dato = ORM::build();
        $datos['producto'] = $dato->row();

        die(json_encode($datos));
    }
}

?>