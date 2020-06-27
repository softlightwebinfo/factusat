<?php

/**
 * Created by PhpStorm.
 * User: rafa
 * Date: 08/03/2017
 * Time: 23:00
 */
class ConfigLayout
{
    private $file;
    const CARPETA = "config";
    const NAME_FILE = "configLayout.json";
    private $file_content;

    function __construct(String $file)
    {
        $this->file = $file;
        $this->file_content = $this->obtenerFile();
//        print_pre($this->file_content);

        return $this;
    }

    private function obtenerFile(): array
    {
        $content = file_get_contents($this->file . self::CARPETA . DS . self::NAME_FILE);
        $json = json_decode($content, false);
        $result = array();
        foreach ($json as $key => $row) {
            foreach ($row as $clave => $valor) {
                $result[$clave] = $valor;
            }
        }
        return $result;
    }

    public function obtener(String $dato)
    {
        if ($this->file_content[$dato]) {
            return $this->file_content[$dato];
        } else {
            return null;
        }
    }
}