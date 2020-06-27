<?php

class clientesController extends Controller
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

    public function getClientes($token)
    {
        $datos = array();
        $User = $this->_getUserToken($token);
        $Clientes = new ClienteEntity();

        ORM::select('*');
        ORM::from($Clientes->getTable(true));
        ORM::where('id_usuario', $User->getId());
        ORM::where('eliminado IS NULL');
        ORM::order_by('nombre');
        $get = ORM::build();
        $datos['clientes'] = $get->result();

        die(json_encode($datos));
    }

    public function createClient($token)
    {
        $datos = array();
        $post = $this->axios();
        $User = $this->_getUserToken($token);

        $Client = new ClienteEntity();

        $Client->setNombre($post['nombre']);
        $Client->setId_usuario($User->getId());
        $Client->setEmail($post['email']);
        $Client->setTelefono($post['telefono']);
        $Client->setEstado(' ' . $post['estado']);
        $Client->setDireccion($post['direccion']);
        $Client->save();

        ORM::select('*');
        ORM::from($Client->getTable(true));
        ORM::where('id_usuario', $User->getId());
        ORM::where('id', $Client->getId());
        $get = ORM::build();

        $datos['cliente'] = $get->row();
        die(json_encode($datos));
    }

    public function eliminarCliente($token)
    {
        $post = $this->axios();
        $datos = array('success' => false);

        $User = $this->_getUserToken($token);
        $Cliente = new ClienteEntity();
        ORM::$_db->updateRows($Cliente->getTable(), array(
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

    public function atualizarCliente($token)
    {
        $User = $this->_getUserToken($token);
        $datos = array('success' => false);
        $post = $this->axios();

        $Cliente = new ClienteEntity();
        ORM::$_db->updateRows($Cliente->getTable(), array(
            'direccion' => $post['direccion'],
            'email' => $post['email'],
            'estado' => $post['estado'],
            'nombre' => $post['nombre'],
            'telefono' => $post['telefono']
        ), array(
            'id_usuario' => $User->getId(),
            'id' => $post['id']
        ));
        $datos['success'] = true;
        die(json_encode($datos));
    }
}

?>