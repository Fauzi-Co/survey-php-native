<?php

if (isset($_POST['kuis'])) {
  require '../../app/init.php';
  $conn = connect_DB();

  $data = [
    'id_kuis' => "$_POST[id_kuis]",
    'kuis' => "$_POST[kuis]",
    'p1' => '',
    'p2' => '',
    'p3' => '',
    'p4' => '',
  ];


  $sql = "UPDATE kuisioners SET kuis='$data[kuis]', pilihan_1='$_POST[pilihan_1]', pilihan_2='$_POST[pilihan_2]', pilihan_3='$_POST[pilihan_3]', pilihan_4='$_POST[pilihan_4]' WHERE id_kuis='$data[id_kuis]'";
  mysqli_query($conn, $sql);
}
