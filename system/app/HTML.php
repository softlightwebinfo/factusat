<?php

    class HTML
    {
        public function __construct()
        {

        }

        /**
         * <p><div class="alert alert-success" role="alert">{$mensaje}</div></p>
         * <p><div class="alert alert-info" role="alert">{$mensaje}</div></p>
         * <p><div class="alert alert-warning" role="alert">{$mensaje}</div></p>
         * <p><div class="alert alert-danger" role="alert">{$mensaje}</div></p>
         *
         * @param type $mensaje
         * @param type $type
         */
        public static function Mensaje($mensaje, $type = "success")
        {
            ?>
            <div class="alert alert-<?= $type ?>" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <?= $mensaje ?>
            </div>
            <?php
        }

        static function a($href, $content, $optional = array())
        {

            $opt = null;

            foreach ($optional as $key => $val) {

                $opt .= " $key='$val'";
            }

            return "<a href='$href'$opt>$content</a>";
        }

        static function a_open($href, $optional = array())
        {

            $opt = null;

            foreach ($optional as $key => $val) {

                $opt .= " $key='$val'";
            }

            return "<a href='$href'$opt>";
        }

        static function a_close()
        {
            return "</a>";
        }

        static function br($lenght = 1)
        {
            $br = null;
            while ($lenght--) {
                $br .= "<br>";
            }

            return $br;
        }

        static public function P($content, $optional = array())
        {

            $opt = null;

            foreach ($optional as $key => $val) {

                $opt .= " $key='$val'";
            }

            return "<p $opt>$content</p>";
        }

        static function open_div($atributes = array())
        {

            $att = null;

            foreach ($atributes as $key => $value) {

                $att .= " $key='$value'";
            }

            return "<div $att>\n";
        }

        static function close_div()
        {

            return "\n</div>\n";
        }

        static function open_form($attribute = array())
        {

            $attr = null;

            foreach ($attribute as $key => $value) {

                $attr .= " $key='$value'";
            }

            return "\n<form $attr>\n";
        }

        static function close_form()
        {

            return "\n</form>\n";
        }

        static function input($type, $name, $value = null, $attributes = array())
        {

            $attr = null;

            foreach ($attributes as $key => $val) {

                $attr .= " $key='$val'";
            }

            return "<input type='$type' name='$name' value='$value' $attr>\n";
        }

        static function label($for, $content, $attributes = array())
        {

            $attr = null;

            foreach ($attributes as $key => $val) {

                $attr .= " $key='$val'";
            }

            return "<label for='$for'$attr>$content</label>\n";
        }

        static function button_HTML5($type, $content, $attributes = array())
        {

            $attr = null;

            foreach ($attributes as $key => $val) {

                $attr .= " $key='$val'";
            }

            return "<button type='$type'$attr>$content</button>\n";
        }

        static function radio($name, $value, $checked = false, $attributes = array())
        {

            $attr = null;

            foreach ($attributes as $key => $val) {

                $attr .= " $key='$val'";
            }

            if ($checked) {

                $checked = 'checked';
            } else {

                $checked = null;
            }

            return "<input type='radio' name='$name' value='$value' $checked>";
        }

        static function checkbox($name, $value, $checked = false, $attributes = array())
        {

            $attr = null;

            foreach ($attributes as $key => $val) {

                $attr .= " $key='$val'";
            }

            if ($checked) {

                $checked = 'checked';
            } else {

                $checked = null;
            }

            return "<input type='checkbox' name='$name' value='$value' $checked>";
        }

        public static function Panel()
        {

        }

        public static function img($optional = array())
        {
            $opt = null;
            foreach ($optional as $key => $val) {
                $opt .= " $key='$val'";
            }

            return "<img {$opt}>";
        }

        public function __destruct()
        {

        }

    }

?>
