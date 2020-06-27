<?php
/**
 * Created by PhpStorm.
 * User: codeunic
 * Date: 13/07/2017
 * Time: 23:47
 */

class UsuarioEntity extends Entity
{
    protected $id;
    protected $usuario;
    protected $email;
    protected $password;
    protected $role;
    protected $level;
    protected $online;
    protected $fechaRegistro;
    protected $fechaLast;
    protected $avatar;
    protected $activo;
    protected $eliminado;

    /**
     * Usuario constructor.
     * @param $id
     * @param $usuario
     * @param $email
     * @param $password
     * @param $role
     * @param $level
     * @param $online
     * @param $fechaRegistro
     * @param $fechaLast
     * @param $avatar
     * @param $activo
     * @param $eliminado
     */
    public function __construct($usuario = null, $email = null, $password = null, $role = null, $id = null)
    {
        parent::__construct('usuarios');
        $this->id = $id;
        $this->usuario = $usuario;
        $this->email = $email;
        $this->password = $password;
        $this->role = null;
        $this->level = 4;
        $this->online = time();
        $this->fechaRegistro = date('Y-m-d H:i:s');
        $this->fechaLast = date('Y-m-d H:i:s');
        $this->avatar = null;
        $this->activo = 1;
        $this->eliminado = null;
    }

    /**
     * @return null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param null $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return null
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * @param null $usuario
     */
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    }

    /**
     * @return null
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param null $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return null
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param null $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return null
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param null $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }

    /**
     * @return null
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * @param null $level
     */
    public function setLevel($level)
    {
        $this->level = $level;
    }

    /**
     * @return null
     */
    public function getOnline()
    {
        return $this->online;
    }

    /**
     * @param null $online
     */
    public function setOnline($online)
    {
        $this->online = $online;
    }

    /**
     * @return null
     */
    public function getFechaRegistro()
    {
        return $this->fechaRegistro;
    }

    /**
     * @param null $fechaRegistro
     */
    public function setFechaRegistro($fechaRegistro)
    {
        $this->fechaRegistro = $fechaRegistro;
    }

    /**
     * @return null
     */
    public function getFechaLast()
    {
        return $this->fechaLast;
    }

    /**
     * @param null $fechaLast
     */
    public function setFechaLast($fechaLast)
    {
        $this->fechaLast = $fechaLast;
    }

    /**
     * @return null
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * @param null $avatar
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;
    }

    /**
     * @return null
     */
    public function getActivo()
    {
        return $this->activo;
    }

    /**
     * @param null $activo
     */
    public function setActivo($activo)
    {
        $this->activo = $activo;
    }

    /**
     * @return null
     */
    public function getEliminado()
    {
        return $this->eliminado;
    }

    /**
     * @param null $eliminado
     */
    public function setEliminado($eliminado)
    {
        $this->eliminado = $eliminado;
    }

}
