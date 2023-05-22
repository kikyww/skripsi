<?php 
    include '../utilities/r-header.php';
    include '../koneksi.php';
    
    $id_user = $_SESSION['id_user'];
    $kecamatan_id = $_POST['kecamatan_id'];
    $kelurahan_id = $_POST['kelurahan_id'];

    if(!isset($id_user)){
        header('Location: ../index.php');
    }
    
    if (isset($_POST['submit'])) {
        $kecamatan_id = $_POST['kecamatan_id'];
        $kelurahan_id = $_POST['kelurahan_id'];
        
        $query = mysqli_query($konek, "SELECT * FROM tb_keluarga INNER JOIN tb_kepkel ON tb_keluarga.kepkel_id = tb_kepkel.id_kepkel INNER JOIN tb_kecamatan ON tb_keluarga.kecamatan_id = tb_kecamatan.id_kecamatan LEFT JOIN tb_kelurahan ON tb_keluarga.kelurahan_id = tb_kelurahan.id_kelurahan WHERE tb_keluarga.kecamatan_id = '$kecamatan_id' AND tb_keluarga.kelurahan_id = '$kelurahan_id' AND tb_keluarga.status_kb = 'Tidak KB' ORDER BY tb_keluarga.kecamatan_id DESC, tb_keluarga.kelurahan_id DESC");
    }


?>

<div style="display:flex;">
    <div style="justify-content: center; align-items: center; margin:auto;">
        <p style="font-size:22px; font-weight: bold; text-align:center;">LAPORAN TIDAK MENGIKUTI PROGRAM KB</p>
        <?php 
        $getQuery = mysqli_query($konek, "SELECT * FROM tb_keluarga LEFT JOIN tb_kecamatan ON tb_keluarga.kecamatan_id = tb_kecamatan.id_kecamatan LEFT JOIN tb_kelurahan ON tb_keluarga.kelurahan_id = tb_kelurahan.id_kelurahan WHERE tb_keluarga.kecamatan_id = '$kecamatan_id' AND tb_keluarga.kelurahan_id = '$kecamatan_id'");
        $data = $getQuery->fetch_assoc();
        ?>
        <p style="font-size:16px; margin-top:-15px; text-align: center;"> Kecamatan <?= $data['nama_kecamatan']; ?>, Kelurahan <?= $data['nama_kelurahan']; ?> </p>
    
        <table class='table table-stripped table-bordered mt-3 table-responsive demo'>

<thead>
    <tr>
        <th rowspan=3 style='text-align:center; vertical-align: middle;'>No</th>
        <th rowspan=3 style='text-align:center; vertical-align: middle;'>Nama</th>       
        <th rowspan=3 style='text-align:center; vertical-align: middle;'>Kepala Keluarga</th>       
        <th rowspan=3 style='text-align:center; vertical-align: middle;'>Status KB</th>       
        <th rowspan=3 style='text-align:center; vertical-align: middle;'>Alasan</th>       
        <th rowspan=3 style='text-align:center; vertical-align: middle;'>Keterangan</th>       
        <th rowspan=3 style='text-align:center; vertical-align: middle;'>Jumlah Anak</th>      
    </tr>
</thead>

<tbody>
    <?php
        $no = 0;
        while ($row = $query->fetch_array()) {
            $no++;
        ?>
        <tr>
                <td style='text-align:center;' class='td1'><?= $no ?></td>
                <td style='text-align:center;' class='td1'><?= $row['nama_keluarga'] ?></td>
                <td style='text-align:center;' class='td1'><?= $row['nama_kepkel'] ?></td>
                <td style='text-align:center;' class='td1'><?= $row['status_kb'] ?></td>
                <td style='text-align:center;' class='td1'><?= $row['keterangan_kb'] ?></td>
                <?php 
                    if ($row['alasan_kb'] == true) {
                        echo"<td style='text-align:center;' class='td1'>$row[alasan_kb]</td>";
                    } else {
                        echo"<td style='text-align:center;' class='td1'>-</td>";
                    }
                ?>
                <td style='text-align:center;' class='td1'><?= $row['jumlah_anak'] ?></td>
        </tr>
    <?php } ?>
</tbody>

</table>
    
    </div>
</div>

<?php 
    include '../utilities/r-footer.php';
?>