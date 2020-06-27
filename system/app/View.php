<?php

/*
 * -------------------------------------
 * www.interactivesweb.com | Rafa Gonzalez Muñoz
 * framework mvc basico
 * View.php
 * -------------------------------------
 */

class View
{

    private static $_item;
    private $_request;
    private $_js;
    private $_jsLibs;
    private $_acl;
    private $_rutas;
    private $_jsPlugin;
    private $template_dir;
    private $contenido;
    private $_template;
    private $_widget;
    private $_configure;
    private $_user;
    private $_registry;
    private $_userdata;
    private $config;

    public function __construct(Request $peticion, ACL $_acl, Registry $registry)
    {
        $this->_request = $peticion;
        $this->_configure = new Configure();
        $this->_js = array();
        $this->_jsLibs = array();
        $this->_acl = $_acl;
        $this->_userdata = $registry->user;
        $this->_rutas = array();
        $this->_jsPlugin = array();
        $this->_template = DEFAULT_LAYOUT;
        self::$_item = null;
        $modulo = $this->_request->getModulo();
        $controlador = $this->_request->get_controlador();
        if ($modulo) {
            $this->_rutas['ruta'] = ROOT . 'modules' . DS . $modulo . DS;
            $this->_rutas['view'] = ROOT . 'modules' . DS . $modulo . DS . 'views' . DS . $controlador . DS;
            $this->_rutas['load_view'] = ROOT . 'modules' . DS . $modulo . DS . 'views' . DS;
            $this->_rutas['views'] = ROOT . "views" . DS;
            $this->_rutas['viewsController'] = ROOT . "views" . DS . $controlador . DS;
            $this->_rutas['js'] = SYSTEM . 'modules' . '/' . $modulo . 'views' . $controlador . '/js/';
        } else {
            $this->_rutas['ruta'] = ROOT . "controllers" . DS . $controlador . DS;
            $this->_rutas['view'] = ROOT . "views" . DS . $controlador . DS;
            $this->_rutas['views'] = ROOT . "views" . DS;
            $this->_rutas['viewsController'] = ROOT . "views" . DS . $controlador . DS;
            $this->_rutas['load_view'] = ROOT . "views" . DS;
            $this->_rutas['js'] = SYSTEM . "views/" . $controlador . '/js/';
        }
        $this->_user = new User();
    }

    public static function getViewId()
    {
        return self::$_item;
    }

    public function renderizar($vista, $item = false, $noLayout = false)
    {
        # Cargamos el archivo de configuracion global
        require_once APP_PATH . "Main.php";
        if ($item) {
            self::$_item = $item;
        }
        //        print_r($this->getWidgets());

        $this->template_dir = ROOT . "layout" . DS . $this->_template . DS;
        $this->contenido = $this->_rutas['view'] . $vista . ".phtml";
        $_layoutParams = array(
            "src_js" => SYSTEM . "src/js/",
            "ruta_src_libs" => SYSTEM . "src/libs/",
            "ruta_dir" => $this->_rutas['ruta'],
            "ruta" => SYSTEM . "layout/" . $this->_template,
            "ruta_css" => SYSTEM . "layout/" . $this->_template . '/css/',
            "ruta_img" => SYSTEM . "layout/" . $this->_template . 'img/',
            "ruta_js" => SYSTEM . "layout/" . $this->_template . "js/",
            "src" => SYSTEM . SYSTEM_NAME . "/",
            "ruta_include" => ROOT . "inc" . DS,
            "ruta_public" => BASE_URL . 'public/',
            "js" => $this->_js,
            'item' => $item,
            'js_plugin' => $this->_jsPlugin,
            'root' => BASE_URL,
            'configs' =>
                array(
                    'app_name' => APP_NAME,
                    'app_slogan' => APP_SLOGAN,
                    'app_company' => APP_COMPANY
                ),
            "jsLibs" => $this->_jsLibs
        );
        //        echo "<pre>";print_r($this->_rutas);exit;
        $ruta = $this->_rutas['view'] . $vista . ".phtml";

        $this->config = new ConfigLayout($this->template_dir);

        if (is_string($noLayout)) {
            $noLayout = str_replace('Controller', '', $noLayout);
            $ruta = $this->_rutas['views'] . $noLayout . DS . $vista . ".phtml";
        }
        if (is_readable($ruta)) {
            if (!is_null($noLayout) and $noLayout !== false and $noLayout !== true) {
                include_once $ruta;
                return;
            } elseif ($noLayout) {
                $this->template = $this->_rutas['view'];
                include_once $this->contenido;
                exit();
            } elseif (is_null($noLayout)) {
                $this->template = $this->_rutas['view'];
                ob_start();
                include_once $this->contenido;
                $dato = ob_get_contents();
                ob_end_clean();

                return $dato;
            }
            $this->_contenido = $this->contenido;
            //            include_once $this->_rutas['view'] . $vista . ".phtml";
            //            include_once ROOT . "views" . DS . "layout" . DS . DEFAULT_LAYOUT . DS . "footer.php";
        } else {
            throw new Exception("Error de vista");
        }
        $this->_widgets = $this->getWidgets();
        $this->_acl = $this->_acl;
        $this->_layoutParams = $_layoutParams;
        $rutaTemplate = $this->template_dir . "template.php";
        if (!is_null($noLayout)) {
            require_once $rutaTemplate;
            $this->removeMessage();
            exit;
        }
    }

