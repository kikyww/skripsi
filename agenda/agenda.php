<?php 
    include '../utilities/sidebar.php';
    include '../koneksi.php';
    $id_user = $_SESSION['id_user'];

    if(!isset($id_user)){
        header('Location: ../index.php');
    }
?>

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last"></div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Intervensi</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Agenda Intervensi</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="d-flex justify-content-between align-items-center">
                <div class="card-header">
                    Agenda Intervensi
                </div>
                <a class="btn btn-primary" style="margin-right:20px;" href="create.php"><i class="fa fa-plus"></i></a>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul Kegiatan</th>
                            <th>Tanggal</th>
                            <th>Tempat</th>
                            <th>Instansi Terkait</th>
                            <th>Status</th>
                            <th>Kecamatan</th>
                            <th>Kelurahan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $dates = date('Y-m-d');
                    $query = mysqli_query($konek, "SELECT * FROM tb_intervensi LEFT JOIN tb_kecamatan ON tb_intervensi.kecamatan_id = tb_kecamatan.id_kecamatan LEFT JOIN tb_kelurahan ON tb_intervensi.kelurahan_id = tb_kelurahan.id_kelurahan LEFT JOIN tb_opd ON tb_intervensi.opd_id = tb_opd.id_opd WHERE tb_intervensi.agenda_intervensi = 'Agenda' ORDER BY tb_intervensi.status_intervensi DESC");
                    $no = 0;
                    while ($row = $query->fetch_array()) {
                        $no++;
                    ?>
                        <tr>
                            <td><?= $no; ?></td>
                            <td><?= $row['judul_intervensi']; ?></td>
                            <td><?= date('d-m-Y', strtotime($row['tgl_intervensi'])); ?></td>
                            <td><?= $row['tempat_intervensi']; ?></td>
                            <td><?= $row['nama_opd']; ?></td>
                            <td><?= $row['status_intervensi'] ?></td>
                            <td><?= $row['nama_kecamatan']; ?></td>
                            <td><?= $row['nama_kelurahan']; ?></td>
                            <td>
                            <?php if ($row['status_intervensi'] == 'Belum' &&  $dates >= $row['tgl_intervensi'] ) { ?>
                                <a href='update-status.php?status=Selesai&id=<?= $row[0] ?>' onclick='return confirm(" Intervensi Selesai? ");' class='btn icon btn-primary'><i class='bi bi-check-lg'></i></a>
                                <a href='update-status.php?status=Ditunda&id=<?= $row[0] ?>' onclick='return confirm(" Intervensi Ditunda? ");' class='btn icon btn-danger'><i class='bi bi-x-lg'></i></a>
                            </td>
                            <?php }if($row['status_intervensi'] == 'Selesai' || $row['status_intervensi'] == 'Ditunda'){ ?>
                                <a href='../catatan/create.php?id=<?= $row[0] ?>' class='btn icon btn-warning'><i class='bi bi-book-half'></i></a>

                            <?php } ?>
                            <td>
                                <a href='update-agenda.php?id=<?= $row[0] ?>' class='btn icon btn-primary'><i class='bi bi-pencil'></i></a>
                                <a href='delete.php?id=<?= $row[0] ?>' onclick='return confirm(" Hapus <?= $row["judul_intervensi"] ?>?");' class='btn icon btn-danger'><i class='bi bi-trash'></i></a>
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