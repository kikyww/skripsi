<?php
include '../koneksi.php';

$kec = $_GET['kec'];

$query = "SELECT *, SUM(DATE_SUB(CURDATE(), INTERVAL 49 YEAR) >= tb_keluarga.lahir_keluarga) AS non_pus, SUM(DATE_SUB(CURDATE(), INTERVAL 50 YEAR) <= tb_keluarga.lahir_keluarga) AS pus FROM tb_keluarga INNER JOIN tb_kepkel ON tb_keluarga.kepkel_id = tb_kepkel.id_kepkel INNER JOIN tb_kecamatan ON tb_keluarga.kecamatan_id = tb_kecamatan.id_kecamatan LEFT JOIN tb_kelurahan ON tb_keluarga.kelurahan_id = tb_kelurahan.id_kelurahan WHERE tb_kecamatan.nama_kecamatan = '$kec'";

$result = mysqli_query($konek, $query);

$data = array();

while ($row = mysqli_fetch_assoc($result)) {
    $data['non_pus'] = $row['non_pus'];
    $data['pus'] = $row['pus'];
}

echo json_encode($data);

mysqli_close($konek);