<?php
include '../koneksi.php';

if(isset($_POST['start_date']) && isset($_POST['end_date'])) {
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $query = mysqli_query($konek, "SELECT * FROM tb_stok LEFT JOIN tb_obat ON tb_stok.obat_id = tb_obat.id_obat LEFT JOIN tb_kecamatan ON tb_stok.kecamatan_id = tb_kecamatan.id_kecamatan WHERE tb_stok.tgl_awal BETWEEN '$start_date' AND '$end_date' ORDER BY tb_stok.stok_stamp DESC");
} else {
    $query = mysqli_query($konek, "SELECT * FROM tb_stok LEFT JOIN tb_obat ON tb_stok.obat_id = tb_obat.id_obat LEFT JOIN tb_kecamatan ON tb_stok.kecamatan_id = tb_kecamatan.id_kecamatan ORDER BY tb_stok.stok_stamp DESC");
}

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=data-obat.csv');

$output = fopen('php://output', 'w');

// fputcsv($output, array('id_stok', 'kecamatan_id', 'obat_id', 'stok_awal', 'stok_akhir', 'tgl_awal', 'tgl_akhir', 'stok_stamp'));

// while($row = mysqli_fetch_assoc($query)) {
//     fputcsv($output, $row);
// }
while($row = mysqli_fetch_assoc($query)) {
    fputcsv($output, array(
        $row['nama_obat'],
        $row['stok_awal'],
        $row['stok_akhir'],
        $row['tgl_awal'],
        $row['tgl_akhir'],
        $row['nama_kecamatan'],
        $row['stok_stamp']
    ));
}

fclose($output);
mysqli_close($konek);
?>
