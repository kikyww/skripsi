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
