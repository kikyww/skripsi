

<?php
include '../koneksi.php';
$id = $_GET['id'];

if (!$konek) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

$sql = "SELECT * FROM tb_intervensi WHERE id_intervensi = '$id'";
$result = mysqli_query($konek, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $gambar = $row['foto_intervensi'];
    echo"<center><img src='../assets/images/intervensi/$gambar' /></center>";
} else {
    echo "Foto tidak ditemukan.";
}

mysqli_close($konek);
?>
