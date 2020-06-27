<?php

class Modules extends Model
{
    private $id;
    private $nombre;
    private $activo;
    private $modules;
    private $table = "modules";

    public function __construct()
    {
        parent::__construct();
        $this->table = DB_PREFIJO . $this->table;
    }

    public function _LoadModules()
    {
        $q = "SELECT * FROM {$this->table}";
        $query = $this->_db->query($q);
        $fetch = $query->fetchAll(PDO::FETCH_OBJ);
        foreach ($fetch as $key => $valor) {
            $this->modules[$key]['name'] = $valor->name;
            $this->modules[$key]['active'] = $valor->active;
        }
    }

    public function getModules()
    {
        return $this->modules;
    }

    public function search($dato)
    {
        $msg = false;
        foreach ($this->getModules() as $key => $valor) {
            if ($valor['name'] == $dato) {
                if ($valor['active']) {
                    return true;
                }
                break;
            }
        }
        return $msg;
    }
}

?>