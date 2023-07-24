<?php 
    include '../utilities/sidebar.php';
    include '../koneksi.php';
    $id_user = $_SESSION['id_user'];


    if(!isset($id_user)){
        header('Location: ../index.php');
    }

    $query = mysqli_query($konek, "SELECT *, COUNT(tb_intervensi.kunjungan_id) AS jumlah FROM tb_intervensi LEFT JOIN tb_jenisinv ON tb_intervensi.jenis_id = tb_jenisinv.id_jenis LEFT JOIN tb_opd AS o ON tb_intervensi.kunjungan_id = o.id_opd LEFT JOIN tb_kecamatan ON tb_intervensi.kecamatan_id = tb_kecamatan.id_kecamatan LEFT JOIN tb_kelurahan ON tb_intervensi.kelurahan_id = tb_kelurahan.id_kelurahan WHERE o.nama_opd <> 'Masyarakat Setempat' GROUP BY tb_intervensi.kunjungan_id ORDER BY tb_intervensi.id_intervensi ASC");

?>

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last"></div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Laporan Intervensi</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Laporan Kunjungan</li>
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
                    Laporan Kunjungan OPD
                </div>
                <div class="buttons">
                    <!-- <a href="./rincian.php" class="btn btn-primary" style="margin-right:30px;">Rincian</a> -->
                </div>
            </div>

            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Jumlah</th>
                            <th>Aksi</th>
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
                            <td><?= $row['nama_opd']; ?></td>
                            <td><?= $row['jumlah']; ?></td>
                            <td>
                                <a href="rincian.php?opd=<?=$row['nama_opd'] ?>" class="btn btn-primary"><i class="fa fa-book-open"></i></a>
                            </td>
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