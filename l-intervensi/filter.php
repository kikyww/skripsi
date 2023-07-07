<?php
include '../koneksi.php';

$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];
$filKecamatan = $_POST['kecamatan_id'];
$filKelurahan = $_POST['kelurahan_id'];

$query = mysqli_query($konek, "SELECT * FROM tb_intervensi LEFT JOIN tb_kecamatan ON tb_intervensi.kecamatan_id = tb_kecamatan.id_kecamatan LEFT JOIN tb_kelurahan ON tb_intervensi.kelurahan_id = tb_kelurahan.id_kelurahan LEFT JOIN tb_jenisinv ON tb_intervensi.jenis_id = tb_jenisinv.id_jenis WHERE tb_intervensi.kecamatan_id = '$filKecamatan' AND tb_intervensi.kelurahan_id = '$filKelurahan' AND tb_intervensi.status_intervensi = 'Selesai' AND tb_intervensi.tgl_intervensi BETWEEN '$start_date' AND '$end_date' ORDER BY tb_intervensi.id_intervensi DESC");

if ($query->num_rows > 0) {
    $no = 0;
    while ($row = $query->fetch_array()) {
        $no++;
        echo"
        <tr>
        <td class=text-center> $no </td>
        <td class=text-center> $row[judul_intervensi] </td>
        <td class=text-center> $row[deskripsi_intervensi] </td>
        <td class=text-center> $row[tgl_intervensi] </td>
        <td class=text-center> $row[nama_jenis] </td>
        <td class=text-center> $row[tempat_intervensi] </td>
        <td class=text-center> $row[nama_kecamatan] </td>
        <td class=text-center> $row[nama_kelurahan] </td>
        </tr>";
    }
} else {
    echo "<tr><td colspan='9'><center>Tidak ada data yang sesuai dengan filter tanggal.</center></td></tr>";
}

