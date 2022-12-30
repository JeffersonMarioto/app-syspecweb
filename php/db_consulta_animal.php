<?php

  require_once 'config.php';

  class Database extends Config {

    // Fetch Single Animal From Database
    public function readOne($numero, $era) {

      if($era == "bezerro"){
        $sql = 'SELECT * FROM animais WHERE numero LIKE :numero ORDER BY data DESC';
      }else{
        $sql = 'SELECT * FROM animais WHERE numero LIKE :numero ORDER BY data ASC';
      }
      $stmt = $this->conn->prepare($sql);
      $stmt->execute(['numero' => $numero]);
      $result = $stmt->fetch();
      $animal = '';
      $data = $result['data'];
      $d1 = new DateTime('now');
      $d2 = new DateTime($data);
      $intervalo = $d1->diff( $d2 );
      $ano = $intervalo->y;
      $meses = $intervalo->m;
      $idade = 0; 
      if($ano > 0){
        $idade = $ano." ano(s)"." e ".$meses." mes(es)";
      }else{
        $idade = $meses." mes(es)";
      }
      $animal .= ' N: '.$numero.'<br>';
      $animal .= ' Era: '.$era.'<br>';
      $animal .= ' Descricao: '.$result['descricao'].'<br>';
      $animal .= ' Idade: '.$idade.'<br>';


      $sql2 = 'SELECT peso_atual FROM pesagem WHERE numero LIKE :numero AND era LIKE :era ORDER BY idp DESC';
      $stmt2 = $this->conn->prepare($sql2);
      $stmt2->execute(['numero' => $numero, 'era' => $era]);
      $result2 = $stmt2->fetch();
      $peso = 0.0;
      $peso = $result2['peso_atual'];
      $animal .= ' Peso: '.$peso.'<br>';

      if($era == "outros"){
        $vaca = "";
        $vaca = $numero;
        $sql = 'SELECT * FROM inseminacao WHERE vaca LIKE :vaca ORDER BY idi DESC';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['vaca' => $vaca]);
        $result = $stmt->fetch();
        $touro = $result['touro'];
        $data_inseminacao = "0000-00-00";
        if( $result['data_inseminacao']){
          $data_inseminacao = $result['data_inseminacao'];
        }
        $estacao = $result['estacao'];
        $diagnostico = $result['diagnostico'];
        $parto = $result['parto'];
        $animal .= ' Inseminada do touro: '.$touro.'<br>';
        $animal .= ' No dia: '.$data_inseminacao.'<br>';
        $animal .= ' Estacao: '.$estacao.'<br>';
        $animal .= ' Diagnostico: '.$diagnostico.'<br>';
        $animal .= ' Data aprox. parto: '.$parto;
      }
      return $animal;
    }

    public function read(){
      $animal = "VACA";
      return $animal;
    }
  }

?>