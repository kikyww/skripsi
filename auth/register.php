<?php 
    include '../utilities/sidebar.php';
    include '../koneksi.php';
    include_once('../function/Kecamatan.php');

    $id_user = $_SESSION['id_user'];

    if (!isset($id_user)) {
        header("Location: ../index.php");
    }
    if (isset($_POST['submit'])) {
        $nip = htmlspecialchars($_POST['nip']);
        $nama = htmlspecialchars($_POST['nama']);
        $telepon = htmlspecialchars($_POST['telepon']);
        $wilayah = htmlspecialchars($_POST['wilayah']);
        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);
        $role = htmlspecialchars($_POST['role']);

        $num = mysqli_query($konek, "SELECT id_user FROM tb_user ORDER BY id_user DESC");
        if (mysqli_num_rows($num) > 0) {
            $num = mysqli_fetch_array($num);
            $iduser = $num['id_user'] + 1;
        }else {
            $iduser = 1;
        }
        $sql = "INSERT INTO tb_user (id_user, nip, nama, telepon, wilayah, username, password, roles) VALUES ('$iduser', '$nip', '$nama', '$telepon', '$wilayah', '$username', '$password', '$role')";
        if (mysqli_query($konek, $sql)) {
            echo "<script>alert('User telah berhasil ditambahkan!');</script>";
            echo '<meta http-equiv="refresh" content="0; url=../akun/list.php">';
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
                        <li class="breadcrumb-item"><a href="kecamatan.php">Kecamatan</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah Kecamatan</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Registrasi Akun</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" method="POST">
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="nip">NIP</label>
                                            <input type="number" id="nip" class="form-control" required placeholder="19xxxxxxxxxxxxxxxx" autocomplete="off" name="nip">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="nama">Nama</label>
                                            <input type="text" id="nama" class="form-control" required placeholder="Nama Lengkap" autocomplete="off" name="nama">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="telepon">Telepon</label>
                                            <input type="number" id="telepon" class="form-control" placeholder="08xxxxxxxxxx" autocomplete="off" name="telepon">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <fieldset class="form-group">
                                            <label for="wilayah">Wilayah</label>
                                            <select class="form-select" autocomplete="off" name="wilayah" id="basicSelect">
                                                <option value="" selected hidden>Pilih Wilayah</option>
                                                <?php
                                                $getKecamatan = getKecamatan();
                                                foreach($getKecamatan as $dataKecamatan):
                                                ?>
                                                <option value="<?= $dataKecamatan['nama_kecamatan'] ?>"><?= $dataKecamatan['nama_kecamatan']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </fieldset>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="username">Username</label>
                                            <input type="text" id="username" class="form-control"
                                                name="username" autocomplete="off" required placeholder="Username">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" id="password" class="form-control"
                                                name="password" autocomplete="off" required placeholder="Password">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                    <fieldset class="form-group">
                                            <label for="role">Jabatan</label>
                                            <select class="form-select" autocomplete="off" name="role" id="basicSelect" required>
                                                <option value="" selected hidden>Pilih Jabatan</option>
                                                <option value="ADMIN">Admin</option>
                                                <option value="KABID">Kepala</option>
                                                <option value="PKB">PKB</option>
                                            </select>
                                        </fieldset>
                                    </div>
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" name="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                    </div>
                                </div>
                            </form>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        let nip = document.getElementById('nip')

        nip.addEventListener('input', function() {
            if(this.value.length > 20){
                this.value = this.value.slice(0, 20)
            }
        })

    </script>

<?php 
    include '../utilities/footer.php';
?>