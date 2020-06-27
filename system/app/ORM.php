<?php

/**
 *   $usuario = new UsuarioEntity(
 *                          'Rafa',
 *                          'rafael.gonzalez.1737@gmail.com',
 *                          '51251451',
 *                          'Administrador'
 *                        );
 * $usuario->save();
 * $user = $usuario->buscarPorPk(1)->getEmail();
 * $users = $usuario->buscarTodos();
 *
 * ORM::select('u.id,u.usuario,u.password');
 * ORM::from('usuarios u');
 * $get = ORM::build();
 *
 * print_pre($get->row());
 * print_pre($get->result());
 * Class ORM
 */
abstract class ORM
{
    /**
     * Contiene los datos de la conexion a la base de datos
     * @var Database
     */
    public static $_db = null;
    /**
     * Contiene el nombre de la tabla correspondiente
     * @var string
     */
    protected $_table;
    private $error;
    private $seteados = 0;
    private $Config;
    protected $fields = array();
    private $_columns;
    protected $keyField;
    /* ORM SELECT */
    private static $select = array();
    private static $from = "";
    private static $where = array();
    private static $orderBy = array();
    private static $limit = array();
    private static $join = array();
    private static $methods = array();
    private static $build = "";

    const JOIN = 1;
    const JOIN_LEFT = 2;
    const JOIN_RIGHT = 3;
    const JOIN_FULL = 4;
    protected $rowCount = 0;

    public function __construct(Database $database = null, $table = null)
    {
        if (is_null(self::$_db)) {
            self::$_db = $database;
        }
        if (!is_null($table)) {
            $this->set_table($table);
            $this->iniciar();
        }
    }

    /**
     * El method select sirve para hacer el select del query
     * ORM::select('x.id,y.nombre');
     * @param string $params
     */
    public static function select($params = '*')
    {
        if (isset(self::$methods['select'])) return;
        if (is_string($params)) {
            self::$select = explode(',', $params);
        } elseif (is_array($params)) {
            array_push(self::$select, $params);
        }
        self::$methods['select'] = 'select';
    }

    public static function from($from)
    {
        if (isset(self::$methods['from'])) return;

        self::$from = DB_PREFIJO . $from;

        self::$methods['from'] = 'from';
    }

    public static function where($attr, $valor = null, $operacion = null)
    {
        if (is_string($valor)) {
            $valor = "'{$valor}'";
        }
        array_push(self::$where, array(
            "attr" => $attr,
            "operacion" => $operacion,
            "valor" => $valor,
            "logica" => 'and'
        ));
        self::$methods['where'] = 'where';
    }

    public static function where_or($attr, $valor = null, $operacion = null)
    {
        if (is_string($valor)) {
            $valor = "'{$valor}'";
        }
        array_push(self::$where, array(
            "attr" => $attr,
            "operacion" => $operacion,
            "valor" => $valor,
            "logica" => 'or'
        ));
        self::$methods['where_or'] = 'where_or';
    }

    public static function order_by($attr, $order = "asc")
    {
        array_push(self::$orderBy, array(
            'attr' => $attr,
            'order' => $order
        ));
        self::$methods['order_by'] = 'order_by';
    }

    public static function limit($puesto = "0", $limite = "")
    {
        if ($limite != "") {
            self::$limit = "{$puesto},{$limite}";
        } else {
            self::$limit = "{$puesto}";
        }

        self::$methods['limit'] = 'limit';
    }

    public static function join($table, $on, $types = ORM::JOIN)
    {
        $type = '';
        if ($types == self::JOIN) {
            $type = "inner join";
        } elseif ($types == self::JOIN_LEFT) {
            $type = "left join";
        } elseif ($types == self::JOIN_RIGHT) {
            $type = "right join";
        } elseif ($types == self::JOIN_FULL) {
            $type = "FULL OUTER join";
        } else {
            $type = "inner join";
        }

        array_push(self::$join, array(
            "table" => DB_PREFIJO . trim($table, ' '),
            "on" => $on,
            "type" => $type
        ));
        self::$methods['join'] = 'join';
    }

    public static function build($fin = true)
    {
        if (isset(self::$methods['build'])) return;
        if (!isset(self::$methods['select'])) {
            self::select();
        }
        self::build_select();
        if (!isset(self::$methods['from'])) {
            throw new Exception('Error: La consulta ORM, no se ha podido ejecutar porque le falta el from');
        }

        self::build_from();
        if (isset(self::$methods['join'])) {
            self::build_join();
        }
        if (isset(self::$methods['where'])) {
            self::build_where();
        }

        if (isset(self::$methods['order_by'])) {
            self::build_orderBy();
        }

        if (isset(self::$methods['limit'])) {
            self::build_limit();
        }
        self::$methods['build'] = 'build';
        $building = self::building();
        $datos = self::$build;
        if ($fin) {
            self::resetear();
            return $building;
        }
        return $datos;
    }

