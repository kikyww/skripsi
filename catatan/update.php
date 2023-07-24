<?php 
    include '../utilities/sidebar.php';
    include '../koneksi.php';
    $id_user = $_SESSION['id_user'];
    $id = $_GET['id'];

    if (!isset($id_user)) {
        header("Location: ../index.php");
    } else if(isset($id)){
        $q = mysqli_query($konek, "SELECT * FROM tb_catatan WHERE id_catatan = '$id'");
        $row = $q->fetch_array();
    }
    
    if (isset($_POST['submit'])) {
        $judul = htmlspecialchars($_POST['judul']);
        $isi = htmlspecialchars($_POST['isi']);
        $saran = htmlspecialchars($_POST['saran']);

        $sql = "UPDATE tb_catatan SET judul_catatan = '$judul', isi_catatan = '$isi', saran_catatan = '$saran' WHERE id_catatan = '$id'";
        if (mysqli_query($konek, $sql)) {
            echo "<script>alert('Catatan Berhasil di Ubah!');</script>";
            echo '<meta http-equiv="refresh" content="0; url=./catatan.php">';
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($konek);
        }
    }
    mysqli_close($konek);
?>

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last"></div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="kecamatan.php">Intervensi</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Catatan</li>
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
                            <h4 class="card-title">Edit Catatan</h4>
                        </div>
                        <a class="btn btn-secondary" style="margin-right:28px;" href="kecamatan.php"><i class="fa fa-arrow-left"></i></a>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form method="POST" class="form form-horizontal">
                                <div class="form-body">
                                    <div class="row">

                                        <div class="col-md-4">
                                            <label>Judul Catatan</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" id="judul" class="form-control" name="judul" value="<?= $row['judul_catatan'] ?>" required>
                                        </div>

                                        <div class="col-md-4">
                                            <label>Isi Catatan</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" id="isi" class="form-control" name="isi" value="<?= $row['isi_catatan'] ?>" required>
                                        </div>

                                        <div class="col-md-4">
                                            <label>Saran</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" id="saran" class="form-control" name="saran" value="<?= $row['saran_catatan'] ?>" required>
                                        </div>

                                        <div class="col-sm-12 d-flex justify-content-end">
                                            <button type="submit" name="submit" id="success" class="btn btn-primary me-1 mb-1">Simpan</button>
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
?>