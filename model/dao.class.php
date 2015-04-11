<?php

class Dao {
  private $db = NULL;
  private $connection_string = NULL;
  private $db_type = NULL;
  private $db_path = NULL;
  private $db_host = NULL;
  private $db_user = NULL;
  private $db_pass = NULL;
  private $db_name = NULL;
  private $con = false;
  private $result = array();

  public function __construct(
    $db_user, $db_pass, $db_name,
    $db_type = 'mysql', $db_path, $db_host = 'localhost') {
      $this->db_host = $db_host;
      $this->db_user = $db_user;
      $this->db_pass = $db_pass;
      $this->db_name = $db_name;
      $this->db_path = $db_path;
      $this->db_type = $db_type;
      switch($this->db_type){
        case "mysql":
        $this->connection_string = "mysql:host=".$db_host.";dbname=".$db_name;
        break;

        case "sqlite":
        $this->connection_string = "sqlite:".$db_path;
        break;

        case "oracle":
        $this->connection_string = "OCI:dbname=".$db_name.";charset=UTF-8";
        break;

        case "dblib":
        $this->connection_string = "dblib:host=".$db_host.";dbname=".$db_name;
        break;

        case "postgresql":
        $this->connection_string = "pgsql:host=".$db_host." dbname=".$db_name;
        break;
      }

      return $this;
  }

  public function connect() {
    if(!$this->con) { // there is no connection setted
      try {
          $this->db = new PDO( // using PDO as a helper to manipulate SQL
            $this->connection_string,
            $this->db_user,
            $this->db_pass
          );

          $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $this->con = true;

          return $this->con;
      } catch(PDOException $e) {
          return $e->getMessage();
      }
    } else {
        return true; //already connected, do nothing and show true
    }
  }

  public function disconnect() {
    if($this->con) {
        unset($this->db);
        $this->con = false;
        return true;
    }
  }

  public function select($table, $rows = '*', $where = NULL, $order = NULL) {
    if($this->tableExists($table)) {
      $q = 'SELECT '.$rows.' FROM '.$table;

      if($where != NULL) {
        $q .= ' WHERE '.$where;
      }

      if($order != NULL) {
        $q .= ' ORDER BY '.$order;
      }

      $this->numResults = NULL;

      try {
        $sql = $this->db->prepare($q);
        $sql->execute();
        $this->result = $sql->fetchAll(PDO::FETCH_ASSOC);
        $this->numResults = count($this->result);
        $this->numResults === 0 ? $this->result = NULL : true ;
        return true;
      } catch(PDOException $e) {
        return $e->getMessage().' '.$e->getTraceAsString();
      }
    }
  }

  public function getResult() {
    return $this->result;
  }

  public function getRows() {
    return $this->numResults;
  }

  public function insert($table, $values, $rows = NULL) {
    $insert = 'INSERT INTO '.$table;

    if($rows != NULL) {
      $insert .= ' ('.$rows.')';
    }

    for($i = 0; $i < count($values); $i++) {
      // Only add double quotes for values that are string indeed
      if(is_string($values[$i])) {
        $values[$i] = '"'.$values[$i].'"';
      }
    }

    $values = implode(',',$values);

    $insert .= ' VALUES ('.$values.')';

    $this->numResults = NULL;

    echo $insert;

    try {
      $ins = $this->db->prepare($insert);
      $ins->execute();
      $this->lastId = $this->db->lastInsertId();
      $this->numResults = $ins->rowCount();
      return true;
    } catch(PDOException $e) {
      return $e->getMessage();
    }
  }
}
