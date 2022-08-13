<?php
session_start();
if (!isset($_SESSION['id_responden'])) {
  header("location: index.php");
}
?>

<?php require 'comp/header.php'; ?>
<div class="row mulai selesai">
  <div class="col-left">
    <div class="logo">
      <img src="img/logo.png" alt="" />
      <p>Indeks Kepuasan Masyarakat (IKM)</p>
    </div>
  </div>
  <div class="col-center">
    <div class="card">
      <form action="" method="POST">
        <h4>Terima Kasih</h4>
        <hr />
        <p>
          Terima kasih telah mengisi Survei Indeks Kepuasan Masyarakat
          Terhadap Pelayanan Publik pada Desa Karang Tengah.
          <br />
          <br />
          Segala masukan dan kritikan anda akan kami jadikan bahan evaluasi
          agar menghasilkan kualitas pelayanan yang semakin baik kedepannya.
          <br />
          <br />
          Hormat Kami,
          <br />
          Desa Karang Tengah.
        </p>
      </form>
    </div>
  </div>
  <div class="col-right">
    <a href="index.php">Keluar</a>
  </div>
</div>

<?php require 'comp/footer.php'; ?>

<?php
session_destroy();
session_unset();
?>