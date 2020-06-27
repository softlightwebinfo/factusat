<?php
    function CrearFiles($ruta, $content)
    {
        $file = fopen($ruta, "w");
        fwrite($file, $content . PHP_EOL);
        fclose($file);
    }

?>
