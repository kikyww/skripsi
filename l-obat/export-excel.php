<?php
include '../koneksi.php';

if(isset($_POST['start_date']) && isset($_POST['end_date'])) {
  $start_date = $_POST['start_date'];
  $end_date = $_POST['end_date'];
  $query = mysqli_query($konek, "SELECT * FROM tb_stok LEFT JOIN tb_obat ON tb_stok.obat_id = tb_obat.id_obat LEFT JOIN tb_kecamatan ON tb_stok.kecamatan_id = tb_kecamatan.id_kecamatan WHERE tb_stok.tgl_awal BETWEEN '$start_date' AND '$end_date' ORDER BY tb_stok.stok_stamp DESC");
} else {
  $query = mysqli_query($konek, "SELECT * FROM tb_stok LEFT JOIN tb_obat ON tb_stok.obat_id = tb_obat.id_obat LEFT JOIN tb_kecamatan ON tb_stok.kecamatan_id = tb_kecamatan.id_kecamatan ORDER BY tb_stok.stok_stamp DESC");
}

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment; filename=data-obat.xlsx');

$output = fopen('php://output', 'w');

fwrite($output, "ID Stok\t");
fwrite($output, "Nama Obat/Alat\t");
fwrite($output, "Jenis Obat\t");
fwrite($output, "Stok Awal\t");
fwrite($output, "Stok Sisa\t");
fwrite($output, "Tanggal Di Stok\t");
fwrite($output, "Tanggal Pengembalian\t");
fwrite($output, "Kecamatan\t");
fwrite($output, "Time Stamp\n");

while($row = mysqli_fetch_assoc($query)) {
    fwrite($output, $row['id_stok'] . "\t");
    fwrite($output, $row['nama_obat'] . "\t");
    fwrite($output, $row['jenis_obat'] . "\t");
    fwrite($output, $row['stok_awal'] . "\t");
    fwrite($output, $row['stok_akhir'] . "\t");
    fwrite($output, $row['tgl_awal'] . "\t");
    fwrite($output, $row['tgl_akhir'] . "\t");
    fwrite($output, $row['nama_kecamatan'] . "\t");
    fwrite($output, $row['stok_stamp'] . "\n");
}

fclose($output);
mysqli_close($konek);
?>
