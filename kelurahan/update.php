<?php 
    include '../utilities/sidebar.php';
    include '../koneksi.php';
    include_once('../function/Kecamatan.php');
    $id_user = $_SESSION['id_user'];
    $id = $_GET['id'];

    if (!isset($id_user)) {
        header("Location: ../index.php");
    } else if(isset($id)){
        $q = mysqli_query($konek, "SELECT * FROM tb_kelurahan LEFT JOIN tb_kecamatan ON tb_kelurahan.kecamatan_id = tb_kecamatan.id_kecamatan WHERE id_kelurahan = '$id'");
        $row = $q->fetch_array();
    }
    
    if (isset($_POST['submit'])) {
        $kelurahan = htmlspecialchars($_POST['kelurahan']);
        $kecamatan = htmlspecialchars($_POST['kecamatan']);

        $sql = "UPDATE tb_kelurahan SET kecamatan_id = '$kecamatan', nama_kelurahan = '$kelurahan' WHERE id_kelurahan = '$id'";
        if (mysqli_query($konek, $sql)) {
            echo "<script>alert('$row[nama_kelurahan] Berhasil di Ubah!');</script>";
            echo '<meta http-equiv="refresh" content="0; url=kelurahan.php">';
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
                        <li class="breadcrumb-item"><a href="kelurahan.php">kelurahan</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah kelurahan</li>
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
                            <h4 class="card-title">Tambah kelurahan</h4>
                        </div>
                        <a class="btn btn-secondary" style="margin-right:28px;" href="kelurahan.php"><i class="fa fa-arrow-left"></i></a>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form method="POST" class="form form-horizontal">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Nama kelurahan</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" id="kelurahan" class="form-control" name="kelurahan" value="<?= $row['nama_kelurahan'] ?>" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Jenis Obat</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <fieldset class="form-group">
                                                <select class="form-select" name="kecamatan" id="basicSelect" required>
                                                    <option value="" selected hidden><?= $row['nama_kecamatan']; ?></option>
                                                    <?php
                                                    $getKecamatan = getKecamatan();
                                                    foreach($getKecamatan as $data):
                                                    ?>
                                                    <option value="<?= $data['id_kecamatan'] ?>"><?= $data['nama_kecamatan']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </fieldset>
                                        </div>
                                        <div class="col-sm-12 d-flex justify-content-end">
                                            <button type="submit" name="submit" class="btn btn-primary me-1 mb-1">Simpan</button>
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