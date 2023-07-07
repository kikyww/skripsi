<?php 
    include '../utilities/r-header.php';
    include '../koneksi.php';
    
    $id_user = $_SESSION['id_user'];
    $filKecamatan = $_POST['kecamatan_id'];
    $filKelurahan = $_POST['kelurahan_id'];
    $opd = $_GET['opd'];
    if(!isset($id_user)){
        header('Location: ../index.php');
    }
    
    if (isset($_POST['submit'])) {
        if(isset($filKecamatan) && isset($filKelurahan)){
            $query = mysqli_query($konek, "SELECT * FROM tb_intervensi LEFT JOIN tb_jenisinv ON tb_intervensi.jenis_id = tb_jenisinv.id_jenis LEFT JOIN tb_opd AS o ON tb_intervensi.kunjungan_id = o.id_opd LEFT JOIN tb_kecamatan ON tb_intervensi.kecamatan_id = tb_kecamatan.id_kecamatan LEFT JOIN tb_kelurahan ON tb_intervensi.kelurahan_id = tb_kelurahan.id_kelurahan WHERE o.nama_opd <> 'Masyarakat Setempat' AND o.nama_opd = '$opd' AND tb_intervensi.kecamatan_id = '$filKecamatan' AND tb_intervensi.kelurahan_id = '$filKelurahan' AND tb_intervensi.status_intervensi = 'Selesai' ORDER BY tb_intervensi.tgl_intervensi DESC");
        } 
    }
?>

<div style="display:flex;">
    <div style="justify-content: center; align-items: center; margin:auto;">
        <p style="font-size:22px; font-weight: bold; text-align:center;">Laporan Kunjungan <?= $opd ?></p>
    
        <table class='table table-stripped table-bordered mt-3 table-responsive demo'>

<thead>
    <tr>
        <th rowspan=3 style='text-align:center; vertical-align: middle;'>No</th>
        <th rowspan=3 style='text-align:center; vertical-align: middle;'>Judul</th>
        <th rowspan=3 style='text-align:center; vertical-align: middle;'>Deskripsi</th>
        <th rowspan=3 style='text-align:center; vertical-align: middle;'>Tanggal</th>
        <th rowspan=3 style='text-align:center; vertical-align: middle;'>Jenis</th>
        <th rowspan=3 style='text-align:center; vertical-align: middle;'>Tempat</th>
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
            <td style='text-align:center;' class='td1'><?= $row['judul_intervensi']; ?></td>
            <td style='text-align:center;' class='td1'><?= $row['deskripsi_intervensi']; ?></td>
            <td style='text-align:center;' class='td1'><?= date('d-m-Y', strtotime($row['tgl_intervensi'])); ?></td>
            <td style='text-align:center;' class='td1'><?= $row['nama_jenis']; ?></td>
            <td style='text-align:center;' class='td1'><?= $row['tempat_intervensi']; ?></td>
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