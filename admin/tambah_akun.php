<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("location: login.php");
}

$res;

if (isset($_POST['add'])) {
  require '../app/init.php';
  $conn = connect_DB();
  $data = [
    'id_user' => '',
    'username' => htmlspecialchars($_POST['username']),
    'password' => htmlspecialchars($_POST['password']),
    'foto' => 'default.jpg',
    'rule' => htmlspecialchars($_POST['rule'])
  ];

  $res = query_insert('user', $data);
}

?>
<?php require 'header.php'; ?>

<div class="dashboard">
  <?php require 'aside.php'; ?>

  <main>
    <h3>Tambah Akun</h3>

    <div class="akun box">
      <br>
      <br>
      <br>
      <form action="" method="POST">
        <label for="username">Username</label>
        <div class="form-group">
          <input type="text" autocomplete="off" id="username" name="username"><button></button>
        </div>
        <label for="password">Password</label>
        <div class="form-group">
          <input type="password" autocomplete="off" name="password" id="password"><button></button>
        </div>
        <label for="rule">Posisi</label>
        <div class="form-group">
          <input type="text" id="rule" name="rule"><button></button>
        </div>

        <div class="link">
          <a href="profil.php">Kembali</a>


          <a href="#" style="background: linear-gradient(to right, #6ce2ff, #39d7ff);;"><button type="submit" name="add" style="border: none; background:none;">Tambah Akun</button></a>

        </div>
      </form>

    </div>
  </main>
</div>
</body>

<script>
  <?php
  if (isset($res)) {
    echo "
    alert('Berhasil Ditambah')
    location.href = 'profil.php'
    ";
  }
  ?>
</script>

</html>