<?php
require '../../app/init.php';
$conn = connect_DB();

$kuis = query_select('kuisioners');
$jumlah_kuis = count($kuis);

$respon = query_select('respondens');
$jumlah_res = count($respon);


$rata_rata = [];
$rata_rata_tertimbang = 1;
$skor_ikm = 0;
?>
<thead>
  <tr>
    <th>Indeks</th>
    <?php for ($i = 0; $i < $jumlah_kuis; $i++) : ?>
      <th>P<?= 1 + $i ?></th>
    <?php endfor; ?>
  </tr>
</thead>
<tbody>
  <tr>
    <td class="left">Total Point</td>

    <?php foreach ($kuis as $item) : ?>
      <?php
      $id_kuis = $item['id_kuis'];
      $jawaban = query_select('jawaban_kuis', "id_kuis='$id_kuis'");
      $total_nilai = 0;
      ?>
      <?php foreach ($jawaban as $data) : ?>
        <?php $total_nilai += $data['jawaban']; ?>
      <?php endforeach; ?>
      <td><?= $total_nilai ?></td>
      <?php $rata_rata[] = ($total_nilai / $jumlah_res) ?>
    <?php endforeach; ?>
  </tr>
  <tr>
    <td class="left">Total Kuisioner</td>
    <?php foreach ($kuis as $item) : ?>
      <td><?= $jumlah_res ?></td>
    <?php endforeach; ?>
  </tr>
  <tr>
    <td class="left">Rata - Rata</td>
    <?php foreach ($rata_rata as $item) : ?>
      <td><?= round($item, 1) ?></td>
    <?php endforeach; ?>
  </tr>
  <tr>
    <td class="left">Rata - Rata x Bobot</td>
    <?php $rata_rata_tertimbang = [] ?>
    <?php foreach ($rata_rata as $i => $item) : ?>
      <td><?= round($item * 1 / $jumlah_kuis, 2) ?></td>
      <?php $rata_rata_tertimbang[] = round(($item * 1 / $jumlah_kuis), 2) ?>
    <?php endforeach; ?>
  </tr>
  <?php $total = 0; ?>
  <?php foreach ($rata_rata_tertimbang as $i => $item) : ?>
    <?php $total += $item ?>
  <?php endforeach; ?>


  <tr>
    <td class="left">Rata - Rata Nilai Tertimbang</td>
    <td colspan="<?= $jumlah_kuis ?>" class="left"><?= $total ?></td>
  </tr>
  <tr>
    <?php $skor_ikm = $total * 25 ?>
    <td class="left">Skor IKM</td>
    <td colspan="<?= $jumlah_kuis ?>" class="left skor-ikm"><?= $skor_ikm ?></td>
  </tr>
</tbody>