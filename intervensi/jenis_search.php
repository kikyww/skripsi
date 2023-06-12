<?php
include '../koneksi.php';

if (!$konek) {
  die("Koneksi gagal: " . mysqli_connect_error());
}

$keyword = $_GET['keyword'];

if (strlen($keyword) >= 1) {
  $query = "SELECT * FROM tb_jenisinv WHERE nama_jenis LIKE '%$keyword%'";
} else {
  $query = "SELECT * FROM tb_jenisinv ORDER BY id_jenis ASC";
}

$result = mysqli_query($konek, $query);

if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    echo "<li class='list-group-item kel-hover' data-id='" . $row['id_jenis'] . "'>" . $row['nama_jenis'] . " <br /><p class='text-muted'>(". $row['deskripsi_jenisinv'] .")</p></li>";
  }
} else {
  echo "<li class='list-group-item kel-hover' data-id='1'>Lainnya <br /><p class='text-muted'>(Kategori belum terdaftar)</p></li>";
}

mysqli_close($konek);
?>
