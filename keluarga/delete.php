<?php
include '../koneksi.php';
session_start();
$id_user = $_SESSION['id_user'];
$id = $_GET['id'];
$kec = $_GET['kec'];

if(!isset($id_user)){
    header('Location: ../index.php');
}

$delete = mysqli_query($konek, "DELETE FROM tb_kepkel WHERE id_kepkel = '$id'");

if($delete){
    echo "<script>alert('Kepala Keluarga telah berhasil dihapus!');</script>";
    echo "<meta http-equiv='refresh' content='0; url=kepkel.php?kec=".$kec."'>";
}