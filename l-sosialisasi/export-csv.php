<?php
include '../koneksi.php';

if(isset($_POST['start_date']) && isset($_POST['end_date'])) {
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $query = mysqli_query($konek, "SELECT * FROM tb_intervensi LEFT JOIN tb_jenisinv ON tb_intervensi.jenis_id = tb_jenisinv.id_jenis LEFT JOIN tb_opd ON tb_intervensi.opd_id = tb_opd.id_opd LEFT JOIN tb_kecamatan ON tb_intervensi.kecamatan_id = tb_kecamatan.id_kecamatan LEFT JOIN tb_kelurahan ON tb_intervensi.kelurahan_id = tb_kelurahan.id_kelurahan WHERE tb_intervensi.agenda_intervensi = 'Agenda' AND tb_intervensi.tgl_intervensi BETWEEN '$start_date' AND '$end_date' ORDER BY tb_intervensi.id_intervensi DESC");
} else {
    $query = mysqli_query($konek, "SELECT * FROM tb_intervensi LEFT JOIN tb_jenisinv ON tb_intervensi.jenis_id = tb_jenisinv.id_jenis LEFT JOIN tb_opd ON tb_intervensi.opd_id = tb_opd.id_opd LEFT JOIN tb_kecamatan ON tb_intervensi.kecamatan_id = tb_kecamatan.id_kecamatan LEFT JOIN tb_kelurahan ON tb_intervensi.kelurahan_id = tb_kelurahan.id_kelurahan WHERE tb_intervensi.agenda_intervensi = 'Agenda' ORDER BY tb_intervensi.id_intervensi DESC");
}

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=laporan-sosialisasi.csv');

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
        $row['status_intervensi'],
        $row['nama_kecamatan'],
        $row['nama_kelurahan'],
        $row['intervensi_stamp']
    ));
}

fclose($output);
mysqli_close($konek);
?>
