<?php require 'header.php'; ?>

<?php

if (isset($_POST['login'])) {
  session_start();

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
    echo "location.href = 'data-ikm.php'";
  } else {
    echo "
    alert('Username atau Password Salah');
    ";
  }
  echo "</script>";
}

?>

<div class="login admin">
  <h3>
    Sistem Informasi Indeks Kepuasan Masyarakat Terhadap Pelayanan Publik
    Pada Desa Karang Tengah Kabupaten Tanggerang
  </h3>

  <div class="logo">
    <img src="../img/logo.png" alt="" />
  </div>
  <h3>Login Admin</h3>

  <form action="" method="POST">
    <input type="text" name="username" placeholder="Username" />
    <input type="password" name="password" placeholder="Password" />
    <div class="col">
      <button type="submit" name="login">Masuk</button>
    </div>
  </form>
</div>
</body>

</html>