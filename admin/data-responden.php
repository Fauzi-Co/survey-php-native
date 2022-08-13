<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("location: login.php");
}
?>
<?php require 'header.php'; ?>


<div class="dashboard">
  <?php require 'aside.php'; ?>

  <main>
    <h3>Data Responden</h3>

    <div class="search">
      <form action="" method="POST">
        <select name="semester" id="">
          <option value="">--Semester--</option>
          <option value="Genap">Genap</option>
          <option value="Ganjil">Ganjil</option>
        </select>
        <select name="tahun" id="">
          <option value="">--Tahun--</option>
          <option value="">2022</option>
        </select>
        <div class="col">
          <button type="submit">Cari</button>
        </div>
      </form>
    </div>

    <div class="card ikm kuis">
      <button class="hapus" style="background: red; margin-bottom: 1rem;" onclick="viewModalHapus('all')">Hapus Semua</button>
      <table id="data" border="1">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Responded</th>
            <th>Usia</th>
            <th>Jenis Kelamin</th>
            <th>Pekerjaan</th>
            <th>Pendidikan Terakhir</th>
            <th>Tindakan</th>
          </tr>
        </thead>
        <tbody></tbody>
      </table>
    </div>
  </main>
</div>
</body>

<div class="modal delete" id="delete">
  <div class="card">
    <div class="box">
      <p>Hapus Data</p>
      <table>
        <tr>
          <td class="left">Apakah Anda Yakin Ingin Menghapus Data ini?</td>
          <td class="right">
            <button class="simpan btn-hapus" onclick="handleHapus(this)">
              Hapus
            </button>
            <button class="batal">Batal</button>
          </td>
        </tr>
      </table>
    </div>
  </div>
</div>

<script>
  document.addEventListener(
    "DOMContentLoaded",
    () => {
      // Load Data
      loadKuis();
    },
    false
  );

  let link = `api/delete_responden.php?id=`;

  const loadKuis = () => {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
      document.querySelector(
        ".card.kuis table tbody"
      ).innerHTML = this.response;

      $(document).ready(function() {
        $('#data').DataTable();
      });
    };
    xhttp.open("GET", "api/responden.php", true);
    xhttp.send();
  };

  const viewModalHapus = (id) => {
    document.querySelector(".modal.delete .btn-hapus").setAttribute("id", id);
    document.querySelector(".modal.delete").classList.add("show");
  };
</script>
<script src="../js/modal.js"></script>

</html>