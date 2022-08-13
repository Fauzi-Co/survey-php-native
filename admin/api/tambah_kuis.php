<?php

if (isset($_POST['kuis'])) {
  require '../../app/init.php';
  $conn = connect_DB();

  $data = [
    'id_kuis' => '',
    'kuis' => "$_POST[kuis]",
    'p1' => "$_POST[pilihan_1]",
    'p2' => "$_POST[pilihan_2]",
    'p3' => "$_POST[pilihan_3]",
    'p4' => "$_POST[pilihan_4]",
  ];

  query_insert('kuisioners', $data);
  if (mysqli_affected_rows($conn) > 0) {
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
