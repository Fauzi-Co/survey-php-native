<?php
require 'comp/header.php';

if (isset($_POST['simpan'])) {
  require 'app/init.php';
  $conn = connect_DB();

  $data = [
    'id' => '',
    'nama' => htmlspecialchars($_POST['nama']),
    'usia' => htmlspecialchars($_POST['usia']),
    'jenis_kelamin' => htmlspecialchars($_POST['jenis_kelamin']),
    'pendidikan_terakhir' => htmlspecialchars($_POST['pendidikan_terakhir']),
    'pekerjaan' => htmlspecialchars($_POST['pekerjaan']),
  ];

  if (isset($_POST['layanan'])) {
    $data['jenis_pelayanan'] = htmlspecialchars($_POST['layanan']);
  }


  if ($data['nama'] == "" || $data['usia'] == "" || $data['jenis_kelamin'] == "" || $data['pendidikan_terakhir'] == "" || $data['pekerjaan'] == "") {
    echo '<script>';
    echo "alert('Isi Biodata dengan Benar')";
    echo '</script>';
  } elseif (!isset($_POST['layanan'])) {
    echo '<script>';
    echo "alert('Isi Biodata dengan Benar')";
    echo '</script>';
  } else {

    if (query_insert('respondens', $data)) {
      session_start();
      $_SESSION['id_responden'] = mysqli_insert_id($conn);
      echo "
      <script>
        alert('Data Anda Berhasil Disimpan')
        location.href = 'kuis.php'
      </script>
      ";
    }
  }
}
?>

<div class="row mulai">
  <div class="col-left">
    <div class="logo">
      <img src="img/logo.png" alt="" />
      <p>Indeks Kepuasan Masyarakat (IKM)</p>
    </div>
  </div>
  <div class="col-center">
    <div class="card">
      <form action="" method="POST">
        <h4>Data Responden</h4>
        <hr />
        <div class="row">
          <div class="col-1">
            <label for="nama">Nama</label>
          </div>
          <div class="col-2">
            <input type="text" id="nama" name="nama" />
          </div>
          <div class="col-1">
            <label for="usia">Usia</label>
          </div>
          <div class="col-2">
            <input type="number" id="usia" name="usia" />
          </div>
          <div class="col-1">
            <label for="jenis_kelamin">Jenis Kelamin</label>
          </div>
          <div class="col-2">
            <select name="jenis_kelamin" id="jenis_kelamin">
              <option value=""></option>
              <option value="Laki - Laki">Laki - Laki</option>
              <option value="Perempuan">Perempuan</option>
            </select>
          </div>
          <div class="col-1">
            <label for="pendidikan_terakhir">Pendidikan Terakhir </label>
          </div>
          <div class="col-2">
            <select name="pendidikan_terakhir" id="pendidikan_terakhir">
              <option value=""></option>
              <option value="SMP">SMP</option>
              <option value="SMA">SMA</option>
              <option value="D3">D3</option>
              <option value="S1">S1</option>
              <option value="S2">S2`</option>
              <option value="S3">S3</option>
            </select>
          </div>
          <div class="col-1">
            <label for="pekerjaan">Pekerjaan</label>
          </div>
          <div class="col-2">
            <input type="text" name="pekerjaan" id="pekerjaan" />
          </div>
          <p>Jenis Pelayanan (sesuaikan pelayanan yang telah diurus)</p>
          <div class="col">
            <div class="box">
              <div class="radio-group">
                <label for="ktp" class="dot"></label>
                <input type="radio" id="ktp" name="layanan" value="Pengantar KTP" />
                <label for="ktp">Pengantar KTP</label>
              </div>
              <div class="radio-group">
                <label for="Pengantar_KK" class="dot"></label>

                <input type="radio" id="Pengantar_KK" name="layanan" value="Pengantar KK" />
                <label for="Pengantar_KK">Pengantar KK</label>
              </div>
              <div class="radio-group">
                <label for="Pengantar_SKCK" class="dot"></label>

                <input type="radio" id="Pengantar_SKCK" name="layanan" value="Pengantar SKCK" />
                <label for="Pengantar_SKCK">Pengantar SKCK</label>
              </div>
            </div>
            <div class="box">
              <div class="radio-group">
                <label for="Surat_Pindah" class="dot"></label>
                <input type="radio" id="Surat_Pindah" name="layanan" value="Surat Pindah" />
                <label for="Surat_Pindah">Surat Pindah</label>
              </div>
              <div class="radio-group">
                <label for="Surat_Keterangan_Tidak_mampu" class="dot"></label>

                <input type="radio" id="Surat_Keterangan_Tidak_mampu" name="layanan" value="Surat Keterangan Tidak mampu" />
                <label for="Surat_Keterangan_Tidak_mampu">Surat Keterangan Tidak Mampu</label>
              </div>
              <div class="radio-group">
                <label for="Surat_Keterangan_Tidak_Usaha" class="dot"></label>

                <input type="radio" id="Surat_Keterangan_Tidak_Usaha" name="layanan" value="Surat Keterangan Usaha" />
                <label for="Surat_Keterangan_Tidak_Usaha">Surat Keterangan Usaha</label>
              </div>
              <div class="radio-group">
                <label for="Lainnya" class="dot"></label>

                <input type="radio" id="Lainnya" name="layanan" value="Lainnya" />
                <label for="Lainnya">Lainnya</label>
              </div>
            </div>
          </div>
          <div class="col submit">
            <button type="submit" name="simpan">Selanjutnya</button>
          </div>
        </div>
      </form>
    </div>
  </div>
  <div class="col-right">
    <a href="index.php">Keluar</a>
  </div>
</div>

<script src="js/radio.js"></script>

<?php
require 'comp/footer.php';
?>