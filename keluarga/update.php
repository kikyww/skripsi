<?php 
    include '../utilities/sidebar.php';
    include '../koneksi.php';
    include_once('../function/Kecamatan.php');
    include_once('../function/Kelurahan.php');

    $id_user = $_SESSION['id_user'];
    $kec = $_GET['kec'];
    $id = $_GET['id'];

    if (!isset($id_user)) {
        header("Location: ../index.php");
    } else if(isset($id)){
        $q = mysqli_query($konek, "SELECT * FROM tb_kepkel LEFT JOIN tb_kelurahan ON tb_kepkel.kelurahan_id = tb_kelurahan.id_kelurahan LEFT JOIN tb_kecamatan ON tb_kepkel.kecamatan_id = tb_kecamatan.id_kecamatan WHERE tb_kecamatan.nama_kecamatan = '$kec' AND tb_kepkel.id_kepkel = '$id'");
        $row = $q->fetch_array();
    }
    
    if (isset($_POST['submit'])) {
        $kk = htmlspecialchars($_POST['kk']);
        $nama = htmlspecialchars($_POST['nama']);
        $tempat = htmlspecialchars($_POST['tempat']);
        $tgl = htmlspecialchars($_POST['tgl']);
        $alamat = htmlspecialchars($_POST['alamat']);
        $jk = htmlspecialchars($_POST['jk']);
        $telp = htmlspecialchars($_POST['telp']);
        $kecamatan = htmlspecialchars($_POST['kecamatan']);
        $kelurahan = htmlspecialchars($_POST['kelurahan']);

        $sql = "UPDATE tb_kepkel SET no_kk = '$kk', nama_kepkel = '$nama', tl_kepkel = '$tempat', lahir_kepkel = '$tgl', alamat_kepkel = '$alamat', jk_kepkel = '$jk', telp_kepkel = '$telp', kecamatan_id = '$kecamatan', kelurahan_id = '$kelurahan' WHERE id_kepkel = '$id'";
        if (mysqli_query($konek, $sql)) {
            echo "<script>alert('Kepala Keluarga Berhasil di Update!');</script>";
            echo "<meta http-equiv='refresh' content='0; url=kepkel.php?kec=".$kec."'>";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($konek);
        }
    }
?>

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last"></div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="obat.php">Stok</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Update Stok</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section id="basic-horizontal-layouts">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="card-header">
                            <h4 class="card-title">Update Kepala Keluarga <?= $kec ?></h4>
                        </div>
                        <a class="btn btn-secondary" style="margin-right:28px;" href="kepkel.php?kec=<?= $kec ?>"><i class="fa fa-arrow-left"></i></a>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form method="POST" class="form form-horizontal">
                                <div class="form-body">
                                    <div class="row">
                                    <div class="col-md-4">
                                            <label>No. KK</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="number" id="kk" class="form-control" name="kk" value="<?= $row['no_kk'] ?>" placeholder="No. KK" required>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <label>Nama</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" name="nama" id="nama" value="<?= $row['nama_kepkel'] ?>" class="form-control" placeholder="Nama Kepala Keluarga" required>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <label>Tempat Lahir</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" name="tempat" id="tempat" value="<?= $row['tl_kepkel'] ?>" class="form-control" placeholder="Tempat Lahir" required>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <label>Tanggal Lahir</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="date" name="tgl" id="tgl" value="<?= $row['lahir_kepkel'] ?>" class="form-control" placeholder="Tanggal Lahir" required>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <label>Alamat</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" name="alamat" id="alamat" value="<?= $row['alamat_kepkel'] ?>" class="form-control" placeholder="Alamat Sekarang" required>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <label>Jenis Kelamin</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <fieldset class="form-group">
                                                <select class="form-select" name="jk" id="basicSelect" required>
                                                    <option value="<?= $row['jk_kepkel'] ?>" selected hidden><?= $row['jk_kepkel'] ?></option>
                                                    <option value="L">Laki-Laki</option>
                                                    <option value="P">Perempuan</option>
                                                </select>
                                            </fieldset>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <label>Telepon Aktif</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="number" name="telp" id="telp" value="<?= $row['telp_kepkel'] ?>" class="form-control" placeholder="No. Telepon/Whats App" required>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <label>Nama Kecamatan</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                        <?php
                                        $getKec = getKec();
                                        foreach ($getKec as $dataKec):
                                        ?>
                                            <input type="text" id="kecamatan" class="form-control" name="kecamatan" value="<?= $dataKec['id_kecamatan']; ?>" hidden required readonly >
                                        <?php endforeach; ?>
                                            <input type="text" class="form-control" placeholder="<?= $kec; ?>" readonly>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <label>Kelurahan</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <fieldset class="form-group">
                                                <select class="form-select" name="kelurahan" id="basicSelect" required>
                                                    <option value="<?= $row['kelurahan_id'] ?>" selected hidden><?= $row['nama_kelurahan'] ?></option>
                                                    <?php
                                                    $getKelurahan = getKelurahan();
                                                    foreach ($getKelurahan as $dataKelurahan):
                                                    ?>
                                                    <option value="<?= $dataKelurahan['id_kelurahan'] ?>"><?= $dataKelurahan['nama_kelurahan']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </fieldset>
                                        </div>
                                        <div class="col-sm-12 d-flex justify-content-end">
                                            <button type="submit" name="submit" id="success" class="btn btn-primary me-1 mb-1">Simpan</button>
                                            <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php 
    include '../utilities/footer.php';
    mysqli_close($konek);
?>