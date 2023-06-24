<?php 
    include '../utilities/r-header.php';
    include '../koneksi.php';
    
    $id_user = $_SESSION['id_user'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    if(!isset($id_user)){
        header('Location: ../index.php');
    }
    
    if (isset($_POST['submit'])) {
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        
        $query = mysqli_query($konek, "SELECT * FROM tb_kb LEFT JOIN tb_kelurahan ON tb_kb.kelurahan_id = tb_kelurahan.id_kelurahan LEFT JOIN tb_kecamatan ON tb_kb.kecamatan_id = tb_kecamatan.id_kecamatan LEFT JOIN tb_keluarga ON tb_kb.keluarga_id = tb_keluarga.id_keluarga LEFT JOIN tb_obat ON tb_kb.obat_id = tb_obat.id_obat LEFT JOIN tb_stok ON tb_kb.stok_id = tb_stok.id_stok WHERE tb_kb.tgl_kb BETWEEN '$start_date' AND '$end_date' ORDER BY tb_kecamatan.nama_kecamatan ASC, tb_kelurahan.nama_kelurahan ASC");
    }


?>

<div style="display:flex;">
    <div style="justify-content: center; align-items: center; margin:auto;">
        <p style="font-size:22px; font-weight: bold; text-align:center;">LAPORAN KB</p>
        <p style="font-size:16px; margin-top:-15px; text-align: center;"> <?= date('d-m-Y', strtotime($start_date)); ?> s/d <?= date('d-m-Y', strtotime($end_date)); ?> </p>
    
        <table class='table table-stripped table-bordered mt-3 table-responsive demo'>

<thead>
    <tr>
        <th rowspan=3 style='text-align:center; vertical-align: middle;'>No</th>
        <th rowspan=3 style='text-align:center; vertical-align: middle;'>NIK</th>
        <th rowspan=3 style='text-align:center; vertical-align: middle;'>Akseptor</th>
        <th rowspan=3 style='text-align:center; vertical-align: middle;'>Kepala Keluarga</th>
        <th rowspan=3 style='text-align:center; vertical-align: middle;'>Tempat Tanggal Lahir</th>
        <th rowspan=3 style='text-align:center; vertical-align: middle;'>Tanggal KB</th>
        <th rowspan=3 style='text-align:center; vertical-align: middle;'>Obat / Alat KB</th>        
        <th rowspan=3 style='text-align:center; vertical-align: middle;'>Anak</th>        
        <th rowspan=3 style='text-align:center; vertical-align: middle;'>Kecamatan</th>        
        <th rowspan=3 style='text-align:center; vertical-align: middle;'>Kelurahan</th>        
    </tr>
</thead>

<tbody>
    <?php
        $no = 0;
        while ($row = $query->fetch_array()) {
            $no++;
        ?>
            <tr>
            <td style='text-align:center;' class='td1'><?= $no; ?></td>
                <td style='text-align:center;' class='td1'><?= $row['nik']; ?></td>
                <td style='text-align:center;' class='td1'><?= $row['nama_keluarga']; ?></td>
                <td style='text-align:center;' class='td1'><?= $row['kepala_keluarga']; ?></td>
                <td style='text-align:center;' class='td1'><?= $row['tl_keluarga']; ?>, <?= date('d-m-Y', strtotime($row['lahir_keluarga'])); ?></td>
                <td style='text-align:center;' class='td1'><?= date('d-m-Y', strtotime($row['tgl_kb'])); ?></td>
                <td style='text-align:center;' class='td1'><?= $row['nama_obat']; ?></td>
                <td style='text-align:center;' class='td1'><?= $row['jumlah_anak']; ?></td>
                <td style='text-align:center;' class='td1'><?= $row['nama_kecamatan']; ?></td>
                <td style='text-align:center;' class='td1'><?= $row['nama_kelurahan']; ?></td>
            </tr>
       <?php } ?>
</tbody>

</table>
    
    </div>
</div>

<?php 
    include '../utilities/r-footer.php';
?>