<?php 
    include '../utilities/r-header.php';
    include '../koneksi.php';
    
    $id_user = $_SESSION['id_user'];
    $kecamatan_id = $_POST['kecamatan_id'];
    $kelurahan_id = $_POST['kelurahan_id'];
    $kategori = $_POST['kategori'];

    if(!isset($id_user)){
        header('Location: ../index.php');
    }
    
    if (isset($_POST['submit'])) {
        if ($kategori == 'PUS') {
            $query = mysqli_query($konek, "SELECT * FROM tb_keluarga INNER JOIN tb_kepkel ON tb_keluarga.kepkel_id = tb_kepkel.id_kepkel INNER JOIN tb_kecamatan ON tb_keluarga.kecamatan_id = tb_kecamatan.id_kecamatan LEFT JOIN tb_kelurahan ON tb_keluarga.kelurahan_id = tb_kelurahan.id_kelurahan WHERE DATE_SUB(CURDATE(), INTERVAL 50 YEAR) <= tb_keluarga.lahir_keluarga AND tb_keluarga.kecamatan_id = '$kecamatan_id' AND tb_keluarga.kelurahan_id = '$kelurahan_id' ORDER BY tb_keluarga.kecamatan_id DESC, tb_keluarga.kelurahan_id DESC");
        } else if ($kategori == 'Non-PUS') {
            $query = mysqli_query($konek, "SELECT * FROM tb_keluarga INNER JOIN tb_kepkel ON tb_keluarga.kepkel_id = tb_kepkel.id_kepkel INNER JOIN tb_kecamatan ON tb_keluarga.kecamatan_id = tb_kecamatan.id_kecamatan LEFT JOIN tb_kelurahan ON tb_keluarga.kelurahan_id = tb_kelurahan.id_kelurahan WHERE DATE_SUB(CURDATE(), INTERVAL 49 YEAR) >= tb_keluarga.lahir_keluarga AND tb_keluarga.kecamatan_id = '$kecamatan_id' AND tb_keluarga.kelurahan_id = '$kelurahan_id' ORDER BY tb_keluarga.kecamatan_id DESC, tb_keluarga.kelurahan_id DESC");
        }
    }


?>

<div style="display:flex;">
    <div style="justify-content: center; align-items: center; margin:auto;">
        <p style="font-size:22px; font-weight: bold; text-align:center;">Laporan Data <?= $kategori ?></p>
        <?php 
        $getQuery = mysqli_query($konek, "SELECT * FROM tb_keluarga LEFT JOIN tb_kecamatan ON tb_keluarga.kecamatan_id = tb_kecamatan.id_kecamatan LEFT JOIN tb_kelurahan ON tb_keluarga.kelurahan_id = tb_kelurahan.id_kelurahan WHERE tb_keluarga.kecamatan_id = '$kecamatan_id' AND tb_keluarga.kelurahan_id = '$kelurahan_id'");
        $data = $getQuery->fetch_assoc();
        ?>
        <p style="font-size:16px; margin-top:-15px; text-align: center;"> Kecamatan <?= $data['nama_kecamatan']; ?>, Kelurahan <?= $data['nama_kelurahan']; ?> </p>
    
        <table class='table table-stripped table-bordered mt-3 table-responsive demo'>

<thead>
    <tr>
        <th rowspan=3 style='text-align:center; vertical-align: middle;'>No</th>
        <th rowspan=3 style='text-align:center; vertical-align: middle;'>Nama</th>
        <th rowspan=3 style='text-align:center; vertical-align: middle;'>Alamat</th>
        <th rowspan=3 style='text-align:center; vertical-align: middle;'>Tempat Tanggal Lahir</th>
        <th rowspan=3 style='text-align:center; vertical-align: middle;'>Umur</th>
    </tr>
</thead>

<tbody>
    <?php
        $no = 0;
        while ($row = $query->fetch_array()) {
            $no++;
            $tanggalLahir = $row['lahir_keluarga'];
            $diff = date_diff(date_create($tanggalLahir), date_create(date('Y-m-d')));
            $umur = $diff->format('%y Tahun');
        ?>
        <tr>
                <td style='text-align:center;' class='td1'><?= $no ?></td>
                <td style='text-align:center;' class='td1'><?= $row['nama_keluarga'] ?></td>
                <td style='text-align:center;' class='td1'><?= $row['alamat_kepkel'] ?></td>
                <td style='text-align:center;' class='td1'><?= $row['tl_keluarga'] ?>, <?= date('d-m-Y', strtotime($row['lahir_keluarga'])) ?></td>
                <td style='text-align:center;' class='td1'><?= $umur ?></td>
        </tr>
    <?php } ?>
</tbody>

</table>
    
    </div>
</div>

<?php 
    include '../utilities/r-footer.php';
?>