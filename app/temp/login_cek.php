<!-- Handle Login -->
<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("location: login.php");
}
?>

<!-- Handle Fitur Login -->
<?php
session_start();
if (isset($_POST['login'])) {
  require '../app/init.php';
  $conn = connect_DB();

  $user = htmlspecialchars($_POST['username']);
  $pass = htmlspecialchars($_POST['password']);

  $res = query_select('user', "username='$user' && password='$pass'");

  echo "<script>";
  if ($res) {
    $_SESSION['admin'] = $res[0];

    echo "
    alert('Behasil Login');
    ";
  } else {
    echo "
    alert('Username atau Password Salah');
    ";
  }
  echo "</script>";
}
