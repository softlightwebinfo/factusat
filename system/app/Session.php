<?php

/*
 * -------------------------------------
 * www.smartyhelpers.com
 * Framework 1.0.0 CWeb
 * Session.php
 * -------------------------------------
 */

class Session
{

    public static function init()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
    }

    public static function acceso_session($url, $type = false)
    {
        if (!$type) {
            if (!self::get('autenticado')) {
                header("location: " . BASE_URL . $url);
            }
        } else {
            if (self::get('autenticado')) {
                header("location: " . BASE_URL . $url);
            }
        }
    }

    public static function is_login($url, $type = false)
    {
        if (!$type) {
            if (self::get('autenticado')) {
                return true;
            }
        } else {
            if (!self::get('autenticado')) {
                return false;
            }
        }
    }

    public static function acceso($level)
    {
        if (!Session::get("autenticado")) {
            //            header("location: " . BASE_URL . "error/access/5050");
            header("location: " . BASE_URL . "");
            exit();
        }

        Session::tiempo();

        if (Session::getLevel($level) > Session::getLevel(Session::get("level"))) {
            //            header("location: " . BASE_URL . "error/access/5050");
            header("location: " . BASE_URL . "");
            exit();
        }
    }

    public static function get($clave = null)
    {
        if (isset($_SESSION[$clave])) {
            return $_SESSION[$clave];
        } else {
            return false;
        }

    }

    public static function tiempo()
    {
        if (!Session::get("tiempo") || !defined("SESSION_TIME")) {
            throw new Exception("No se ha definido el tiempo de sesion");
        }
        if (SESSION_TIME == 0) {
            return;
        }
        if (time() - Session::get("tiempo") > (SESSION_TIME * 60)) {
            Session::destroy();
            //            header("location: " . BASE_URL . "error/access/8080");
            header("location: " . BASE_URL . "usuarios/login/");
        } else {
            Session::set("tiempo", time());
        }
    }

    public static function user(): User
    {
        return self::get("user");
    }

    public static function idUser()
    {
        return self::get("id_user");
    }

    public static function destroy($clave = false)
    {
        if ($clave) {
            if (is_array($clave)) {
                for ($i = 0; $i < count($clave); $i++) {
                    if (isset($_SESSION[$clave[$i]])) {
                        unset($_SESSION[$clave[$i]]);
                    }
                }
            } else {
                if (isset($_SESSION[$clave])) {
                    unset($_SESSION[$clave]);
                }
            }
        } else {
            session_destroy();
        }
    }

    public static function set($clave, $valor)
    {
        if (!empty($clave)) {
            $_SESSION[$clave] = $valor;
        }
    }

    public static function getLevel($level)
    {
        $role['admin'] = 1;
        $role['especial'] = 2;
        $role['usuario'] = 4;
        if (!array_key_exists($level, $role)) {
            return;
        } else {
            return $role[$level];
        }
    }

    public static function accesoView($level)
    {
        if (!Session::get("autenticado")) {
            return false;
        }
        if (Session::getLevel($level) > Session::getLevel2(Session::get("level"))) {
            return false;
        }

        return true;
    }

    public static function getLevel2($level)
    {
        $role[1] = "administrador";
        $role[2] = "especial";
        $role[4] = "usuario";
        if (!array_key_exists($level, $role)) {
            throw new Exception("Error de acceso");
        } else {
            return $role[$level];
        }
    }

    public static function accesoViewSimple()
    {
        if (!Session::get("autenticado")) {
            return false;
        }

        return true;
    }

    public static function accesoEstricto(array $level, $noAdmin = false)
    {
        if (!Session::get("autenticado")) {
            header("location: " . BASE_URL . "error/access/5050");
            exit();
        }
        Session::tiempo();
        if ($noAdmin == false) {
            if (Session::get("level") == "admin") {
                return;
            }
        }
        if (count($level)) {
            if (in_array(Session::get("level"), $level)) {
                return;
            }
        }
        header("location: " . BASE_URL . "error/access/5050");
    }

    public static function accesoEstrictoAdmin(array $level, $noAdmin = false)
    {
        if (!Session::get("autenticado")) {
            header("location: " . BASE_URL_ADMIN . "pages/login/");
            exit();
        }
        Session::tiempo();
        if ($noAdmin == false) {
            if (Session::get("level") == Session::getLevel('admin')) {
                return;
            }
        }
        if (count($level)) {
            if (in_array(Session::get("level"), $level)) {
                return;
            }
        }
        header("location: " . BASE_URL_ADMIN . "pages/login/");
    }

    public static function accesoViewEstricto(array $level, $noAdmin = false)
    {
        if (!Session::get("autenticado")) {
            return false;
        }
        if ($noAdmin == false) {
            if (Session::get("level") == "admin") {
                return true;
            }
        }
        if (count($level)) {
            if (in_array(Session::get("level"), $level)) {
                return true;
            }
        }

        return false;
    }

    public static function accesoViewEstrictoAdmin(array $level, $noAdmin = false)
    {
        if (!Session::get("autenticado")) {
            return false;
        }
        if ($noAdmin == false) {
            if (Session::get("level") == Session::getLevel('admin')) {
                return true;
            }
        }
        if (count($level)) {
            if (in_array(Session::get("level"), $level)) {
                return true;
            }
        }

        return false;
    }

}

?>
