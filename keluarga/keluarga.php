<?php 
    include '../utilities/sidebar.php';
    include '../koneksi.php';
    $id_user = $_SESSION['id_user'];

    if(!isset($id_user)){
        header('Location: ../index.php');
    }
    $kec = $_GET['kec'];
    $kel = $_GET['kel'];
    $query = mysqli_query($konek, "SELECT * FROM tb_keluarga LEFT JOIN tb_kelurahan ON tb_keluarga.kelurahan_id = tb_kelurahan.id_kelurahan LEFT JOIN tb_kecamatan ON tb_keluarga.kecamatan_id = tb_kecamatan.id_kecamatan LEFT JOIN tb_kepkel ON tb_keluarga.kepkel_id = tb_kepkel.id_kepkel WHERE tb_kecamatan.nama_kecamatan = '$kec' AND tb_kelurahan.nama_kelurahan = '$kel'");
?>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last"></div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="kepkel.php">Keluarga</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Keluarga <?= $kec ?></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="d-flex justify-content-between align-items-center">
                <div class="card-header">
                    Keluarga <?= $kel ?>
                </div>
                <div class="buttons">
                    <a class="btn btn-secondary" style="margin-right:20px;" href="kelurahan.php?kec=<?= $kec ?>"><i class="fa fa-arrow-left"></i></a>
                    <a class="btn btn-primary" style="margin-right:20px;" href="create.php?kec=<?= $kec ?>&kel=<?= $kel ?>"><i class="fa fa-plus"></i></a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kepala Keluarga</th>
                            <th>Nama</th>
                            <th>TTL</th>
                            <th>Alamat</th>
                            <th>Jenis Kelamin</th>
                            <th>Telepon</th>
                            <th>Status KB</th>
                            <th>Jumlah Anak</th>
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
                            <td><?= $no ?></td>
                            <td><?=$row['nama_kepkel']?></td>
                            <td><?=$row['nama_keluarga']?></td>
                            <td><?=$row['tl_keluarga']?>, <?= date('d-m-Y', strtotime($row['lahir_keluarga'])) ?></td>
                            <td><?=$row['alamat_kepkel']?></td>
                            <td><?=$row['jk_keluarga']?></td>
                            <td><?=$row['telp_keluarga']?></td>
                            <td><?=$row['status_kb']?></td>
                            <td><?=$row['jumlah_anak']?></td>
                            <td>
                            <a href='update.php?kec=<?= $kec ?>&kel=<?= $kel ?>&id=<?= $row[0] ?>' class='btn icon btn-primary'><i class='bi bi-pencil'></i></a>
                            <a href='delete.php?kec=<?= $kec ?>&kel=<?= $kel ?>&id=<?= $row[0] ?>' onclick='return confirm(\" Hapus?\");' class='btn icon btn-danger'><i class='bi bi-trash'></i></a>
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