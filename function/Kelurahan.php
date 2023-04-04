<?php
function getKelurahan(){
    include '../koneksi.php';
    $kec = $_GET['kec'];
    
    $query = mysqli_query($konek, "SELECT * FROM tb_kelurahan LEFT JOIN tb_kecamatan ON tb_kelurahan.kecamatan_id = tb_kecamatan.id_kecamatan WHERE tb_kecamatan.nama_kecamatan = '$kec'");
    $kelurahan = array();
    
    while ($row = $query->fetch_assoc()) {
        $kelurahan[] = $row;
    }
    return $kelurahan;
}

function getKel(){
    include '../koneksi.php';
    $kel = $_GET['kel'];

    $query = mysqli_query($konek, "SELECT * FROM tb_kelurahan LEFT JOIN tb_kecamatan ON tb_kelurahan.kecamatan_id = tb_kecamatan.id_kecamatan WHERE nama_kelurahan = '$kel'");
    $kecamatan = array();
    
    while ($row = $query->fetch_assoc()) {
        $kecamatan[] = $row;
    }
    return $kecamatan;
}