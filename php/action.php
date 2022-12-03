<?php

  require_once 'db.php';
  require_once 'util.php';

  $db = new Database;
  $util = new Util;

  // Handle Add New User Ajax Request
  if (isset($_POST['add'])) {
    $usuario = $util->testInput($_POST['usuario']);
    $senha = $util->testInput($_POST['senha']);

    if ($db->insert($usuario, $senha)) {
      echo $util->showMessage('success', 'Usuário cadastrado com sucesso!');
    } else {
      echo $util->showMessage('danger', 'Algo deu errado!');
    }
  }

  // Handle Fetch All Users Ajax Request
  if (isset($_GET['read'])) {
    $users = $db->read();
    $output = '';
    if ($users) {
      foreach ($users as $row) {
        $output .= '<tr>
                      <td>' . $row['usuario_id'] . '</td>
                      <td>' . $row['usuario'] . '</td>
                      <td>' . $row['senha'] . '</td>
                      <td>
                        <a href="#" usuario_id="' . $row['usuario_id'] . '" class="btn btn-success btn-sm rounded-pill py-0 editLink" data-toggle="modal" data-target="#editUserModal">Edit</a>

                        <a href="#" usuario_id="' . $row['usuario_id'] . '" class="btn btn-danger btn-sm rounded-pill py-0 deleteLink">Deletar</a>
                      </td>
                    </tr>';
      }
      echo $output;
    } else {
      echo '<tr>
              <td colspan="6">Sem usuários no banco de dados!</td>
            </tr>';
    }
  }

  // Handle Edit User Ajax Request
  if (isset($_GET['edit'])) {
    $usuario_id = $_GET['usuario_id'];

    $user = $db->readOne($usuario_id);

    echo json_encode($user);
  }

  // Handle Update User Ajax Request
  if (isset($_POST['update'])) {
    $usuario_id = $util->testInput($_POST['usuario_id']);
    $usuario = $util->testInput($_POST['usuario']);
    $senha = $util->testInput($_POST['senha']);

    if ($db->update($usuario_id, $usuario, $senha)) {
      echo $util->showMessage('success', 'Usuário atualizado com sucesso!');
    } else {
      echo $util->showMessage('danger', 'Deu ruim!');
    }
  }

  // Handle Delete User Ajax Request
  if (isset($_GET['delete'])) {
    $id = $_GET['id'];
    if ($db->delete($id)) {
      echo $util->showMessage('info', 'Deletado!');
    } else {
      echo $util->showMessage('danger', 'Não deletado!');
    }
  }

?>