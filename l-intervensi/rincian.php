<?php 
    include '../utilities/sidebar.php';
    include '../koneksi.php';
    $id_user = $_SESSION['id_user'];
    $kec = $_GET['kec'];

    if(!isset($id_user)){
        header('Location: ../index.php');
    }

    $query = mysqli_query($konek, "SELECT *, SUM(tb_intervensi.status_intervensi = 'Selesai') AS jumlah FROM tb_intervensi LEFT JOIN tb_kelurahan ON tb_intervensi.kelurahan_id = tb_kelurahan.id_kelurahan LEFT JOIN tb_kecamatan ON tb_intervensi.kecamatan_id = tb_kecamatan.id_kecamatan WHERE tb_intervensi.status_intervensi = 'Selesai' tb_kecamatan.nama_kecamatan = '$kec' GROUP BY tb_kelurahan.id_kelurahan ORDER BY tb_kelurahan.nama_kelurahan ASC");

?>

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last"></div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Laporan</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Laporan Obat/Alat</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

    <section class="section">
        <div class="card">
            <div class="d-flex justify-content-between align-items-center">
                <div class="card-header">
                    <h4>Rincian Total Kegiatan Pada Kecamatan <?= $kec ?></h4>
                </div>
                <div class="buttons">
                    <a class="btn btn-secondary" style="margin-right:20px;" href="detail.php"><i class="fa fa-arrow-left"></i></a>
                </div>
            </div>

            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kelurahan</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $no = 0;
                    while ($row = $query->fetch_array()) {
                        $no++;
                    ?>
                        <tr>
                            <td><?= $no; ?></td>
                            <td><?= $row['nama_kelurahan']; ?></td>
                            <td><?= $row['jumlah']; ?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

<?php 
    include '../utilities/footer.php';
?>