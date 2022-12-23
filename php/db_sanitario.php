<?php

  require_once 'config.php';

  class Database extends Config {
    // Insert Sanitário Into Database
    public function insert($produto, $total, $data_aplicacao) {
      $sql = 'INSERT INTO sanitario (produto, total, data_aplicacao) VALUES (:produto, :total, :data_aplicacao)';
      $stmt = $this->conn->prepare($sql);
      $stmt->execute([
        'produto' => $produto,
        'total' => $total,
        'data_aplicacao' => $data_aplicacao
      ]);
      return true;
    }

    // Fetch All Sanitários From Database
    public function read() {
      $sql = 'SELECT * FROM sanitario ORDER BY ids DESC';
      $stmt = $this->conn->prepare($sql);
      $stmt->execute();
      $result = $stmt->fetchAll();
      return $result;
    }

    // Fetch Single Sanitário From Database
    public function readOne($ids) {
      $sql = 'SELECT * FROM sanitario WHERE ids = :ids';
      $stmt = $this->conn->prepare($sql);
      $stmt->execute(['ids' => $ids]);
      $result = $stmt->fetch();
      return $result;
    }

    // Update Single Sanitário
    public function update($ids, $produto, $total, $data_aplicacao) {
      $sql = 'UPDATE sanitario SET produto = :produto, total = :total, data_aplicacao = :data_aplicaco WHERE ids = :ids';
      $stmt = $this->conn->prepare($sql);
      $stmt->execute([
        'produto' => $produto,
        'total' => $total,
        'data_aplicacao' => $data_aplicacao,
        'ids' => $ids
      ]);

      return true;
    }

    // Delete Sanitário From Database
    public function delete($ids) {
      $sql = 'DELETE FROM sanitario WHERE ids = :ids';
      $stmt = $this->conn->prepare($sql);
      $stmt->execute(['ids' => $ids]);
      return true;
    }
  }

?>