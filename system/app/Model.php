<?php

class Model
{
    protected $_db;
    private $_registry;
    protected $_table;

    public function __construct()
    {
        $this->_registry = Registry::getInstancia();
        $this->_db = $this->_registry->_db;
    }

    protected function Setter($datos)
    {
        foreach ($datos as $num => $valor) {
            foreach ($valor as $key => $value) {
                if (!is_array($this->$key)) {
                    $this->$key = array();
                }
                array_push($this->$key, $value);
            }
        }
    }

    protected function rellenarLeft($string, int $character = 10)
    {
        $rellenar = str_pad($string, $character, 0, STR_PAD_LEFT);

        return $rellenar;
    }

    protected function SetterFetch($datos)
    {
        if (empty($datos)) {
            return;
        }
        foreach ($datos as $key => $value) {
            $this->{$key} = $value;
        }
    }

    protected function sql_insert(array $array = array())
    {
        $fields = $this->sql_column($array);
        $values = $this->sql_values($array);
//        $qs = str_repeat("?,", count($fields) - 1);


//        $sql = "INSERT INTO `" . $this->_table . "` (" . $fieldlist . ") VALUES (${qs}?)";
        $sql = "INSERT INTO `" . $this->_table . "` (" . $fields . ") VALUES ($values);";
        return $sql;
    }

    protected function sql_update(array $array = array(), $where = null)
    {
        $fields = $this->sql_set($array);

        $sql = "UPDATE `" . $this->_table . "` SET {$fields} WHERE {$where}";
        return $sql;
    }

    private function sql_column($array)
    {
        $fields = array_keys($array);
        $fieldlist = implode(',', $fields);
        return $fieldlist;
    }

    private function sql_values($array)
    {
        $val = array_values($array);
        $values = "";

        foreach ($val as $item) {
            if (is_numeric($item
            )) {
                $values .= $item . ",";
                continue;
            }
            $values .= "'{$item}',";
        }
        $values = trim($values, ",");

        return $values;
    }

    public function sql_set($array)
    {
        $values = "";

        foreach ($array as $item => $row) {
            if (is_numeric($row)) {
                $values .= "{$item}={$row},";
                continue;
            }
            $values .= "{$item}='{$row}',";
        }
        $values = trim($values, ",");

        return $values;
    }

    protected function sql_descomponer($type, $array, $valorExtra)
    {
        $datos = "";
        switch ($type) {
            case "insert": {
                foreach ($array as $item) {
                    if (is_numeric($item)) {
                        $item = "{$item}";
                    } else {
                        $item = "'{$item}'";
                    }
                    if (is_numeric($valorExtra)) {
                        $valorExtra = "{$valorExtra}";
                    } else {
                        $valorExtra = "'{$valorExtra}'";
                    }
                    $datos .= "({$valorExtra},{$item}),";
                }
            }
        }

        return trim($datos, ",");

    }

    protected function sqlDescomponer($arr, $type = "insert")
    {
        $datos = "";
        switch ($type) {
            case "insert": {
                $datos = "";
                $values = "";
                $keys = "";
                foreach ($arr as $key => $item) {
                    if (is_numeric($item)) {
                        $item = "{$item}";
                    } else {
                        $item = "'{$item}'";
                    }
                    $values .= "{$item},";
                    $keys .= "{$key},";
                }
                return array(
                    "keys" => trim($keys, ","),
                    "values" => trim($values, ",")
                );
            }
        }

        return trim($datos, ",");
    }

    protected function set_table($table)
    {
        $this->_table = DB_PREFIJO . $table;
    }

    protected function setTable($table, $valor)
    {
        $this->{$table} = DB_PREFIJO . $valor;
    }
}

?>
