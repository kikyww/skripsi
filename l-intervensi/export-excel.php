<?php
include '../koneksi.php';

if(isset($_POST['start_date']) && isset($_POST['end_date']) && isset($_POST['kecamatan_id']) && isset($_POST['kelurahan_id'])) {
  $start_date = $_POST['start_date'];
  $end_date = $_POST['end_date'];
  $filKecamatan = $_POST['kecamatan_id'];
  $filKelurahan = $_POST['kelurahan_id'];
  $query = mysqli_query($konek, "SELECT * FROM tb_intervensi LEFT JOIN tb_kecamatan ON tb_intervensi.kecamatan_id = tb_kecamatan.id_kecamatan LEFT JOIN tb_kelurahan ON tb_intervensi.kelurahan_id = tb_kelurahan.id_kelurahan LEFT JOIN tb_jenisinv ON tb_intervensi.jenis_id = tb_jenisinv.id_jenis LEFT JOIN tb_opd ON tb_intervensi.opd_id = tb_opd.id_opd LEFT JOIN tb_opd AS o ON tb_intervensi.kunjungan_id = o.id_opd WHERE tb_intervensi.kecamatan_id = '$filKecamatan' AND tb_intervensi.kelurahan_id = '$filKelurahan' AND tb_intervensi.status_intervensi = 'Selesai' AND tb_intervensi.tgl_intervensi BETWEEN '$start_date' AND '$end_date' ORDER BY tb_intervensi.id_intervensi ASC");
} else {
  $query = mysqli_query($konek, "SELECT * FROM tb_intervensi LEFT JOIN tb_kecamatan ON tb_intervensi.kecamatan_id = tb_kecamatan.id_kecamatan LEFT JOIN tb_kelurahan ON tb_intervensi.kelurahan_id = tb_kelurahan.id_kelurahan LEFT JOIN tb_jenisinv ON tb_intervensi.jenis_id = tb_jenisinv.id_jenis LEFT JOIN tb_opd ON tb_intervensi.opd_id = tb_opd.id_opd LEFT JOIN tb_opd AS o ON tb_intervensi.kunjungan_id = o.id_opd WHERE tb_intervensi.status_intervensi = 'Selesai' ORDER BY tb_intervensi.id_intervensi ASC");
}

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment; filename=catatan_intervensi.xlsx');

$output = fopen('php://output', 'w');

fwrite($output, "ID Intervensi\t");
fwrite($output, "Judul Intervensi\t");
fwrite($output, "Tanggal Intervensi\t");
fwrite($output, "Tempat\t");
fwrite($output, "Deskripsi Singkat\t");
fwrite($output, "Kategori Intervensi\t");
fwrite($output, "Seksi Intervensi\t");
fwrite($output, "Peserta\t");
fwrite($output, "Instansi Terkait\t");
fwrite($output, "Kecamatan\t");
fwrite($output, "Kelurahan\t");
fwrite($output, "Time Stamp\n");

while($row = mysqli_fetch_assoc($query)) {
    fwrite($output, $row['id_intervensi'] . "\t");
    fwrite($output, $row['judul_intervensi'] . "\t");
    fwrite($output, $row['tgl_intervensi'] . "\t");
    fwrite($output, $row['tempat_intervensi'] . "\t");
    fwrite($output, $row['deskripsi_intervensi'] . "\t");
    fwrite($output, $row['nama_jenis'] . "\t");
    fwrite($output, $row['seksi_intervensi'] . "\t");
    fwrite($output, $row['pesertai_intervensi'] . "," . $row['pesertaii_intervensi'] . "," . $row['pesertaiii_intervensi'] . "\t");
    fwrite($output, $row['nama_opd'] . "\t");
    fwrite($output, $row['nama_kecamatan'] . "\t");
    fwrite($output, $row['nama_kelurahan'] . "\t");
    fwrite($output, $row['intervensi_stamp'] . "\n");
}

fclose($output);
mysqli_close($konek);
?>
