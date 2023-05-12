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
        
        $query = mysqli_query($konek, "SELECT * FROM tb_stok LEFT JOIN tb_obat ON tb_stok.obat_id = tb_obat.id_obat LEFT JOIN tb_kecamatan ON tb_stok.kecamatan_id = tb_kecamatan.id_kecamatan  WHERE tb_stok.tgl_awal BETWEEN '$start_date' AND '$end_date' ORDER BY tb_stok.stok_stamp ASC");
    }


?>

<div style="display:flex;">
    <div style="justify-content: center; align-items: center; margin:auto;">
        <p style="font-size:22px; font-weight: bold; text-align:center;">LAPORAN OBAT / ALAT KB</p>
        <p style="font-size:16px; margin-top:-15px; text-align: center;"> <?= date('d-m-Y', strtotime($start_date)); ?> s/d <?= date('d-m-Y', strtotime($end_date)); ?> </p>
    
        <table class='table table-stripped table-bordered mt-3 table-responsive demo'>

<thead>
    <tr>
        <th rowspan=3 style='text-align:center; vertical-align: middle;'>No</th>
        <th rowspan=3 style='text-align:center; vertical-align: middle;'>Obat / Alat KB</th>
        <th rowspan=3 style='text-align:center; vertical-align: middle;'>Stok Awal</th>
        <th rowspan=3 style='text-align:center; vertical-align: middle;'>Stok Sisa</th>
        <th rowspan=3 style='text-align:center; vertical-align: middle;'>Tanggal di Stok</th>
        <th rowspan=3 style='text-align:center; vertical-align: middle;'>Tanggal Pengembalian</th>        
        <th rowspan=3 style='text-align:center; vertical-align: middle;'>Kecamatan</th>       
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
            <td style='text-align:center;' class='td1'><?= $row['nama_obat']; ?></td>
            <td style='text-align:center;' class='td1'><?= $row['stok_awal']; ?></td>
            <td style='text-align:center;' class='td1'><?= $row['stok_akhir']; ?></td>
            <td style='text-align:center;' class='td1'><?= date('d-m-Y', strtotime($row['tgl_awal'])); ?></td>
            <td style='text-align:center;' class='td1'><?= date('d-m-Y', strtotime($row['tgl_akhir'])); ?></td>
            <td style='text-align:center;' class='td1'><?= $row['nama_kecamatan']; ?></td>
        </tr>
    <?php } ?>
</tbody>

</table>
    
    </div>
</div>

<?php 
    include '../utilities/r-footer.php';
?>