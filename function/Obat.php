<?php
function getObat(){
    include '../koneksi.php';
    
    $query = mysqli_query($konek, "SELECT * FROM tb_obat");
    $obat = array();
    
    while ($row = $query->fetch_assoc()) {
        $obat[] = $row;
    }
    return $obat;
}
