<?php

class Users_bl
{

    public static function crearSesion(Usuari $usr)
    {
        Session::set("username", $usr->getUsername());
        Session::set("idUser", $usr->getId());
    }

    public static function cerrarSesion()
    {

        Session::remove("username");
        Session::remove("idUser");

    }

    public static function login(Usuari $usr, $password)
    {
        if ($usr->getPassword() == $password) {
            $r["error"] = 0;
            self::crearSesion($usr);
        } else {
            $r["error"] = 1;
        }
        return $r;
    }

}
