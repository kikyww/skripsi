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

$delete = mysqli_query($konek, "DELETE FROM tb_keluarga WHERE id_keluarga = '$id'");

if($delete){
    echo "<script>alert('Akseptor telah berhasil dihapus!');</script>";
    echo "<meta http-equiv='refresh' content='0; url=keluarga.php?kec=".$kec."&kel=".$kel."'>";
}