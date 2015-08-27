<?php

require_once "../model/dao.class.php";

class Pessoa {
	private $db = NULL;

	public function __construct() {
		$this->db = new dao('root','toor','vamojunto_development');
		$this->db->connect();
	}

	public function __destruct() {
$this->db->disconnect();
	}

	public function getPessoaById($id_pessoa) {
		$this->db->select(
			$table = "tab_pessoa",
			$rows = "*",
			$where = "id = $id_pessoa"
		);
		
		return $this->db->getResult();
	}

	public function getAllPessoas() {
		$this->db->select(
			$table = "tab_pessoa",
			$rows = "*"
		);
		
		return $this->db->getResult();
	}

}