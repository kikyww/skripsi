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
                        <li class="breadcrumb-item active" aria-current="page">Catatan Intervensi</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="d-flex justify-content-between align-items-center">
                <div class="card-header">
                    Catatan Intervensi
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul Intervensi</th>
                            <th>Tanggal Intervensi</th>
                            <th>Isi Catatan</th>
                            <th>Saran</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $dates = date('Y-m-d');
                    $query = mysqli_query($konek, "SELECT * FROM tb_catatan LEFT JOIN tb_intervensi ON tb_catatan.intervensi_id = tb_intervensi.id_intervensi ORDER BY tb_intervensi.tgl_intervensi DESC");
                    $no = 0;
                    while ($row = $query->fetch_array()) {
                        $no++;
                    ?>
                        <tr>
                            <td><?= $no; ?></td>
                            <td><?= $row['judul_intervensi']; ?></td>
                            <td><?= date('d-m-Y', strtotime($row['tgl_intervensi'])); ?></td>
                            <td><?= $row['isi_catatan']; ?></td>
                            <td><?= $row['saran_catatan']; ?></td>
                            <td>
                                <a href='update.php?id=<?= $row[0] ?>' class='btn icon btn-primary'><i class='bi bi-pencil'></i></a>
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