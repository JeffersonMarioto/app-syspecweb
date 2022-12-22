<?php

  require_once 'db_pesagem.php';
  require_once 'util.php';

  $db = new Database;
  $util = new Util;

  // Handle Add New User Ajax Request
  if (isset($_POST['add'])) {
    $numero = $util->testInput($_POST['numero']);
    $data_atual = $util->testInput($_POST['data_atual']);
    $peso_atual = $util->testInput($_POST['peso_atual']);
    $era = $util->testInput($_POST['era']);

    if ($db->insert($numero, $data_atual, $peso_atual, $era)) {
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
                      <td>' . $row['idp'] . '</td>
                      <td>' . $row['numero'] . '</td>
                      <td>' . $row['data_atual'] . '</td>
                      <td>' . $row['peso_atual'] . '</td>
                      <td>' . $row['peso_anterior'] . '</td>
                      <td>' . $row['data_anterior'] . '</td>
                      <td>' . $row['resultado'] . '</td>
                      <td>' . $row['media'] . '</td>
                      <td>' . $row['idade'] . '</td>
                      <td>' . $row['era'] . '</td>
                      <td>
                        <a href="#" idp="' . $row['idp'] . '" class="btn btn-danger btn-sm rounded-pill py-0 deleteLink">Delete</a>
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
    $idp = $_GET['idp'];

    $user = $db->readOne($idp);
    echo json_encode($user);
  }
  // Handle Update Pesagem Ajax Request
  if (isset($_POST['update'])) {
    $idp = $util->testInput($_POST['idp']);
    $numero = $util->testInput($_POST['numero']);
    $data_atual = $util->testInput($_POST['data_atual']);
    $peso_atual = $util->testInput($_POST['peso_atual']);
    $peso_anterior = $util->testInput($_POST['peso_anterior']);
    $data_anterior = $util->testInput($_POST['data_anterior']);
    $resultado = $util->testInput($_POST['resultado']);
    $media = $util->testInput($_POST['media']);
    $idade = $util->testInput($_POST['idade']);
    $era = $util->testInput($_POST['era']);    

    if ($db->update($idp, $numero, $data_atual, $peso_atual, $peso_anterior, $data_anterior, $resultado, $media, $idade, $era)) {
      echo $util->showMessage('success', 'Updated successfully!');
    } else {
      echo $util->showMessage('danger', 'No Updated!');
    }
  }

  // Handle Delete User Ajax Request
  if (isset($_GET['delete'])) {
    $idp = $_GET['idp'];
    if ($db->delete($idp)) {
      echo $util->showMessage('info', 'Deleted successfully!');
    } else {
      echo $util->showMessage('danger', 'No Deleted!');
    }
  }

?>