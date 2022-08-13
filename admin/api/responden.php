<?php
require '../../app/init.php';
$conn = connect_DB();

if (isset($_GET['id'])) : ?>
  <?php $result = query_select('respondens', "id_respondens=$_GET[id]"); ?>
  <?php if ($result) echo json_encode($result); ?>
<?php else : ?>
  <?php
  $result = query_select('respondens');
  $i = 1;
  ?>
  <?php foreach ($result as $responden) : ?>
    <tr>
      <td><?= $i ?></td>
      <?php $i++ ?>
      <td><?= $responden['nama'] ?></td>
      <td><?= $responden['usia'] ?></td>
      <td><?= $responden['jenis_kelamin'] ?></td>
      <td><?= $responden['pekerjaan'] ?></td>
      <td><?= $responden['pendidikan_terakhir'] ?></td>
      <td>
        <button class="delete rounded" onclick="viewModalHapus(<?= $responden['id_responden'] ?>)"><i class="fa-solid fa-trash-can"></i></button>
      </td>
    </tr>
  <?php endforeach; ?>
<?php endif; ?>