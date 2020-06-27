<?php

/*
 * -------------------------------------
 * www.dlancedu.com | Jaisiel Delance
 * framework mvc basico
 * Bootstrap.php
 * -------------------------------------
 */

class ACL
{

    private $_registry;
    private $_db;
    private $_id;
    private $_role;
    private $_permisos;

    public function __construct($id = false)
    {
        if ($id) {
            $this->_id = (int)$id;
        } else {
            if (Session::get('id_user')) {
                $this->_id = Session::get('id_user');
            } else {
                $this->_id = 0;
            }
        }
        $this->_registry = Registry::getInstancia();
        $this->_db = $this->_registry->_db;
        $this->_role = $this->getRole();
        $this->_permisos = $this->getPermisosRole();
        $this->compilarAcl();
    }

    private function getRole()
    {
        $role = $this->_db->query("SELECT role from " . DB_PREFIJO . "usuarios " . "WHERE id = '{$this->_id}'");
        $role = $role->fetch(PDO::FETCH_ASSOC);

        $row = $role['role'];
        return $row;
    }

    private function getPermisosRole()
    {
        $sql = "select pr.*,p.ky from " . DB_PREFIJO . "permisos_roles pr " . "inner join " . DB_PREFIJO . "permisos p on pr.permiso = p.ky " . "where pr.role = '{$this->_role}'";
        $permisos = $this->_db->query($sql);

        $permisos = $permisos->fetchAll(PDO::FETCH_ASSOC);
        $data = array();

        for ($i = 0; $i < count($permisos); $i++) {
            if ($permisos[$i]["ky"] == '') {
                continue;
            }

            if ($permisos[$i]['valor'] == 1) {
                $v = true;
            } else {
                $v = false;
            }

            $data[$permisos[$i]['ky']] = array('key' => $permisos[$i]['ky'], 'permiso' => $permisos[$i]['ky'], 'valor' => $v, 'heredado' => true, 'id' => $permisos[$i]['permiso'],);
        }

        return $data;
    }

    private function getPermisoKey($permisoID)
    {
        $permisoID = (int)$permisoID;

        $sql = "select `ky` from " . DB_PREFIJO . "permisos " . "where permiso = {$permisoID}";
        $key = $this->_db->query($sql);

        $key = $key->fetch();

        return $key['ky'];
    }

    private function getPermisoNombre($permisoID)
    {
        $permisoID = (int)$permisoID;

        $key = $this->_db->query("select `permiso` from " . DB_PREFIJO . "permisos " . "where permiso = {$permisoID}");

        $key = $key->fetch();

        return $key['permiso'];
    }

    private function compilarAcl()
    {
        $this->_permisos = array_merge($this->_permisos, $this->getPermisosUsuario());
    }

    private function getPermisosUsuario()
    {
        $ids = $this->getPermisosRoleId();
        if (count($ids)) {
            $datos = Ayuda::array_separate($ids, ",");
            $sql = "select pu.*,p.ky from " . DB_PREFIJO . "permisos_usuarios pu " . "inner join " . DB_PREFIJO . "permisos p on pu.permiso = p.ky where pu.usuarioID = {$this->_id} " . " and pu.permiso in({$datos})";
            $permisos = $this->_db->query($sql);
            $permisos = $permisos->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $permisos = array();
        }
        $data = array();

        for ($i = 0; $i < count($permisos); $i++) {
            $key = $permisos[$i]['ky'];
            if ($key == '') {
                continue;
            }

            if ($permisos[$i]['valor'] == 1) {
                $v = true;
            } else {
                $v = false;
            }

            $data[$key] = array('key' => $key, 'permiso' => $permisos[$i]['ky'], 'valor' => $v, 'heredado' => false, 'id' => $permisos[$i]['permiso']);
        }

        return $data;
    }

    private function getPermisosRoleId()
    {
        $ids = $this->_db->query("select permiso from " . DB_PREFIJO . "permisos_roles " . "where role = '{$this->_role}'");

        $ids = $ids->fetchAll(PDO::FETCH_ASSOC);
        $id = array();
        for ($i = 0; $i < count($ids); $i++) {
            $id[] = $ids[$i]['permiso'];
        }

        return $id;
    }

    public function getPermisos()
    {
        if (isset($this->_permisos) && count($this->_permisos)) {
            return $this->_permisos;
        }
    }

    public function acceso($key)
    {

        if ($this->permiso($key)) {
            Session::tiempo();

            return;
        }

        //        header("location: " . BASE_URL . "error / access / 5050");
        header("location: " . BASE_URL);
        exit();
    }

    public function permiso($key)
    {
        if (array_key_exists($key, $this->_permisos)) {
            if ($this->_permisos[$key]['valor'] == true || $this->_permisos[$key]['valor'] == 1) {
                return true;
            }
        }

        return false;
    }

    public function getRol()
    {
        return $this->_role;
    }

    public function isRol(string $role)
    {
        if ($this->getRol() != $role) {
            return false;
        }
        return true;
    }

    /**
     * SessionRol comprueba si el rol del usuario es igual al pasado por argumento,
     * y si es invalido, será redirigido
     * @param string $role
     */
    public function sessionRol(string $role)
    {
        if ($this->getRol() != $role) {
            header('Location: ' . base_url(''));
        }
    }

}

?>
