<?php

  require_once 'db_consulta_partos_atrasados.php';
  require_once 'util.php';

  $db = new Database;
  $util = new Util;

  if (isset($_POST['add'])) {
    $estacao = $util->testInput($_POST['estacao']);
    $output = $db->read($estacao);
    if ($output) {
      echo $output;
    } else {
      echo '<tr>
              <td colspan="6">No Data Found in the Database!</td>
            </tr>';
    }
  }

?>