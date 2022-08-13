<?php require 'comp/header.php'; ?>

<?php
session_start();
if (!isset($_SESSION['id_responden'])) {
  header("location: index.php");
}

require 'app/init.php';
$conn = connect_DB();

if (isset($_POST['submit'])) {
  $id_responden  = $_SESSION['id_responden'];

  $start = true;
  $error = false;

  $i = 1;
  while ($start) {
    if (isset($_POST['id_kuis_' . $i])) {
      $id_kuis = $_POST['id_kuis_' . $i];

      if (isset($_POST['p' . $i])) {
        $jawaban = $_POST['p' . $i];
      }


      if (!isset($_POST['p' . $i])) {
        echo "<script>";
        echo "alert('Isi kuis dengan benar ya!')";
        echo "</script>";
        $error = true;
        break;
      }
    } else {
      $start = false;
    }

    $i++;
    if ($i > 100) {
      $start = false;
    }
  }


  if (!$error) {

    $start = true;
    $i = 1;
    while ($start) {
      if (isset($_POST['id_kuis_' . $i])) {
        $id_kuis = $_POST['id_kuis_' . $i];

        if (isset($_POST['p' . $i])) {
          $jawaban = $_POST['p' . $i];
        }


        if (!isset($_POST['p' . $i])) {
          echo "<script>";
          echo "alert('Isi kuis dengan benar ya!')";
          echo "</script>";
          $error = true;
          break;
        }

        $data = [
          'id_jawaban' => '',
          'id_responden' => $id_responden,
          'id_kuis' => $id_kuis,
          'jawaban' => $jawaban,
        ];

        query_insert('jawaban_kuis', $data);
      } else {
        $start = false;
      }

      $i++;
      if ($i > 100) {
        $start = false;
      }
    }

    header("location: selesai.php");
  }
}
?>

<?php

$result = query_select('kuisioners');

?>
<div class="row mulai kuis">
  <div class="col-left">
    <div class="logo">
      <img src="img/logo.png" alt="" />
      <p>Indeks Kepuasan Masyarakat (IKM)</p>
    </div>
  </div>
  <div class="col-center">
    <div class="card">
      <form action="" method="POST">
        <h4>Kuesioner</h4>
        <hr />

        <form action="">
          <?php $i = 1 ?>
          <?php foreach ($result as $kuis) : ?>
            <div class="row">
              <div class="no">
                <div class="circle"><?= $i ?></div>
              </div>
              <div class="soal">
                <p>
                  <?= $kuis['kuis'] ?>
                  <input type="hidden" name="id_kuis_<?= $i ?>" value="<?= $kuis['id_kuis'] ?>">
                </p>
                <div class="col">
                  <div class="box">
                    <div class="radio-group">
                      <label for="s_mudah_<?= $i ?>" class="dot"></label>
                      <input type="radio" id="s_mudah_<?= $i ?>" onclick="handleRadio(this)" name="p<?= $i ?>" value="4" />
                      <label for="s_mudah_<?= $i ?>"><?= $kuis['pilihan_4'] ?></label>
                    </div>
                    <div class="radio-group">
                      <label for="mudah_<?= $i ?>" class="dot"></label>

                      <input type="radio" id="mudah_<?= $i ?>" onclick="handleRadio(this)" name="p<?= $i ?>" value="3" />
                      <label for="mudah_<?= $i ?>"><?= $kuis['pilihan_3'] ?></label>
                    </div>
                    <div class="radio-group">
                      <label for="k_<?= $i ?>" class="dot"></label>

                      <input type="radio" id="k_<?= $i ?>" onclick="handleRadio(this)" name="p<?= $i ?>" value="2" />
                      <label for="k_<?= $i ?>"><?= $kuis['pilihan_2'] ?></label>
                    </div>
                    <div class="radio-group">
                      <label for="s_<?= $i ?>" class="dot"></label>

                      <input type="radio" id="s_<?= $i ?>" onclick="handleRadio(this)" name="p<?= $i ?>" value="1" />
                      <label for="s_<?= $i ?>"><?= $kuis['pilihan_1'] ?></label>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php $i++ ?>
          <?php endforeach; ?>

          <div class="col submit">
            <button type="submit" name="submit">Selesai</button>
          </div>
        </form>
      </form>
    </div>
  </div>
  <div class="col-right">
    <a href="index.php">Keluar</a>
  </div>
</div>

<script>
  const handleRadio = e => {
    let box = e.parentElement.parentElement;

    if (box.querySelector('.active')) {
      box.querySelector('.active').classList.remove('active');
    }

    e.previousElementSibling.classList.add('active');

  }
</script>
<!-- <script src="js/radio.js"></script> -->
<?php require 'comp/footer.php'; ?>