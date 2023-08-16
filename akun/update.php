<?php 
    include '../utilities/sidebar.php';
    include '../koneksi.php';
    include_once('../function/Kecamatan.php');
    $id_user = $_SESSION['id_user'];
    $id = $_GET['id'];

    if (!isset($id_user)) {
        header("Location: ../index.php");
    } else if(isset($id)){
        $q = mysqli_query($konek, "SELECT * FROM tb_user WHERE id_user = '$id'");
        $row = $q->fetch_array();
    }
    
    if (isset($_POST['submit'])) {
        $nip = htmlspecialchars($_POST['nip']);
        $nama = htmlspecialchars($_POST['nama']);
        $telepon = htmlspecialchars($_POST['telepon']);
        $wilayah = htmlspecialchars($_POST['wilayah']);
        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);
        $role = htmlspecialchars($_POST['role']);

        $sql = "UPDATE tb_user SET nip = '$nip', nama = '$nama', telepon = '$telepon', wilayah = '$wilayah', username = '$username', password = '$password', roles = '$role' WHERE id_user = '$id'";
        if (mysqli_query($konek, $sql)) {
            echo "<script>alert('$row[username] Berhasil di Ubah!');</script>";
            echo '<meta http-equiv="refresh" content="0; url=./list.php">';
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
                                            <input type="number" id="nip" class="form-control" required placeholder="19xxxxxxxxxxxxxxxx" value="<?= $row['nip'] ?>" autocomplete="off" name="nip">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="nama">Nama</label>
                                            <input type="text" id="nama" class="form-control" required placeholder="Nama Lengkap" value="<?= $row['nama'] ?>" autocomplete="off" name="nama">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="telepon">Telepon</label>
                                            <input type="number" id="telepon" class="form-control" placeholder="08xxxxxxxxxx" value="<?= $row['telepon'] ?>" autocomplete="off" name="telepon">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <fieldset class="form-group">
                                            <label for="wilayah">Wilayah</label>
                                            <select class="form-select" autocomplete="off" name="wilayah" id="basicSelect" required>
                                                <option value="<?= $row['wilayah'] ?>" selected hidden><?= $row['wilayah'] ?></option>
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
                                                name="username" value="<?= $row['username'] ?>" autocomplete="off" required placeholder="Username">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="text" id="password" class="form-control"
                                                name="password" value="<?= $row['password'] ?>" autocomplete="off" required placeholder="Password">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                    <fieldset class="form-group">
                                            <label for="role">Jabatan</label>
                                            <select class="form-select" autocomplete="off" name="role" id="basicSelect" required>
                                                <option value="<?= $row['roles'] ?>" selected hidden><?= $row['roles'] ?></option>
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
    mysqli_close($konek);
?>