<?php

class menuModelWidget extends Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getMenu($menu)
    {
        $dbName = DB_PREFIJO . "widgets";
        $men = $this->_db->query("SELECT * FROM {$dbName} WHERE activo=1");
        $men = $men->fetchAll(PDO::FETCH_OBJ);
        $menus = array();
        foreach ($men as $key => $valor) {
            $menus[$valor->nombre] = json_decode($valor->datos);
        }
        return $menus[$menu];
    }

}


?>
