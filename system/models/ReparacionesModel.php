<?php
/**
 * Created by PhpStorm.
 * User: codeunic
 * Date: 14/07/2017
 * Time: 21:18
 */

class ReparacionesModel extends Model implements SQL_model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get($id)
    {
        $Reparacion = new ReparacioneEntity();
        return $Reparacion->buscarPorPk($id);
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

    public function getAll($limit = null, int $fk_cliente = null, $estado = null)
    {
        $where = null;
        if (!is_null($fk_cliente)) {
            if(!is_null($estado)){
                $where = "WHERE fk_usuario={$fk_cliente} AND estado = {$estado}";
            }else{
                $where = "WHERE fk_usuario={$fk_cliente}";
            }
        }else{
            if(!is_null($estado)){
                $where = "WHERE estado = {$estado}";
            }
        }

        $queryTotal = "SELECT * FROM cu_reparaciones {$where} ORDER BY fecha_modificacion DESC";
        $queryCount = ORM::sql($queryTotal)->rowCount();

        if (!is_null($limit)) {
            $queryLimit = $queryTotal .= " LIMIT {$limit}";
            $queryLimit = ORM::sql($queryLimit);
        } else {
            $queryLimit = ORM::sql($queryTotal);
        }
        $queryLimit = $queryLimit->fetchAll(PDO::FETCH_OBJ);
        $reparaciones = array(
            'reparaciones' => array(),
            'length' => 0
        );

        foreach ($queryLimit as $key => $row) {
            $Reparacion = new ReparacioneEntity();
            print_pre($row->getId());
            $Reparacion->setearCampos(array(
                'id' => $row->id,
                'averia' => $row->averia,
                'fecha_creacion' => $row->fecha_creacion,
                'fecha_modificacion' => $row->fecha_modificacion,
                'notas' => $row->notas,
                'fk_cliente' => $row->fk_cliente,
                'fk_tecnico' => $row->fk_tecnico,
                'fk_modalidad' => $row->fk_modalidad,
                'num_averia' => $row->num_averia,
                'estado' => $row->estado
            ));
            array_push($reparaciones['reparaciones'], $Reparacion);
        }
        $reparaciones['length'] = $queryCount;
        return $reparaciones;
    }

    public function truncate()
    {
        // TODO: Implement truncate() method.
    }

    public function obtenerReparacionesPorCliente($id){
        $sql= "SELECT * FROM cu_reparaciones WHERE fk_cliente = {$id}";
        $query = ORM::sql($sql)->fetchAll();

        return $query;
    }
}