<?php
include '../koneksi.php';

$kec = $_GET['kec'];
$kel = $_GET['kel'];

$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];

$query = mysqli_query($konek, "SELECT * FROM tb_kb LEFT JOIN tb_kelurahan ON tb_kb.kelurahan_id = tb_kelurahan.id_kelurahan LEFT JOIN tb_kecamatan ON tb_kb.kecamatan_id = tb_kecamatan.id_kecamatan LEFT JOIN tb_kepkel ON tb_kb.kepkel_id = tb_kepkel.id_kepkel LEFT JOIN tb_keluarga ON tb_kb.keluarga_id = tb_keluarga.id_keluarga LEFT JOIN tb_obat ON tb_kb.obat_id = tb_obat.id_obat LEFT JOIN tb_stok ON tb_kb.stok_id = tb_stok.id_stok WHERE tb_kecamatan.nama_kecamatan = '$kec' AND tb_kelurahan.nama_kelurahan = '$kel' AND tb_kb.tgl_kb BETWEEN '$start_date' AND '$end_date'");

if ($query->num_rows > 0) {
    $no = 0;
    while ($row = $query->fetch_array()) {
        $no++;
        echo "
            <tr>
                <td>$no</td>
                <td>$row[nama_kepkel]</td>
                <td>$row[nama_keluarga]</td>
                <td>$row[alamat_kepkel]</td>
                <td>$row[tgl_kb]</td>
                <td>$row[nama_obat]</td>
                <td>$row[jumlah_obat]</td>
                <td>
                    <a href='update.php?kec=$kec&kel=$kel&id=$row[0]' class='btn icon btn-primary'><i class='bi bi-pencil'></i></a>
                    <a href='delete.php?kec=$kec&kel=$kel&id=$row[0]' onclick='return confirm(\"Hapus?\");' class='btn icon btn-danger'><i class='bi bi-trash'></i></a>
                </td>
            </tr>";
    }
} else {
    echo "<tr><td colspan='9'><center>Tidak ada data yang sesuai dengan filter tanggal.</center></td></tr>";
}
