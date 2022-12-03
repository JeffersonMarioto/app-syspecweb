<?php

  require_once 'db_animais.php';
  require_once 'util.php';

  $db = new Database;
  $util = new Util;

  // Handle Add New User Ajax Request
  if (isset($_POST['add'])) {
    $numero = $util->testInput($_POST['numero']);
    $descricao = $util->testInput($_POST['descricao']);
    $data = $util->testInput($_POST['data']);
    $propriedade = $util->testInput($_POST['propriedade']);
    $sexo = $util->testInput($_POST['sexo']);

    if ($db->insert($numero, $descricao, $data, $propriedade, $sexo)) {
      echo $util->showMessage('success', 'Sucess!');
    } else {
      echo $util->showMessage('danger', 'No Sucess!');
    }
  }

  // Handle Fetch All Users Ajax Request
  if (isset($_GET['read'])) {
    $users = $db->read();
    $output = '';
    if ($users) {
      foreach ($users as $row) {
        $output .= '<tr>
                      <td>' . $row['id'] . '</td>
                      <td>' . $row['numero'] . '</td>
                      <td>' . $row['descricao'] . '</td>
                      <td>' . $row['data'] . '</td>
                      <td>' . $row['propriedade'] . '</td>
                      <td>' . $row['sexo'] . '</td>
                      <td>
                        <a href="#" id="' . $row['id'] . '" class="btn btn-success btn-sm rounded-pill py-0 editLink" data-toggle="modal" data-target="#editUserModal">Edit</a>

                        <a href="#" id="' . $row['id'] . '" class="btn btn-danger btn-sm rounded-pill py-0 deleteLink">Delete</a>
                      </td>
                    </tr>';
      }
      echo $output;
    } else {
      echo '<tr>
              <td colspan="6">No Data Found in the Database!</td>
            </tr>';
    }
  }

  // Handle Edit User Ajax Request
  if (isset($_GET['edit'])) {
    $id = $_GET['id'];

    $user = $db->readOne($id);
    echo json_encode($user);
  }

  // Handle Update User Ajax Request
  if (isset($_POST['update'])) {
    $id = $util->testInput($_POST['id']);
    $numero = $util->testInput($_POST['numero']);
    $descricao = $util->testInput($_POST['descricao']);
    $data = $util->testInput($_POST['data']);
    $propriedade = $util->testInput($_POST['propriedade']);
    $sexo = $util->testInput($_POST['sexo']);

    if ($db->update($id, $numero, $descricao, $data, $propriedade, $sexo)) {
      echo $util->showMessage('success', 'Updated successfully!');
    } else {
      echo $util->showMessage('danger', 'No Updated!');
    }
  }

  // Handle Delete User Ajax Request
  if (isset($_GET['delete'])) {
    $id = $_GET['id'];
    if ($db->delete($id)) {
      echo $util->showMessage('info', 'Deleted successfully!');
    } else {
      echo $util->showMessage('danger', 'No Deleted!');
    }
  }

?>