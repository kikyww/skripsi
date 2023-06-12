<?php 
include '../utilities/sidebar.php';
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
                        <li class="breadcrumb-item"><a href="#">Wilayah</a></li>
                        <li class="breadcrumb-item active" aria-current="page"></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="row justify-content-center">
            <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Wilayah</h4>
                    </div>
                    <div class="card-body">
                        <h6>Kecamatan</h6>
                        <div class="d-flex">
                            <div class="buttons">
                                <a href="../kecamatan/kecamatan.php" class="btn btn-primary">Masuk</a>
                            </div>
                            <div class="buttons">
                                <a href="stok.php" class="btn btn-secondary">Stok Obat/Alat</a>
                            </div>
                        </div>
                            <hr>
                        <h6>Kelurahan</h6>
                        <div class="buttons">
                            <a href="../kelurahan/kelurahan.php" class="btn btn-primary">Masuk</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php 
include '../utilities/footer.php';
?>