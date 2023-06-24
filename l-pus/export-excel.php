<?php
include '../koneksi.php';
$kategori = $_POST['kategori'];
$kecamatan_id = $_POST['kecamatan_id'];
$kelurahan_id = $_POST['kelurahan_id'];

if(isset($_POST['kecamatan_id']) && isset($_POST['kecamatan_id'])) {    
  if($kategori == 'PUS'){
    $query = mysqli_query($konek, "SELECT * FROM tb_keluarga LEFT JOIN tb_kecamatan ON tb_keluarga.kecamatan_id = tb_kecamatan.id_kecamatan LEFT JOIN tb_kelurahan ON tb_keluarga.kelurahan_id = tb_kelurahan.id_kelurahan WHERE DATE_SUB(CURDATE(), INTERVAL 50 YEAR) <= tb_keluarga.lahir_keluarga AND tb_keluarga.kecamatan_id = '$kecamatan_id' AND tb_keluarga.kelurahan_id = '$kelurahan_id' ORDER BY tb_keluarga.kecamatan_id DESC, tb_keluarga.kelurahan_id DESC");
  } else if($kategori == 'Non-PUS'){
    $query = mysqli_query($konek, "SELECT * FROM tb_keluarga LEFT JOIN tb_kecamatan ON tb_keluarga.kecamatan_id = tb_kecamatan.id_kecamatan LEFT JOIN tb_kelurahan ON tb_keluarga.kelurahan_id = tb_kelurahan.id_kelurahan WHERE DATE_SUB(CURDATE(), INTERVAL 49 YEAR) >= tb_keluarga.lahir_keluarga AND tb_keluarga.kecamatan_id = '$kecamatan_id' AND tb_keluarga.kelurahan_id = '$kelurahan_id' ORDER BY tb_keluarga.kecamatan_id DESC, tb_keluarga.kelurahan_id DESC");
  }
} else {
  $query = mysqli_query($konek, "SELECT * FROM tb_keluarga LEFT JOIN tb_kecamatan ON tb_keluarga.kecamatan_id = tb_kecamatan.id_kecamatan LEFT JOIN tb_kelurahan ON tb_keluarga.kelurahan_id = tb_kelurahan.id_kelurahan WHERE DATE_SUB(CURDATE(), INTERVAL 49 YEAR) >= tb_keluarga.lahir_keluarga ORDER BY tb_keluarga.kecamatan_id DESC, tb_keluarga.kelurahan_id DESC");
}

header('Content-Type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=laporan-data-PUS-Non-Pus.xlsx");

$output = fopen('php://output', 'w');

fwrite($output, "NIK\t");
fwrite($output, "Nama\t");
fwrite($output, "Alamat\t");
fwrite($output, "Tempat Tanggal Lahir\t");
fwrite($output, "Telepon\t");
fwrite($output, "Umur\t");
fwrite($output, "Kecamatan\t");
fwrite($output, "Kelurahan\n");

while($row = mysqli_fetch_assoc($query)) {
    $tanggalLahir = $row['lahir_keluarga'];
    $diff = date_diff(date_create($tanggalLahir), date_create(date('Y-m-d')));
    $umur = $diff->format('%y Tahun');
  
    fwrite($output, $row['nik'] . "\t");
    fwrite($output, $row['nama_keluarga'] . "\t");
    fwrite($output, $row['alamat_keluarga'] . "\t");
    fwrite($output, $row['tl_keluarga'] . ',' . $row['lahir_keluarga'] . "\t");
    fwrite($output, $row['telp_keluarga'] . "\t");
    fwrite($output, $umur . "\t");
    fwrite($output, $row['nama_kecamatan'] . "\t");
    fwrite($output, $row['nama_kelurahan'] . "\n");
}

fclose($output);
mysqli_close($konek);
?>
