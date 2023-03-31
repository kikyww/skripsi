<?php 
    include '../utilities/sidebar.php';
    include '../koneksi.php';
    $id_user = $_SESSION['id_user'];
    $id = $_GET['id'];

    if (!isset($id_user)) {
        header("Location: ../index.php");
    } else if(isset($id)){
        $q = mysqli_query($konek, "SELECT * FROM tb_obat WHERE id_obat = '$id'");
        $row = $q->fetch_array();
    }
    
    if (isset($_POST['submit'])) {
        $obat = htmlspecialchars($_POST['obat']);
        $jenis = htmlspecialchars($_POST['jenis']);

        $sql = "UPDATE tb_obat SET jenis_obat = '$jenis', nama_obat = '$obat' WHERE id_obat = '$id'";
        if (mysqli_query($konek, $sql)) {
            echo "<script>alert('Obat Berhasil di Ubah!');</script>";
            echo '<meta http-equiv="refresh" content="0; url=obat.php">';
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
                        <li class="breadcrumb-item"><a href="obat.php">Obat</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah Obat</li>
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
                            <h4 class="card-title">Tambah Obat</h4>
                        </div>
                        <a class="btn btn-secondary" style="margin-right:28px;" href="obat.php"><i class="fa fa-arrow-left"></i></a>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form method="POST" class="form form-horizontal">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Nama Obat/Alat</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" id="obat" class="form-control" name="obat" value="<?= $row['nama_obat'] ?>" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Jenis Obat</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <fieldset class="form-group">
                                                <select class="form-select" name="jenis" id="basicSelect" required>
                                                    <option value="" selected hidden><?= $row['jenis_obat'] ?></option>
                                                    <option value="Non-MKJP">Non-MKJP</option>
                                                    <option value="MKJP">MKJP</option>
                                                </select>
                                            </fieldset>
                                        </div>
                                        <div class="col-sm-12 d-flex justify-content-end">
                                            <button type="submit" name="submit" id="success" class="btn btn-primary me-1 mb-1">Ubah</button>
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