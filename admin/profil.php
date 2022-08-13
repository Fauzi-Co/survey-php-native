<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("location: login.php");
}

$user_id = $_SESSION['admin']['id_user'];
require '../app/init.php';
$conn = connect_DB();


if (isset($_FILES['foto'])) {

  $file_upload = $_FILES['foto']['tmp_name'];
  $old_file_name = $_FILES['foto']['name'];
  $old_file_name = explode('.', $old_file_name);

  $ekstensi = $old_file_name[count($old_file_name) - 1];
  $new_file_name = time();
  $new_file_name .= '.' . $ekstensi;

  $user_cek = query_select('user', "id_user='$user_id'");

  if ($user_cek[0]['foto'] != "default.jpg") {
    if (file_exists("../img/" . $user_cek[0]['foto'])) {
      unlink("../img/" . $user_cek[0]['foto']);
    }
  }

  $sql = "UPDATE user SET foto='$new_file_name' WHERE id_user='$user_id'";
  mysqli_query($conn, $sql);
  $_SESSION['admin']['foto'] = $new_file_name;
  move_uploaded_file($file_upload, "../img/$new_file_name");
}


$user = query_select('user', "id_user='$user_id'");
?>
<?php require 'header.php'; ?>

<div class="dashboard">
  <?php require 'aside.php'; ?>

  <main>
    <h3>Akun</h3>

    <div class="akun box">
      <div class="foto">
        <div class="profil">
          <img src="../img/<?= $user[0]['foto'] ?>" alt="">
        </div>
        <label for="foto" onclick="updateProfil(this)"><i class="fa-solid fa-pen"></i></label>
      </div>

      <h5 class="nama"><?= $user[0]['username'] ?></h5>
      <p class="rule">Staff Pelayanan</p>

      <label for="username" class="label-foto" style="display: none;">Foto Profil Baru</label>
      <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-group input-foto" style="display: none;">
          <input type="file" style="display: block;" name="foto">
          <button style="border-radius:0" type="submit">Upload</button><button type="button" onclick="hiddenUpdate()">Batal</button>
        </div>
      </form>
      <label for="username">Username</label>
      <div class="form-group">
        <input type="text" value="<?= $user[0]['username'] ?>" autocomplete="off" id="username" onkeydown="handleUbahInput(this)"><button data-mode="ubah" onclick="simpan(this)">Ubah</button>
      </div>
      <label for="password">Password</label>
      <div class="form-group">
        <input type="password" value="<?= $user[0]['password'] ?>" autocomplete="off" onkeydown="handleUbahInput(this)" id="password"><button data-mode="ubah" onclick="simpan(this)">Ubah</button>
      </div>
      <label for="rule">Posisi</label>
      <div class="form-group">
        <input type="text" id="rule" value="<?= $user[0]['rule'] ?>" readonly><button></button>
      </div>

      <div class="link">
        <a href="logout.php">Keluar</a>
        <a href="tambah_akun.php" style="background: linear-gradient(to right, #6ce2ff, #39d7ff);;">Tambah Akun</a>
      </div>
    </div>
  </main>
</div>
</body>

<script>
  const updateProfil = (e) => {
    document.querySelector('.label-foto').setAttribute('style', '')
    document.querySelector('.input-foto').setAttribute('style', '')
  }

  const hiddenUpdate = () => {
    document.querySelector('.label-foto').setAttribute('style', 'display:none')
    document.querySelector('.input-foto').setAttribute('style', 'display:none')
  }

  const handleUbahInput = (e) => {
    e.nextElementSibling.innerHTML = "Simpan"
    e.nextElementSibling.dataset.mode = 'simpan'
  }

  const simpan = (e) => {
    if (e.dataset.mode == 'simpan') {
      const xhttp = new XMLHttpRequest();

      let data = e.previousElementSibling.value
      let link = ''

      if (e.previousElementSibling.id == "username") {
        document.querySelector('h5.nama').innerHTML = data;
        link = 'api/user.php';
      } else if (e.previousElementSibling.id == "password") {
        link = 'api/pass.php';
      }

      xhttp.open("POST", link);
      xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhttp.send(`data=${data}&id=<?= $user_id ?>`);

      e.innerHTML = "Ubah"
      e.dataset.mode = 'Ubah'
      alert("Berhasil diubah");
    }
  }
</script>

</html>