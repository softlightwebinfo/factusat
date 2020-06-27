<?php
/* VARIABLES GLOBALES DE LAS FUNCIONES */
$STYLESHEET = array();
$JAVASCRIPT = array();

# STYLESHEET
function StyleSheet()
{
    global $STYLESHEET;
    $ruta = SYSTEM . "src/css/";
    array_push($STYLESHEET, $ruta . "system.css");

    return $STYLESHEET;
}

function Add_StyleSheet($css = null, $order = 'top')
{
    global $STYLESHEET;
    $ruta = SYSTEM . "src/css/";
    if ($css != null) {
        switch ($order) {
            case 'top':
                array_unshift($STYLESHEET, $ruta . $css . ".css");
                break;
            case 'bottom':
                array_push($STYLESHEET, $ruta . $css . ".css");
                break;
        }

    }
}

function Javascript()
{
    global $JAVASCRIPT;
    $ruta = SYSTEM . "src/js/";

    //        array_push($JAVASCRIPT, array("position" => 'header', 'file' => $ruta . "jquery-3.1.1.min" . ".js"));
    //        array_push($JAVASCRIPT, array("position" => 'header', 'file' => $ruta . "jquery-3.1.1.min" . ".js"));

    return $JAVASCRIPT;
}

function Add_Javascript($js = null, $order = 'top')
{
    global $JAVASCRIPT;
    $ruta = SYSTEM . "src/js/";

    if ($js != null) {
        switch ($order) {
            case 'top':
                array_unshift($JAVASCRIPT, $ruta . $js . ".js");
                break;
            case 'bottom':
                array_push($JAVASCRIPT, $ruta . $js . ".js");
                break;
        }

    }
}

/* HELPERS */
function base_url($url = "")
{
    return BASE_URL . $url;
}

function imageUrl($image = "", $dir = "public")
{
    return BASE_URL . "{$dir}/img/{$image}";
}

function publicUrl($image = "", $dir = "public")
{
    return BASE_URL . "{$dir}/{$image}";
}

function publicJs($js = "")
{
    return BASE_URL . "public/js/{$js}.js";
}

function imageUsuario($image = "", $dir = "usuarios")
{
    return BASE_URL . "public/{$dir}/{$image}";
}

function imageUrlSrc($image = "", $dir = "system/src/")
{
    return BASE_URL . "{$dir}/img/{$image}";
}

function src($file, $ruta = "")
{
    return base_url("system/src/" . $ruta . "/" . $file);
}

function srcLib(string $lib, string $ruta): string
{
    return base_url("system/src/libs/" . $lib . "/" . $ruta);
}

function ruta_public($file = "")
{
    return base_url("public/" . $file);
}

function getFunctionsJs()
{
    if (function_exists("funciones_js")) {
        echo funciones_js();
    }
}

/**
 * Obtenemos la plantilla
 *
 * @param        $url
 * @param string $ruta
 *
 * @return string
 */
function getTemplate($file, $ruta = "templates/")
{
    $ruta = ROOT . $ruta . $file . ".phtml";
    ob_start();
    include($ruta);
    $content = ob_get_contents();
    ob_end_clean();

    return $content;
}

/**
 * Remplazamos el contenido de la plantilla
 *
 * @param $content
 * @param $search
 * @param $replace
 *
 * @return mixed
 */
function template_replace($content, $search, $replace)
{
    return str_replace($search, $replace, $content);
}

function searchString($string, $search)
{
    $encontrado = false;
    $pos = "";
    if (is_array($search)) {
        foreach ($search as $need) {
            if (strpos($string, $need) !== false) {
                $encontrado = true;
                $pos = strpos($string, $need);
                break;
            }
        }
        if ($encontrado) {
            return $pos;
        } else {
            return false;
        }
    } else {
        if ($datos = strpos($search, $string)) {
            return $datos;
        } else {
            return false;
        }
    }


}

function srcCss($file)
{
    return SYSTEM . "src/css/{$file}.css";
}

function view($url)
{
    include(ROOT . "views" . DS . $url . ".phtml");
}

?>