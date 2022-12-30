<?php

  require_once 'db_consulta_partos.php';
  require_once 'util.php';

  $db = new Database;
  $util = new Util;

  if (isset($_POST['add'])) {
    $estacao = $util->testInput($_POST['estacao']);
    $mes = $util->testInput($_POST['mes']);
    $output = $db->read($estacao, $mes);
    if ($output) {
      echo $output;
    } else {
      echo '<tr>
              <td colspan="6">No Data Found in the Database!</td>
            </tr>';
    }
  }

?>