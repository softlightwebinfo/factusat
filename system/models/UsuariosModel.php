<?php

/**
 * Created by PhpStorm.
 * User: codeunic
 * Date: 14/07/2017
 * Time: 21:18
 */
class UsuariosModel extends Model implements SQL_model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function remove()
    {
        // TODO: Implement remove() method.
    }

    public function update()
    {
        // TODO: Implement update() method.
    }

    public function create()
    {
        // TODO: Implement create() method.
    }

    public function getAll($datos=null)
    {
        // TODO: Implement getAll($datos=null) method.
        ORM::select('u.id,u.usuario,u.email,u.password,u.role,u.level,u.online,u.fechaRegistro,u.fechaLast,u.avatar,u.activo,u.eliminado, r.role,r.active as roleActive');
        ORM::from('usuarios u');
        ORM::join('roles r', 'u.role=r.role');
        ORM::order_by('u.fechaRegistro', 'desc');
        $query = ORM::build();

        return $query;
    }

    public function truncate()
    {
        // TODO: Implement truncate() method.
    }

    public function get($id)
    {
        // TODO: Implement get() method.
    }

    public function changePassword($idUser, $passwordNew, $passwordOld)
    {
        $usuario = new UsuarioEntity();
        $usuario->buscarPorPk($idUser);

        $passwordEncrypt = Hash::getHash(HASH_ALGORITMO, $passwordOld, HASH_KEY);
        $passwordEncryptNew = Hash::getHash(HASH_ALGORITMO, $passwordNew, HASH_KEY);
        if ($usuario->getPassword() == $passwordEncrypt) {
            ORM::$_db->updateRows($usuario->getTable(), array(
                "password" => $passwordEncryptNew
            ), array(
                "id" => $usuario->getId()
            ));
            return true;
        } else {
            return false;
        }
    }
}