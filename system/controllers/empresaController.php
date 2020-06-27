<?php

/**
 * Created by PhpStorm.
 * User: codeunic
 * Date: 15/07/2017
 * Time: 21:04
 */
class empresaController extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {

    }

    public function getDatos($token)
    {

        $User = $this->_getUserToken($token);
        $Config = new ConfigEntity();
        $Config->buscar(array(
            'id_usuario=' => $User->getId(),
        ));

        $datos = array(
            'empresa_nombre' => $User->getUsuario(),
            'empresa_email_login' => $User->getEmail(),
            'empresa_role' => $User->getRole(),
            'empresa_registro' => $User->getFechaRegistro(),
            'empresa_datos_email' => $Config->getCorreo(),
            'empresa_datos_direccion' => $Config->getDireccion(),
            'empresa_datos_telefono' => $Config->getTelefono(),
            'empresa_datos_logo' => $Config->getLogo(),
            'empresa_id' => $User->getId()
        );


        die(json_encode($datos));
    }

    public function actualizarEmpresa($token)
    {
        $datos = array(
            'success' => false
        );

        $User = $this->_getUserToken($token);
        $Config = new ConfigEntity();
        $Config->buscar(array(
            'id_usuario=' => $User->getId()
        ));
        $post = $_POST;
        ORM::$_db->updateRows($User->getTable(), array(
            'usuario' => $post['empresa_nombre']
        ),
            array(
                'id' => $User->getId()
            )
        );
        $dato = array(
            'correo' => $post['empresa_datos_email'],
            'direccion' => $post['empresa_datos_direccion'],
            'telefono' => $post['empresa_datos_telefono'],
        );
        if (!empty($_FILES['empresa_datos_logo'])) {
            $dir = "public/usuario/{$User->getId()}/{$Config->getLogo()}";
            if (is_readable($dir)) {
                unlink($dir);
            }
            $file = Image::uploadFile("public/usuario/{$User->getId()}/", 'empresa_datos_logo');
            $dato['logo'] = $file;
        }

        ORM::$_db->updateRows($Config->getTable(), $dato, array(
            'id_usuario' => $User->getId(),
        ));
        $datos['success'] = true;

        $this->getDatos($token);
    }
}