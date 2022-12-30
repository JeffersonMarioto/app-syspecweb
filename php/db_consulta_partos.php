<?php

  require_once 'config.php';
  require_once 'util.php';

  class Database extends Config {

    // Fetch Partos Database
    public function read($estacao, $mes) {
      $diagnostico = "prenha";
      $count = 0;
      $sql = 'SELECT * FROM inseminacao WHERE estacao = :estacao
       AND MONTH(parto) = :mes AND diagnostico LIKE "prenha" ORDER BY idi ASC';
      $stmt = $this->conn->prepare($sql);
      $stmt->execute(['estacao' => $estacao,
       'mes' => $mes
     ]);
      $result = $stmt->fetchAll();
      foreach ($result as $row) {
        $count++;
        $output = "";
        $output .= '<tr>
                      <td>' . $count . '</td>
                      <td>' . $row['vaca'] . '</td>
                      <td>' . $row['parto'] . '</td>
                    </tr>';

        return $output;
      }
      echo "Total de partos para o mês selecionado: ".$count;
    }
  }
?>