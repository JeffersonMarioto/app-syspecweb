<?php

  require_once 'config.php';

  class Database extends Config {

    // Insert Pesagem Into Database
    public function insert($numero, $data_atual, $peso_atual, $era) {
      if($era == "bezerro"){
        $sql = 'SELECT data FROM animais WHERE numero LIKE :numero ORDER BY id DESC';
      }else{
        $sql = 'SELECT data FROM animais WHERE numero LIKE :numero ORDER BY id ASC';
      }
      $stmt = $this->conn->prepare($sql);
      $stmt->execute(['numero' => $numero]);
      $result = $stmt->fetch();
      $data = $result['data'];
      $d1 = new DateTime($data_atual);
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

      $peso_anterior = 0.0;
      $data_anterior = "0000/00/00";

      $sql = 'SELECT data_atual, peso_atual FROM pesagem WHERE numero LIKE :numero AND era LIKE :era ORDER BY idp DESC';
      $stmt = $this->conn->prepare($sql);
      $stmt->execute(['numero' => $numero, 'era' => $era]);
      $result = $stmt->fetch();
      $peso_anterior = $result['peso_atual'];
      $data_anterior = $result['data_atual'];

      $resultado = 0.0;
      if($peso_anterior > 0){
        $diferenca = strtotime($data_atual) - strtotime($data_anterior);
        $dias = floor($diferenca / (60 * 60 * 24));
        $resultado = ($peso_atual - $peso_anterior);
        $media = $resultado/$dias;
        $resultado = $resultado." Kg em ".$dias." dia(s)";
        $media = $media." kg/dia";
      }else{
        $peso_anterior = 0.0;
        $data_anterior = "0000/00/00";
        $media = 0;
      }

      $sql = 'INSERT INTO pesagem (numero, data_atual, peso_atual, peso_anterior, data_anterior, resultado, media, idade, era) VALUES (:numero, :data_atual, :peso_atual, :peso_anterior, :data_anterior, :resultado, :media, :idade, :era)';
      $stmt = $this->conn->prepare($sql);
      $stmt->execute([
        'numero' => $numero,
        'data_atual' => $data_atual,
        'peso_atual' => $peso_atual,
        'peso_anterior' => $peso_anterior,
        'data_anterior' => $data_anterior,
        'resultado' => $resultado,
        'media' => $media,
        'idade' => $idade,
        'era' => $era
      ]);
      return true;
    }

    // Fetch All Pesagem From Database
    public function read() {
      $sql = 'SELECT * FROM pesagem ORDER BY idp DESC';
      $stmt = $this->conn->prepare($sql);
      $stmt->execute();
      $result = $stmt->fetchAll();
      return $result;
    }

    // Fetch Single Pesagem From Database
    public function readOne($idp) {
      $sql = 'SELECT * FROM pesagem WHERE idp = :idp';
      $stmt = $this->conn->prepare($sql);
      $stmt->execute(['idp' => $idp]);
      $result = $stmt->fetch();
      return $result;
    }

    // Update Single Pesagem
    public function update($idp, $numero, $data_atual, $peso_atual, $peso_anterior, $data_anterior, $resultado, $idade, $era) {
      $sql = 'UPDATE pesagem SET numero = :numero, data_atual = :data_atual, peso_atual = :peso_atual, peso_anterior = :peso_anterior, data_anterior = :data_anterior, resultado = :resultado, idade = :idade, era = :era WHERE idp = :idp';
      $stmt = $this->conn->prepare($sql);
      $stmt->execute([
        'numero' => $numero,
        'data_atual' => $data_atual,
        'peso_atual' => $peso_atual,
        'peso_anterior' => $peso_anterior,
        'data_anterior' => $data_anterior,
        'resultado' => $resultado,
        'idade' => $idade,
        'era' => $era,
        'idp' => $idp
      ]);

      return true;
    }

    // Delete User From Database
    public function delete($idp) {
      $sql = 'DELETE FROM pesagem WHERE idp = :idp';
      $stmt = $this->conn->prepare($sql);
      $stmt->execute(['idp' => $idp]);
      return true;
    }
  }

?>