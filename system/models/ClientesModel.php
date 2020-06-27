<?php

/**
 * Created by PhpStorm.
 * User: codeunic
 * Date: 14/07/2017
 * Time: 21:18
 */
class ClientesModel extends Model implements SQL_model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get($id)
    {
        $Cliente = new ClienteEntity();
        return $Cliente->buscarPorPk($id);
    }

    public function remove()
    {
        // TODO: Implement remove() method.
    }

    public function update()
    {
        // TODO: Implement update() method.
    }

    public function create()
    {
        // TODO: Implement create() method.
    }

    public function getAll($Usuario = null)
    {
        $clientes = new ClienteEntity();
        return $clientes->buscarTodos(null, null, array(
            'id_usuario=' => $Usuario->getId()
        ));
    }

    public function truncate()
    {
        // TODO: Implement truncate() method.
    }

    public function obtenerClientes($string)
    {
        $sql = "SELECT * FROM cu_clientes WHERE nombre LIKE '%{$string}%' OR telefono LIKE '%{$string}%'";
        $query = ORM::sql($sql)->fetchAll();

        return $query;
    }
}