<?php

require_once "../model/dao.class.php";

class Post {
	private $db = NULL;

	public function __construct() {
		$this->db = new dao('root','toor','vamojunto_development');
		$this->db->connect();
	}

	public function __destruct() {
		$this->db->disconnect();
	}

	public function getPosts() {
		$this->db->select(
			$table = "tab_post",
			$rows = "*",
			$where = "status = 1"
		);
		return $this->db->getResult();
	}

	public function getTrajeto($post_id) {
		$this->db->select(
			$table = "tab_post_tags",
			$rows = "*",
			$where = "id_post = $post_id",
			$order = "ordem ASC"
		);

		$resultado_post_tags = $this->db->getResult();
		
		$trajetos = array();
		foreach( $resultado_post_tags as $result ) {

			$this->db->select(
				$table = "tab_tags",
				$rows = "descricao",
				$where = "id = ". $result['id_tag']
			);

			$tag_descricao = $this->db->getResult();

			array_push( $trajetos, $tag_descricao[0]['descricao'] );

		}

		return $trajetos;
	}

	public function getConfirmacoes($post_id) {
		$this->db->select(
			$table = "tab_confirmacao",
			$rows = "id_pessoa",
			$where = "id_post = $post_id"
		);

		$id_pessoas = $this->db->getResult();
		return $id_pessoas;
	}

}