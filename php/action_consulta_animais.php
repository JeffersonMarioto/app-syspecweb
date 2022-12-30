<?php

  require_once 'db_consulta_animais.php';
  require_once 'util.php';

  $db = new Database;
  $util = new Util;

  if (isset($_GET['read'])) {
    $output = $db->buscar();
    if ($output) {
      echo $output;
    } else {
      echo '<tr>
              <td colspan="6">No Data Found in the Database!</td>
            </tr>';
    }
  }

?>  