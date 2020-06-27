<?php
    function detecting_system()
    {
        /**
         * Función para detectar el sistema operativo, navegador y versión del mismo
         */
        /**
         * Funcion que devuelve un array con los valores:
         *    os => sistema operativo
         *    browser => navegador
         *    version => version del navegador
         */
        $browser = array("IE", "OPERA", "MOZILLA", "NETSCAPE", "FIREFOX", "SAFARI", "CHROME");
        $os = array("WINDOWS", "MAC", "LINUX");

        # definimos unos valores por defecto para el navegador y el sistema operativo
        $info['browser'] = "OTHER";
        $info['os'] = "OTHER";
        # buscamos el navegador con su sistema operativo

        foreach ($browser as $parent => $item) {
            $s = strpos(strtoupper($_SERVER['HTTP_USER_AGENT']), $parent);
            $f = $s + strlen($parent);
            $version = substr($_SERVER['HTTP_USER_AGENT'], $f, 15);
            $version = preg_replace('/[^0-9,.]/', '', $version);
            if ($s) {
                $info['browser'] = $parent;
                $info['version'] = $version;
            }
        }

        # obtenemos el sistema operativo
        foreach ($os as $val) {
            if (strpos(strtoupper($_SERVER['HTTP_USER_AGENT']), $val) !== false) {
                $info['os'] = $val;
            }
        }

        # devolvemos el array de valores
        return $info;
    }

?>
