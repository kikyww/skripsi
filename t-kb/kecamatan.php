<?php 
include '../utilities/sidebar.php';
include '../koneksi.php';
include_once('../function/Kecamatan.php');
$id_user = $_SESSION['id_user'];

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
                        <li class="breadcrumb-item active" aria-current="page">Pilih Kecamatan</li>
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
                        <h4>Kecamatan</h4>
                    </div>
                    <form method="GET" action="kelurahan.php" class="">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="col-md-8 form-group">
                                    <fieldset class="form-group">
                                        <select class="form-select" name="kec" id="basicSelect" required>
                                            <option value="" selected hidden>Pilih Kecamatan</option>
                                            <?php
                                            $getKecamatan = getKecamatan();
                                            foreach($getKecamatan as $row):
                                            ?>
                                            <option value="<?= $row['nama_kecamatan'] ?>"><?= $row['nama_kecamatan']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </fieldset>
                                </div>
                                <div class="buttons" style="margin-left : 1rem">
                                    <button type="submit" class="btn btn-primary">Masuk</button>
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