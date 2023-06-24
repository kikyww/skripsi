<?php
include '../koneksi.php';

if(isset($_POST['kecamatan_id']) && isset($_POST['kelurahan_id'])) {
    $kecamatan_id = $_POST['kecamatan_id'];
    $kelurahan_id = $_POST['kelurahan_id'];
    $query = mysqli_query($konek, "SELECT * FROM tb_keluarga LEFT JOIN tb_kecamatan ON tb_keluarga.kecamatan_id = tb_kecamatan.id_kecamatan LEFT JOIN tb_kelurahan ON tb_keluarga.kelurahan_id = tb_kelurahan.id_kelurahan WHERE tb_keluarga.kecamatan_id = '$kecamatan_id' AND tb_keluarga.kelurahan_id = '$kelurahan_id' AND tb_keluarga.status_kb = 'Tidak KB' ORDER BY tb_keluarga.kecamatan_id DESC, tb_keluarga.kelurahan_id DESC");
} else {
    $query = mysqli_query($konek, "SELECT * FROM tb_keluarga LEFT JOIN tb_kecamatan ON tb_keluarga.kecamatan_id = tb_kecamatan.id_kecamatan LEFT JOIN tb_kelurahan ON tb_keluarga.kelurahan_id = tb_kelurahan.id_kelurahan WHERE  tb_keluarga.status_kb = 'Tidak KB' ORDER BY tb_keluarga.kecamatan_id DESC, tb_keluarga.kelurahan_id DESC");
}

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=tidak-kb.csv');

$output = fopen('php://output', 'w');

while($row = mysqli_fetch_assoc($query)) {
    fputcsv($output, array(
        $row['nama_keluarga'],
        $row['kepala_keluarga'],
        $row['status_kb'],
        $row['keterangan_kb'],
        $row['alasan_kb'],
        $row['jumlah_anak'],
        $row['nama_kecamatan'],
        $row['nama_kelurahan']
    ));
}

fclose($output);
mysqli_close($konek);
?>
