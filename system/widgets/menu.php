<?php

/*
 * -------------------------------------
 * www.interactivesweb.com | Rafa Gonzalez Muñoz
 * framework mvc basico
 * menu.php
 * -------------------------------------
 */

class menuWidget extends Widget
{

    private $modelo;

    public function __construct()
    {
        $this->modelo = $this->loadModel('menu');
    }

    public function getMenu($menu, $view, $inverse = null)
    {
        $data['menu'] = $this->modelo->getMenu($menu);
        $data['inverse'] = $inverse;
        return $this->render($view, $data);
    }

    public function getConfig($menu)
    {
        $menus = array();

        $db = new Database(DB_HOST, DB_NAME, DB_USER, DB_PASS, DB_CHAR);
        $dbName = DB_PREFIJO . "widgets";
        $query = $db->query("SELECT * FROM {$dbName} WHERE activo=1");
        $men = $query->fetchAll(PDO::FETCH_OBJ);

        foreach ($men as $key => $valor) {
            if ($valor->show === "all") {
                $show = 'all';
            } else {
                $exp = explode(',', $valor->show);
                $show = $exp;
            }
            $exp2 = explode(',', $valor->hide);
            if (!empty($exp2[0])) {
                $menus[$valor->nombre] = array(
                    'position' => $valor->position,
                    'show' => $show,
                    'hide' => $exp2,
                );
            } else {
                $menus[$valor->nombre] = array(
                    'position' => $valor->position,
                    'show' => $show,
                );
            }

        }

        return $menus[$menu];
    }

}

?>
