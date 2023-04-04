<?php 
    include '../utilities/sidebar.php';
    include '../koneksi.php';
    $id_user = $_SESSION['id_user'];

    if(!isset($id_user)){
        header('Location: ../index.php');
    }
    $kec = $_GET['kec'];
    // $query = mysqli_query($konek, "SELECT * FROM tb_keluarga LEFT JOIN tb_kepkel ON tb_keluarga.kepkel_id = tb_kepkel.id_kepkel LEFT JOIN tb_kb ON tb_keluarga.kb_id = tb_kb.kb_id WHERE tb_kepkel.kecamatan_id = '$kec'");
    $query = mysqli_query($konek, "SELECT tb_keluarga.*, tb_kepkel.*, tb_kecamatan.nama_kecamatan, tb_kelurahan.nama_kelurahan
    FROM tb_keluarga
    INNER JOIN tb_kepkel ON tb_keluarga.kepkel_id = tb_kepkel.id_kepkel
    INNER JOIN tb_kecamatan ON tb_kepkel.kecamatan_id = tb_kecamatan.id_kecamatan 
    INNER JOIN tb_kelurahan ON tb_kepkel.kelurahan_id = tb_kelurahan.id_kelurahan;
    ");
?>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last"></div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="kepkel.php">Keluarga</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Kepala Keluarga</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="d-flex justify-content-between align-items-center">
                <div class="card-header">
                    Kepala Keluarga <?= $kec ?>
                </div>
                <div class="buttons">
                    <a class="btn btn-secondary" style="margin-right:20px;" href="kecamatan.php"><i class="fa fa-arrow-left"></i></a>
                    <a class="btn btn-primary" style="margin-right:20px;" href="create.php?kec=<?= $kec ?>"><i class="fa fa-plus"></i></a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No. KK</th>
                            <th>Nama</th>
                            <th>TTL</th>
                            <th>Alamat</th>
                            <th>Jenis Kelamin</th>
                            <th>Telepon</th>
                            <th>Kelurahan</th>
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
                            <td>$no</td>
                            <td>$row[no_kk]</td>
                            <td>$row[nama_kepkel]</td>
                            <td>$row[tl_kepkel], $row[lahir_kepkel]</td>
                            <td>$row[alamat_kepkel]</td>
                            <td>$row[jk_kepkel]</td>
                            <td>$row[telp_kepkel]</td>
                            <td>$row[nama_kelurahan]</td>
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