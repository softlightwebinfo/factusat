<?php
/*
 * -------------------------------------
 * www.smartyhelpers.com
 * Framework 1.0.0 CWeb
 * index.phtml
 * -------------------------------------
 */
/**************************************** DEVELOPER *****************************************/
define("DEVELOPER", true);
define("CONFIG_FILE", 'Config');
define("CU_CONFIG", 'cu-config');
if ($_SERVER['SERVER_NAME'] == "localhost") {
    $config = CONFIG_FILE . "_local.php";
    $cuConfig = CU_CONFIG . "_local.php";
} else {
    $config = CONFIG_FILE . ".php";
    $cuConfig = CU_CONFIG . ".php";
}

/*MOSTRAMOS ERRORES PHP*/
if (DEVELOPER) {
    ini_set("display_errors", "1");
    error_reporting(E_ALL);
} else {
    ini_set("display_errors", "0");
    error_reporting(0);
}
# Es mostrar la forma en la que se separan las carpetas. Por ejemplo. En Windows es \ en Linux es /
define('DS', DIRECTORY_SEPARATOR);
# La ruta raiz de la aplicación
define("SYSTEM_NAME", "system");
define("ROOT_NAME", "cibersat");
define('ROOT', realpath(dirname(__FILE__)) . DS . SYSTEM_NAME . DS);
# DOCUMENT_ROOT
define("DOCUMENT_ROOT", $_SERVER['DOCUMENT_ROOT']);
# Definimos el directorio de las aplicaciones
define('APP_PATH', ROOT . 'app' . DS);
define('FUNCTIONS_PATH', ROOT . 'functions' . DS);
# Incluimos los archivos base de la aplicacion
try {
    # Auto cargas de clases
    require_once APP_PATH . 'Autoload.php';
    # Archivo de configuracion de la aplicación
    require_once APP_PATH . $config;
    # Cargamos el archivo predeterminado functions
    require_once FUNCTIONS_PATH . "functions_system.php";
    # Cargamos el archivo de funciones maestras
    require_once APP_PATH . "Functions.php";
    # FUNCION PARA LA WEB EN MANTENIMIENTO
    mantenimiento(MANTENIMIENTO, array('127.0.0.1'));
    if (!file_exists(APP_PATH . DS . $cuConfig)) {
        include ROOT . "install" . DS . "index.php";
        exit;
    } else {
        include APP_PATH . $cuConfig;
    }
    # Iniciamos la sessión
    Session::init();
    # Iniciamos el sistema singleton
    $registry = Registry::getInstancia();
    # Iniciamos el mapping de url
    # Instanciamos la base de datos
    $registry->_db = new Database(DB_HOST, DB_NAME, DB_USER, DB_PASS, DB_CHAR);
    $registry->_request = new Request();
    $registry->_system = new CodeUnic();
    # Instanciamos el sistema de permisos
    $registry->_acl = new ACL();
    $registry->_user = new User();

    Bootstrap::run($registry->_request);

} catch (Exception $ex) {
    if (is_numeric($ex)) {
        redirect("error/access/{$ex->getMessage()}/");
    } else {
        echo $ex->getMessage();
    }
}
?>
