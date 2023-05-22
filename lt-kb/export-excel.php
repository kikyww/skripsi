<?php
include '../koneksi.php';

if(isset($_POST['kecamatan_id']) && isset($_POST['kelurahan_id'])) {
  $kecamatan_id = $_POST['kecamatan_id'];
  $kelurahan_id = $_POST['kelurahan_id'];
  $query = mysqli_query($konek, "SELECT * FROM tb_keluarga INNER JOIN tb_kepkel ON tb_keluarga.kepkel_id = tb_kepkel.id_kepkel INNER JOIN tb_kecamatan ON tb_keluarga.kecamatan_id = tb_kecamatan.id_kecamatan LEFT JOIN tb_kelurahan ON tb_keluarga.kelurahan_id = tb_kelurahan.id_kelurahan WHERE tb_keluarga.kecamatan_id = '$kecamatan_id' AND tb_keluarga.kelurahan_id = '$kelurahan_id' AND tb_keluarga.status_kb = 'Tidak KB' ORDER BY tb_keluarga.kecamatan_id DESC, tb_keluarga.kelurahan_id DESC");
} else {
  $query = mysqli_query($konek, "SELECT * FROM tb_keluarga INNER JOIN tb_kepkel ON tb_keluarga.kepkel_id = tb_kepkel.id_kepkel INNER JOIN tb_kecamatan ON tb_keluarga.kecamatan_id = tb_kecamatan.id_kecamatan LEFT JOIN tb_kelurahan ON tb_keluarga.kelurahan_id = tb_kelurahan.id_kelurahan WHERE  tb_keluarga.status_kb = 'Tidak KB' ORDER BY tb_keluarga.kecamatan_id DESC, tb_keluarga.kelurahan_id DESC");
}

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment; filename=tidak-kb.xlsx');

$output = fopen('php://output', 'w');

fwrite($output, "ID Keluarga\t");
fwrite($output, "Nama\t");
fwrite($output, "Kepala Keluarga\t");
fwrite($output, "Alamat\t");
fwrite($output, "Telepon\t");
fwrite($output, "Status KB\t");
fwrite($output, "Alasan\t");
fwrite($output, "Keterangan\t");
fwrite($output, "Jumlah Anak\t");
fwrite($output, "Kecamatan\t");
fwrite($output, "Kelurahan\n");

while($row = mysqli_fetch_assoc($query)) {
    fwrite($output, $row['id_keluarga'] . "\t");
    fwrite($output, $row['nama_keluarga'] . "\t");
    fwrite($output, $row['nama_kepkel'] . "\t");
    fwrite($output, $row['alamat_kepkel'] . "\t");
    fwrite($output, $row['telp_keluarga'] . "\t");
    fwrite($output, $row['status_kb'] . "\t");
    fwrite($output, $row['keterangan_kb'] . "\t");
    fwrite($output, $row['alasan_kb'] . "\t");
    fwrite($output, $row['jumlah_anak'] . "\t");
    fwrite($output, $row['nama_kecamatan'] . "\t");
    fwrite($output, $row['nama_kelurahan'] . "\n");
}

fclose($output);
mysqli_close($konek);
?>
