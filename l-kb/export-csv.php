<?php
include '../koneksi.php';

if(isset($_POST['start_date']) && isset($_POST['end_date'])) {
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $query = mysqli_query($konek, "SELECT * FROM tb_kb LEFT JOIN tb_kelurahan ON tb_kb.kelurahan_id = tb_kelurahan.id_kelurahan LEFT JOIN tb_kecamatan ON tb_kb.kecamatan_id = tb_kecamatan.id_kecamatan LEFT JOIN tb_keluarga ON tb_kb.keluarga_id = tb_keluarga.id_keluarga LEFT JOIN tb_obat ON tb_kb.obat_id = tb_obat.id_obat LEFT JOIN tb_stok ON tb_kb.stok_id = tb_stok.id_stok WHERE tb_kb.tgl_kb BETWEEN '$start_date' AND '$end_date' ORDER BY tb_kecamatan.nama_kecamatan ASC, tb_kelurahan.nama_kelurahan ASC");
} else {
    $query = mysqli_query($konek, "SELECT * FROM tb_kb LEFT JOIN tb_kelurahan ON tb_kb.kelurahan_id = tb_kelurahan.id_kelurahan LEFT JOIN tb_kecamatan ON tb_kb.kecamatan_id = tb_kecamatan.id_kecamatan LEFT JOIN tb_keluarga ON tb_kb.keluarga_id = tb_keluarga.id_keluarga LEFT JOIN tb_obat ON tb_kb.obat_id = tb_obat.id_obat LEFT JOIN tb_stok ON tb_kb.stok_id = tb_stok.id_stok ORDER BY tb_kecamatan.nama_kecamatan ASC, tb_kelurahan.nama_kelurahan ASC");
}

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=data-kb.csv');

$output = fopen('php://output', 'w');

fputcsv($output, array('nama_keluarga', 'tgl_kb', 'tgl_kembali', 'nama_obat', 'jumlah_obat', 'nama_kelurahan', 'nama_kecamatan'));

while($row = mysqli_fetch_assoc($query)) {
    fputcsv($output, $row);
}

fclose($output);
mysqli_close($konek);
?>
