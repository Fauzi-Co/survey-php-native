<?php
require '../../app/init.php';
$conn = connect_DB();

if (isset($_GET['id'])) : ?>
  <?php $result = query_select('kuisioners', "id_kuis=$_GET[id]"); ?>
  <?php if ($result) echo json_encode($result); ?>
<?php else : ?>
  <?php
  $result = query_select('kuisioners');
  $i = 1;
  ?>
  <?php foreach ($result as $kuis) : ?>
    <tr>
      <td><?= $i ?></td>
      <td class="left">
        <?= $kuis['kuis'] ?>
      </td>
      <?php $i++ ?>
      <td class="left">
        <div class="radio-group">
          <label for="s_mudah_<?= $i ?>" class="dot"></label>
          <input type="radio" id="s_mudah_<?= $i ?>" name="kuis_<?= $i ?>" value="Sangat_mudah" />
          <label for="s_mudah_<?= $i ?>"><?= $kuis["pilihan_4"] ?></label>
        </div>
        <div class="radio-group">
          <label for="mudah_<?= $i ?>" class="dot"></label>
          <input type="radio" id="mudah_<?= $i ?>" name="kuis_<?= $i ?>" value="Mudah" />
          <label for="mudah_<?= $i ?>"><?= $kuis["pilihan_3"] ?></label>
        </div>
        <div class="radio-group">
          <label for="k_<?= $i ?>" class="dot"></label>
          <input type="radio" id="k_<?= $i ?>" name="kuis_<?= $i ?>" value="Kurang Mudah" />
          <label for="k_<?= $i ?>"><?= $kuis["pilihan_2"] ?></label>
        </div>
        <div class="radio-group">
          <label for="s_<?= $i ?>" class="dot"></label>

          <input type="radio" id="s_<?= $i ?>" name="kuis_<?= $i ?>" value="Sulit" />
          <label for="s_<?= $i ?>"><?= $kuis["pilihan_1"] ?></label>
        </div>
      </td>
      <td>
        <button class="edit rounded" data-target="edit" onclick="viewModalEdit(<?= $kuis['id_kuis'] ?>)"><i class="fa-solid fa-pen-to-square"></i></button>
        <button class="delete rounded" data-target="hapus" onclick="viewModalHapus(<?= $kuis['id_kuis'] ?>)">
          <i class="fa-solid fa-trash-can"></i>
        </button>
      </td>
    </tr>
  <?php endforeach; ?>
<?php endif; ?>