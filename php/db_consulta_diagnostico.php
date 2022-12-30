<?php

  require_once 'config.php';
  require_once 'util.php';

  class Database extends Config {

    // Fetch Inseminaçoes show animals com data Database
    public function readAnimals($estacao, $data_inseminacao) {
      $sql = 'SELECT * FROM inseminacao WHERE estacao = :estacao
       AND MONTH(data_inseminacao) = :data_inseminacao ORDER BY diagnostico ASC, data_inseminacao ASC';
      $stmt = $this->conn->prepare($sql);
      $stmt->execute(['estacao' => $estacao,
       'data_inseminacao' => $data_inseminacao
      ]);      
      $result = $stmt->fetchAll();
      $output = "";
      $count = 0;
      foreach ($result as $row) {
        $count++;
        $output .= '<tr>
                      <td>' . $count . '</td>
                      <td>' . $row['idi'] . '</td>
                      <td>' . $row['vaca'] . '</td>
                      <td>' . $row['touro'] . '</td>
                      <td>' . $row['data_inseminacao'] . '</td>
                      <td>' . $row['diagnostico'] . '</td> 
                      <td>' . $row['parto'] . '</td> 
                    </tr>';
    }

      return $output;
    }

    public function readAllAnimals($estacao) {
      $sql = 'SELECT * FROM inseminacao WHERE estacao = :estacao
       ORDER BY diagnostico ASC, data_inseminacao ASC';
      $stmt = $this->conn->prepare($sql);
      $stmt->execute(['estacao' => $estacao]);      
      $result = $stmt->fetchAll();
      $output = "";
      $count = 0;
      foreach ($result as $row) {
        $count++;
        $output .= '<tr>
                      <td>' . $count . '</td>
                      <td>' . $row['idi'] . '</td>
                      <td>' . $row['vaca'] . '</td>
                      <td>' . $row['touro'] . '</td>
                      <td>' . $row['data_inseminacao'] . '</td>
                      <td>' . $row['diagnostico'] . '</td> 
                      <td>' . $row['parto'] . '</td> 
                    </tr>';
    }

      return $output;
    }    

  }
?>