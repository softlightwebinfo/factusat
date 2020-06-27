<?php


class Usuario extends Entity implements Sql_implement
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
    protected $token;

    public function __construct()
    {
        parent::__construct('usuarios');
    }

    public function create()
    {
        $query = self::$_db->get($this->_table, array(
            "email=" => $this->email
        ), 'or');

        try {
            if (count($query) == 1) {
                throw new Exception('El email ya existe en la base de datos');
            } else {
                // TODO: Implement create() method.
                $id = self::$_db->insert($this->_table, array(
                    'usuario' => $this->usuario,
                    'email' => $this->email,
                    'password' => Hash::getHash(HASH_ALGORITMO, $this->password, HASH_KEY),
                    'role' => $this->role,
                    'level' => $this->level,
                    'online' => time(),
                    'fechaLast' => date('Y-m-d H:i:s'),
                    'activo' => $this->activo
                ));
            }
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
        return $this->id = $id;
    }

    public function login()
    {
        $query = "SELECT * FROM {$this->_table} where email=:email and password=:password LIMIT 1";

        $st = self::$_db->prepare($query);
        $dato = array(
            ":email" => $this->email,
            ":password" => Hash::getHash(HASH_ALGORITMO, $this->password, HASH_KEY)
        );
        $st->execute($dato);
        $fetch = $st->fetch(PDO::FETCH_OBJ);
        if (empty($fetch)) {
            throw new Exception('La cuenta es incorrecta');
        }
        $usuario = new Usuario();
        $usuario->setId($fetch->id);
        $usuario->setUsuario($fetch->usuario);
        $usuario->setEmail($fetch->email);
        $usuario->setFechaLast($fetch->fechaLast);
        $usuario->setFechaRegistro($fetch->fechaRegistro);
        $usuario->setOnline($fetch->online);
        $usuario->setPassword($fetch->password);
        $usuario->setRole($fetch->role);
        $usuario->setLevel($fetch->level);
        $usuario->setAvatar($fetch->avatar);
        $usuario->setToken($fetch->token);
        Session::set("autenticado", 1);
        Session::set("tiempo", time());
        Session::set("level", $fetch->role);
        Session::set("id_user", $fetch->id);
        Session::set("user", $usuario);
        return true;
    }

    public function buscarPorToken($token)
    {
        ORM::select('*');
        ORM::from($this->getTable(true));
        ORM::where('token', $token);
        $build = ORM::build();
        $fetch = $build->row();

        $this->setId($fetch->id);
        $this->setUsuario($fetch->usuario);
        $this->setEmail($fetch->email);
        $this->setFechaLast($fetch->fechaLast);
        $this->setFechaRegistro($fetch->fechaRegistro);
        $this->setOnline($fetch->online);
        $this->setPassword($fetch->password);
        $this->setRole($fetch->role);
        $this->setLevel($fetch->level);
        $this->setAvatar($fetch->avatar);
        $this->setToken($fetch->token);
        return $this;
    }

    public function update()
    {
        // TODO: Implement update() method.
    }

    public function get()
    {
        // TODO: Implement get() method.
    }

    public function delete()
    {

    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * @param mixed $usuario
     */
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param mixed $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }

    /**
     * @return mixed
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * @param mixed $level
     */
    public function setLevel($level)
    {
        $this->level = $level;
    }

    /**
     * @return mixed
     */
    public function getOnline()
    {
        return $this->online;
    }

    /**
     * @param mixed $online
     */
    public function setOnline($online)
    {
        $this->online = $online;
    }

    /**
     * @return mixed
     */
    public function getFechaRegistro()
    {
        return $this->fechaRegistro;
    }

    /**
     * @param mixed $fechaRegistro
     */
    public function setFechaRegistro($fechaRegistro)
    {
        $this->fechaRegistro = $fechaRegistro;
    }

    /**
     * @return mixed
     */
    public function getFechaLast()
    {
        return $this->fechaLast;
    }

    /**
     * @param mixed $fechaLast
     */
    public function setFechaLast($fechaLast)
    {
        $this->fechaLast = $fechaLast;
    }

    /**
     * @return mixed
     */
    public function getAvatar()
    {
        if (true) {
            $this->avatar = imageUrl("avatar.png");
        }
        return $this->avatar;
    }

    public function avatar()
    {
        return $this->avatar;
    }

    /**
     * @param mixed $avatar
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;
    }

    /**
     * @return mixed
     */
    public function getEliminado()
    {
        return $this->eliminado;
    }

    /**
     * @param mixed $eliminado
     */
    public function setEliminado($eliminado)
    {
        $this->eliminado = $eliminado;
    }

    /**
     * @return mixed
     */
    public function getActivo()
    {
        return $this->activo;
    }

    /**
     * @param mixed $activo
     */
    public function setActivo($activo)
    {
        $this->activo = $activo;
    }

    /**
     * @return mixed
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param mixed $token
     */
    public function setToken($token)
    {
        $this->token = $token;
    }

    public function __destruct()
    {
        // TODO: Implement __destruct() method.
        self::$_db = null;
    }

    public function iniciarSession($email, $password)
    {
        $query = "SELECT * FROM {$this->_table} where email=:email and password=:password LIMIT 1";

        $st = self::$_db->prepare($query);
        $dato = array(
            ":email" => $email,
            ":password" => Hash::getHash(HASH_ALGORITMO, $password, HASH_KEY)
        );
        $st->execute($dato);
        $fetch = $st->fetch(PDO::FETCH_OBJ);
        if (empty($fetch)) {
            throw new Exception('La cuenta es incorrecta');
        }

        $token = Hash::getHash(HASH_ALGORITMO, microtime(true), HASH_KEY);
        if ($fetch->token != '' || $fetch->token !== null) {
            $token = $fetch->token;
        }
        self::$_db->updateRows(DB_PREFIJO . 'usuarios', array(
            'token' => $token,
            'online' => time()
        ), array(
            'id' => $fetch->id
        ));

        $this->setId($fetch->id);
        $this->setUsuario($fetch->usuario);
        $this->setEmail($fetch->email);
        $this->setFechaLast($fetch->fechaLast);
        $this->setFechaRegistro($fetch->fechaRegistro);
        $this->setOnline($fetch->online);
        $this->setPassword($fetch->password);
        $this->setRole($fetch->role);
        $this->setLevel($fetch->level);
        $this->setAvatar($fetch->avatar);
        $this->setToken($token);
        return true;
    }

}