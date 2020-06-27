<?php

/**
 * Created by PhpStorm.
 * User: rafagonzalez
 * Date: 30/11/16
 * Time: 21:20
 */
class Configure extends Model
{
	public $id;
	public $title;
	public $email;
	public $privacidad;
	public $num_repair;

	public function __construct()
	{
		parent::__construct();
		$this->_table = DB_PREFIJO . "config";

		$this->obtenerConfig();
		return $this;
	}

	private function obtenerConfig()
	{
		$sql = "SELECT * FROM {$this->_table} LIMIT 1";

		$query = $this->_db->query($sql);
		$row = $query->fetch(PDO::FETCH_OBJ);
		$this->SetterFetch($row);
	}

	private function returnConfig()
	{
		return $this->Configure;
	}

}
