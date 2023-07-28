<?php
include '../koneksi.php';

$filKecamatan = $_POST['kecamatan_id'];
$filKelurahan = $_POST['kelurahan_id'];

$query = mysqli_query($konek, "SELECT * FROM tb_keluarga LEFT JOIN tb_kecamatan ON tb_keluarga.kecamatan_id = tb_kecamatan.id_kecamatan LEFT JOIN tb_kelurahan ON tb_keluarga.kelurahan_id = tb_kelurahan.id_kelurahan WHERE tb_keluarga.kecamatan_id = '$filKecamatan' AND tb_keluarga.kelurahan_id = '$filKelurahan' AND tb_keluarga.status_kb = 'Tidak KB' ORDER BY tb_keluarga.kecamatan_id DESC, tb_keluarga.kelurahan_id DESC");

if ($query->num_rows > 0) {
    $no = 0;
    while ($row = $query->fetch_array()) {
        $no++;
        echo"
        <tr>
        <td class=text-center> $no </td>
        <td class=text-center> $row[nik] </td>
        <td class=text-center> $row[nama_keluarga] </td>
        <td class=text-center> $row[kepala_keluarga] </td>
        <td class=text-center> $row[status_kb] </td>
        <td class=text-center> $row[keterangan_kb] </td>";
        
            if ($row['alasan_kb'] == true) {
                echo"<td class=text-center>$row[alasan_kb]</td>";
            } else {
                echo"<td class=text-center text-muted>-</td>";
            }
        echo"
        <td class=text-center> $row[jumlah_anak] </td>
        <td class=text-center> $row[nama_kecamatan] </td>
        <td class=text-center> $row[nama_kelurahan] </td>
        
        </tr>";
    }
} else {
    echo "<tr><td colspan='9'><center>Tidak ada data yang sesuai dengan filter tanggal.</center></td></tr>";
}

