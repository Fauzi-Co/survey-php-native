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
    <h3>Data IKM</h3>

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

    <div class="card" style="overflow-x: auto;">
      <table id="data" class="jawaban-res" border="1">
      </table>

      <?php
      require '../app/init.php';
      $conn = connect_DB();
      $respondens = query_select('respondens');
      $jawaban = query_select('jawaban_kuis');
      ?>

      <?php if ($respondens && $jawaban) : ?>
        <br>
        <br>
        <button onclick="showRekap()">Lihat Skor IKM</button>
      <?php else : ?>
        <p style="text-align: center; color: red;">Belum Ada responden yang menjawab kuis!!</p>
      <?php endif; ?>
    </div>

    <?php if ($respondens && $jawaban) : ?>
      <div class="card ikm data-ikm">
        <h5>Rekapitulasi Skor IKM</h5>
        <table id="data-2" border="1" class="data-rekap">
        </table>

        <br>
        <br>
        <button onclick="showKesimpulan()">Lihat Kesimpulan</button>
      </div>

      <div class="card ikm kesimpulan">
        <h5>Kesimpulan</h5>
        <table border="1">
          <tbody>
            <tr>
              <td class="left">Skor IKM</td>
              <td class="ikm"></td>
            </tr>
            <tr>
              <td class="left">Mutu Pelayanan</td>
              <td class="mutu"></td>
            </tr>
            <tr>
              <td class="left">Kinerja Unit Pelayanan</td>
              <td class="unit right"></td>
            </tr>
          </tbody>
        </table>
        <button onclick="printPDF()">Export PDF</button>
      </div>
    <?php endif; ?>

  </main>
</div>
</body>

<script>
  document.title = "Data IKM";

  document.addEventListener(
    "DOMContentLoaded",
    () => {
      // Load Data
      loadJawabanRes();
    },
    false
  );

  const loadJawabanRes = () => {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
      document.querySelector(
        ".jawaban-res"
      ).innerHTML = this.response;

    };
    xhttp.open("GET", "api/jawaban-res.php", true);
    xhttp.send();
  };

  const showRekap = () => {
    document.querySelector('.data-ikm').classList.add('show');
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
      document.querySelector(
        ".data-rekap"
      ).innerHTML = this.response;

    };
    xhttp.open("GET", "api/data-rekap.php", true);
    xhttp.send();
  }

  const showKesimpulan = () => {
    document.querySelector('.kesimpulan').classList.add('show');

    let mutu = '';
    let unit = '';
    let skorIKM = document.querySelector('.skor-ikm').innerHTML;

    if (skorIKM >= 88.31 && skorIKM <= 100) {
      mutu = "A";
      unit = "Sangat Baik";
    } else if (skorIKM >= 76.61 && skorIKM <= 88.30) {
      mutu = "B";
      unit = "Baik";
    } else if (skorIKM >= 65 && skorIKM <= 76.60) {
      mutu = "C";
      unit = "Kurang Baik";
    } else if (skorIKM >= 25 && skorIKM <= 64.99) {
      mutu = "D";
      unit = "Tidak Baik";
    }

    document.querySelector('td.ikm').innerHTML = skorIKM;
    document.querySelector('td.mutu').innerHTML = mutu;
    document.querySelector('td.unit').innerHTML = unit;
  }

  const printPDF = () => {
    const btn = document.querySelectorAll('button');
    document.querySelector('.aside').setAttribute('style', 'display: none');
    document.querySelector('.search').setAttribute('style', 'display: none');
    document.querySelector('main').setAttribute('style', 'width: 100%');

    btn.forEach(e => {
      e.setAttribute('style', 'display: none')
    })

    print();

    document.querySelector('.aside').setAttribute('style', '');
    document.querySelector('.search').setAttribute('style', '');
    document.querySelector('main').setAttribute('style', '');

    btn.forEach(e => {
      e.setAttribute('style', '')
    })
  }
</script>

</html>