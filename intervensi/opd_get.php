<?php
include '../koneksi.php';

if (!$konek) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$query = "SELECT * FROM tb_opd ORDER BY id_opd ASC";

$result = mysqli_query($konek, $query);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<li class='list-group-item kun-hover' data-id='" . $row['id_opd'] . "'>" . $row['nama_opd'] . "</li>";
    }
} else {
    echo '<li class="list-group-item">Tidak ada data</li>';
}

mysqli_close($konek);
?>
