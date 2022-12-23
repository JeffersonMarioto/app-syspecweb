<?php

  require_once 'db_inseminacao.php';
  require_once 'util.php';

  $db = new Database;
  $util = new Util;

  // Handle Add New Ins Ajax Request
  if (isset($_POST['add'])) {
    $vaca = $util->testInput($_POST['vaca']);
    $touro = $util->testInput($_POST['touro']);
    $data_inseminacao = $util->testInput($_POST['data_inseminacao']);
    $estacao = $util->testInput($_POST['estacao']);
    $diagnostico = $util->testInput($_POST['diagnostico']);

    if ($db->insert($vaca, $touro, $data_inseminacao, $estacao, $diagnostico)) {
      echo $util->showMessage('success', 'Sucess!');
    } else {
      echo $util->showMessage('danger', 'No Sucess!');
    }
  }

  // Handle Fetch All Ins.s Ajax Request
  if (isset($_GET['read'])) {
    $users = $db->read();
    $output = '';
    if ($users) {
      foreach ($users as $row) {
        $output .= '<tr>
                      <td>' . $row['idi'] . '</td>
                      <td>' . $row['vaca'] . '</td>
                      <td>' . $row['touro'] . '</td>
                      <td>' . $row['data_inseminacao'] . '</td>
                      <td>' . $row['estacao'] . '</td>
                      <td>' . $row['diagnostico'] . '</td>
                      <td>' . $row['parto'] . '</td>
                      <td>
                        <a href="#" idi="' . $row['idi'] . '" class="btn btn-success btn-sm rounded-pill py-0 editLink" data-toggle="modal" data-target="#editUserModal">Edit</a>
                        <a href="#" idi="' . $row['idi'] . '" class="btn btn-danger btn-sm rounded-pill py-0 deleteLink">Delete</a>
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

  // Handle Edit Ins. Ajax Request
  if (isset($_GET['edit'])) {
    $idi = $_GET['idi'];

    $user = $db->readOne($idi);
    echo json_encode($user);
  }

  // Handle Update Ins. Ajax Request
  if (isset($_POST['update'])) {
    $idi = $util->testInput($_POST['idi']);
    $vaca = $util->testInput($_POST['vaca']);
    $touro = $util->testInput($_POST['touro']);
    $data_inseminacao = $util->testInput($_POST['data_inseminacao']);
    $estacao = $util->testInput($_POST['estacao']);
    $diagnostico = $util->testInput($_POST['diagnostico']);

    if ($db->update($idi, $vaca, $touro, $data_inseminacao, $estacao, $diagnostico)) {
      echo $util->showMessage('success', 'Updated successfully!');
    } else {
      echo $util->showMessage('danger', 'No Updated!');
    }
  }

  // Handle Delete User Ajax Request
  if (isset($_GET['delete'])) {
    $idi = $_GET['idi'];
    if ($db->delete($idi)) {
      echo $util->showMessage('info', 'Deleted successfully!');
    } else {
      echo $util->showMessage('danger', 'No Deleted!');
    }
  }

?>