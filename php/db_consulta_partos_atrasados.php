<?php

  require_once 'config.php';

  class Database extends Config {

    // Fetch Partos Database
    public function read($estacao) {
      $sql = 'SELECT vaca, parto FROM inseminacao WHERE estacao = :estacao
       AND parto < NOW() AND diagnostico LIKE "prenha" ORDER BY idi ASC';
      $stmt = $this->conn->prepare($sql);
      $stmt->execute(['estacao' => $estacao]);
      $result = $stmt->fetchAll();
      // loop para armazenar objeto Parto criado do select todos partos ate a data de hoje.
      // 2 arrays um guarda objeto parto e outro somente os numeros das vacas. 
      $array_vacas = array();
      $array_parto = array();

      foreach ($result as $row) {
        $array_vacas = array("numero" => $row['vaca']);
        $array_parto = array($row['vaca'] => $row['parto']);
      } 

      $sql = 'SELECT numero FROM animais WHERE data BETWEEN CURDATE() - INTERVAL 1 YEAR AND CURDATE() ORDER BY id ASC';  
      $stmt = $this->conn->prepare($sql);
      $stmt->execute();
      $result = $stmt->fetchAll();
      $array_bezerros = array();
      foreach ($result as $row) {
        $array_bezerros = array($row['numero']);
      }

      $array_atrasadas = array();
      $array_atrasadas = array_diff($array_vacas, $array_bezerros);

      $output = "";
      $cont = 0;
      foreach ($array_parto as $key => $value) {; 
        $vaca = $key;
        $parto = $value;

        if(in_array($vaca, $array_atrasadas)){
          $cont++;
          $output .= '<tr>
                        <td>' . $cont . '</td>
                        <td>' . $vaca . '</td>
                        <td>' . $parto . '</td>
                      </tr>';
        }
      }
      return $output;
    }
  }
?>