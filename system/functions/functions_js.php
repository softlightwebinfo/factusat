<?php
    /**
     * Created by PhpStorm.
     * User: rafagonzalez
     * Date: 5/12/16
     * Time: 18:55
     */
?>
<?php

    function funciones_js()
    {
        ob_start();
        ?>
        <script>
            function siteUrl(url) {
                $url = '<?=BASE_URL;?>' + url;
                return $url;
            }
            function siteUrlReact(url) {
                $url = '<?=DOMINIO_REACT;?>' + url;
                return $url;
            }
        </script>

        <?php
        $contenido = ob_get_contents();
        ob_end_clean();
        return $contenido;
    }
