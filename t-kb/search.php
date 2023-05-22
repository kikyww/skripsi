<?php
include '../koneksi.php';

$kec = $_GET['kec'];
$kel = $_GET['kel'];
$search = $_POST['search'];

$search = $konek->real_escape_string($search);


$query = "SELECT * FROM tb_keluarga LEFT JOIN tb_kelurahan ON tb_keluarga.kelurahan_id = tb_kelurahan.id_kelurahan LEFT JOIN tb_kecamatan ON tb_keluarga.kecamatan_id = tb_kecamatan.id_kecamatan LEFT JOIN tb_kepkel ON tb_keluarga.kepkel_id = tb_kepkel.id_kepkel WHERE tb_kecamatan.nama_kecamatan = '$kec' AND tb_kelurahan.nama_kelurahan = '$kel' AND tb_keluarga.status_kb = 'KB' AND tb_keluarga.nama_keluarga LIKE '%$search%'";

$result = $konek->query($query);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    echo "<li class='list-group-item kel-hover' kepkel-id='" . $row['id_kepkel'] . "' data-id='" . $row['id_keluarga'] . "'>" . $row['nama_keluarga'] ." | ". $row['nama_kepkel'] . "</li>";
  }
} else {
  echo "<li class='list-group-item disabled bg-primary' style='cursor:default;'>No results found!</li>";
}

$konek->close();
