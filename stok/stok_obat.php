<?php 
    include '../utilities/sidebar.php';
    include '../koneksi.php';
    $id_user = $_SESSION['id_user'];

    if(!isset($id_user)){
        header('Location: ../index.php');
    }

    $kec = $_GET['kec'];
    $query = mysqli_query($konek, "SELECT * FROM tb_stok LEFT JOIN tb_obat ON tb_stok.obat_id = tb_obat.id_obat LEFT JOIN tb_kecamatan ON tb_stok.kecamatan_id = tb_kecamatan.id_kecamatan WHERE tb_kecamatan.nama_kecamatan = '$kec' AND tb_stok.tgl_awal <= CURDATE() AND tb_stok.tgl_akhir >= CURDATE()");


?>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last"></div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="./wilayah.php">Wilayah</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Stok <?= $kec; ?></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="d-flex justify-content-between align-items-center">
                <div class="card-header">
                    <?= $kec ?>
                </div>
                <div class="buttons">
                    <a class="btn btn-secondary" style="margin-right:20px;" href="stok.php"><i class="fa fa-arrow-left"></i></a>
                    <a class="btn btn-primary" style="margin-right:20px;" href="create.php?kec=<?= $kec ?>"><i class="fa fa-plus"></i></a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>Obat/Alat</th>
                            <th>Stok Awal</th>
                            <th>Sisa Stok</th>
                            <th>Tanggal di Stok</th>
                            <th>Sampai Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $no = 0;
                    while ($row = $query->fetch_array()) {
                        $no++;
                    echo"
                        <tr>
                            <td>$row[nama_obat]</td>
                            <td>$row[stok_awal]</td>
                            <td>$row[stok_akhir]</td>
                            <td>$row[tgl_awal]</td>
                            <td>$row[tgl_akhir]</td>
                            <td>
                            <a href='update.php?kec=$kec&id=$row[0]' class='btn icon btn-primary'><i class='bi bi-pencil'></i></a>
                            <a href='delete.php?kec=$kec&id=$row[0]' onclick='return confirm(\" Hapus?\");' class='btn icon btn-danger'><i class='bi bi-trash'></i></a>
                            </td>
                        </tr>";
                    }?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

<?php 
include '../utilities/footer.php';
?>