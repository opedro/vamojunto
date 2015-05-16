<?php
/*
 * Departamento: Desenvolvimento
 * Data e hora: 09/05/2015 - 10:00
 * Autor: Thiago Retondar
 * <<Definição da Classe Post>>
 * Versão: 1.0.1
 * Resp. alterações: Pedro Ruiz
 * Motivo: Inserção do método createPost();
 * Aguardando a revisão de Thiago Retondar
  */

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

    public function insertPost($continuo, $week_Days, $status, $id_comunidade, $num_vagas, $id_pessoa, $hr_partida, $hr_chegada) {
        $values[0] = getDate();
        $values[1] = $continuo;
        $j = 2;
        for($i = 0; $i < count($week_Days); $i++,$j++)
            $values[$j] = $week_Days[$i] == true ? true : false;

        $values[10] = $status;
        $values[11] = $id_comunidade;
        $values[12] = $num_vagas;
        $values[13] = $id_pessoa;
        $values[14] = $hr_partida;
        $values[15] = $hr_chegada;

        $result = $this->db->insert(
            $table = "tab_post",
            $values
        );

        return $result;
    }

}