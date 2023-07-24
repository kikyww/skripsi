<?php
include '../koneksi.php';

$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];

$query = mysqli_query($konek, "SELECT * FROM tb_intervensi LEFT JOIN tb_jenisinv ON tb_intervensi.jenis_id = tb_jenisinv.id_jenis LEFT JOIN tb_opd ON tb_intervensi.opd_id = tb_opd.id_opd LEFT JOIN tb_kecamatan ON tb_intervensi.kecamatan_id = tb_kecamatan.id_kecamatan LEFT JOIN tb_kelurahan ON tb_intervensi.kelurahan_id = tb_kelurahan.id_kelurahan WHERE tb_intervensi.agenda_intervensi = 'Agenda' AND tb_intervensi.tgl_intervensi BETWEEN '$start_date' AND '$end_date' ORDER BY tb_intervensi.tgl_intervensi DESC");

if ($query->num_rows > 0) {
    $no = 0;
    while ($row = $query->fetch_array()) {
        $no++;
        echo"
        <tr>
        <td class='text-center'> $no </td>
        <td class='text-center'> $row[judul_intervensi] </td>
        <td class='text-center'> $row[deskripsi_intervensi] </td>
        <td class='text-center'> " . date('d-m-Y', strtotime($row['tgl_intervensi'])) . "</td>
        <td class='text-center'> $row[tempat_intervensi] </td>
        <td class='text-center'> $row[nama_jenis] </td>
        <td class='text-center'> $row[nama_opd] </td>
        <td class='text-center'> $row[status_intervensi] </td>";

        if ($row['saran_catatan'] == true) {
            echo"<td class='text-center'>$row[saran_catatan]</td>";
        } else {
            echo"<td class='text-center'>-</td>";
        }

        echo"
        <td class='text-center'> $row[nama_kecamatan] </td>
        <td class='text-center'> $row[nama_kelurahan] </td>
        </tr>";
    }
} else {
    echo "<tr><td colspan='9'><center>Tidak ada data yang sesuai dengan filter tanggal.</center></td></tr>";
}

