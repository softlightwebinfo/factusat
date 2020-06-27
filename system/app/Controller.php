<?php

abstract class Controller
{

    protected $_view;
    protected $_acl;
    protected $_request;
    protected $_userdata;
    private $_registry;
    protected $_db;
    protected $vista = false;

    public function __construct()
    {
        $this->_registry = Registry::getInstancia();
        $this->_acl = $this->_registry->_acl;
        $this->_request = $this->_registry->_request;
        $this->_userdata = new User();
        $this->_db = $this->_registry->_db;
        $this->_view = new View($this->_request, $this->_acl, $this->_registry);
    }

    abstract public function index();

    public function setVista($vista)
    {
        $this->vista = $vista;
    }

    public function getVista()
    {
        return $this->vista;
    }

    function validateKeys($keys, $where)
    {
        foreach ($keys as $key) {
            if (empty($where[$key]) or !isset($where[$key])) {
                exit("No se encuentra el campo " . $key . "!");
            }
        }

        return true;
    }

    public function validarEmail($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        return true;
    }

    public function loadAjax($file, $atributos)
    {
        include(ROOT_API . $file);
    }

    protected function loadModel($modelo, $modulo = false)
    {
        $modelo = ucfirst($modelo . "Model");
        $rutaModelo = ROOT . "models" . DS . $modelo . ".php";
        if (!$modulo) {
            $modulo = $this->_request->getModulo();
        }
        if ($modulo) {
            if ($modulo != 'default') {
                $rutaModelo = ROOT . 'modules' . DS . $modulo . DS . "models" . DS . $modelo . ".php";
            }
        }
        if (is_readable($rutaModelo)) {
            require_once $rutaModelo;
            $modelo = new $modelo;

            return $modelo;
        } else {
            throw new Exception("Error de modelo");
        }
    }

    protected function includeModel($modelo, $modulo = false)
    {
        $modelo = ucfirst($modelo . "Model");
        $rutaModelo = ROOT . "models" . DS . $modelo . ".php";
        if (!$modulo) {
            $modulo = $this->_request->getModulo();
        }
        if ($modulo) {
            if ($modulo != 'default') {
                $rutaModelo = ROOT . 'modules' . DS . $modulo . DS . "models" . DS . $modelo . ".php";
            }
        }
        if (is_readable($rutaModelo)) {
            require_once $rutaModelo;
        } else {
            throw new Exception("Error de modelo");
        }
    }

    protected function getLibrary($libreria)
    {
        $rutaLibreria = ROOT . "libs" . DS . $libreria . ".php";
        if (is_readable($rutaLibreria)) {
            require_once $rutaLibreria;
        } else {
            throw new Exception("Error de libreria");
        }
    }

    protected function getTexto($clave)
    {
        if (isset($_POST[$clave]) && !empty($_POST[$clave])) {
            $_POST[$clave] = htmlspecialchars($_POST[$clave], ENT_QUOTES);

            return $_POST[$clave];
        }

        return '';
    }

    protected function getInt($clave)
    {
        if (isset($_POST[$clave]) && !empty($_POST[$clave])) {
            $_POST[$clave] = filter_input(INPUT_POST, $clave, FILTER_VALIDATE_INT);

            return $_POST[$clave];
        }

        return 0;
    }

    protected function redireccionar($ruta = false)
    {
        if ($ruta) {
            header('location:' . BASE_URL . $ruta);
            exit;
        } else {
            header('location:' . BASE_URL);
            exit;
        }
    }

    protected function redireccionarURL($ruta = false)
    {
        if ($ruta) {
            header('location:' . $ruta);
            exit;
        } else {
            header('location:' . BASE_URL);
            exit;
        }
    }

    protected function GetURL($url = null)
    {
        if ($url == "http") {
            $url_actual = "http://" . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
        } else {
            $url_actual = $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
        }

        return $url_actual;
    }

