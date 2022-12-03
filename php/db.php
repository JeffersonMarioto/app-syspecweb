<?php

  require_once 'config.php';

  class Database extends Config {
    // Insert User Into Database
    public function insert($usuario, $senha) {
      $sql = 'INSERT INTO usuario (usuario, senha) VALUES (:usuario, :senha)';
      $stmt = $this->conn->prepare($sql);
      $stmt->execute([
        'usuario' => $usuario,
        'senha' => $senha
      ]);
      return true;
    }

    // Fetch All Users From Database
    public function read() {
      $sql = 'SELECT * FROM usuario ORDER BY usuario_id DESC';
      $stmt = $this->conn->prepare($sql);
      $stmt->execute();
      $result = $stmt->fetchAll();
      return $result;
    }

    // Fetch Single User From Database
    public function readOne($usuario_id) {
      $sql = 'SELECT * FROM usuario WHERE usuario_id = :usuario_id';
      $stmt = $this->conn->prepare($sql);
      $stmt->execute(['usuario_id' => $usuario_id]);
      $result = $stmt->fetch();
      return $result;
    }

    // Update Single User
    public function update($usuario_id, $usuario, $senha) {
      $sql = 'UPDATE usuario SET usuario = :usuario, senha = :senha WHERE usuario_id = :usuario_id';
      $stmt = $this->conn->prepare($sql);
      $stmt->execute([
        'usuario' => $usuario,
        'senha' => $senha,
        'usuario_id' => $usuario_id
      ]);

      return true;
    }

    // Delete User From Database
    public function delete($id) {
      $sql = 'DELETE FROM usuario WHERE usuario_id = :usuario_id';
      $stmt = $this->conn->prepare($sql);
      $stmt->execute(['usuario_id' => $id]);
      return true;
    }
  }

?>