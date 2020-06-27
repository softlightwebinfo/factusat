<?php

/**
 * Sistema de Templates que enlaza PHP con las plantillas (MVC)
 *
 * Clase encargada de tomar los datos enviados desde
 * PHP en forma de array y distribuirlos sobre un archivo- Template
 * El sistema catura dentro del template las palabras entre {}
 * y las reemplaza por el valor con la llave respectiva de un array asociativo
 *
 * @category MVC
 * @subpackage Library Classes
 * @copyright Copyright (c) 2010, Hidek1 [rhyudek1@gmail.com]
 * @license http://creativecommons.org/licenses/by-sa/2.0/cl/
 * Atribución-Licenciar Igual 2.0 Chile.
 * @since 0.1a
 */
class Template extends Entity
{
    private $_filename;

    /**
     * Obtiene la ruta al template
     * este debe tener permisos de lectura
     * retorna una Exception en caso de que
     * el archivo especificado no se encuentre.
     *
     * @param string $filename
     */
    public function __construct($filename)
    {
        parent::__construct();
        if (file_exists($filename)) {
            $this->_filename = $filename;
        } else {
            throw new Exception("Template no encotrado.");
        }
    }

    /**
     * Devuelve el template procesado con sus variables correspondientes
     * captura dentro de este las palabras entre {} y las modifica por su
     * valor correspondiente en el array
     *
     * $valores = array('foo' => 'bar');
     * La palabra de prueba {foo}
     *
     * @param array $matriz
     * @return string
     */
    public function render(array $matriz = array())
    {
        if (empty($matriz)) {
            return file_get_contents($this->_filename);
        } else {
            foreach ($matriz as $key => $value) {
                $$key = $value;
            }
            $template = file_get_contents($this->_filename);
            $template = str_replace(array('\\', '\''), array('\\\\', '\\\''), $template);
            $template = preg_replace('/{([a-z]\w+?)}/i', "'.$$1.'", $template);
            eval("\$template = '$template';");
            return $template;
        }
    }
}