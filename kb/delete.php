<?php
include '../koneksi.php';
session_start();
$id_user = $_SESSION['id_user'];
$id = $_GET['id'];
$kec = $_GET['kec'];
$kel = $_GET['kel'];

if(!isset($id_user)){
    header('Location: ../index.php');
}

$resultJumlahObat = mysqli_query($konek, "SELECT jumlah_obat FROM tb_kb WHERE id_kb = '$id'");
$rowJumlahObat = $resultJumlahObat->fetch_assoc();
$jumlahObat = $rowJumlahObat['jumlah_obat'];

$resultStokId = mysqli_query($konek, "SELECT stok_id FROM tb_kb WHERE id_kb = '$id'");
$rowStokId = $resultStokId->fetch_assoc();
$stokId = $rowStokId['stok_id'];

mysqli_query($konek, "UPDATE tb_stok SET stok_akhir = stok_akhir + $jumlahObat WHERE id_stok = '$stokId'");

$delete = mysqli_query($konek, "DELETE FROM tb_kb WHERE id_kb = '$id'");

if($delete){
    echo "<script>alert('Catatan KB telah berhasil dihapus!');</script>";
    echo "<meta http-equiv='refresh' content='0; url=kb.php?kec=".$kec."&kel=".$kel."'>";
} else {
    echo "Error: " . mysqli_error($conn);
}