<?php

  require_once 'config.php';

  class Database extends Config {
    // Insert Ins. Into Database
    public function insert($vaca, $touro, $data_inseminacao, $estacao, $diagnostico) {
      // Calculando data aproximada do parto
      $parto = new DateTime($data_inseminacao);
      $parto->add(new DateInterval('P9M10D'));
      $parto = $parto->format('Y-m-d');

      if($diagnostico == "vazia"){
        $parto = 0000-00-00;
      }
 
      $sql = 'INSERT INTO inseminacao (vaca, touro, data_inseminacao, estacao, diagnostico, parto) VALUES (:vaca, :touro, :data_inseminacao, :estacao, :diagnostico, :parto)';
      $stmt = $this->conn->prepare($sql);
      $stmt->execute([
        'vaca' => $vaca,
        'touro' => $touro,
        'data_inseminacao' => $data_inseminacao,
        'estacao' => $estacao,
        'diagnostico' => $diagnostico,
        'parto' => $parto
      ]);
      return true;
    }

    // Fetch All Ins.s From Database
    public function read() {
      $sql = 'SELECT * FROM inseminacao ORDER BY idi DESC';
      $stmt = $this->conn->prepare($sql);
      $stmt->execute();
      $result = $stmt->fetchAll();
      return $result;
    }

    // Fetch Single Ins From Database
    public function readOne($idi) {
      $sql = 'SELECT * FROM inseminacao WHERE idi = :idi';
      $stmt = $this->conn->prepare($sql);
      $stmt->execute(['idi' => $idi]);
      $result = $stmt->fetch();
      return $result;
    }

    // Update Single Ins
    public function update($idi, $vaca, $touro, $data_inseminacao, $estacao, $diagnostico) {
    // Calculando data aproximada do parto
      $parto = new DateTime($data_inseminacao);
      $parto->add(new DateInterval('P9M10D'));
      $parto = $parto->format('Y-m-d');

      if($diagnostico == "vazia"){
        $parto = 0000-00-00;
      }

      $sql = 'UPDATE inseminacao SET vaca = :vaca, touro = :touro, data_inseminacao = :data_inseminacao, estacao = :estacao, diagnostico = :diagnostico, parto = :parto WHERE idi = :idi';
      $stmt = $this->conn->prepare($sql);
      $stmt->execute([
        'vaca' => $vaca,
        'touro' => $touro,
        'data_inseminacao' => $data_inseminacao,
        'estacao' => $estacao,
        'diagnostico' => $diagnostico,
        'parto' => $parto,
        'idi' => $idi
      ]);

      return true;
    }

    // Delete User From Database
    public function delete($idi) {
      $sql = 'DELETE FROM inseminacao WHERE idi = :idi';
      $stmt = $this->conn->prepare($sql);
      $stmt->execute(['idi' => $idi]);
      return true;
    }
  }

?>