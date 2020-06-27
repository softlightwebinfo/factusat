<?php
    /*
     * -------------------------------------
     * www.smartyhelpers.com
     * Framework 1.0.0 CWeb
     * index.phtml
     * -------------------------------------
     */
    function listar_archivos($carpeta, $callback)
    {
        if (is_dir($carpeta)) {
            if ($dir = opendir($carpeta)) {
                $array = array();
                while (($archivo = readdir($dir)) !== false) {
                    if ($archivo != '.' && $archivo != '..' && $archivo != '.htaccess') {
                        if ($callback !== null) {
                            $callback($carpeta, $archivo);
                        } else {
                            array_push($array, array(
                                "directory" => $carpeta,
                                "file" => $archivo
                            ));
                        }
                    }
                }
                closedir($dir);

                return $array;
            }
        }
    }
