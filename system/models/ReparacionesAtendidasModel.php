<?php
/**
 * Created by PhpStorm.
 * User: codeunic
 * Date: 14/07/2017
 * Time: 21:18
 */

class ReparacionesAtendidasModel extends Model implements SQL_model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get($id)
    {
        $Reparacion = new ReparacionAtendidaEntity();
        return $Reparacion->buscarPorPk($id);
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
        $Reparaciones = new ReparacioneEntity();
        return $Reparaciones->buscarTodos();
    }

    public function truncate()
    {
        // TODO: Implement truncate() method.
    }
}