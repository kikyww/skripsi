<?php 
    include '../utilities/sidebar.php';
    include '../koneksi.php';
    $id_user = $_SESSION['id_user'];

    if (!isset($id_user)) {
        header("Location: ../index.php");
    }
    if (isset($_POST['submit'])) {
        $obat = htmlspecialchars($_POST['obat']);
        $jenis = htmlspecialchars($_POST['jenis']);

        $num = mysqli_query($konek, "SELECT id_obat FROM tb_obat ORDER BY id_obat DESC");
        if (mysqli_num_rows($num) > 0) {
            $num = mysqli_fetch_array($num);
            $idobat = $num['id_obat'] + 1;
        }else {
            $idobat = 1;
        }
        $sql = "INSERT INTO tb_obat (id_obat, jenis_obat, nama_obat) VALUES ('$idobat', '$jenis', '$obat')";
        if (mysqli_query($konek, $sql)) {
            echo "<script>alert('Obat berhasil di tambahkan')</script>";
            echo '<meta http-equiv="refresh" content="0; url=obat.php">';
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
                                            <input type="text" id="obat" class="form-control" name="obat"
                                                placeholder="Nama Obat/Alat" autocomplete="off" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Jenis Obat</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <fieldset class="form-group">
                                                <select class="form-select" name="jenis" id="basicSelect" required>
                                                    <option value="" selected hidden>Pilih Salah Satu</option>
                                                    <option value="Non-MKJP">Non-MKJP</option>
                                                    <option value="MKJP">MKJP</option>
                                                </select>
                                            </fieldset>
                                        </div>
                                        <div class="col-sm-12 d-flex justify-content-end">
                                            <button type="submit" name="submit" class="btn btn-primary me-1 mb-1">Tambah</button>
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

</script>
<?php 
    include '../utilities/footer.php';
    mysqli_close($konek);
?>