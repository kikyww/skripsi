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
        $judul = htmlspecialchars($_POST['judul']);
        $users = htmlspecialchars($_POST['users']);
        $tgl = htmlspecialchars($_POST['tgl']);
        $tempat = htmlspecialchars($_POST['tempat']);
        $deskripsi = htmlspecialchars($_POST['deskripsi']);
        $seksi = htmlspecialchars($_POST['seksi']);
        $kategori = htmlspecialchars($_POST['kategori']);
        $pesertai = htmlspecialchars($_POST['pesertai']);
        $pesertaii = htmlspecialchars($_POST['pesertaii']);
        $pesertaiii = htmlspecialchars($_POST['pesertaiii']);
        $instansi = htmlspecialchars($_POST['instansi']);
        $kunjungan = htmlspecialchars($_POST['kunjungan']);
        $status = htmlspecialchars($_POST['status']);
        $kecamatan = htmlspecialchars($_POST['kecamatan']);
        $kelurahan = htmlspecialchars($_POST['kelurahan']);

        $namaFile = $_FILES['foto']['name'];
        $tmpFile = $_FILES['foto']['tmp_name'];
        $folderTujuan = 'D:/xampp/htdocs/dist-skripsi/assets/images/intervensi/';
        $pathFile = $folderTujuan . $namaFile;

        if (move_uploaded_file($tmpFile, $pathFile)) {
            $num = mysqli_query($konek, "SELECT id_intervensi FROM tb_intervensi ORDER BY id_intervensi DESC");
            if (mysqli_num_rows($num) > 0) {
                $num = mysqli_fetch_array($num);
                $idintervensi = $num['id_intervensi'] + 1;
            }else {
                $idintervensi = 1;
            }
            
            $sql = "INSERT INTO tb_intervensi (id_intervensi, kecamatan_id, kelurahan_id, user_id, judul_intervensi, tgl_intervensi, tempat_intervensi, deskripsi_intervensi, jenis_id, seksi_intervensi, pesertai_intervensi, pesertaii_intervensi, pesertaiii_intervensi, opd_id, kunjungan_id, foto_intervensi, status_intervensi) VALUES ('$idintervensi', '$kecamatan', '$kelurahan', '$users', '$judul', '$tgl', '$tempat', '$deskripsi', '$kategori', '$seksi', '$pesertai', '$pesertaii', '$pesertaiii', '$instansi', '$kunjungan', '$namaFile', '$status')";
            if (mysqli_query($konek, $sql)) {
                echo "<script>alert('Intervensi telah berhasil ditambahkan!');</script>";
                echo '<meta http-equiv="refresh" content="0; url=intervensi.php?kec='. $kec .'&kel='. $kel .'">';
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($konek);
            }
        } else {
            echo "<script>alert('Gagal Mengupload Foto!');</script>";
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
                        <li class="breadcrumb-item"><a href="./intervensi.php?kec=<?= $kec ?>&kel=<?= $kel ?>">Intervensi</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah Intervensi</li>
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
                            <h4 class="card-title">Tambah Intervensi/Kegiatan</h4>
                        </div>
                        <a class="btn btn-secondary" style="margin-right:28px;" href="./intervensi.php"><i class="fa fa-arrow-left"></i></a>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form method="POST" class="form form-horizontal" enctype="multipart/form-data">
                                <div class="form-body">
                                    <div class="row">
                                    <input type="hidden" class="form-control" value="<?= $id_user ?>" name="users" autocomplete="off" required>
                                        <div class="col-md-4">
                                            <label>Judul Intervensi</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" id="judul" class="form-control" name="judul" placeholder="Judul Intervensi" autocomplete="off" required>
                                        </div>

                                        <div class="col-md-4">
                                            <label>Tanggal Intervensi</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="date" id="tgl" class="form-control" name="tgl" autocomplete="off" required>
                                        </div>

                                        <div class="col-md-4">
                                            <label>Tempat</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" id="tempat" class="form-control" name="tempat" placeholder="Tempat Intervensi" autocomplete="off" required>
                                        </div>

                                        <div class="col-md-4">
                                            <label>Deskripsi</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <textarea type="text" id="deskripsi" class="form-control" name="deskripsi" placeholder="Deskripsi singkat pada kegiatan/intervensi yang telah di laksanakan" autocomplete="off" required></textarea>
                                        </div>

                                        <div class="col-md-4">
                                            <label>Seksi Kegiatan</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="radio" value="Keagamaan" class="btn-check" name="seksi" id="keagamaan" autocomplete="off">
                                            <label class="btn btn-outline-primary m-1" for="keagamaan">Keagamaan</label>

                                            <input type="radio" value="Pendidikan" class="btn-check" name="seksi" id="pendidikan" autocomplete="off">
                                            <label class="btn btn-outline-primary m-1" for="pendidikan">Pendidikan</label>

                                            <input type="radio" value="Reproduksi" class="btn-check" name="seksi" id="reproduksi" autocomplete="off">
                                            <label class="btn btn-outline-primary m-1" for="reproduksi">Reproduksi</label>

                                            <input type="radio" value="Ekonomi" class="btn-check" name="seksi" id="ekonomi" autocomplete="off">
                                            <label class="btn btn-outline-primary m-1" for="ekonomi">Ekonomi</label>

                                            <input type="radio" value="Perlindungan" class="btn-check" name="seksi" id="perlindungan" autocomplete="off">
                                            <label class="btn btn-outline-primary m-1" for="perlindungan">Perlindungan</label>

                                            <input type="radio" value="Kasih Sayang" class="btn-check" name="seksi" id="sayang" autocomplete="off">
                                            <label class="btn btn-outline-primary m-1" for="sayang">Kasih Sayang</label>

                                            <input type="radio" value="Sosisal Budaya" class="btn-check" name="seksi" id="budaya" autocomplete="off">
                                            <label class="btn btn-outline-primary m-1" for="budaya">Sosisal Budaya</label>

                                            <input type="radio" value="Pembinaan Lingkungan" class="btn-check" name="seksi" id="lingkungan" autocomplete="off">
                                            <label class="btn btn-outline-primary m-1" for="lingkungan">Pembinaan Lingkungan</label>

                                            <input type="radio" value="Lainnya" class="btn-check" name="seksi" id="lainnya" autocomplete="off">
                                            <label class="btn btn-outline-primary m-1" for="lainnya">Lainnya</label>
                                        </div>

                                        <div class="col-md-4">
                                            <label>Kategori Kegiatan</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="hidden" id="id_kategori" class="form-control" name="kategori" readonly required>
                                            <input type="text" id="kategori" class="form-control" placeholder="Kategori Kegiatan" autocomplete="off" required>

                                            <script>
                                                $(document).ready(function() {
                                                    $('#kategori').on('click', function() {
                                                        $.ajax({
                                                        type: 'GET',
                                                        url: 'jenis_get.php',
                                                        success: function(response) {
                                                            $('#kategori-results').html(response);
                                                        }
                                                    });
                                                })

                                                $('#kategori').on('input', function() {
                                                    var input = $(this).val();
                                                    if (input.trim() !== '') {
                                                        $.ajax({
                                                            type: 'GET',
                                                            url: 'jenis_search.php',
                                                            data: {
                                                                keyword: input
                                                            },
                                                            success: function(response) {
                                                                $('#kategori-results').html(response);
                                                            }
                                                        });
                                                    } else {
                                                        getDataFromDatabase();
                                                    }
                                                });

                                                function getDataFromDatabase() {
                                                    $.ajax({
                                                        type: 'GET',
                                                        url: 'jenis_get.php',
                                                        success: function(response) {
                                                            $('#kategori-results').html(response);
                                                        }
                                                    });
                                                }

                                                $(document).on('click', '.kel-hover', function() {
                                                    var id = $(this).data('id');
                                                    var kategori = $(this).text();

                                                        $('#id_kategori').val(id);
                                                        $('#kategori').val(kategori);
                                                    });
                                                    
                                                    $(document).on('click', function(event) {
                                                        if (!$(event.target).closest('#kategori-results, #kategori').length) {
                                                            $('#kategori-results').empty();
                                                        }
                                                    });
                                                });
                                            </script>

                                            <ul id="kategori-results" class="list-group" style="max-height: 200px; overflow-y: auto;"></ul>
                                        </div>

                                        <div class="col-md-4">
                                            <label>Peserta Kegiatan</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" id="pesertai" class="form-control" name="pesertai" placeholder="Peserta Kegiatan" autocomplete="off" required>

                                            <div id="pesertaii">
                                                <div class="d-flex">
                                                    <input type="text" class="form-control mt-2" name="pesertaii" placeholder="Peserta Kegiatan" autocomplete="off">
                                                    <button type="button" id="del-formii" class="btn btn-danger h-25 mt-2">Hapus</button>
                                                </div>
                                            </div>

                                            <div id="pesertaiii">
                                                <div class="d-flex">
                                                    <input type="text" class="form-control mt-2" name="pesertaiii" placeholder="Peserta Kegiatan" autocomplete="off">
                                                    <button type="button" id="del-formiii" class="btn btn-danger h-25 mt-2">Hapus</button>
                                                </div>
                                            </div>

                                            <button type="button" id="plus-form" class="btn btn-primary mt-2 mb-1">Tambah</button>
                                        </div>

                                        <div class="col-md-4">
                                            <label>Instansi Terkait</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="hidden" id="id_instansi" class="form-control" name="instansi" readonly required>
                                            <input type="text" id="instansi" class="form-control" placeholder="Instansi Terkait" autocomplete="off" required>

                                            <script>
                                                $(document).ready(function() {
                                                    $('#instansi').on('click', function() {
                                                        $.ajax({
                                                        type: 'GET',
                                                        url: 'ins_get.php',
                                                        success: function(response) {
                                                            $('#instansi-results').html(response);
                                                        }
                                                    });
                                                })

                                                $('#instansi').on('input', function() {
                                                    var input = $(this).val();
                                                    if (input.trim() !== '') {
                                                        $.ajax({
                                                            type: 'GET',
                                                            url: 'ins_search.php',
                                                            data: {
                                                                keyword: input
                                                            },
                                                            success: function(response) {
                                                                $('#instansi-results').html(response);
                                                            }
                                                        });
                                                    } else {
                                                        getDataFromDatabase();
                                                    }
                                                });

                                                function getDataFromDatabase() {
                                                    $.ajax({
                                                        type: 'GET',
                                                        url: 'ins_get.php',
                                                        success: function(response) {
                                                            $('#instansi-results').html(response);
                                                        }
                                                    });
                                                }

                                                $(document).on('click', '.ins-hover', function() {
                                                    var id = $(this).data('id');
                                                    var instansi = $(this).text();

                                                        $('#id_instansi').val(id);
                                                        $('#instansi').val(instansi);
                                                    });
                                                    
                                                    $(document).on('click', function(event) {
                                                        if (!$(event.target).closest('#instansi-results, #instansi').length) {
                                                            $('#instansi-results').empty();
                                                        }
                                                    });
                                                });
                                            </script>
                                            <ul id="instansi-results" class="list-group" style="max-height: 200px; overflow-y: auto;"></ul>
                                        </div>

                                        <div class="col-md-4">
                                            <label>Kunjungan OPD</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="hidden" id="id_kunjungan" class="form-control" name="kunjungan" required>
                                            <input type="text" id="kunjungan" class="form-control" placeholder="Kunjungan OPD" autocomplete="off" required>
                                        
                                            <script>
                                                $(document).ready(function() {
                                                    $('#kunjungan').on('click', function() {
                                                        $.ajax({
                                                        type: 'GET',
                                                        url: 'opd_get.php',
                                                        success: function(response) {
                                                            $('#kunjungan-results').html(response);
                                                        }
                                                    });
                                                })

                                                $('#kunjungan').on('input', function() {
                                                    var input = $(this).val();
                                                    if (input.trim() !== '') {
                                                        $.ajax({
                                                            type: 'GET',
                                                            url: 'opd_search.php',
                                                            data: {
                                                                keyword: input
                                                            },
                                                            success: function(response) {
                                                                $('#kunjungan-results').html(response);
                                                            }
                                                        });
                                                    } else {
                                                        getDataFromDatabase();
                                                    }
                                                });

                                                function getDataFromDatabase() {
                                                    $.ajax({
                                                        type: 'GET',
                                                        url: 'opd_get.php',
                                                        success: function(response) {
                                                            $('#kunjungan-results').html(response);
                                                        }
                                                    });
                                                }

                                                $(document).on('click', '.kun-hover', function() {
                                                    var id = $(this).data('id');
                                                    var kunjungan = $(this).text();

                                                        $('#id_kunjungan').val(id);
                                                        $('#kunjungan').val(kunjungan);
                                                    });
                                                    
                                                    $(document).on('click', function(event) {
                                                        if (!$(event.target).closest('#kunjungan-results, #kunjungan').length) {
                                                            $('#kunjungan-results').empty();
                                                        }
                                                    });
                                                });
                                            </script>
                                            <ul id="kunjungan-results" class="list-group" style="max-height: 200px; overflow-y: auto;"></ul>
                                        </div>

                                        <input type="hidden" value="Selesai" class="form-control" name="status" readonly required>

                                        <div class="col-md-4">
                                            <label>*Lampiran Foto Kegiatan</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="file" id="foto" class="form-control" name="foto" autocomplete="off" required>
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

    <script>
        $(document).ready(function() {
            $("#pesertaii").hide();
            $("#pesertaiii").hide();
            $('#plus-form').click(function(){
                $('#pesertaii').show()
                $('#pesertaiii').show()
                $('#plus-form').hide()
            })
            $('#del-formii').click(function(){
                $('#pesertaii').hide()
                $('#plus-form').show()
            })
            $('#del-formiii').click(function(){
                $('#pesertaiii').hide()
                $('#plus-form').show()
            })
        })
    </script>


<?php 
    include '../utilities/footer.php';
?>