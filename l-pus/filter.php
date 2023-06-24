<?php
include '../koneksi.php';

$kecamatan_id = $_POST['kecamatan_id'];
$kelurahan_id = $_POST['kelurahan_id'];
$kategori = $_POST['kategori'];
if ($kategori == true) {
    $query = mysqli_query($konek, "SELECT *, SUM(DATE_SUB(CURDATE(), INTERVAL 49 YEAR) >= tb_keluarga.lahir_keluarga) AS age_nonpus, SUM(DATE_SUB(CURDATE(), INTERVAL 50 YEAR) <= tb_keluarga.lahir_keluarga) AS age_pus FROM tb_keluarga LEFT JOIN tb_kecamatan ON tb_keluarga.kecamatan_id = tb_kecamatan.id_kecamatan LEFT JOIN tb_kelurahan ON tb_keluarga.kelurahan_id = tb_kelurahan.id_kelurahan WHERE tb_keluarga.kecamatan_id = '$kecamatan_id' AND tb_keluarga.kelurahan_id = '$kelurahan_id' GROUP BY tb_keluarga.kecamatan_id, tb_keluarga.kelurahan_id ORDER BY tb_keluarga.kecamatan_id DESC, tb_keluarga.kelurahan_id DESC");
}
if ($query->num_rows > 0) {
    $no = 0;
    while ($row = $query->fetch_array()) {
        $no++;
        echo"
        <tr>
            <td class=text-center> $no </td>
            <td class=text-center> $row[nama_kecamatan] </td>
            <td class=text-center> $row[nama_kelurahan] </td>
            <td class=text-center> $row[age_pus] </td>
            <td class=text-center> $row[age_nonpus] </td>
        </tr>";
    }
} else {
    echo "<tr><td colspan='9'><center>Tidak ada data yang sesuai.</center></td></tr>";
}

