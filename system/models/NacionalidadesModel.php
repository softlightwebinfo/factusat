<?php
/**
 * Created by PhpStorm.
 * User: codeunic
 * Date: 14/07/2017
 * Time: 21:18
 */

class NacionalidadesModel extends Model implements SQL_model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get($id)
    {
        // TODO: Implement get() method.
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

    public function getAll($datos=null)
    {
        // TODO: Implement getAll($datos=null) method.
        $nacionalidades = new NacionalidadEntity();
        return $nacionalidades->buscarTodos();
    }

    public function truncate()
    {
        // TODO: Implement truncate() method.
    }
}