<?php
include 'dao.class.php';

$db = new dao('root','toor','vamojunto_development');
$db->connect();

$result = $db->insert(
  "teste", //tabela
  array("test123"), // campos - valores
  "name" // campos - nome
);

echo $result;

$db->disconnect();
?>
