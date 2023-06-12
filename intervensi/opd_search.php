<?php
include '../koneksi.php';

if (!$konek) {
  die("Koneksi gagal: " . mysqli_connect_error());
}

$keyword = $_GET['keyword'];

if (strlen($keyword) >= 1) {
  $query = "SELECT * FROM tb_opd WHERE nama_opd LIKE '%$keyword%'";
} else {
  $query = "SELECT * FROM tb_opd ORDER BY id_opd ASC";
}

$result = mysqli_query($konek, $query);

if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    echo "<li class='list-group-item kun-hover' data-id='" . $row['id_opd'] . "'>" . $row['nama_opd'] . "</li>";
  }
} else {
  echo '<li class="list-group-item">Tidak ada huruf terdeteksi</li>';
}

mysqli_close($konek);
?>
