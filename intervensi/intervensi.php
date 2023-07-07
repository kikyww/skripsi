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
                            <th>Judul Intervensi</th>
                            <th>Tanggal</th>
                            <th>Jenis</th>
                            <th>Tempat</th>
                            <th>Foto</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $query = mysqli_query($konek, "SELECT * FROM tb_intervensi LEFT JOIN tb_jenisinv ON tb_intervensi.jenis_id = tb_jenisinv.id_jenis LEFT JOIN tb_kecamatan ON tb_intervensi.kecamatan_id = tb_kecamatan.id_kecamatan LEFT JOIN tb_kelurahan ON tb_intervensi.kelurahan_id = tb_kelurahan.id_kelurahan WHERE tb_kecamatan.nama_kecamatan = '$kec' AND tb_kelurahan.nama_kelurahan = '$kel' AND tb_intervensi.status_intervensi = 'Selesai' ORDER BY tb_intervensi.tgl_intervensi DESC");
                    $no = 0;
                    while ($row = $query->fetch_array()) {
                        $no++;
                    ?>
                        <tr>
                            <td><?= $no; ?></td>
                            <td><?= $row['judul_intervensi']; ?></td>
                            <td><?= date('d-m-Y', strtotime($row['tgl_intervensi'])); ?></td>
                            <td><?= $row['nama_jenis']; ?></td>
                            <td><?= $row['tempat_intervensi']; ?></td>
                            <td><a href="open_image.php?id=<?= $row[0] ?>" target="_blank">Lihat Gambar</a></td>
                            <td> 
                                <a href='update.php?id=<?= $row[0] ?>&kec=<?= $kec ?>&kel=<?= $kel ?>' class='btn icon btn-primary'><i class='bi bi-pencil'></i></a>
                                <?php echo"
                                <a href='delete.php?id=$row[0]&kec=$kec&kel=$kel' onclick='return confirm(\" Hapus $row[judul_intervensi] ?\");' class='btn icon btn-danger'><i class='bi bi-trash'></i></a>
                            </td>
                        </tr>";
                    } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

<?php 
include '../utilities/footer.php';
?>