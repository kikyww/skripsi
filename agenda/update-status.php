<?php
include '../koneksi.php';

// Periksa apakah permintaan dikirim melalui metode POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Pastikan Anda telah memasang koneksi ke database sebelumnya

  // Dapatkan data yang dikirim melalui permintaan POST
  $id = $_POST['id'];
  $statusIntervensi = $_POST['statusIntervensi'];

  // Lakukan validasi data jika diperlukan

  // Lakukan perbaruan data di database
  // Gantikan "nama_tabel" dengan nama tabel yang sesuai dalam database Anda
  $query = "UPDATE tb_intervensi SET status_intervensi = '$statusIntervensi' WHERE id_intervensi = $id";
  
  // Jalankan query
  $result = mysqli_query($konek, $query);

  if ($result) {
    // Jika berhasil memperbarui data
    echo "Data berhasil diperbarui";
  } else {
    // Jika terjadi kesalahan saat memperbarui data
    echo "Terjadi kesalahan saat memperbarui data";
  }
}
?>
