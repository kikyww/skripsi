<?php
include '../koneksi.php';

if (!$konek) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$query = "SELECT * FROM tb_jenisinv ORDER BY id_jenis ASC";

$result = mysqli_query($konek, $query);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<li class='list-group-item kel-hover' data-id='" . $row['id_jenis'] . "'>" . $row['nama_jenis'] . " <br /><p class='text-muted'>(". $row['deskripsi_jenisinv'] .")</p></li>";
    }
} else {
    echo '<li class="list-group-item">Tidak ada data</li>';
}

mysqli_close($konek);
?>
