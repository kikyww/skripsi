<?php 
    include '../utilities/sidebar.php';
    include '../koneksi.php';
    include_once ('../function/Kecamatan.php');
    include_once ('../function/Kelurahan.php');

    $id_user = $_SESSION['id_user'];
    $id = $_GET['id'];

    if (!isset($id_user)) {
        header("Location: ../index.php");
    } else if(isset($id)){
        $q = mysqli_query($konek, "SELECT * FROM tb_intervensi LEFT JOIN tb_jenisinv ON tb_intervensi.jenis_id = tb_jenisinv.id_jenis LEFT JOIN tb_opd ON tb_intervensi.opd_id = tb_opd.id_opd LEFT JOIN tb_opd AS o ON tb_intervensi.kunjungan_id = o.id_opd LEFT JOIN tb_kecamatan ON tb_intervensi.kecamatan_id = tb_kecamatan.id_kecamatan LEFT JOIN tb_kelurahan ON tb_intervensi.kelurahan_id = tb_kelurahan.id_kelurahan WHERE id_intervensi = '$id'");
        $row = $q->fetch_array();
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
        $kelurahan = htmlspecialchars($_POST['kelurahan_id']);

        $namaFile = $_FILES['foto']['name'];
        $tmpFile = $_FILES['foto']['tmp_name'];
        $folderTujuan = 'D:/xampp/htdocs/dist-skripsi/assets/images/intervensi/';
        $pathFile = $folderTujuan . $namaFile;

        if (move_uploaded_file($tmpFile, $pathFile)) {
            $sql = "UPDATE tb_intervensi SET judul_intervensi = '$judul', tgl_intervensi = '$tgl', user_id = '$users', tempat_intervensi = '$tempat', deskripsi_intervensi= '$deskripsi', seksi_intervensi = '$seksi', jenis_id = '$kategori', pesertai_intervensi = '$pesertai', pesertaii_intervensi = '$pesertaii', pesertaiii_intervensi = '$pesertaiii', opd_id = '$instansi', kunjungan_id = '$kunjungan', foto_intervensi = '$namaFile', status_intervensi = '$status', kecamatan_id = '$kecamatan', kelurahan_id = '$kelurahan' WHERE id_intervensi = '$id'";
            if (mysqli_query($konek, $sql)) {
                echo "<script>alert('Intervensi Berhasil di Ubah!');</script>";
                echo '<meta http-equiv="refresh" content="0; url=./agenda.php">';
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
                        <li class="breadcrumb-item"><a href="./jenis.php">Intervensi</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Jenis Intervensi</li>
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
                            <h4 class="card-title">Update Jenis Intervensi</h4>
                        </div>
                        <a class="btn btn-secondary" style="margin-right:28px;" href="./intervensi.php?kec=<?= $kec ?>&kel=<?= $kel ?>"><i class="fa fa-arrow-left"></i></a>
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
                                            <input type="text" id="judul" class="form-control" value="<?= $row['judul_intervensi'] ?>" name="judul" placeholder="Judul Intervensi" autocomplete="off" required>
                                        </div>

                                        <div class="col-md-4">
                                            <label>Tanggal Intervensi</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="date" id="tgl" class="form-control" value="<?= $row['tgl_intervensi'] ?>" name="tgl" autocomplete="off" required>
                                        </div>

                                        <div class="col-md-4">
                                            <label>Tempat</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" id="tempat" class="form-control" value="<?= $row['tempat_intervensi'] ?>" name="tempat" placeholder="Tempat Intervensi" autocomplete="off" required>
                                        </div>

                                        <div class="col-md-4">
                                            <label>Deskripsi</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" id="deskripsi" class="form-control" value="<?= $row['deskripsi_intervensi'] ?>" name="deskripsi" placeholder="Deskripsi singkat pada kegiatan/intervensi yang telah di laksanakan" autocomplete="off" required>
                                        </div>

                                        <div class="col-md-4">
                                            <label>Seksi Kegiatan</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="radio" value="<?= $row['seksi_intervensi'] ?>" class="btn-check" name="seksi" id="<?= $row['seksi_intervensi'] ?>" autocomplete="off" checked>
                                            <label class="btn btn-outline-primary m-1" for="<?= $row['seksi_intervensi'] ?>"><?= $row['seksi_intervensi'] ?></label>
                                            
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
                                            <input type="hidden" id="id_kategori" class="form-control" value="<?= $row['jenis_id'] ?>" name="kategori" readonly required>
                                            <input type="text" value="<?= $row['nama_jenis'] ?>" id="kategori" class="form-control" placeholder="Kategori Kegiatan" autocomplete="off" required>

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
                                            <input type="text" id="pesertai" class="form-control" value="<?= $row['pesertai_intervensi'] ?>" name="pesertai" placeholder="Peserta Kegiatan" autocomplete="off" required>

                                            <div id="pesertaii">
                                                <div class="d-flex">
                                                    <input type="text" class="form-control mt-2" value="<?= $row['pesertaii_intervensi'] ?>" name="pesertaii" placeholder="Peserta Kegiatan" autocomplete="off">
                                                    <button type="button" id="del-formii" class="btn btn-danger h-25 mt-2">Hapus</button>
                                                </div>
                                            </div>

                                            <div id="pesertaiii">
                                                <div class="d-flex">
                                                    <input type="text" class="form-control mt-2" value="<?= $row['pesertaiii_intervensi'] ?>" name="pesertaiii" placeholder="Peserta Kegiatan" autocomplete="off">
                                                    <button type="button" id="del-formiii" class="btn btn-danger h-25 mt-2">Hapus</button>
                                                </div>
                                            </div>

                                            <button type="button" id="plus-form" class="btn btn-primary mt-2 mb-1">Tambah</button>
                                        </div>

                                        <div class="col-md-4">
                                            <label>Instansi Terkait</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="hidden" id="id_instansi" class="form-control" value="<?= $row['opd_id'] ?>" name="instansi" readonly required>
                                            <input type="text" id="instansi" value="<?= $row['nama_opd'] ?>" class="form-control" placeholder="Instansi Terkait" autocomplete="off" required>

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
                                            <input type="hidden" id="id_kunjungan" class="form-control" value="<?= $row['kunjungan_id'] ?>" name="kunjungan" required>
                                            <input type="text" id="kunjungan" value="<?= $row['nama_opd'] ?>" class="form-control" placeholder="Kunjungan OPD" autocomplete="off" required>
                                        
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

                                        <div class="col-md-4">
                                            <label>Status Kegiatan</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <fieldset class="form-group">
                                                <select class="form-select" name="status" id="status" required>
                                                    <option value="<?= $row['status_intervensi'] ?>" selected hidden><?= $row['status_intervensi'] ?></option>
                                                    <option value="Selesai">Selesai</option>
                                                    <option value="Belum">Belum</option>
                                                </select>
                                            </fieldset>
                                        </div>

                                        <div class="col-md-4">
                                            <label>*Lampiran Foto Kegiatan</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="file" id="foto" class="form-control" value="<?= $row['foto_intervensi'] ?>" name="foto" autocomplete="off" required>
                                        </div>

                                        <div class="col-md-4">
                                            <label>Nama Kecamatan</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <fieldset class="form-group">
                                                <select class="form-select" name="kecamatan" id="filKecamatan" required>
                                                    <option selected hidden>Pilih Kecamatan</option> 
                                                    <?php
                                                    $getKecamatan = getKecamatan();
                                                    foreach ($getKecamatan as $dataKecamatan):
                                                    ?>
                                                    <option value="<?= $dataKecamatan['id_kecamatan'] ?>"><?= $dataKecamatan['nama_kecamatan']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </fieldset>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <label>Kelurahan</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <fieldset class="form-group">
                                                <select class="form-select" name="kelurahan_id" id="filKelurahan" required>
                                                    <option value="x" selected hidden>Pilih Kelurahan</option>
                                                    <option value=""></option>
                                                </select>
                                            </fieldset>
                                        </div>

                                        <script>
                                            $(document).ready(function() {
                                                $('#filKecamatan').change(function() {
                                                    var kecamatan_id = $(this).val();
                                                    $.ajax({
                                                        type : "POST",
                                                        url : "../l-pus/get-kelurahan.php",
                                                        data : {kecamatan_id : kecamatan_id},
                                                        dataType : "json",
                                                        success : function(data) {
                                                            var options = '';
                                                            $.each(data, function(index, value){
                                                                options += '<option value="' + value.id_kelurahan + '">' + value.nama_kelurahan + '</option>';
                                                            });
                                                            $('#filKelurahan').html(options)
                                                        }
                                                    });
                                                });
                                            });
                                        </script>

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
            if($('#pesertaii').length === true){
                $("#pesertaii").show();
            } else {
                $("#pesertaii").hide();
            }
            
            if($('#pesertaiii').length === true){
                $("#pesertaiii").show();
            } else {
                $("#pesertaiii").hide();                
            }

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