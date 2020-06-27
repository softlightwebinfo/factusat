<?php
/**
 * Created by PhpStorm.
 * User: codeunic
 * Date: 14/07/2017
 * Time: 21:18
 */

class MunicipiosModel extends Model implements SQL_model
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

    public function getAll($limit = "50")
    {
        // TODO: Implement getAll($datos=null) method.
        $municipios = new MunicipioEntity();
        return $municipios->buscarTodos($limit);
    }

    public function truncate()
    {
        // TODO: Implement truncate() method.
    }

    public function getAllId($provinciaID)
    {
        $municipios = array();

        ORM::select();
        ORM::from('municipios');
        ORM::where('provinciaID', $provinciaID);
        ORM::order_by('municipio');
        $st = ORM::build();
        $municipios = $st->object('municipio');
        return $municipios;
    }
}