    public function renderizarInclude($vista, $noLayout = true, $datos = array())
    {
        # Cargamos el archivo de configuracion global
        require_once APP_PATH . "Main.php";

        $this->contenido = $this->_rutas['views'] . $vista . ".phtml";
        $_layoutParams = array(
            "src_js" => SYSTEM . "src/js/",
            "ruta_src_libs" => SYSTEM . "src/libs/",
            "ruta_dir" => $this->_rutas['ruta'],
            "ruta" => SYSTEM . "layout/" . $this->_template,
            "ruta_css" => SYSTEM . "layout/" . $this->_template . 'css/',
            "ruta_img" => SYSTEM . "layout/" . $this->_template . 'img/',
            "ruta_js" => SYSTEM . "layout/" . $this->_template . "js/",
            "src" => SYSTEM . SYSTEM_NAME . "/",
            "ruta_include" => ROOT . "inc" . DS,
            "ruta_public" => BASE_URL . 'public/',
            "js" => $this->_js,
            'item' => self::$_item,
            'js_plugin' => $this->_jsPlugin,
            'root' => BASE_URL,
            'configs' =>
                array(
                    'app_name' => APP_NAME,
                    'app_slogan' => APP_SLOGAN,
                    'app_company' => APP_COMPANY
                ),
            "jsLibs" => $this->_jsLibs
        );
        $ruta = $this->_rutas['views'] . $vista . ".phtml";

        $this->config = new ConfigLayout($this->template_dir);
        if (is_readable($ruta)) {
            $this->_widgets = $this->getWidgets();
            $this->_acl = $this->_acl;
            $this->_layoutParams = $_layoutParams;
            if ($noLayout) {
                $this->template = $this->_rutas['view'];
                extract($datos);
                include $this->contenido;
            } elseif (!$noLayout) {
                ob_start();
                extract($datos);
                include $this->contenido;
                $dato = ob_get_contents();
                ob_end_clean();
                return $dato;
            }
        } else {
            throw new Exception("Error de vista");
        }
    }

