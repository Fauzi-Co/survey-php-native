<?php
require '../../app/init.php';
$conn = connect_DB();

$result = query_select('respondens');
$j = 1;

$kuis = query_select('kuisioners');
$jumlah_kuis = count($kuis);
?>

<thead>
  <tr>
    <th>No</th>
    <th>Nama Responden</th>
    <th>Usia</th>
    <th>Jenis Kelamin</th>
    <th>Pekerjaan</th>
    <th>Pendidikan Terakhir</th>
    <th>Jenis Pelayanan</th>
    <?php for ($i = 0; $i < $jumlah_kuis; $i++) : ?>
      <th>P<?= 1 + $i ?></th>
    <?php endfor; ?>
  </tr>
</thead>
<tbody>
  <?php foreach ($result as $responden) : ?>
    <?php $id_responden = $responden['id_responden'] ?>
    <?php $jawaban = query_select('jawaban_kuis', "id_responden='$id_responden'"); ?>
    <tr>
      <td><?= $j ?></td>
      <?php $j++ ?>
      <td><?= $responden['nama'] ?></td>
      <td><?= $responden['usia'] ?></td>
      <td><?= $responden['jenis_kelamin'] ?></td>
      <td><?= $responden['pekerjaan'] ?></td>
      <td><?= $responden['pendidikan_terakhir'] ?></td>
      <td><?= $responden['jenis_pelayanan'] ?></td>
      <?php foreach ($jawaban as $item) : ?>
        <td><?= $item['jawaban'] ?></td>
      <?php endforeach; ?>
    </tr>
  <?php endforeach; ?>
</tbody>