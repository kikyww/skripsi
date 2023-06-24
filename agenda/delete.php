<?php
include '../koneksi.php';
session_start();
$id = $_GET['id'];
$kec = $_GET['kec'];
$kel = $_GET['kel'];
$id_user = $_SESSION['id_user'];

if(!isset($id_user)){
    header('Location: ../index.php');
}

$delete = mysqli_query($konek, "DELETE FROM tb_intervensi WHERE id_intervensi = '$id'");

if($delete){
    echo "<script>alert('Intervensi berhasil dihapus');</script>";
    echo '<meta http-equiv="refresh" content="0; url=intervensi.php?kec='. $kec .'&kel='. $kel .'">';
}