<?php 
    include '../utilities/sidebar.php';
    include '../koneksi.php';
    include_once('../function/Kecamatan.php');
    include_once('../function/Kelurahan.php');

    $id_user = $_SESSION['id_user'];
    $kec = $_GET['kec'];
    $kel = $_GET['kel'];
    $id = $_GET['id'];

    if (!isset($id_user)) {
        header("Location: ../index.php");
    } else if(isset($id)){
        $q = mysqli_query($konek, "SELECT * FROM tb_keluarga LEFT JOIN tb_kelurahan ON tb_keluarga.kelurahan_id = tb_kelurahan.id_kelurahan LEFT JOIN tb_kecamatan ON tb_keluarga.kecamatan_id = tb_kecamatan.id_kecamatan WHERE tb_kecamatan.nama_kecamatan = '$kec' AND tb_keluarga.id_keluarga = '$id'");
        $row = $q->fetch_array();
    }
    
    if (isset($_POST['submit'])) {
        $kk = htmlspecialchars($_POST['no-kk']);
        $nik = htmlspecialchars($_POST['nik']);
        $nama = htmlspecialchars($_POST['nama']);
        $kepkel = htmlspecialchars($_POST['kepkel']);
        $tempat = htmlspecialchars($_POST['tempat']);
        $tgl = htmlspecialchars($_POST['tgl']);
        $alamat = htmlspecialchars($_POST['alamat']);
        $telp = htmlspecialchars($_POST['telp']);
        $status = htmlspecialchars($_POST['status']);
        $keterangan = htmlspecialchars($_POST['keterangan']);
        $jmlanak = htmlspecialchars($_POST['jmlanak']);
        $kecamatan = htmlspecialchars($_POST['kecamatan']);
        $kelurahan = htmlspecialchars($_POST['kelurahan']);

        $sql = "UPDATE tb_keluarga SET no_kk = '$kk', nik = '$nik', nama_keluarga = '$nama', kepala_keluarga = '$kepkel', tl_keluarga = '$tempat', lahir_keluarga = '$tgl', alamat_keluarga = '$alamat', telp_keluarga = '$telp', status_kb = '$status', keterangan_kb = '$keterangan', jumlah_anak ='$jmlanak', kecamatan_id = '$kecamatan', kelurahan_id = '$kelurahan' WHERE id_keluarga = '$id'";
        if (mysqli_query($konek, $sql)) {
            echo "<script>alert('Akseptor Berhasil di Update!');</script>";
            echo "<meta http-equiv='refresh' content='0; url=keluarga.php?kec=".$kec."&kel=".$kel."'>";
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
                        <li class="breadcrumb-item"><a href="kecamatan.php">Akseptor KB</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Akseptor KB <?= $kec ?></li>
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
                            <h4 class="card-title">Update Akseptor KB <?= $kel ?></h4>
                        </div>
                        <a class="btn btn-secondary" style="margin-right:28px;" href="keluarga.php?kec=<?= $kec ?>&kel=<?= $kel ?>"><i class="fa fa-arrow-left"></i></a>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form method="POST" class="form form-horizontal">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Nomor Kartu Keluarga</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="number" id="no-kk" class="form-control" name="no-kk" value="<?= $row['no_kk'] ?>" placeholder="68xxxxxxxxxxxxxx" required>
                                        </div>

                                        <div class="col-md-4">
                                            <label>NIK</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="number" id="nik" class="form-control" name="nik" value="<?= $row['nik'] ?>" placeholder="68xxxxxxxxxxxxxx" required>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <label>Nama</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" name="nama" id="nama" value="<?= $row['nama_keluarga'] ?>" class="form-control" placeholder="Nama Keluarga" required>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <label>Kepala Keluarga</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" id="kepkel" class="form-control" name="kepkel" value="<?= $row['kepala_keluarga'] ?>" placeholder="Kepala Keluarga" required>
                                        </div>

                                        <div class="col-md-4">
                                            <label>Tempat Lahir</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" name="tempat" id="tempat" value="<?= $row['tl_keluarga'] ?>" class="form-control" placeholder="Tempat Lahir" required>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <label>Tanggal Lahir</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="date" name="tgl" id="tgl" value="<?= $row['lahir_keluarga'] ?>" class="form-control" placeholder="Tanggal Lahir" required>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <label>Alamat</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" name="alamat" id="alamat" value="<?= $row['alamat_keluarga'] ?>" class="form-control" placeholder="Alamat" required>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <label>Telepon Aktif</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="number" name="telp" id="telp" value="<?= $row['telp_keluarga'] ?>" class="form-control" placeholder="No. Telepon/Whats App" required>
                                        </div>

                                        <div class="col-md-4">
                                            <label>Status KB</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <fieldset class="form-group">
                                                <select class="form-select" name="status" id="basicSelect" required>
                                                    <option selected hidden value="<?= $row['status_kb'] ?>"><?= $row['keterangan_kb'] ?></option>
                                                    <option value="KB">KB</option>
                                                    <option value="Tidak KB">Tidak KB</option>
                                                </select>
                                            </fieldset>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Keterangan KB</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" name="keterangan" id="keterangan" value="<?= $row['keterangan_kb'] ?>" class="form-control" placeholder="Keterangan">
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <label>Jumlah Anak</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="number" name="jmlanak" id="jmlanak" value="<?= $row['jumlah_anak'] ?>" class="form-control" placeholder="Jumlah Anak" required>
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