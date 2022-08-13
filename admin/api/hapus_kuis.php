<?php

if (isset($_GET['id'])) {
  require '../../app/init.php';
  $conn = connect_DB();

  $sql = "DELETE FROM kuisioners WHERE id_kuis='$_GET[id]'";
  $sql_del_kuis = "DELETE FROM jawaban_kuis WHERE id_kuis='$_GET[id]'";

  if (mysqli_query($conn, $sql)) {
    mysqli_query($conn, $sql_del_kuis);
    $data = [
      'success' => true
    ];
    echo json_encode($data);
  } else {
    $data = [
      'success' => false
    ];
    echo json_encode($data);
  }
}
