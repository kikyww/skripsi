<?php 
include '../utilities/sidebar.php';
include '../koneksi.php';
include_once('../function/Kelurahan.php');
$id_user = $_SESSION['id_user'];
$kec = $_GET['kec'];

if (!isset($id_user)) {
    header('Location: ../index.php');
}

?>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last"></div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Tidak KB</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Pilih Kelurahan</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h4>Kelurahan</h4>
                    </div>
                    <form method="GET" action="t-kb.php" class="">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="col-md-8 form-group">
                                    <input type="hidden" name="kec" value="<?= $kec ?>">
                                    <fieldset class="form-group">
                                        <select class="form-select" name="kel" id="basicSelect" required>
                                            <option value="" selected hidden>Pilih Kelurahan</option>
                                            <?php
                                            $getKelurahan = getKelurahan();
                                            foreach($getKelurahan as $row):
                                            ?>
                                            <option value="<?= $row['nama_kelurahan'] ?>"><?= $row['nama_kelurahan']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </fieldset>
                                </div>
                                <div class="buttons" style="margin-left : 1rem">
                                    <button type="submit" class="btn btn-primary">Masuk</button>
                                    <a href="kecamatan.php" class="btn btn-secondary"><i class="fa fa-arrow-left"></i></a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
<?php 
include '../utilities/footer.php';
?>