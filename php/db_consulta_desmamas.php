<?php

  require_once 'config.php';

  class Database extends Config {

    // Fetch Partos Database
    public function read() {
      $sql = 'SELECT * FROM animais, pesagem WHERE animais.data BETWEEN CURDATE() - INTERVAL 1 YEAR AND CURDATE() - INTERVAL 6 MONTH AND pesagem.era LIKE "bezerro"';  
      $stmt = $this->conn->prepare($sql);
      $stmt->execute();
      $result = $stmt->fetchAll();
      $numero = "";
      $data_nascimento = 0000-00-00;
      $sexo = "";
      $peso = 0;
      $output = "";
      $cont = 0;
      foreach ($result as $row) {
        $numero = $row['numero'];
        $data_nascimento = $row['data'];
        $sexo = $row['sexo'];
        $d1 = new DateTime('now');
        $d2 = new DateTime($data_nascimento);
        $intervalo = $d1->diff( $d2 );
        $ano = $intervalo->y;
        $meses = $intervalo->m;
        $idade = 0; 
        if($ano > 0){
          $idade = $ano." ano(s)"." e ".$meses." mes(es)";
        }else{
          $idade = $meses." mes(es)";
        }
        $peso = $row['peso_atual'];
        $cont++;
        $output .= '<tr>
                      <td>' . $cont . '</td>
                      <td>' . $numero . '</td>
                      <td>' . $data_nascimento . '</td>
                      <td>' . $idade . '</td>
                      <td>' . $sexo . '</td>
                      <td>' . $peso . '</td>
                    </tr>';
      }
      return $output;
    }
  }
?>