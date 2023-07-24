<?php
include '../koneksi.php';
session_start();
$id = $_GET['id'];
$id_user = $_SESSION['id_user'];

if(!isset($id_user)){
    header('Location: ../index.php');
}

$delete = mysqli_query($konek, "DELETE FROM tb_kelurahan WHERE id_kelurahan = '$id'");

if($delete){
    echo "<script>alert('Data berhasil dihapus');</script>";
    echo '<meta http-equiv="refresh" content="1;url=kelurahan.php">';
}