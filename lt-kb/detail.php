<?php 
    include '../utilities/sidebar.php';
    include '../koneksi.php';
    $id_user = $_SESSION['id_user'];

    if(!isset($id_user)){
        header('Location: ../index.php');
    }

    $query = mysqli_query($konek,"SELECT *, SUM(tb_keluarga.status_kb = 'Tidak KB') AS status, COUNT(tb_keluarga.id_keluarga) AS id_keluarga FROM tb_keluarga LEFT JOIN tb_kecamatan ON tb_keluarga.kecamatan_id = tb_kecamatan.id_kecamatan LEFT JOIN tb_kelurahan ON tb_keluarga.kelurahan_id = tb_kelurahan.id_kelurahan GROUP BY tb_keluarga.kecamatan_id ORDER BY tb_keluarga.kecamatan_id DESC, tb_keluarga.kelurahan_id DESC");


?>

    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last"></div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Laporan</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Laporan Tidak KB</li>
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
                    Detail Tidak KB
                </div>
                <div class="buttons">
                    <a class="btn btn-secondary" style="margin-right:20px;" href="report.php"><i class="fa fa-arrow-left"></i></a>
                </div>
            </div>

            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kecamatan</th>
                            <th>Jumlah Warga</th>
                            <th>Jumlah Tidak KB</th>
                            <th>Rincian</th>
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
                            <td><?= $row['nama_kecamatan']; ?></td>
                            <td><?= $row['id_keluarga']; ?></td>
                            <td><?= $row['status']; ?></td>
                            <td>
                                <a href="rincian.php?kec=<?=$row['nama_kecamatan'] ?>" class="btn btn-primary"><i class="fa fa-book-open"></i></a>
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