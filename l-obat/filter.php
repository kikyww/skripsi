<?php
include '../koneksi.php';

$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];

$query = mysqli_query($konek, "SELECT * FROM tb_stok LEFT JOIN tb_obat ON tb_stok.obat_id = tb_obat.id_obat LEFT JOIN tb_kecamatan ON tb_stok.kecamatan_id = tb_kecamatan.id_kecamatan WHERE tb_stok.tgl_awal BETWEEN '$start_date' AND '$end_date' ORDER BY tb_stok.stok_stamp DESC");

if ($query->num_rows > 0) {
    $no = 0;
    while ($row = $query->fetch_array()) {
        $no++;
        ?>
        <tr>
            <td><?= $no; ?></td>
            <td><?= $row['nama_obat']; ?></td>
            <td><?= $row['stok_awal']; ?></td>
            <td><?= $row['stok_akhir']; ?></td>
            <td><?= date('d-m-Y', strtotime($row['tgl_awal'])); ?></td>
            <td><?= date('d-m-Y', strtotime($row['tgl_akhir'])); ?></td>
            <td><?= $row['nama_kecamatan']; ?></td>
        </tr>
    <?php } 
} else {
    echo "<tr><td colspan='9'><center>Tidak ada data yang sesuai dengan filter tanggal.</center></td></tr>";
}

