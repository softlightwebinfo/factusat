<?php

    function redirect($url = null)
    {
        if ($url == null) {
            header("Location: " . BASE_URL);
        } else {
            header("Location: " . BASE_URL . $url);
        }
    }

?>
