<?php 
    include '../utilities/sidebar.php';
    include '../koneksi.php';
    $id_user = $_SESSION['id_user'];
    $kec = $_GET['kec'];
    $kel = $_GET['kel'];

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
                        <li class="breadcrumb-item active" aria-current="page">Intervensi</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="d-flex justify-content-between align-items-center">
                <div class="card-header">
                    Intervensi
                </div>
                <a class="btn btn-primary" style="margin-right:20px;" href="create.php?kec=<?= $kec ?>&kel=<?= $kel ?>"><i class="fa fa-plus"></i></a>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kegiatan</th>
                            <th>Tanggal</th>
                            <th>Jenis</th>
                            <th>Kategori</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $query = mysqli_query($konek, "SELECT * FROM tb_intervensi ORDER BY tgl_intervensi DESC");
                    $no = 0;
                    while ($row = $query->fetch_array()) {
                        $no++;
                    ?>
                        <tr>
                            <td><?= $no; ?></td>
                            <td><?= $row['judul_intervensi']; ?></td>
                            <td><?= date('d-m-Y', strtotime($row['tgl_intervensi'])); ?></td>
                            <td><?= $row['jenis_intervensi']; ?></td>
                            <td><?= $row['kategori_intervensi']; ?></td>
                            <td> 
                            <a href='update.php?id=$row[0]' class='btn icon btn-primary'><i class='bi bi-pencil'></i></a>
                            <a href='delete.php?id=$row[0]' onclick='return confirm(\" Hapus <?= $row["judul_intervensi"] ?> ?\");' class='btn icon btn-danger'><i class='bi bi-trash'></i></a>
                            </td>
                        </tr>";
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

<?php 
include '../utilities/footer.php';
?>