    private static function building()
    {
        $query = self::$_db->prepare(self::$build);

        return new ORM_Statement(self::$_db, $query);
    }

    public static function union($sql, $sql1, $order = array(), $where = array(), $limit = null)
    {
        if (!is_null($limit)) {
            $limit = "LIMIT {$limit}";
        }
        $order_sql = "";
        foreach ($order as $key => $row) {
            $order_sql .= "{$key} {$row},";
        }
        $order_sql = trim($order_sql, ',');
        if (!empty($order)) {
            $order_sql = "ORDER BY {$order_sql}";
        }
        $where_sql = "";
        foreach ($order as $key => $row) {
            $where_sql .= "{$key}{$row},";
        }
        $where_sql = trim($where_sql, ',');


        $query = "{$sql} UNION {$sql1} {$where_sql} {$order_sql} {$limit}";
        echo $query;
        echo "<br>";
        $query = self::$_db->prepare($query);
        return new ORM_Statement(self::$_db, $query);
    }

    private static function addBuild(string $q)
    {
        self::$build .= $q . " ";
    }

    private static function build_select()
    {
        $select = "SELECT ";
        $select .= implode(',', self::$select);
        self::addBuild($select);
    }

    private static function build_from()
    {
        $from = "FROM ";
        $from .= self::$from;
        self::addBuild($from);
    }

    private static function build_join()
    {
        $join = "";
        foreach (self::$join as $key => $row) {
            $join .= "{$row['type']} {$row['table']} ON {$row['on']} ";
        }

        self::addBuild($join);
    }

    private static function build_where()
    {
        $where = "WHERE ";
        $where_datos = self::$where;
        $contador = 0;
        $oper = "";
        for ($i = 0; $i < count($where_datos); $i++) {
            $operacion = $where_datos[$i]['operacion'];
            $valor = $where_datos[$i]['valor'];
            $attr = $where_datos[$i]['attr'];
            $logica = $where_datos[$i]['logica'];

            $logica_extra = $where_datos[$i + 1]['logica'] ?? '';

            if ($operacion == "" and $valor != "") {
                $operacion = "=";
            }
            $where .= "{$attr}{$operacion}{$valor} {$logica_extra} ";
        }
        $where = trim($where, ' ');
        self::addBuild($where);
    }

    private static function build_orderBy()
    {
        $order = "ORDER BY ";

        foreach (self::$orderBy as $key => $row) {
            $order .= "{$row['attr']} {$row['order']},";
        }
        $order = trim($order, ",");
        $order = trim($order, " ");

        self::addBuild($order);
    }

    private static function build_limit()
    {
        $limit = "LIMIT ";
        $limit .= self::$limit;
        $limit = trim($limit, " ");
        self::addBuild($limit);
    }

    private static function resetear()
    {
        self::$select = array();
        self::$from = '';
        self::$where = array();
        self::$orderBy = array();
        self::$limit = array();
        self::$join = array();
        self::$methods = array();
        self::$build = '';
    }

    /**
     * METHOD PARA GENERAR LOS POJOS
     */
    public static function generarPojos()
    {
        $q = self::showTablesPojos();
        $directory = './system/entity/';
        foreach ($q as $key => $row) {
            $file = $row['pojo'] . ".php";
            $directoryFile = $directory . $file;
            $directoryFile = self::clearString($directoryFile);
            if (!is_file($directoryFile)) {
                self::createPojo($row['table'], $row['pojo']);
            }
        }
    }

    private static function createPojo($table, $pojo)
    {
        $ruta = "./system/entity/{$pojo}.php";
        $tbl = str_replace('cu_', '', $table);
        $attrs = self::showAttrs($table);
        $transformAttr = self::transformATRR($attrs);
        $transformGettersAndSetters = self::transformGettersAndSetters($attrs);
        $template = <<<template
<?php 
class {$pojo} extends Entity{
{$transformAttr}
    public function __construct(){
        parent::__construct('{$tbl}');
    }
{$transformGettersAndSetters}
}
?>
template;
        $ruta = self::clearString($ruta);
        file_put_contents($ruta, $template);
    }

