<?php

  require_once 'db_sanitario.php';
  require_once 'util.php';

  $db = new Database;
  $util = new Util;

  // Handle Add New Sanitário Ajax Request
  if (isset($_POST['add'])) {
    $produto = $util->testInput($_POST['produto']);
    $total = $util->testInput($_POST['total']);
    $data_aplicacao = $util->testInput($_POST['data_aplicacao']);
 
    if ($db->insert($produto, $total, $data_aplicacao)) {
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
                      <td>' . $row['ids'] . '</td>
                      <td>' . $row['produto'] . '</td>
                      <td>' . $row['total'] . '</td>
                      <td>' . $row['data_aplicacao'] . '</td>
                      <td>
                        <a href="#" ids="' . $row['ids'] . '" class="btn btn-success btn-sm rounded-pill py-0 editLink" data-toggle="modal" data-target="#editUserModal">Edit</a>
                        <a href="#" ids="' . $row['ids'] . '" class="btn btn-danger btn-sm rounded-pill py-0 deleteLink">Delete</a>
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

  // Handle Edit Sanitário Ajax Request
  if (isset($_GET['edit'])) {
    $ids = $_GET['ids'];
    $user = $db->readOne($ids);
    echo json_encode($user);
  }

  // Handle Update Sanitário Ajax Request
  if (isset($_POST['update'])) {
    $ids = $util->testInput($_POST['ids']);
    $produto = $util->testInput($_POST['produto']);
    $total = $util->testInput($_POST['total']);
    $data_aplicacao = $util->testInput($_POST['data_aplicacao']);
 
    if ($db->update($ids, $produto, $total, $data_aplicacao)) {
      echo $util->showMessage('success', 'Updated successfully!');
    } else {
      echo $util->showMessage('danger', 'No Updated!');
    }
  }

  // Handle Delete Sanitário Ajax Request
  if (isset($_GET['delete'])) {
    $ids = $_GET['ids'];
    if ($db->delete($ids)) {
      echo $util->showMessage('info', 'Deleted successfully!');
    } else {
      echo $util->showMessage('danger', 'No Deleted!');
    }
  }

?>