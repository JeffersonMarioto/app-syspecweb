<?php

  require_once 'config.php';

  class Database extends Config {
    // Insert Animal Into Database
    public function insert($numero, $descricao, $data, $propriedade, $sexo) {
      $sql = 'INSERT INTO animais (numero, descricao, data, propriedade, sexo) VALUES (:numero, :descricao, :data, :propriedade, :sexo)';
      $stmt = $this->conn->prepare($sql);
      $stmt->execute([
        'numero' => $numero,
        'descricao' => $descricao,
        'data' => $data,
        'propriedade' => $propriedade,
        'sexo' => $sexo
      ]);
      return true;
    }

    // Fetch All Animais From Database
    public function read() {
      $sql = 'SELECT * FROM animais ORDER BY id DESC';
      $stmt = $this->conn->prepare($sql);
      $stmt->execute();
      $result = $stmt->fetchAll();
      return $result;
    }

    // Fetch Single Animal From Database
    public function readOne($id) {
      $sql = 'SELECT * FROM animais WHERE id = :id';
      $stmt = $this->conn->prepare($sql);
      $stmt->execute(['id' => $id]);
      $result = $stmt->fetch();
      return $result;
    }

    // Update Single Animal
    public function update($id, $numero, $descricao, $data, $propriedade, $sexo) {
      $sql = 'UPDATE animais SET numero = :numero, descricao = :descricao, data = :data, propriedade = :propriedade, sexo = :sexo WHERE id = :id';
      $stmt = $this->conn->prepare($sql);
      $stmt->execute([
        'numero' => $numero,
        'descricao' => $descricao,
        'data' => $data,
        'propriedade' => $propriedade,
        'sexo' => $sexo,
        'id' => $id
      ]);

      return true;
    }

    // Delete User From Database
    public function delete($id) {
      $sql = 'DELETE FROM animais WHERE id = :id';
      $stmt = $this->conn->prepare($sql);
      $stmt->execute(['id' => $id]);
      return true;
    }
  }

?>