<?php
    /*
     * -------------------------------------
     * www.interactivesweb.com | Rafa Gonzalez Muñoz
     * framework mvc basico
     * Widget.php
     * -------------------------------------
     */

    /**
     * CLASS Widget, Abstract para no instanciarse
     */
    abstract class Widget
    {

        /**
         * Metodo para cargar los modelos para los widget, cada widget tendra acceso a sus propios datos
         *
         * @param type $model
         *
         * @return \modelClass
         * @throws Exception
         */
        public function __construct()
        {
            parent::__construct();
        }

        protected function loadModel($model)
        {
            /* Si el archivo es legible */
            if (is_readable(ROOT . 'widgets' . DS . 'models' . DS . $model . '.php')) {
                include_once ROOT . 'widgets' . DS . 'models' . DS . $model . '.php';
                $modelClass = $model . 'ModelWidget';
                /* Si la clase existe */
                if (class_exists($modelClass)) {
                    /* Instancamos la la clase widget */
                    return new $modelClass;
                }
            }
            throw new Exception("Error modelo de widget");
        }

        /**
         * Mostrar el widget en la plantilla
         *
         * @param type $view
         * @param type $data
         * @param type $ext
         *
         * @return type
         * @throws Exception
         */
        protected function render($view, $data = array(), $ext = 'phtml')
        {
            /*Si es leible el archivo*/
            $ruta = ROOT . 'widgets' . DS . 'views' . DS . $view . '.' . $ext;
            if (is_readable($ruta)) {
                /**/
                ob_start();
                include APP_PATH . 'Main.php';
                //extract(), el arreglo lo combierte a variables
                extract($data);
                include ROOT . 'widgets' . DS . 'views' . DS . $view . '.' . $ext;
                $content = ob_get_contents();
                ob_end_clean();

                return $content;
            }
            throw new Exception("Error vista widget");
        }

    }

?>
