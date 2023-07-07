y<?php 
    include '../utilities/r-header.php';
    include '../koneksi.php';
    
    $id_user = $_SESSION['id_user'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    if(!isset($id_user)){
        header('Location: ../index.php');
    }
    
    if (isset($_POST['submit'])) {
        if(isset($start_date) && isset($end_date)){
            $query = mysqli_query($konek, "SELECT * FROM tb_intervensi LEFT JOIN tb_jenisinv ON tb_intervensi.jenis_id = tb_jenisinv.id_jenis LEFT JOIN tb_opd ON tb_intervensi.opd_id = tb_opd.id_opd LEFT JOIN tb_kecamatan ON tb_intervensi.kecamatan_id = tb_kecamatan.id_kecamatan LEFT JOIN tb_kelurahan ON tb_intervensi.kelurahan_id = tb_kelurahan.id_kelurahan WHERE tb_intervensi.agenda_intervensi = 'Agenda' AND tb_intervensi.tgl_intervensi BETWEEN '$start_date' AND '$end_date' ORDER BY tb_intervensi.id_intervensi DESC");
        }
    }
?>

<div style="display:flex;">
    <div style="justify-content: center; align-items: center; margin:auto;">
        <p style="font-size:22px; font-weight: bold; text-align:center;">Laporan Agenda Sosialisasi</p>
        <p style="font-size:16px; margin-top:-15px; text-align: center;"><?= date('d-m-Y', strtotime($start_date)); ?> s/d <?= date('d-m-Y', strtotime($end_date)); ?> </p>
    
        <table class='table table-stripped table-bordered mt-3 table-responsive demo'>

<thead>
    <tr>
        <th rowspan=3 style='text-align:center; vertical-align: middle;'>No</th>
        <th rowspan=3 style='text-align:center; vertical-align: middle;'>Judul</th>
        <th rowspan=3 style='text-align:center; vertical-align: middle;'>Deskripsi</th>
        <th rowspan=3 style='text-align:center; vertical-align: middle;'>Tanggal</th>
        <th rowspan=3 style='text-align:center; vertical-align: middle;'>Tempat</th>
        <th rowspan=3 style='text-align:center; vertical-align: middle;'>Kategori</th>
        <th rowspan=3 style='text-align:center; vertical-align: middle;'>OPD Terkait</th>
        <th rowspan=3 style='text-align:center; vertical-align: middle;'>Status</th>
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
            <td style='text-align:center;' class='td1'><?= $row['judul_intervensi']; ?></td>
            <td style='text-align:center;' class='td1'><?= $row['deskripsi_intervensi']; ?></td>
            <td style='text-align:center;' class='td1'><?= date('d-m-Y', strtotime($row['tgl_intervensi'])); ?></td>
            <td style='text-align:center;' class='td1'><?= $row['tempat_intervensi']; ?></td>
            <td style='text-align:center;' class='td1'><?= $row['nama_jenis']; ?></td>
            <td style='text-align:center;' class='td1'><?= $row['nama_opd']; ?></td>
            <td style='text-align:center;' class='td1'><?= $row['status_intervensi']; ?></td>
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