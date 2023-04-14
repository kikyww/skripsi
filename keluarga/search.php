<?php
include '../koneksi.php';

$kec = $_GET['kec'];
$kel = $_GET['kel'];
$search = $_POST['search'];

if (isset($search)) {
    $sql = "SELECT * FROM tb_kepkel LEFT JOIN tb_kelurahan ON tb_kepkel.kelurahan_id = tb_kelurahan.id_kelurahan LEFT JOIN tb_kecamatan ON tb_kepkel.kecamatan_id = tb_kecamatan.id_kecamatan WHERE tb_kepkel.nama_kepkel LIKE '%$search%' AND tb_kecamatan.nama_kecamatan = '$kec' AND tb_kelurahan.nama_kelurahan = '$kel'";
    $result = $konek->query($sql);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        echo "<li class='list-group-item kel-hover' data-id='" . $row['id_kepkel'] . "'>" . $row['nama_kepkel'] . "</li>";
      }
  } else {
    echo "<li class='list-group-item disabled bg-primary' style='cursor:default;'>No results found!</li>";
  }
}