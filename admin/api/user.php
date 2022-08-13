<?php

if (isset($_POST['data'])) {
  echo $_POST['data'];

  require '../../app/init.php';
  $conn = connect_DB();

  $user_id = $_POST['id'];
  $sql = "UPDATE user SET username='$_POST[data]' WHERE id_user='$user_id'";
  mysqli_query($conn, $sql);
}
