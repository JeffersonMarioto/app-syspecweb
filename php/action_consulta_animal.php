<?php

  require_once 'db_consulta_animal.php';
  require_once 'util.php';

  $db = new Database;
  $util = new Util;

  if (isset($_POST['add'])) {
    $numero = $util->testInput($_POST['numero']);
    $numero_sem_zeros = ltrim($numero, '0');
    $numero = $numero_sem_zeros;    
    $era = $util->testInput($_POST['era']);
    $animal = $db->readOne($numero, $era);
    echo json_encode($animal);
  }

?>