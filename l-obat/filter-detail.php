<?php
include '../koneksi.php';

$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];

$query = mysqli_query($konek, "SELECT *, SUM(tb_kb.jumlah_obat) AS jumlah FROM tb_kb LEFT JOIN tb_kelurahan ON tb_kb.kelurahan_id = tb_kelurahan.id_kelurahan LEFT JOIN tb_kecamatan ON tb_kb.kecamatan_id = tb_kecamatan.id_kecamatan LEFT JOIN tb_keluarga ON tb_kb.keluarga_id = tb_keluarga.id_keluarga LEFT JOIN tb_obat ON tb_kb.obat_id = tb_obat.id_obat LEFT JOIN tb_stok ON tb_kb.stok_id = tb_stok.id_stok WHERE tb_stok.tgl_awal BETWEEN '$start_date' AND '$end_date' GROUP BY tb_stok.id_stok ORDER BY tb_stok.stok_stamp DESC");

if ($query->num_rows > 0) {
    $no = 0;
    while ($row = $query->fetch_array()) {
        $no++;
        ?>
        <tr>
            <td><?= $no; ?></td>
            <td><?= $row['nama_kecamatan']; ?></td>
            <td><?= $row['nama_obat']; ?></td>
            <td><?= $row['jumlah']; ?></td>
            <td><?= date('d-m-Y', strtotime($row['tgl_awal'])); ?></td>
            <td><button class="btn btn-primary">Detail</button></td>
        </tr>
    <?php } 
} else {
    echo "<tr><td colspan='9'><center>Tidak ada data yang sesuai dengan filter tanggal.</center></td></tr>";
}

