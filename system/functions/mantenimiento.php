<?php
function mantenimiento($activar, $ips, $ruta = "mantenimiento/index.html")
{
    if ($activar and !in_array($_SERVER['REMOTE_ADDR'], $ips)) {
        include_once(ROOT . $ruta);
        exit;
    }
}

?>
