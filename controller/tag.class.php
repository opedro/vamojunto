<?php

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
    public function insertPost(Tag $tag) {
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