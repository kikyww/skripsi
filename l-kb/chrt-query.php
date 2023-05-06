<?php
include '../koneksi.php';

$tahun = $_GET['tahun'];

$query = "SELECT tb_kecamatan.nama_kecamatan, MONTH(tb_kb.tgl_kb) AS bulan, COUNT(tb_kb.id_kb) AS jumlah
          FROM tb_kb
          LEFT JOIN tb_kecamatan ON tb_kb.kecamatan_id = tb_kecamatan.id_kecamatan
          WHERE YEAR(tb_kb.tgl_kb) = '$tahun'
          GROUP BY tb_kecamatan.nama_kecamatan, MONTH(tb_kb.tgl_kb)";

$result = mysqli_query($konek, $query);

$data = array(
    'Banjarmasin Utara' => array(),
    'Banjarmasin Barat' => array(),
    'Banjarmasin Selatan' => array(),
    'Banjarmasin Tengah' => array(),
    'labels' => array()
);

while ($row = mysqli_fetch_assoc($result)) {
    $kecamatan = $row['nama_kecamatan'];
    $bulan = $row['bulan'];
    $jumlah = $row['jumlah'];

    $data[$kecamatan][$bulan] = $jumlah;

    if (!in_array($bulan, $data['labels'])) {
        $data['labels'][] = $bulan;
    }
}

$jsonData = json_encode($data);

header('Content-Type: application/json');

echo $jsonData;

mysqli_close($konek);
?>
