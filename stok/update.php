<?php 
    include '../utilities/sidebar.php';
    include '../koneksi.php';
    include_once('../function/Obat.php');

    $id_user = $_SESSION['id_user'];
    $kec = $_GET['kec'];
    $id = $_GET['id'];

    if (!isset($id_user)) {
        header("Location: ../index.php");
    } else if(isset($id)){
        $q = mysqli_query($konek, "SELECT * FROM tb_stok LEFT JOIN tb_obat ON tb_stok.obat_id = tb_obat.id_obat LEFT JOIN tb_kecamatan ON tb_stok.kecamatan_id = tb_kecamatan.id_kecamatan WHERE tb_kecamatan.nama_kecamatan = '$kec' AND tb_stok.id_stok = '$id'");
        $row = $q->fetch_array();
    }
    
    if (isset($_POST['submit'])) {
        $kecamatan = htmlspecialchars($_POST['kecamatan']);
        $obat = htmlspecialchars($_POST['obat']);
        $jumlah = htmlspecialchars($_POST['jumlah']);
        $tgl_awal = htmlspecialchars($_POST['tgl_awal']);
        $tgl_akhir = htmlspecialchars($_POST['tgl_akhir']);
        
        if ($row['stok_awal'] == $row['stok_akhir']){
            $sql = "UPDATE tb_stok SET kecamatan_id = '$kecamatan', obat_id = '$obat', stok_awal = '$jumlah', stok_akhir = '$jumlah', tgl_awal = '$tgl_awal', tgl_akhir = '$tgl_akhir' WHERE id_stok = '$id'";
        } else {
            // $sql = "UPDATE tb_stok SET kecamatan_id = '$kecamatan', obat_id = '$obat', stok_awal = '$jumlah', tgl_awal = '$tgl_awal', tgl_akhir = '$tgl_akhir' WHERE id_stok = '$id'";
            echo "<script>alert('Stok Gagal di Update! Hubungi Admin untuk melihat lebih lanjut');</script>";
            echo "<meta http-equiv='refresh' content='0; url=stok_obat.php?kec=".$kec."'>";
        }
        if (mysqli_query($konek, $sql)) {
            echo "<script>alert('Stok Berhasil di Update!');</script>";
            echo "<meta http-equiv='refresh' content='0; url=stok_obat.php?kec=".$kec."'>";
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
                            <h4 class="card-title">Update Stok <?= $kec ?></h4>
                        </div>
                        <a class="btn btn-secondary" style="margin-right:28px;" href="stok_obat.php?kec=<?= $kec ?>"><i class="fa fa-arrow-left"></i></a>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form method="POST" class="form form-horizontal">
                                <div class="form-body">
                                    <div class="row">

                                        <div class="col-md-4">
                                            <label>Nama Kecamatan</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                        <?php
                                        $q = mysqli_query($konek, "SELECT * FROM tb_kecamatan WHERE nama_kecamatan = '$kec'");
                                        while($dataKecamatan = $q->fetch_array()){
                                        ?>
                                            <input type="text" id="kecamatan" class="form-control" name="kecamatan" value="<?= $dataKecamatan['id_kecamatan']; ?>" hidden required readonly >
                                        <?php } ?>
                                            <input type="text" class="form-control" placeholder="<?= $kec; ?>" readonly>
                                        </div>

                                        <div class="col-md-4">
                                            <label>Obat/Alat</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <fieldset class="form-group">
                                                <select class="form-select" name="obat" id="basicSelect" required>
                                                    <option value="<?= $row['id_obat'] ?>" selected hidden><?= $row['nama_obat'] ?></option>
                                                    <?php
                                                    $getObat = getObat();
                                                    foreach ($getObat as $dataObat):
                                                    ?>
                                                    <option value="<?= $dataObat['id_obat'] ?>"><?= $dataObat['nama_obat']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </fieldset>
                                        </div>

                                        <div class="col-md-4">
                                            <label>Jumlah Obat/Alat</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="number" id="jumlah" class="form-control" name="jumlah" placeholder="Jumlah Obat/Alat" value="<?= $row['stok_awal'] ?>" required>
                                        </div>

                                        <div class="col-md-4">
                                            <label>Tanggal Awal</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="date" value="<?= $row['tgl_awal'] ?>" class="form-control" name="tgl_awal" placeholder="Tanggal" autocomplete="off" required>
                                        </div>

                                        <div class="col-md-4">
                                            <label>Sampai Tanggal</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="date" value="<?= $row['tgl_akhir'] ?>" class="form-control" name="tgl_akhir" placeholder="Tanggal" autocomplete="off" required>
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