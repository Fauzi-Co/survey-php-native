<?php

if (isset($_GET['id'])) {
  require '../../app/init.php';
  $conn = connect_DB();

  if ($_GET['id'] == 'all') {
    $sql = "DELETE FROM respondens";
  } else {
    $sql = "DELETE FROM respondens WHERE id_responden='$_GET[id]'";
  }

  $sql_del_jawaban = "DELETE FROM jawaban_kuis";
  if (mysqli_query($conn, $sql)) {
    mysqli_query($conn, $sql_del_jawaban);
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
