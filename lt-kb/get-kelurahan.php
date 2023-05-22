<?php
include '../koneksi.php';
$kecamatan_id = $_POST['kecamatan_id'];

$query = mysqli_query($konek, "SELECT * FROM tb_kelurahan WHERE kecamatan_id = '$kecamatan_id'");

$data = array();
while($row = mysqli_fetch_array($query)){
    $data[] = $row;
}

echo json_encode($data);
