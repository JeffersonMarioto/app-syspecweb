<?php

  require_once 'config.php';
  require_once 'util.php';

  class Database extends Config {

    // Fetch Inseminaçoes com data Database
    public function read($estacao, $data_inseminacao) {
      $diagnostico = "prenha";
      $count = 0;
      $count_prenhas = 0;
      $count_vazias = 0;
      $percent_prenhas = 0;
      $percent_vazias =0;
      $sql = 'SELECT * FROM inseminacao WHERE estacao = :estacao
       AND MONTH(data_inseminacao) = :data_inseminacao ORDER BY idi ASC';
      $stmt = $this->conn->prepare($sql);

      $stmt->execute(['estacao' => $estacao,
       'data_inseminacao' => $data_inseminacao
      ]);      
      $result = $stmt->fetchAll();
      foreach ($result as $row) {
        $count++;
        if($row['diagnostico'] == "prenha"){
          $count_prenhas++;
        }else{
          $count_vazias++;
        }
      }
      if($count > 0){
        $percent_prenhas = ($count_prenhas *100) / $count;
      }
      
      if($count > 0){
        $percent_vazias = ($count_vazias *100) / $count;
      }
      $total = 0;
      $total = $count_prenhas + $count_vazias;      $output = "";
      $output .= '<tr>
                      <td>' . $count . '</td>
                      <td>' . $data_inseminacao . '</td>
                      <td>' . $estacao . '</td>
                      <td>' . $count_prenhas . '</td>
                      <td>' . $percent_prenhas . '</td>
                      <td>' . $count_vazias . '</td> 
                      <td>' . $percent_vazias . '</td> 
                    </tr>';

      return $output;
    }

    public function readAll($estacao) {
      $diagnostico = "prenha";
      $count = 0;
      $count_prenhas = 0;
      $count_vazias = 0;
      $percent_prenhas = 0;
      $percent_vazias =0;      
      $sql = 'SELECT * FROM inseminacao WHERE estacao = :estacao ORDER BY idi ASC';
      $stmt = $this->conn->prepare($sql);
      $stmt->execute(['estacao' => $estacao]);
      $result = $stmt->fetchAll();
      foreach ($result as $row) {
        $count++;
        if($row['diagnostico'] == "prenha"){
          $count_prenhas++;
        }else{
          $count_vazias++;
        }
      }
      if($count > 0){
        $percent_prenhas = ($count_prenhas *100) / $count;
      }
      
      if($count > 0){
        $percent_vazias = ($count_vazias *100) / $count;
      }
      $data = "TODOS";
      $output = "";
      $output .= '<tr>
                      <td>' . $count . '</td>
                      <td>' . $data . '</td>
                      <td>' . $estacao. '</td>
                      <td>' . $count_prenhas . '</td>
                      <td>' . $percent_prenhas . '</td>
                      <td>' . $count_vazias . '</td> 
                      <td>' . $percent_vazias . '</td> 
                    </tr>';

      return $output;
    }

  }
?>