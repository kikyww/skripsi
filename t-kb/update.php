<?php 
    include '../utilities/sidebar.php';
    include '../koneksi.php';
    include_once('../function/Kecamatan.php');
    include_once('../function/Kelurahan.php');
    
    $id_user = $_SESSION['id_user'];
    $kec = $_GET['kec'];
    $kel = $_GET['kel'];
    $id = $_GET['id'];

    if (!isset($id_user)) {
        header("Location: ../index.php");
    } else if(isset($id)){
        $q = mysqli_query($konek, "SELECT * FROM tb_keluarga LEFT JOIN tb_kelurahan ON tb_keluarga.kelurahan_id = tb_kelurahan.id_kelurahan LEFT JOIN tb_kecamatan ON tb_keluarga.kecamatan_id = tb_kecamatan.id_kecamatan LEFT JOIN tb_kepkel ON tb_keluarga.kepkel_id = tb_kepkel.id_kepkel WHERE tb_kecamatan.nama_kecamatan = '$kec' AND tb_kelurahan.nama_kelurahan = '$kel' AND tb_keluarga.id_keluarga = '$id'");
        $row = $q->fetch_array();
    }
    
    if (isset($_POST['submit'])) {
        $status = htmlspecialchars($_POST['status']);
        $keterangan = htmlspecialchars($_POST['alasan']);
        $alasan = htmlspecialchars($_POST['keterangan']);
        $kecamatan = htmlspecialchars($_POST['kecamatan']);
        $kelurahan = htmlspecialchars($_POST['kelurahan']);

        $sql = "UPDATE tb_keluarga SET status_kb = '$status', keterangan_kb = '$keterangan', alasan_kb = '$alasan' WHERE id_keluarga = '$id'";

        if (mysqli_query($konek, $sql)) {
            echo "<script>alert('Telah berhasil diubah!');</script>";
            echo "<meta http-equiv='refresh' content='0; url=t-kb.php?kec=".$kec."&kel=".$kel."'>";
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
                        <li class="breadcrumb-item"><a href="kb.php">Tidak KB</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Update <?= $kec ?></li>
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
                            <h4 class="card-title">Update Tidak KB <?= $kel ?></h4>
                        </div>
                        <a class="btn btn-secondary" style="margin-right:28px;" href="./t-kb.php?kec=<?= $kec ?>&kel=<?= $kel ?>"><i class="fa fa-arrow-left"></i></a>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                        <form method="POST" class="form form-horizontal">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Nama | Kepala Keluarga</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="hidden" name="nama" id="id-input" class="form-control" placeholder="ID Nama Keluarga" autocomplete="off" readonly required>
                                            <input type="hidden" name="kepkel" id="id-kepkel" class="form-control" placeholder="ID Kepala Keluarga" autocomplete="off" readonly required>
                                            <input type="text" id="search-input" class="form-control" value="<?= $row['nama_keluarga'] ?> | <?= $row['nama_kepkel'] ?>" autocomplete="off" readonly required>

                                            <script>
                                                $(document).ready(function() {
                                                    $('#search-input').keyup(function() {
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
                                                                            var idKepkel = $(this).attr('kepkel-id')
                                                                            var name = $(this).text()
                                                                            $('#id-input').val(id)
                                                                            $('#id-kepkel').val(idKepkel)
                                                                            $('#search-input').val(name)
                                                                            $('#search-results').html('')
                                                                        })
                                                                    }
                                                                }   
                                                            })
                                                        } else {
                                                            $('#search-results').html('')
                                                        }
                                                    })
                                                    $('#search-input').on('input', function() {
                                                        if ($(this).val() === '') {
                                                            $('#id-input').val('')
                                                            $('#id-kepkel').val('')
                                                        }
                                                    })
                                                })
                                            </script>                                            
                                            <ul id="search-results" class="list-group"></ul>
                                        </div>

                                        <div class="col-md-4">
                                            <label>Status KB</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <fieldset class="form-group">
                                                <select class="form-select" name="status" id="basicSelect" required>
                                                    <option value="<?= $row['status_kb'] ?>" selected hidden><?= $row['status_kb'] ?></option>
                                                    <option value="Tidak KB">Tidak KB</option>
                                                    <option value="KB"> KB</option>
                                                </select>
                                            </fieldset>
                                        </div>

                                        <div class="col-md-4">
                                            <label>Alasan</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <fieldset class="form-group">
                                                <select class="form-select" name="alasan" id="basicSelect" required>
                                                    <option value="<?= $row['keterangan_kb'] ?>" selected hidden><?= $row['keterangan_kb'] ?></option>
                                                    <option value="KB">KB</option>
                                                    <option value="Program Hamil">Program Hamil</option>
                                                    <option value="Hamil">Hamil</option>
                                                    <option value="Belum Konfirmasi">Belum Konfirmasi</option>
                                                    <option value="Lainnya">Lainnya (sertakan keterangan)</option>
                                                </select>
                                            </fieldset>
                                        </div>

                                        <div class="col-md-4">
                                            <label>Keterangan</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" name="keterangan" id="keterangan" class="form-control" placeholder="Keterangan (tidak wajib di isi)" value="<?= $row['alasan_kb'] ?>" autocomplete="off" />
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