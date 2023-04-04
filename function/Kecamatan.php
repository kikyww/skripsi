<?php
function getKecamatan(){
    include '../koneksi.php';

    $query = mysqli_query($konek, "SELECT * FROM tb_kecamatan");
    $kecamatan = array();
    
    while ($row = $query->fetch_assoc()) {
        $kecamatan[] = $row;
    }
    return $kecamatan;
}

function getKec(){
    include '../koneksi.php';
    $kec = $_GET['kec'];

    $query = mysqli_query($konek, "SELECT * FROM tb_kecamatan WHERE nama_kecamatan = '$kec'");
    $kecamatan = array();
    
    while ($row = $query->fetch_assoc()) {
        $kecamatan[] = $row;
    }
    return $kecamatan;
}
