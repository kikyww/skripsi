<?php
include '../koneksi.php';

if(isset($_POST['start_date']) && isset($_POST['end_date']) && isset($_POST['kecamatan_id']) && isset($_POST['kelurahan_id'])) {
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $filKecamatan = $_POST['kecamatan_id'];
    $filKelurahan = $_POST['kelurahan_id'];
    $query = mysqli_query($konek, "SELECT * FROM tb_intervensi LEFT JOIN tb_kecamatan ON tb_intervensi.kecamatan_id = tb_kecamatan.id_kecamatan LEFT JOIN tb_kelurahan ON tb_intervensi.kelurahan_id = tb_kelurahan.id_kelurahan LEFT JOIN tb_jenisinv ON tb_intervensi.jenis_id = tb_jenisinv.id_jenis LEFT JOIN tb_opd ON tb_intervensi.opd_id = tb_opd.id_opd WHERE tb_intervensi.kecamatan_id = '$filKecamatan' AND tb_intervensi.kelurahan_id = '$filKelurahan' AND tb_intervensi.status_intervensi = 'Selesai' AND tb_intervensi.tgl_intervensi BETWEEN '$start_date' AND '$end_date' ORDER BY tb_intervensi.id_intervensi DESC");
} else {
    $query = mysqli_query($konek, "SELECT * FROM tb_intervensi LEFT JOIN tb_kecamatan ON tb_intervensi.kecamatan_id = tb_kecamatan.id_kecamatan LEFT JOIN tb_kelurahan ON tb_intervensi.kelurahan_id = tb_kelurahan.id_kelurahan LEFT JOIN tb_jenisinv ON tb_intervensi.jenis_id = tb_jenisinv.id_jenis LEFT JOIN tb_opd ON tb_intervensi.opd_id = tb_opd.id_opd WHERE tb_intervensi.status_intervensi = 'Selesai' ORDER BY tb_intervensi.id_intervensi DESC");
}

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=catatan-intervensi.csv');

$output = fopen('php://output', 'w');

while($row = mysqli_fetch_assoc($query)) {
    fputcsv($output, array(
        $row['judul_intervensi'],
        $row['tgl_intervensi'],
        $row['tempat_intervensi'],
        $row['deskripsi_intervensi'],
        $row['nama_jenis'],
        $row['seksi_intervensi'],
        $row['pesertai_intervensi'],
        $row['pesertaii_intervensi'],
        $row['pesertaiii_intervensi'],
        $row['nama_opd'],
        $row['nama_kecamatan'],
        $row['nama_kelurahan'],
        $row['intervensi_stamp']
    ));
}

fclose($output);
mysqli_close($konek);
?>
