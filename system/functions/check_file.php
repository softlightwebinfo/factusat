<?php
    function checkFiles($ruta)
    {
        if (file_exists($ruta)) {
            return true;
        } else {
            return false;
        }
    }

?>
