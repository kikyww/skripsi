<?php
include '../koneksi.php';
session_start();
$id = $_GET['id'];
$id_user = $_SESSION['id_user'];

if(!isset($id_user)){
    header('Location: ../index.php');
}

$delete = mysqli_query($konek, "DELETE FROM tb_catatan WHERE id_catatan = '$id'");

if($delete){
    echo "<script>alert('Catatan berhasil dihapus');</script>";
    echo '<meta http-equiv="refresh" content="1;url=./catatan.php">';
}