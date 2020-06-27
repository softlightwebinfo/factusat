<?php

class loginController extends Controller
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

    public function iniciarSession()
    {
        $post = $this->axios();
        $this->headerJson();
        $datos = array(
            'error' => true,
            'errorMensaje' => '',
            'user' => array(
                '_id' => null,
                '_token' => null,
            )
        );
        $time = time();

        $User = new Usuario();

        try {
            $User->iniciarSession($post['email'], $post['password']);
            $datos['errorMensaje'] = 'Ha iniciado correctamente';
            $auth = Auth::SignIn([
                'id' => $User->getId(),
                'token' => $User->getToken()
            ]);
            $datos['user'] = array(
                '_token' => $auth
            );
            $datos['error'] = false;
        } catch (Exception $exception) {
            $datos['error'] = true;
            $datos['errorMensaje'] = 'Error no existe la cuenta o no tienes privilegios.';
        }

        die(json_encode($datos));
    }
}

?>