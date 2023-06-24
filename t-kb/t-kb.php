<?php 
    include '../utilities/sidebar.php';
    include '../koneksi.php';
    $id_user = $_SESSION['id_user'];

    if(!isset($id_user)){
        header('Location: ../index.php');
    }
    $kec = $_GET['kec'];
    $kel = $_GET['kel'];
    $query = mysqli_query($konek, "SELECT * FROM tb_keluarga LEFT JOIN tb_kecamatan ON tb_keluarga.kecamatan_id = tb_kecamatan.id_kecamatan LEFT JOIN tb_kelurahan ON tb_keluarga.kelurahan_id = tb_kelurahan.id_kelurahan WHERE tb_kecamatan.nama_kecamatan = '$kec' AND tb_kelurahan.nama_kelurahan = '$kel' AND tb_keluarga.status_kb = 'Tidak KB'");


?>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last"></div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="kb.php">Tidak KB</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Kecamatan <?= $kec ?></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="d-flex justify-content-between align-items-center">
                <div class="card-header">
                    Kelurahan <?= $kel ?>
                </div>
                <div class="buttons">
                    <a class="btn btn-secondary" style="margin-right:20px;" href="kelurahan.php?kec=<?= $kec ?>"><i class="fa fa-arrow-left"></i></a>
                    <a class="btn btn-primary" style="margin-right:30px;" href="create.php?kec=<?= $kec ?>&kel=<?= $kel ?>"><i class="fa fa-plus"></i></a>
                </div>
            </div>

            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th class="text-center">NIK</th>
                            <th class="text-center">Nama</th>
                            <th class="text-center">Kepala Keluarga</th>
                            <th class="text-center">Status KB</th>
                            <th class="text-center">Alasan</th>
                            <th class="text-center">Keterangan</th>
                            <th class="text-center">Jumlah Anak</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $no = 0;
                    while ($row = $query->fetch_array()) {
                        $no++;
                    ?> 
                        <tr>
                            <td class="text-center"><?= $row['nik'] ?></td>
                            <td class="text-center"><?= $row['nama_keluarga'] ?></td>
                            <td class="text-center"><?= $row['kepala_keluarga'] ?></td>
                            <td class="text-center"><?= $row['status_kb'] ?></td>
                            <td class="text-center"><?= $row['keterangan_kb'] ?></td>
                            <?php 
                                if ($row['alasan_kb'] == true) {
                                    echo"<td class='text-center'>$row[alasan_kb]</td>";
                                } else {
                                    echo"<td class='text-center text-muted'>-</td>";
                                }
                            ?>
                            <td class='text-center'><?= $row['jumlah_anak'] ?></td>
                            <td class="text-center">
                                <a href='update.php?kec=<?= $kec ?>&kel=<?= $kel ?>&id=<?= $row[0] ?>' class='btn icon btn-primary'><i class='bi bi-pencil'></i></a>
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