    /**
     * @return array
     */
    public static function showTablesPojos()
    {
        $st = self::showTables();
        $tables = array();
        foreach ($st as $key => $row) {
            $tbl = $row;
            $row = str_replace(DB_PREFIJO, '', $row);
            $row = ucfirst($row);

            $texto = "";
            $separate = explode('_', $row);
            foreach ($separate as $key => $item) {
                $item = trim($item, " ");
                if (substr($item, -1) == 's') {
                    $texto .= trim($item, 's') . "_";
                } else {
                    $texto .= $item . "_";
                }
            }

            $row = trim($texto, '_');

            $texto = "";
            $pos = strpos($row, '_');
            for ($i = 0; $i < strlen($row); $i++) {
                if (($pos == $i) and $pos != false) {
                    $row[$i] = "";
                    $row[$i + 1] = ucfirst($row[$i + 1]);
                    $texto .= $row[$i];
                    $texto .= $row[$i + 1];
                    $i++;
                } else {
                    $texto .= $row[$i];
                }
            }
            $row .= "Entity";
            $row = self::clearString($row);
            array_push($tables, array(
                'pojo' => $row,
                'table' => $tbl
            ));
        }

        return $tables;
    }

    /**
     * Mostramos todas las tablas de la base de datos
     * @return array
     */
    public static function showTables()
    {
        $sql = self::sql('show tables');
        $st = $sql->fetchAll(PDO::FETCH_COLUMN);
        return $st;
    }

    /**
     * Mostramos todos los atributos de una tabla
     * @param $table
     * @return array
     * @throws Exception
     */
    private static function showAttrs($table)
    {
        //obtengo los campos de la tabl
        $query = "SHOW FIELDS FROM " . $table;
        $command = self::sql($query);
        $command = $command->fetchAll(PDO::FETCH_ASSOC);

        $fields = array();
        $primary = '';

        //recorro los campos y los guardo en un arrgeglo
        for ($i = 0; $i < count($command); $i++) {
            $fields[$command[$i]['Field']] = array(
                "name" => $command[$i]['Field'],
                "type" => $command[$i]['Type'],
                "defaultValue" => $command[$i]['Default'],
                "key" => $command[$i]['Key'],
            );
            //obtengo  la clave primaria
            if ($command[$i]['Key'] === "PRI") {
                $primary = $command[$i]['Field'];
            }
        }
        if (empty($primary)) {
            throw new Exception("No se encontro la columna clave para la tabla: " . $table);
        }
        return array(
            'primary' => $primary,
            'fields' => $fields
        );
    }

    /**
     * Transformamos losatributos de la base de datos en atributos para la class pojo
     * @param $attrs
     * @return string
     */
    private static function transformATRR($attrs)
    {
        $attr = "";
        foreach ($attrs['fields'] as $key => $row) {
            $template = <<<template
\tprotected \${$row['name']};\n
template;
            $attr .= $template;
        }
        return $attr;
    }

    /**
     * Transformamos los atributos en Getters y Setters
     * @param $attr
     * @return string
     */
    private static function transformGettersAndSetters($attr)
    {
        $gettersAndSetters = "";
        foreach ($attr['fields'] as $key => $row) {
            $name = ucfirst($row['name']);
            $template = <<<template
\n\tpublic function get{$name}(){
    \treturn \$this->{$row['name']};
\t}\n
\tpublic function set{$name}(\${$row['name']}){
    \t\$this->{$row['name']} = \${$row['name']};
\t}\n
template;
            $gettersAndSetters .= $template;
        }
        return $gettersAndSetters;
    }

    /**
     * Iniciamos el objeto con todos sus datos, columnas etc...
     * @throws Exception
     */
    protected function iniciar()
    {
        //si no hay seteada una tabla corto el proceso y muestro el error.

        if (!$this->_table) {
            error_log("[" . date("F j, Y, G:i") . "] [E_USER_NOTICE] [tipo Modelo] No se seteo ninguna tabla para el modidelo: " . get_class($this) . "\n", 3, '/errores.log');
            die('No se seteo ninguna tabla para el modelo: ' . get_class($this));
        }

        //obtengo los campos de la tabl
        $query = "SHOW FIELDS FROM " . $this->_table;
        $command = self::sql($query);
        $command = $command->fetchAll(PDO::FETCH_ASSOC);

        $fields = array();
        $primary = '';

        //recorro los campos y los guardo en un arrgeglo
        for ($i = 0; $i < count($command); $i++) {
            $fields[$command[$i]['Field']] = array(
                "name" => $command[$i]['Field'],
                "type" => $command[$i]['Type'],
                "defaultValue" => $command[$i]['Default'],
                "key" => $command[$i]['Key'],
            );
            //obtengo  la clave primaria
            if ($command[$i]['Key'] === "PRI") {
                $primary = $command[$i]['Field'];
            }
            $this->fields[$command[$i]['Field']] = '';
        }

        $this->_columns = $fields;

        if (empty($primary)) {
            throw new Exception("No se encontro la columna clave para la tabla: " . $this->_table);
        }

        $this->keyField = $primary;
    }

