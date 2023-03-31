<?php
function getKelurahan(){
    include '../koneksi.php';
    $query = mysqli_query($konek, "SELECT * FROM tb_kelurahan LEFT JOIN tb_kecamatan ON tb_kelurahan.kecamatan_id = tb_kecamatan.id_kecamatan");
    $kelurahan = array();
    
    while ($row = $query->fetch_assoc()) {
        $kelurahan[] = $row;
    }
    return $kelurahan;
}
