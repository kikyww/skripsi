<?php
include '../koneksi.php';

if(isset($_POST['start_date']) && isset($_POST['end_date'])) {
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $query = mysqli_query($konek, "SELECT * FROM tb_kb WHERE tgl_kb BETWEEN '$start_date' AND '$end_date' ORDER BY kecamatan_id ASC, kelurahan_id ASC");
} else {
    $query = mysqli_query($konek, "SELECT * FROM tb_kb ORDER BY kecamatan_id ASC, kelurahan_id ASC");
}

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=data-kb.csv');

$output = fopen('php://output', 'w');

fputcsv($output, array('id_kb', 'kepkel_id', 'keluarga_id', 'kecamatan_id', 'kelurahan_id', 'tgl_kb', 'tgl_kembali', 'obat_id', 'stok_id', 'jumlah_obat', 'kb_stamp'));

while($row = mysqli_fetch_assoc($query)) {
    fputcsv($output, $row);
}

fclose($output);
mysqli_close($konek);
?>