    public function renderizarController($vista, $noLayout = null)
    {
        # Cargamos el archivo de configuracion global
        require_once APP_PATH . "Main.php";

        $this->contenido = $this->_rutas['views'] . $vista . ".phtml";
        $_layoutParams = array(
            "src_js" => SYSTEM . "src/js/",
            "ruta_src_libs" => SYSTEM . "src/libs/",
            "ruta_dir" => $this->_rutas['ruta'],
            "ruta" => SYSTEM . "layout/" . $this->_template,
            "ruta_css" => SYSTEM . "layout/" . $this->_template . 'css/',
            "ruta_img" => SYSTEM . "layout/" . $this->_template . 'img/',
            "ruta_js" => SYSTEM . "layout/" . $this->_template . "js/",
            "src" => SYSTEM . SYSTEM_NAME . "/",
            "ruta_include" => ROOT . "inc" . DS,
            "ruta_public" => BASE_URL . 'public/',
            "js" => $this->_js,
            'item' => self::$_item,
            'js_plugin' => $this->_jsPlugin,
            'root' => BASE_URL,
            'configs' =>
                array(
                    'app_name' => APP_NAME,
                    'app_slogan' => APP_SLOGAN,
                    'app_company' => APP_COMPANY
                ),
            "jsLibs" => $this->_jsLibs
        );
        $ruta = $this->_rutas['views'] . $vista . ".phtml";

        $this->config = new ConfigLayout($this->template_dir);

        $url = explode("/", $vista);
        # Todos los elementos que no sean validos en el array los va a eliminar
        $url = array_filter($url);

        # El array_shift extrae el primer elemento y me lo devuelve
        $controller = strtolower(array_shift($url));
        $method = null;
        $args = null;
        if (!$controller) {
            $controller = "index";
        }
        $method = strtolower(array_shift($url));
        $method = str_replace("-", "", $method);
        $args = $url;

        if (!$controller) {
            $controller = DEFAULT_CONTROLLER;
        }
        if (!$method) {
            $method = "index";
        }
        if (!$args) {
            $args = array();
        }
        $rutaControlador = ROOT . 'controllers' . DS . $controller . "Controller.php";
        if (is_readable($rutaControlador)) {
            require_once $rutaControlador;
            $controller = str_replace("-", "", $controller) . 'Controller';
            $controller = new $controller();
            $controller->setVista(get_class($controller));
            # verifica si el archivo existe y es legible
            if (is_callable(array($controller, $method))) {
                $method = $method;
            } else {
                $method = DEFAULT_METHOD;
            }
            if (isset($args)) {
                call_user_func_array(array($controller, $method), $args);
            } else {
                call_user_func($controller, $method);
            }
        } else {
            throw new Exception(404);
        }
    }

    public function load_view($vista, $item = false, $noLayout = false)
    {
        # Cargamos el archivo de configuracion global
        if ($item) {
            self::$_item = $item;
        }
        $_layoutParams = array("src_js" => SYSTEM . "src/js/", "ruta_src_libs" => SYSTEM . "src/libs/", "ruta_dir" => $this->_rutas['ruta'], "ruta_css" => SYSTEM . "layout/" . $this->_template . 'css/', "ruta_img" => SYSTEM . "layout/" . $this->_template . 'img/', "ruta_js" => SYSTEM . "layout/" . $this->_template . "js/", "src" => SYSTEM . SYSTEM_NAME . "/", "ruta_include" => ROOT . "inc" . DS, "ruta_public" => BASE_URL . 'public/', "js" => $this->_js, 'item' => $item, 'js_plugin' => $this->_jsPlugin, 'root' => BASE_URL, 'configs' => array('app_name' => APP_NAME, 'app_slogan' => APP_SLOGAN, 'app_company' => APP_COMPANY), "jsLibs" => $this->_jsLibs);
        //        echo "<pre>";print_r($this->_rutas);exit;
        $ruta = $this->_rutas['load_view'] . $vista . ".phtml";
        if (is_readable($ruta)) {
            if (!$noLayout) {
                include_once $ruta;
            } else {
                ob_start();
                include_once $ruta;
                $content = ob_get_contents();
                ob_end_clean();
                return $content;
            }
        } else {
            throw new Exception("Error de vista");
        }
    }

    private function getWidgets()
    {
        /* Configurar Widgets ala vista */
        /* Config: menu widget,metodo getGonfig
         * $this->widget
         *
         * Content: array(widget,metodo,);
         */

        /*
         *  'config' => $this->widget('menu', 'getConfig', array('perfil-img')),
         *  ** array('perfil-img') == array de la posicion y la visibilidad **
        */

        /*
         * 'content' => array('menu', 'getMenu', array('perfil-img', 'perfil-img')),
         * ** array('perfil-img', 'perfil-img') ==
         */
        $db = new Database(DB_HOST, DB_NAME, DB_USER, DB_PASS, DB_CHAR);
        $query = $db->query("SELECT * FROM " . DB_PREFIJO . "widgets");
        $widget = $query->fetchAll(PDO::FETCH_OBJ);
        $widgets = array();
        foreach ($widget as $key => $valor) {
            $widgets[$valor->nombre] = array('config' => $this->widget('menu', 'getConfig', array($valor->nombre)), 'content' => array('menu', 'getMenu', array($valor->nombre, $valor->view)),);
        }
        $positions = $this->getLayoutPositions();
        $keys = array_keys($widgets);
        foreach ($keys as $k) {
            /* verificar si la posicion del widget esta presente */
            if (isset($positions[$widgets[$k]['config']['position']])) {
                /* verificar si esta deshabilitado para la vista */
                if (!isset($widgets[$k]['config']['hide']) || !in_array(self::$_item, $widgets[$k]['config']['hide'])) {
                    /* verificar si esta habilitado para la vista */
                    if ($widgets[$k]['config']['show'] === 'all' || in_array(self::$_item, $widgets[$k]['config']['show'])) {
                        if (isset($this->_widget[$k])) {
                            $widgets[$k]['content'][2] = $this->_widget[$k];
                        }
                        /* llenar la posicion del layout */
                        $positions[$widgets[$k]['config']['position']][] = $this->getWidgetContent($widgets[$k]['content']);

                    }
                }
            }
        }
        return $positions;
    }

