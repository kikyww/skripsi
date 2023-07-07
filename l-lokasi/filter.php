<?php
include '../koneksi.php';

$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];

$query = mysqli_query($konek, "SELECT * FROM tb_kb LEFT JOIN tb_kecamatan ON tb_kb.kecamatan_id = tb_kecamatan.id_kecamatan LEFT JOIN tb_kelurahan ON tb_kb.kelurahan_id = tb_kelurahan.id_kelurahan WHERE tb_kb.tgl_kb BETWEEN '$start_date' AND '$end_date' GROUP BY tb_kb.tgl_kb ORDER BY tb_kb.tgl_kb DESC");

if ($query->num_rows > 0) {
    $no = 0;
    while ($row = $query->fetch_array()) {
        $no++;
        echo "
            <tr>
                <td>$no</td>
                <td>$row[nama_kelurahan]</td>
                <td>". date('d-m-Y', strtotime($row['tgl_kb'])) ."</td>
            </tr>";
    }
} else {
    echo "<tr><td colspan='9'><center>Tidak ada data yang sesuai dengan filter tanggal.</center></td></tr>";
}