    private static function clearString($directoryFile)
    {
        return strval(str_replace("\0", "", $directoryFile));
    }

    public function buscar($whereArray = array())
    {
        $class = get_class($this);
        $where = '';
        foreach ($whereArray as $key => $row) {
            if ($where == '') {
                $where = 'WHERE ';
            }
            $where .= "{$key}'{$row}'";
        }
        $where = trim($where, ',');
        $sql = "SELECT * FROM " . $this->_table . " " . $where;
        $consulta = self::$_db->query($sql);
        $query = $consulta->fetch(PDO::FETCH_OBJ);

        if (!$query) {
            $query = array();
        }
        foreach ($query as $key => $value) {
            if (!is_numeric($key)) {
                $this->$key = $value;
                $this->fields[$key] = $value;
            }
        }
        $this->rowCount = $consulta->rowCount();
        return $this;
    }

    /**
     * Buscamos los datos por id
     * @param $id
     * @return $this
     */
    public function buscarPorPk($id = null)
    {
        //valido si el parametro es una arreglo o no
        if (is_array($id)) {
            $valor = $id[$this->keyField];
        } else {
            if (is_null($id)) {
                $valor = $this->{$this->keyField};
            } else {
                $valor = $id;
            }
        }

        $sql = "SELECT * FROM `%s` WHERE `%s`='%s' LIMIT 1";
        $sql = sprintf($sql, $this->_table, $this->keyField, $valor);

        $consulta = self::$_db->query($sql);
        $query = $consulta->fetch(PDO::FETCH_OBJ);
        if (!$query) {
            $query = array();
        }
        foreach ($query as $key => $value) {
            if (!is_numeric($key)) {
                $this->$key = $value;
                $this->fields[$key] = $value;
            }
        }
        $this->rowCount = $consulta->rowCount();
        return $this;
    }


    public function rowCount()
    {
        return $this->rowCount;
    }