    protected function filtrarInt($int)
    {
        $int = (int)$int;

        if (is_int($int)) {
            return $int;
        } else {
            return 0;
        }
    }

    protected function getPostParam($clave)
    {
        if (isset($_POST[$clave])) {
            return $_POST[$clave];
        }
    }

    protected function getPostParamSql($clave = null)
    {
        if (!empty($clave)) {

            if (isset($_POST[$clave]) && !empty($_POST[$clave])) {
                $_POST[$clave] = strip_tags($_POST[$clave]);

                return trim($_POST[$clave]);
            }
        }

    }

    protected function getSql($clave)
    {
        if (isset($_POST[$clave]) && !empty($_POST[$clave])) {
            $_POST[$clave] = strip_tags($_POST[$clave]);

            return trim($_POST[$clave]);
        }
    }

    protected function getAlphaNum($clave)
    {
        if (isset($_POST[$clave]) && !empty($_POST[$clave])) {
            $_POST[$clave] = (string)preg_replace('/[^A-Z0-9_]/i', '', $_POST[$clave]);

            return trim($_POST[$clave]);
        }
    }

    protected function formatPermiso($clave)
    {
        if (isset($_POST[$clave]) && !empty($_POST[$clave])) {
            $_POST[$clave] = (string)preg_replace('/[^A-Z_]/i', '', $_POST[$clave]);

            return trim($_POST[$clave]);
        }
    }

    protected function empty($data)
    {
        if (empty($data)) {
            return true;
        }

        return false;

    }

    protected function post($data = null)
    {
        if (!is_null($data)) {
            if (isset($_POST[$data])) {
                return $_POST[$data];
            }
        }

        return null;
    }

    protected function get($data)
    {
        if (!is_null($data)) {
            if (isset($_GET[$data])) {
                return $_GET[$data];
            }
        }

        return null;
    }

    protected function server($data)
    {
        return $_SERVER[$data];
    }

    protected function request($data)
    {
        return $_SERVER[$data];
    }

    protected function validate($name, $type = "true")
    {
        switch ($type) {
            case "true": {
                if ($this->empty($name)) {
                    return true;
                } else {
                    return false;
                }
                break;
            }
            case "false": {
                break;
            }
            case "email": {
                return $this->validarEmail($name);
                break;
            }
        }

    }

    /**
     * @param String $string
     *
     * @return String
     */
    public function rellenar($string, $direction, $character = 10)
    {
        if ($direction == "left") {
            $rellenar = $this->rellenarLeft($string, $character);
        } else {
            $rellenar = str_pad($string, $character, "-=", STR_PAD_RIGHT);
        }

        return $rellenar;
    }

    public function rellenarLeft($string, int $character = 10)
    {
        $rellenar = str_pad($string, $character, 0, STR_PAD_LEFT);

        return $rellenar;
    }

    protected function segment($position)
    {

        $url = trim($_GET['url'], "/");
        $urlEx = explode("/", $url);
        if (isset($urlEx[$position - 1])) {
            return $urlEx[$position - 1];
        }
        return false;
    }

    protected function is_ajax()
    {
        if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) return false;
        if ($_SERVER['HTTP_X_REQUESTED_WITH'] !== "XMLHttpRequest") {
            return false;
        }
        return true;
    }

    protected function is_post()
    {
        if ($_SERVER['REQUEST_METHOD'] !== "POST") {
            return false;
        }
        return true;
    }

    protected function is_get()
    {
        if ($_SERVER['REQUEST_METHOD'] !== "GET") {
            return false;
        }
        return true;
    }

    protected function axios()
    {
        $datos = json_decode(file_get_contents("php://input"), true);
        return $datos;
    }

    public function headerJson()
    {
        return header('Content-Type: application/json');
    }

    public function _getUserToken($token): Usuario
    {
        $t = Auth::GetData(
            $token
        );
        $Usuario = new Usuario();
        $Usuario->setId($t->id);
        $Usuario->buscarPorPk();
        return $Usuario;
    }
}

?>