    public function widget($widget, $method, $options = array())
    {
        $ruta = ROOT . 'widgets' . DS . $widget . ".php";
        if (!is_array($options)) {
            $options = array($options);
        }
        if (is_readable($ruta)) {
            include_once $ruta;
            $widgetClass = $widget . 'Widget';
            if (!class_exists($widgetClass)) {
                throw new Exception("Error clase widget");
            }
            if (is_callable($widgetClass, $method)) {
                if (count($options)) {
                    return call_user_func_array(array(new $widgetClass, $method), $options);
                } else {
                    return call_user_func(array(new $widgetClass, $method));
                }
            }
            throw new Exception('Error metodo widget');
        }
        throw new Exception('Error de widget');
    }

    public function getLayoutPositions()
    {
        $ruta = ROOT . 'layout' . DS . $this->_template . DS . 'configs.php';
        if (is_readable($ruta)) {
            include_once($ruta);

            return get_layout_positions();
        }

        throw new Exception('Error configuracion layout');
    }

    public function getWidgetContent(array $content)
    {
        if (!isset($content[0]) || !isset($content[1])) {
            throw new Exception('Error contenido widget');

            return;
        }
        if (!isset($content[2])) {
            $content[2] = array();
        }

        return $this->widget($content[0], $content[1], $content[2]);
    }

    public function setJs(array $js)
    {
        if (is_array($js) && count($js)) {
            for ($i = 0; $i < count($js); $i++) {
                $this->_js[] = $this->_rutas['js'] . $js[$i] . '.js';
            }
        } else {
            throw new Exception('Error de js');
        }
    }

    public function setJsPlugin(array $js)
    {
        if (is_array($js) && count($js)) {
            for ($i = 0; $i < count($js); $i++) {
                $this->_jsPlugin[] = BASE_URL . 'public/js/' . $js[$i] . '.js';
            }
        } else {
            throw new Exception('Error de js plugin');
        }
    }

    public function setJsLibs(array $js)
    {
        if (is_array($js) && count($js)) {
            for ($i = 0; $i < count($js); $i++) {
                $this->_jsLibs[] = SYSTEM . 'src/libs/' . $js[$i] . '.js';
            }
        } else {
            throw new Exception('Error de js plugin');
        }
    }

    public function setTemplate($template)
    {
        $this->_template = (string)$template;
    }

    public function setWidgetOptions($key, $options)
    {
        $this->_widget[$key] = $options;
    }

    public function getConfigure()
    {
        return $this->_configure;
    }

    public function getDirTemplate()
    {
        return $this->template_dir;
    }

    public function url($dir = 'img', $file)
    {
        $template = $this->getDirTemplate();

        return $template . $dir . "/" . $file;
    }

    public function segment($segment = null)
    {
        if (!is_null($segment)) {
            $url = filter_input(INPUT_GET, "url", FILTER_SANITIZE_URL);
            $url = explode("/", $url);
            # Todos los elementos que no sean validos en el array los va a eliminar
            $url = array_filter($url);
            if (isset($url[$segment])) {
                return $url[$segment];
            }
            return null;
        }
    }

    public function setMessage(Mensajes $mensaje)
    {
        Session::set("mensaje", $mensaje);
    }

    public function removeMessage()
    {
        Session::destroy("mensaje");
    }

}

?>
