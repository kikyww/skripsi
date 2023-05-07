<?php
include '../koneksi.php';

if(isset($_POST['start_date']) && isset($_POST['end_date'])) {
  $start_date = $_POST['start_date'];
  $end_date = $_POST['end_date'];
  $query = mysqli_query($konek, "SELECT * FROM tb_kb LEFT JOIN tb_kelurahan ON tb_kb.kelurahan_id = tb_kelurahan.id_kelurahan LEFT JOIN tb_kecamatan ON tb_kb.kecamatan_id = tb_kecamatan.id_kecamatan LEFT JOIN tb_kepkel ON tb_kb.kepkel_id = tb_kepkel.id_kepkel LEFT JOIN tb_keluarga ON tb_kb.keluarga_id = tb_keluarga.id_keluarga LEFT JOIN tb_obat ON tb_kb.obat_id = tb_obat.id_obat LEFT JOIN tb_stok ON tb_kb.stok_id = tb_stok.id_stok WHERE tb_kb.tgl_kb BETWEEN '$start_date' AND '$end_date' ORDER BY tb_kecamatan.nama_kecamatan ASC, tb_kelurahan.nama_kelurahan ASC");
} else {
  $query = mysqli_query($konek, "SELECT * FROM tb_kb LEFT JOIN tb_kelurahan ON tb_kb.kelurahan_id = tb_kelurahan.id_kelurahan LEFT JOIN tb_kecamatan ON tb_kb.kecamatan_id = tb_kecamatan.id_kecamatan LEFT JOIN tb_kepkel ON tb_kb.kepkel_id = tb_kepkel.id_kepkel LEFT JOIN tb_keluarga ON tb_kb.keluarga_id = tb_keluarga.id_keluarga LEFT JOIN tb_obat ON tb_kb.obat_id = tb_obat.id_obat LEFT JOIN tb_stok ON tb_kb.stok_id = tb_stok.id_stok ORDER BY tb_kecamatan.nama_kecamatan ASC, tb_kelurahan.nama_kelurahan ASC");
}

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment; filename=data-kb.xls');

$output = fopen('php://output', 'w');

fwrite($output, "ID KB\t");
fwrite($output, "Nama Kepala Keluarga\t");
fwrite($output, "Nama\t");
fwrite($output, "Alamat\t");
fwrite($output, "Tempat Tanggal Lahir\t");
fwrite($output, "Telepon\t");
fwrite($output, "Tanggal KB\t");
fwrite($output, "Tanggal Kembali KB\t");
fwrite($output, "Obat/Alat yang digunakan\t");
fwrite($output, "Jumlah Obat\t");
fwrite($output, "Keterangan\t");
fwrite($output, "Kecamatan\t");
fwrite($output, "Kelurahan\t");
fwrite($output, "kb_stamp\n");

while($row = mysqli_fetch_assoc($query)) {
    fwrite($output, $row['id_kb'] . "\t");
    fwrite($output, $row['nama_kepkel'] . "\t");
    fwrite($output, $row['nama_keluarga'] . "\t");
    fwrite($output, $row['alamat_kepkel'] . "\t");
    fwrite($output, $row['tl_keluarga'] . ',' . date('d-m-Y', strtotime($row['lahir_keluarga'])) . "\t");
    fwrite($output, $row['telp_keluarga'] . "\t");
    fwrite($output, $row['tgl_kb'] . "\t");
    fwrite($output, $row['tgl_kembali'] . "\t");
    fwrite($output, $row['nama_obat'] . "\t");
    fwrite($output, $row['jumlah_obat'] . "\t");
    fwrite($output, $row['keterangan_kb'] . "\t");
    fwrite($output, $row['nama_kecamatan'] . "\t");
    fwrite($output, $row['nama_kelurahan'] . "\t");
    fwrite($output, $row['kb_stamp'] . "\n");
}

fclose($output);
mysqli_close($konek);
?>
