<?php 
    include '../utilities/sidebar.php';
    include '../koneksi.php';
    include_once('../function/Kecamatan.php');
    include_once('../function/Kelurahan.php');

    $id_user = $_SESSION['id_user'];
    $kec = $_GET['kec'];
    $kel = $_GET['kel'];

    if (!isset($id_user)) {
        header("Location: ../index.php");
    }
    if (isset($_POST['submit'])) {
        $kk = htmlspecialchars($_POST['kk']);
        $nama = htmlspecialchars($_POST['nama']);
        $tempat = htmlspecialchars($_POST['tempat']);
        $tgl = htmlspecialchars($_POST['tgl']);
        $jk = htmlspecialchars($_POST['jk']);
        $telp = htmlspecialchars($_POST['telp']);
        $status = htmlspecialchars($_POST['status']);
        $keterangan = htmlspecialchars($_POST['keterangan']);
        $jmlanak = htmlspecialchars($_POST['jmlanak']);
        $kecamatan = htmlspecialchars($_POST['kecamatan']);
        $kelurahan = htmlspecialchars($_POST['kelurahan']);

        $num = mysqli_query($konek, "SELECT id_keluarga FROM tb_keluarga ORDER BY id_keluarga DESC");
        if (mysqli_num_rows($num) > 0) {
            $num = mysqli_fetch_array($num);
            $idkeluarga = $num['id_keluarga'] + 1;
        } else {
            $idkeluarga = 1;
        }
        $sql = "INSERT INTO tb_keluarga (id_keluarga, kepkel_id, nama_keluarga, tl_keluarga, lahir_keluarga, jk_keluarga, telp_keluarga, status_kb, keterangan_kb, jumlah_anak, kecamatan_id, kelurahan_id) VALUES ('$idkeluarga', '$kk', '$nama', '$tempat', '$tgl', '$jk', '$telp', '$status', '$keterangan', '$jmlanak', '$kecamatan', '$kelurahan')";
        if (mysqli_query($konek, $sql)) {
            echo "<script>alert('Keluarga telah berhasil ditambahkan!');</script>";
            echo "<meta http-equiv='refresh' content='0; url=keluarga.php?kec=".$kec."&kel=".$kel."'>";
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
                        <li class="breadcrumb-item"><a href="keluarga.php?kec=<?= $kec ?>&kel=<?= $kel ?>">Keluarga</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah Keluarga <?= $kec ?></li>
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
                            <h4 class="card-title">Tambah Kepala Keluarga <?= $kel ?></h4>
                        </div>
                        <a class="btn btn-secondary" style="margin-right:28px;" href="keluarga.php?kec=<?= $kec ?>&kel=<?= $kel ?>"><i class="fa fa-arrow-left"></i></a>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form method="POST" class="form form-horizontal">
                                <div class="form-body">
                                    <div class="row">

                                        <div class="col-md-4">
                                            <label>Kepala Keluarga</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" id="search-kk" class="form-control" placeholder="Nama Kepala Keluarga" autocomplete="off" required>
                                            <input type="hidden" id="id-input" name="kk">

                                            <script>
                                                $(document).ready(function() {
                                                    $('#search-kk').keyup(function() {
                                                        var search = $(this).val()
                                                        if (search.length >= 1) {
                                                            $.ajax({
                                                                url: 'search.php?kec=<?= $kec ?>&kel=<?= $kel ?>',
                                                                type: 'POST',
                                                                data: {search: search},
                                                                dataType: 'html',
                                                                success: function(response) {
                                                                    $('#search-results').html(response)
                                                                    if (!$(this).hasClass('disabled')) {
                                                                        $('#search-results li').on('click', function() {
                                                                            var id = $(this).attr('data-id')
                                                                            var name = $(this).text()
                                                                            $('#id-input').val(id)
                                                                            $('#search-kk').val(name)
                                                                            $('#search-results').html('')
                                                                        })
                                                                    }
                                                                }   
                                                            })
                                                        } else {
                                                            $('#search-results').html('')
                                                        }
                                                    })
                                                    $('#search-kk').on('input', function() {
                                                        if ($(this).val() === '') {
                                                            $('#id-input').val('')
                                                        }
                                                    })
                                                })
                                            </script>                   
                                            <ul id="search-results" class="list-group"></ul>
                                        </div>
                                            
                                        <div class="col-md-4">
                                            <label>Nama</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama" autocomplete="off" required>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <label>Tempat Lahir</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" name="tempat" id="tempat" class="form-control" placeholder="Tempat Lahir" autocomplete="off" required>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <label>Tanggal Lahir</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="date" name="tgl" id="tgl" class="form-control" placeholder="Tanggal Lahir" autocomplete="off" required>
                                        </div>

                                        <div class="col-md-4">
                                            <label>Jenis Kelamin</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <fieldset class="form-group">
                                                <select class="form-select" name="jk" id="basicSelect" required>
                                                    <option value="" selected hidden>Jenis Kelamin</option>
                                                    <option value="L">Laki-Laki</option>
                                                    <option value="P">Perempuan</option>
                                                </select>
                                            </fieldset>
                                        </div>

                                        <div class="col-md-4">
                                            <label>Telepon Aktif</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="number" name="telp" id="telp" class="form-control" placeholder="No. Telepon/WhatsApp" autocomplete="off" required>
                                        </div>

                                        <div class="col-md-4">
                                            <label>Status KB</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <fieldset class="form-group">
                                                <select class="form-select" name="status" id="basicSelect" required>
                                                    <option value="" selected hidden>Status</option>
                                                    <option value="Tidak KB">Tidak KB</option>
                                                    <option value="KB">KB</option>
                                                </select>
                                            </fieldset>
                                        </div>

                                        <div class="col-md-4">
                                            <label>Keterangan KB</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" name="keterangan" id="keterangan" class="form-control" placeholder="Keterangan KB" autocomplete="off">
                                        </div>

                                        <div class="col-md-4">
                                            <label>Jumlah Anak</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="number" name="jmlanak" id="jmlanak" class="form-control" placeholder="Jumlah Anak" autocomplete="off" required>
                                        </div>

                                        <div class="col-md-4">
                                            <label>Nama Kecamatan</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                        <?php
                                        $getKec = getKec();
                                        foreach ($getKec as $dataKec):
                                        ?>
                                            <input type="text" id="kecamatan" class="form-control" name="kecamatan" value="<?= $dataKec['id_kecamatan']; ?>" hidden required readonly >
                                        <?php endforeach; ?>
                                            <input type="text" class="form-control" placeholder="<?= $kec; ?>" readonly>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <label>Kelurahan</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <fieldset class="form-group">
                                                <select class="form-select" name="kelurahan" id="basicSelect" required>
                                                    <?php
                                                    $getKel = getKel();
                                                    foreach ($getKel as $dataKel):
                                                    ?>
                                                    <option value="<?= $dataKel['id_kelurahan'] ?>" selected hidden><?= $kel ?></option> 
                                                    <?php endforeach; ?>
                                                    <?php
                                                    $getKelurahan = getKelurahan();
                                                    foreach ($getKelurahan as $dataKelurahan):
                                                    ?>
                                                    <option value="<?= $dataKelurahan['id_kelurahan'] ?>"><?= $dataKelurahan['nama_kelurahan']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </fieldset>
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
    mysqli_close($konek);
?>