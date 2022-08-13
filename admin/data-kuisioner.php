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
    <h3>Data Kuisioner</h3>

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
      <button class="add">Tambah Kuis</button>
      <table id="data" border="1">
        <thead>
          <tr>
            <th>No</th>
            <th>Pertanyaan</th>
            <th>Pilihan</th>
            <th>Tindakan</th>
          </tr>
        </thead>
        <tbody></tbody>
      </table>
    </div>
  </main>
</div>
</body>

<div class="modal add" id="add">
  <div class="card">
    <div class="box">
      <style>
        .radio-group {
          display: flex;
          gap: .5rem;
          margin-bottom: 4px;
        }

        input.add {
          display: block !important;
          width: 100% !important;
          border: none;
          background: rgba(0, 0, 0, 0);
        }

        input.add:focus {
          outline: none !important;
        }
      </style>
      <p>Tambah Kuis</p>
      <table>
        <tr>
          <td>Pertanyaan</td>
          <td>Pilihan</td>
        </tr>
        <tr>
          <td class="left">
            <textarea name="" id="kuis" placeholder="Ketik Pertanyaan ..."></textarea>
          </td>
          <td class="left">
            <div class="radio-group">
              <label for="s_mudah_1" class="dot"></label>
              <input type="radio" id="s_mudah_1" name="soal_1" value="Sangat_mudah" />
              <input type="text" class="add" id="pilihan_1" placeholder="Masukkan Pilihan 1">
            </div>
            <div class="radio-group">
              <label for="mudah_1" class="dot"></label>
              <input type="radio" id="mudah_1" name="soal_1" value="Mudah" />
              <input type="text" class="add" id="pilihan_2" placeholder="Masukkan Pilihan 2">
            </div>
            <div class="radio-group">
              <label for="k_1" class="dot"></label>

              <input type="radio" id="k_1" name="soal_1" value="Kurang Mudah" />
              <input type="text" class="add" id="pilihan_3" placeholder="Masukkan Pilihan 3">

            </div>
            <div class="radio-group">
              <label for="s_1" class="dot"></label>

              <input type="radio" id="s_1" name="soal_1" value="Sulit" />
              <input type="text" class="add" id="pilihan_4" placeholder="Masukkan Pilihan 4">
            </div>
          </td>
        </tr>
      </table>
      <button type="submit" class="simpan" onclick="handleTambah(this)">
        Tambah
      </button>
      <button class="batal">Batal</button>
    </div>
  </div>
</div>

<div class="modal edit" id="edit">
  <div class="card">
    <div class="box">
      <p>Edit Data</p>
      <table>
        <tr>
          <td>Pertanyaan</td>
          <td>Pilihan</td>
        </tr>
        <tr>
          <td class="left">
            <textarea name="" id="kuis"></textarea>
          </td>
          <td class="left">
            <div class="radio-group">
              <label for="s_mudah_1" class="dot"></label>
              <input type="radio" id="s_mudah_1" name="soal_1" value="Sangat_mudah" />
              <input type="text" class="add" id="edit-pilihan_1" placeholder="Pilihan 1">
            </div>
            <div class="radio-group">
              <label for="mudah_1" class="dot"></label>
              <input type="radio" id="mudah_1" name="soal_1" value="Mudah" />
              <input type="text" class="add" id="edit-pilihan_2" placeholder="Pilihan 2">

            </div>
            <div class="radio-group">
              <label for="k_1" class="dot"></label>

              <input type="radio" id="k_1" name="soal_1" value="Kurang Mudah" />
              <input type="text" class="add" id="edit-pilihan_3" placeholder="Pilihan 3">

            </div>
            <div class="radio-group">
              <label for="s_1" class="dot"></label>

              <input type="radio" id="s_1" name="soal_1" value="Sulit" />
              <input type="text" class="add" id="edit-pilihan_4" placeholder="Pilihan 4">

            </div>
          </td>
        </tr>
      </table>
      <button class="simpan btn-edit" onclick="handleUbah(this)">
        Simpan
      </button>
      <button class="batal">Batal</button>
    </div>
  </div>
</div>

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
  let link = `api/hapus_kuis.php?id=`;

  document.addEventListener(
    "DOMContentLoaded",
    () => {
      // Load Data
      loadKuis();
    },
    false
  );

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
    xhttp.open("GET", "api/kuis.php", true);
    xhttp.send();
  };

  const getKuis = (id, modal) => {
    let link = `api/kuis.php?id=${id}`;
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
      let kuis = JSON.parse(this.response);
      modal.querySelector("textarea").value = kuis[0]["kuis"];
      document.querySelector("#edit-pilihan_1").value = kuis[0]["pilihan_4"];
      document.querySelector("#edit-pilihan_2").value = kuis[0]["pilihan_3"];
      document.querySelector("#edit-pilihan_3").value = kuis[0]["pilihan_2"];
      document.querySelector("#edit-pilihan_4").value = kuis[0]["pilihan_1"];
    };
    xhttp.open("GET", link, true);
    xhttp.send();
  };

  const buttonAdd = document.querySelector("button.add");
  buttonAdd.addEventListener("click", (btn) => {
    document.querySelector(".modal.add").classList.add("show");
  });

  const viewModalEdit = (id) => {
    let modal = document.querySelector(".modal.edit");
    getKuis(id, modal);

    modal.querySelector(".btn-edit").setAttribute("id", id);
    modal.classList.add("show");
  };

  const viewModalHapus = (id) => {
    document.querySelector(".modal.delete .btn-hapus").setAttribute("id", id);
    document.querySelector(".modal.delete").classList.add("show");
  };
</script>
<script src="../js/modal.js"></script>

</html>