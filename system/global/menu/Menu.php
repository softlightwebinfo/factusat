<?php


class Menu extends Model
{
    private $menu = array();
    private $left = array();
    private $right = array();
    private $table;

    public function __construct()
    {
        $this->table = DB_PREFIJO . "cu_menu";
        parent::__construct();
        $this->getMenu();
    }

    private function getMenu()
    {
        $sql = "SELECT * FROM {$this->table} ORDER BY orden ASC";
        $sql = $this->_db->query($sql);
        $row = $sql->fetchAll(PDO::FETCH_OBJ);
        $this->menu = $row;
    }

    public function getPosition($position)
    {
        $pos = "set" . ucfirst($position);
        $pos = $this->$pos();
        return $pos;
    }

    private function setLeft()
    {
        foreach ($this->menu as $key => $value) {
            if ($value->active and $value->position == 'left') {
                array_push($this->left, $value);
            }
        }
        return $this->left;
    }

    private function setRight()
    {
        foreach ($this->menu as $key => $value) {
            if ($value->active and $value->position == 'right') {
                array_push($this->right, $value);
            }
        }
        return $this->right;
    }
}

?>
