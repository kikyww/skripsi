<?php
include '../koneksi.php';

// query untuk mengambil data
$query = "SELECT *, SUM(tb_kb.jumlah_obat) AS jumlah FROM tb_kb LEFT JOIN tb_kelurahan ON tb_kb.kelurahan_id = tb_kelurahan.id_kelurahan LEFT JOIN tb_kecamatan ON tb_kb.kecamatan_id = tb_kecamatan.id_kecamatan LEFT JOIN tb_kepkel ON tb_kb.kepkel_id = tb_kepkel.id_kepkel LEFT JOIN tb_keluarga ON tb_kb.keluarga_id = tb_keluarga.id_keluarga LEFT JOIN tb_obat ON tb_kb.obat_id = tb_obat.id_obat LEFT JOIN tb_stok ON tb_kb.stok_id = tb_stok.id_stok GROUP BY tb_stok.id_stok";

$result = mysqli_query($konek, $query);

// mengambil data dan menyimpannya dalam array
$data = array();
while ($row = mysqli_fetch_assoc($result)) {
  $data[] = $row['jumlah'];
}

// mengirimkan data dalam format JSON
echo json_encode($data);

// menutup koneksi
mysqli_close($konek);
?>
