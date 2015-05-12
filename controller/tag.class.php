<?php
/*
 * Departamento: Desenvolvimento
 * Gerente responsável: Pedro Ruiz
 * Data e hora: 09/05/2015 - 10:00
 * Autor: Pedro Ruiz
 * <<Definição da Classe TAG>>
 * Versão: 1.0
  */

require_once "../model/dao.class.php";

class Tag {
	private $db = NULL;

    private $id;
    private $desc;

	public function __construct() {
		$this->db = new dao('root','toor','vamojunto_development');
		$this->db->connect();
	}

	public function __destruct() {
		$this->db->disconnect();
	}
    public function insertTag(Tag $tag) {
        $this->db->insert(
            $table = "tab_tags",
            $values = "descricao=".$tag->$desc
        );
        return $this->db->getResult();
    }

	public function getAllTags() {
		$this->db->select(
			$table = "tab_tags",
			$rows = "descricao"
		);
		return $this->db->getResult();
	}

	public function getTag($tag_id) {
		$this->db->select(
			$table = "tab_tag",
			$rows = "*",
			$where = "id = $tag_id"
		);

		return $this->db->getResult();

	}

}