    /**
     * Buscamos todos los datos y devolvemos el objeto
     * @return PDOStatement
     */
    public function buscarTodos($limit = null, $order = array(), $whereArray = array())
    {
        $class = get_class($this);
        if (!is_null($limit)) {
            $limit = "LIMIT $limit";
        }
        $orderBy = '';
        if (is_array($order)) {
            foreach ($order as $key => $row) {
                if ($orderBy == '') {
                    $orderBy = "ORDER BY ";
                }
                $orderBy .= "$row, ";
            }
            $orderBy = trim($orderBy, ', ');
        }
        $where = '';
        foreach ($whereArray as $key => $row) {
            if ($where == '') {
                $where = 'WHERE ';
            }
            $where .= "{$key}{$row}";
        }
        $sql = "SELECT * FROM " . $this->_table . " " . $where . " " . $orderBy . ' ' . $limit;
        $consulta = self::$_db->query($sql);
        $st = $consulta->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $class);
        if (!$st) {

        }
        return $st;
    }

    public function buscarTodosByPK($whereArray = array(), $limit = null, $order = array())
    {
        $class = get_class($this);
        if (!is_null($limit)) {
            $limit = "LIMIT $limit";
        }
        $orderBy = '';
        if (is_array($order)) {
            foreach ($order as $key => $row) {
                if ($orderBy == '') {
                    $orderBy = "ORDER BY ";
                }
                $orderBy .= "$row, ";
            }
            $orderBy = trim($orderBy, ', ');
        }
        $where = '';
        foreach ($whereArray as $key => $row) {
            if ($where == '') {
                $where = 'WHERE ';
            }
            $where .= "{$key}{$row}";
        }
        $sql = "SELECT * FROM " . $this->_table . " " . $where . " " . $orderBy . ' ' . $limit;
        $consulta = self::$_db->query($sql);
        $st = $consulta->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $class);
        if (!$st) {

        }
        return $st;
    }

    /**
     * Podemos hacer consultas normales con este method
     * @param string $query
     * @return PDOStatement
     */
    public static function sql(string $query)
    {
        return self::$_db->query($query);
    }

    /**
     * Devolvemos la informacion de el pojo
     * @return array
     */
    public function info()
    {
        return array(
            "name" => $this->tableName,
            "columns" => $this->_columns,
            "primary" => $this->keyField,
        );
    }

    public function traerClavePrimaria()
    {
        return $this->keyField;
    }

    public function nuevo($valores)
    {
        $vacio = 0;
        //recorro los valores enviados y los voy asignando a los campos del registro
        foreach ($valores as $key => $val) {
            if (empty ($val) && $key != $this->keyField) {
                $vacio++;
            }
            if (!empty($val)) {
                if (strpos($this->_columns[$key]['type'], 'int') !== false) {
                    $insertar[$key] = "" . trim($val) . "";
                } else {
                    $insertar[$key] = "" . trim($val) . "";
                }
            }
        }
        if ($vacio == count($this->fields)) {
            $this->error = "Todos los campos estan vacios o los campos no existe en la tabla.<br/>";
            return false;
        } else {
            $consulta = self::$_db->insertRow($this->_table, $insertar);
            $this->{$this->keyField} = $consulta;
            if (self::rowCount() == 0) {
//                return false;
            } else {
                //$consulta = $this->db->GetLastInsertID();
//                return true;
            }
            return true;
        }

    }

    public function actualizar($valores)
    {
        $vacio = 0;
        //recorro los valores enviados y los voy asignando a los campos del registro
        foreach ($valores as $key => $val) {
            //valido si el campo existe en la tabla
            if ($key === $this->keyField) {
                $filtro[$this->keyField] = $val;
            }
            if (empty ($val)) {
                $vacio++;
            }
            $actualizar[$key] = "" . trim($val) . "";
        }

        if ($vacio == count($this->fields)) {
            $this->error = "Todos los campos estan vacios o los campos no existe en la tabla.<br/>";
            return false;
        } else {
            //actualizo el registro
            $consulta = self::$_db->updateRows($this->_table, $actualizar, $filtro);
            if (!$consulta) {
                $this->error = $this->db->Error();
                return false;
            } else {
                return true;
            }
        }
    }

    public function guardar()
    {
        //valido si se seteadon los campos automaticamente.
        // si no estan seteados es porque se hizo a mano desde el controlador
        if (!$this->seteados) {
            //recorro los campos y voy asignando los valores
            foreach ($this->fields as $key => $value) {
                $this->fields[$key] = $this->$key;
            }
        }

        // valido si en los campos seteados esta la clave primaria par saber si es
        // una actualizacion o un nuevo registro
        if (empty($this->fields[$this->keyField])) {
            return $this->nuevo($this->fields);
        } else {
            return $this->actualizar($this->fields);
        }
    }

    public function save()
    {
        //valido si se setearon los campos automáticamente.
        // si no están seteados es porque se hizo a mano desde el controlador
        if (!$this->seteados) {
            //recorro los campos y voy asignando los valores
            foreach ($this->fields as $key => $value) {
                $this->fields[$key] = $this->$key;
            }
        }
        return $this->nuevo($this->fields);

    }

    public function setearCampos($data)
    {
        //Recorro el arreglo y lo asigno a los campos del registro
        foreach ($data as $key => $value) {
            //valido si existe la clave en el arreglo de los campos y lo asigno al campo
            if (array_key_exists($key, $this->fields)) {
                $this->fields[$key] = $value;
                $this->{$key} = $value;
            }
            //valido si existe la clave primaria en el arreglo si no existe la seteo en vacio.
            if (!array_key_exists($this->keyField, $data)) {
                $this->fields[$this->keyField] = '';
            }
        }
        //cambio el estado de la bandera seteados
        $this->seteados = 1;
    }

    public function borrarPorPk($id)
    {
        $filtro[$this->keyField] = $id;
        $consulta = self::$_db->deleteRows($this->table, $filtro);

        if (!$consulta) {
            $this->error = $this->db->Error();
            return false;
        } else {
            return true;
        }

    }

    public function borrarTodo()
    {
        $consulta = self::$_db->truncateTable($this->table);
        if (!$consulta) {
            $this->error = self::$_db->Error();
            return false;
        } else {
            return true;
        }

    }

    /**
     * Inicializar ORM, lo que va hacer es crear la entidad apartir de la tabla
     */
    public static function inicializar()
    {

    }

    protected function set_table($table)
    {
        $this->_table = DB_PREFIJO . $table;
    }

    protected function setTable($table, $valor)
    {
        $this->{$table} = DB_PREFIJO . $valor;
    }

    public function getTable($full = false): string
    {
        if (!$full) {

            return $this->_table;
        }
        return str_replace(DB_PREFIJO, '', $this->_table);
    }

    public function truncate($table = null)
    {
        if (is_null($table)) {
            return self::$_db->truncateTable($this->_table);
        } else {
            return self::$_db->truncateTable($table);
        }
    }
}