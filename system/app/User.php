<?php

/**
 * Created by PhpStorm.
 * User: rafa
 * Date: 22/01/2017
 * Time: 10:47
 */
class User extends Entity
{
    private $autenticado;
    private $tiempo;
    private $level;
    private $id_user;
    private $_user;

    public function __construct()
    {
        parent::__construct('usuarios');
        if (Session::get("autenticado")) {
            $this->autenticado = Session::get("autenticado");
            $this->tiempo = Session::get("tiempo");
            $this->level = Session::get("level");
            $this->id_user = Session::get("id_user");
            $this->_user = $this->startUser();
        } else {
            return;
        }

    }

    private function startUser(): Usuario
    {
        $row = Session::get("user");
        $usuario = new Usuario();
        $usuario->setId($row->getId());
        $usuario->setUsuario($row->getUsuario());
        $usuario->setEmail($row->getEmail());
        $usuario->setFechaLast($row->getFechaLast());
        $usuario->setFechaRegistro($row->getFechaRegistro());
        $usuario->setOnline($row->getOnline());
        $usuario->setPassword($row->getPassword());
        $usuario->setRole($row->getRole());
        $usuario->setLevel($row->getLevel());
        $usuario->setAvatar($row->getAvatar());
        return $usuario;
    }

    /**
     * @return bool
     */
    public function isAutenticado()
    {
        return $this->autenticado;
    }

    /**
     * @param bool $autenticado
     */
    public function setAutenticado($autenticado)
    {
        $this->autenticado = $autenticado;
    }

    /**
     * @return bool
     */
    public function isTiempo()
    {
        return $this->tiempo;
    }

    /**
     * @param bool $tiempo
     */
    public function setTiempo($tiempo)
    {
        $this->tiempo = $tiempo;
    }

    /**
     * @return bool
     */
    public function isLevel()
    {
        return $this->level;
    }

    /**
     * @param bool $level
     */
    public function setLevel($level)
    {
        $this->level = $level;
    }

    /**
     * @return bool
     */
    public function isIdUser()
    {
        return $this->id_user;
    }

    public function idUser()
    {
        return $this->id_user;
    }

    /**
     * @param bool $id_user
     */
    public function setIdUser($id_user)
    {
        $this->id_user = $id_user;
    }

    /**
     * @return bool
     */
    public function isUserObj()
    {
        return $this->userObj;
    }

    /**
     * @param bool $userObj
     */
    public function setUserObj($userObj)
    {
        $this->userObj = $userObj;
    }

    /**
     * @return Usuario
     */
    public function getUser()
    {
        return $this->_user;
    }

    /**
     * @param Usuario $user
     */
    public function setUser($user)
    {
        $this->_user = $user;
    }
}

?>