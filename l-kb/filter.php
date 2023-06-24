<?php
include '../koneksi.php';

$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];

$query = mysqli_query($konek, "SELECT * FROM tb_kb LEFT JOIN tb_kelurahan ON tb_kb.kelurahan_id = tb_kelurahan.id_kelurahan LEFT JOIN tb_kecamatan ON tb_kb.kecamatan_id = tb_kecamatan.id_kecamatan LEFT JOIN tb_keluarga ON tb_kb.keluarga_id = tb_keluarga.id_keluarga LEFT JOIN tb_obat ON tb_kb.obat_id = tb_obat.id_obat LEFT JOIN tb_stok ON tb_kb.stok_id = tb_stok.id_stok WHERE tb_kb.tgl_kb BETWEEN '$start_date' AND '$end_date' ORDER BY tb_kecamatan.nama_kecamatan DESC, tb_kelurahan.nama_kelurahan ASC");

if ($query->num_rows > 0) {
    $no = 0;
    while ($row = $query->fetch_array()) {
        $no++;
        echo "
            <tr>
                <td>$no</td>
                <td>$row[nik]</td>
                <td>$row[nama_keluarga]</td>
                <td>$row[kepala_keluarga]</td>
                <td>$row[tgl_kb]</td>
                <td>$row[tgl_kembali]</td>
                <td>$row[nama_obat]</td>
                <td>$row[jumlah_obat]</td>
                <td>$row[nama_kecamatan]</td>
                <td>$row[nama_kelurahan]</td>
            </tr>";
    }
} else {
    echo "<tr><td colspan='9'><center>Tidak ada data yang sesuai dengan filter tanggal.</center></td></tr>";
}
