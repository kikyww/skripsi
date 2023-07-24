<?php 
    include '../utilities/sidebar.php';
    include '../koneksi.php';
    $id_user = $_SESSION['id_user'];
    $id = $_GET['username'];

    if (!isset($id_user)) {
        header("Location: ../index.php");
    } else if(isset($id)){
        $q = mysqli_query($konek, "SELECT * FROM tb_user WHERE username = '$id'");
        $row = $q->fetch_array();
    }
?>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last"></div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="./list.php">Akun</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Daftar Akun</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

    <section class="section">
        <div class="col-xl-8">
            <div class="card">
                <div class="card-body pt-3">
                    <h5 class="card-title">Detail Profil</h5>
                    <div class="row mb-3">
                        <div class="col-lg-3 col-md-4 label">Username</div>
                        <div class="col-lg-9 col-md-8"><?= $row['username'] ?></div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-lg-3 col-md-4 label">NIP</div>
                        <div class="col-lg-9 col-md-8"><?= $row['nip'] ?></div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-lg-3 col-md-4 label ">Nama</div>
                        <div class="col-lg-9 col-md-8"><?= $row['nama'] ?></div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-lg-3 col-md-4 label">No. Telepon</div>
                        <div class="col-lg-9 col-md-8"><?= $row['telepon'] ?></div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-lg-3 col-md-4 label">Wilayah</div>
                        <div class="col-lg-9 col-md-8"><?= $row['wilayah'] ?></div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-lg-3 col-md-4 label">Jabatan</div>
                        <div class="col-lg-9 col-md-8"><?= $row['roles'] ?></div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-lg-3 col-md-4 label">Password</div>
                        <div class="col-lg-9 col-md-8"><?= $row['password'] ?></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php 
include '../utilities/footer.php';
?>