<?php

  require_once 'db_consulta_diagnostico.php';
  require_once 'util.php';

  $db = new Database;
  $util = new Util;

  if (isset($_POST['add'])) {
    $estacao = $util->testInput($_POST['estacao']);
    $mes = $util->testInput($_POST['mes']);
    echo $mes;
    if($mes == 0){
      $output = $db->readAllAnimals($estacao);
      if ($output) {
        echo $output;
      } else {
        echo '<tr>
                <td colspan="6">No Data Found in the Database!</td>
              </tr>';
      }
    }else{
      $output = $db->readAnimals($estacao, $mes);
      if ($output) {
        echo $output;
      } else {
        echo '<tr>
                <td colspan="6">No Data Found in the Database!</td>
              </tr>';
      }
    }
  }

?>