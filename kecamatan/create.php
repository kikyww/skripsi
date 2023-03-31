<?php 
    include '../utilities/sidebar.php';
    include '../koneksi.php';
    $id_user = $_SESSION['id_user'];

    if (!isset($id_user)) {
        header("Location: ../index.php");
    }
    if (isset($_POST['submit'])) {
        $kecamatan = htmlspecialchars($_POST['kecamatan']);

        $num = mysqli_query($konek, "SELECT id_kecamatan FROM tb_kecamatan ORDER BY id_kecamatan DESC");
        if (mysqli_num_rows($num) > 0) {
            $num = mysqli_fetch_array($num);
            $idkecamatan = $num['id_kecamatan'] + 1;
        }else {
            $idkecamatan = 1;
        }
        $sql = "INSERT INTO tb_kecamatan (id_kecamatan, nama_kecamatan) VALUES ('$idkecamatan', '$kecamatan')";
        if (mysqli_query($konek, $sql)) {
            echo "<script>alert('Kecamatan telah berhasil ditambahkan!');</script>";
            echo '<meta http-equiv="refresh" content="0; url=kecamatan.php">';
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
                            <h4 class="card-title">Tambah Kecamatan</h4>
                        </div>
                        <a class="btn btn-secondary" style="margin-right:28px;" href="kecamatan.php"><i class="fa fa-arrow-left"></i></a>
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
                                            <input type="text" id="kecamatan" class="form-control" name="kecamatan"
                                                placeholder="Nama Kecamatan" required>
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
?>