<?php
include '../koneksi.php';

if(isset($_POST['start_date']) && isset($_POST['end_date'])) {
$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];
$query = mysqli_query($konek, "SELECT * FROM tb_intervensi LEFT JOIN tb_jenisinv ON tb_intervensi.jenis_id = tb_jenisinv.id_jenis LEFT JOIN tb_catatan ON tb_catatan.intervensi_id = tb_intervensi.id_intervensi LEFT JOIN tb_opd ON tb_intervensi.opd_id = tb_opd.id_opd LEFT JOIN tb_kecamatan ON tb_intervensi.kecamatan_id = tb_kecamatan.id_kecamatan LEFT JOIN tb_kelurahan ON tb_intervensi.kelurahan_id = tb_kelurahan.id_kelurahan WHERE tb_intervensi.status_intervensi = 'Selesai' AND tb_intervensi.agenda_intervensi = 'Agenda' AND tb_intervensi.tgl_intervensi BETWEEN '$start_date' AND '$end_date' ORDER BY tb_intervensi.id_intervensi DESC");
} else {
$query = mysqli_query($konek, "SELECT * FROM tb_intervensi LEFT JOIN tb_jenisinv ON tb_intervensi.jenis_id = tb_jenisinv.id_jenis LEFT JOIN tb_catatan ON tb_catatan.intervensi_id = tb_intervensi.id_intervensi LEFT JOIN tb_opd ON tb_intervensi.opd_id = tb_opd.id_opd LEFT JOIN tb_kecamatan ON tb_intervensi.kecamatan_id = tb_kecamatan.id_kecamatan LEFT JOIN tb_kelurahan ON tb_intervensi.kelurahan_id = tb_kelurahan.id_kelurahan WHERE tb_intervensi.status_intervensi = 'Selesai' AND tb_intervensi.agenda_intervensi = 'Agenda' ORDER BY tb_intervensi.id_intervensi DESC");
}

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment; filename=laporan-sosialisasi.xlsx');

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
fwrite($output, "Status\t");
fwrite($output, "Catatan\t");
fwrite($output, "Saran\t");
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
    fwrite($output, $row['status_intervensi'] . "\t");
    fwrite($output, $row['isi_catatan'] . "\t");
    fwrite($output, $row['saran_catatan'] . "\t");
    fwrite($output, $row['nama_kecamatan'] . "\t");
    fwrite($output, $row['nama_kelurahan'] . "\t");
    fwrite($output, $row['intervensi_stamp'] . "\n");
}

fclose($output);
mysqli_close($konek);
?>
