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
        $q = mysqli_query($konek, "SELECT * FROM tb_kb LEFT JOIN tb_kelurahan ON tb_kb.kelurahan_id = tb_kelurahan.id_kelurahan LEFT JOIN tb_kecamatan ON tb_kb.kecamatan_id = tb_kecamatan.id_kecamatan LEFT JOIN tb_keluarga ON tb_kb.keluarga_id = tb_keluarga.id_keluarga LEFT JOIN tb_obat ON tb_kb.obat_id = tb_obat.id_obat LEFT JOIN tb_stok ON tb_kb.stok_id = tb_stok.id_stok WHERE tb_kb.id_kb = '$id' AND tb_kecamatan.nama_kecamatan = '$kec' AND tb_kelurahan.nama_kelurahan = '$kel'");
        $row = $q->fetch_array();
    }
    
    if (isset($_POST['submit'])) {
        $nama = htmlspecialchars($_POST['nama']);
        $tgl = htmlspecialchars($_POST['tgl']);
        $stok = htmlspecialchars($_POST['stok']);
        $jumlah = htmlspecialchars($_POST['jumlah']);
        $obatId = htmlspecialchars($_POST['obat_id']);
        $kecamatan = htmlspecialchars($_POST['kecamatan']);
        $kelurahan = htmlspecialchars($_POST['kelurahan']);
        $plusenam = htmlspecialchars($_POST['enam']);
        $idstok = htmlspecialchars($_POST['idstok']);
        $jumlahawal = htmlspecialchars($_POST['jumlahawal']);
        $enam_bulan = date('Y-m-d', strtotime('+6 months', strtotime($tgl)));

        $sql = "UPDATE tb_kb SET keluarga_id = '$nama', kecamatan_id = '$kecamatan', kelurahan_id = '$kelurahan', tgl_kb = '$tgl', tgl_kembali = '$plusenam', obat_id = '$obatId', stok_id = '$stok', jumlah_obat = '$jumlah' WHERE id_kb = '$id'";

        if (mysqli_query($konek, $sql)) {
            mysqli_query($konek, "UPDATE tb_stok SET stok_akhir = stok_akhir + $jumlahawal WHERE id_stok = '$idstok'");

            mysqli_query($konek, "UPDATE tb_stok SET stok_akhir = stok_akhir - $jumlah WHERE id_stok = '$stok'");

            echo "<script>alert('Catatan KB telah berhasil diubah!');</script>";
            echo "<meta http-equiv='refresh' content='0; url=kb.php?kec=".$kec."&kel=".$kel."'>";

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
                        <li class="breadcrumb-item"><a href="kb.php">KB</a></li>
                        <li class="breadcrumb-item active" aria-current="page">KB <?= $kec ?></li>
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
                            <h4 class="card-title">Update KB <?= $kel ?></h4>
                        </div>
                        <a class="btn btn-secondary" style="margin-right:28px;" href="kb.php?kec=<?= $kec ?>&kel=<?= $kel ?>"><i class="fa fa-arrow-left"></i></a>
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
                                            <input type="hidden" name="nama" id="id-input" class="form-control" placeholder="ID Nama Keluarga" autocomplete="off" value="<?= $row['id_keluarga']; ?>" readonly required>
                                            <input type="hidden" name="kepkel" id="id-kepkel" class="form-control" placeholder="ID Kepala Keluarga" autocomplete="off" value="" readonly required>
                                            <input type="text" id="search-input" class="form-control" placeholder="Nama" autocomplete="off" value="<?= $row['nama_keluarga']; ?> | <?= $row['nik']; ?>" required>

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
                                            <label>Tanggal KB</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="date" name="tgl" id="tgl" class="form-control" placeholder="Tanggal KB" value="<?= $row['tgl_kb']; ?>" autocomplete="off" required>
                                        </div>

                                        <script>
                                            $(document).ready(function() {
                                                $('#tgl').on('change', function() {
                                                    var selectedDate = $(this).val();
                                                    var newDate = new Date(selectedDate);
                                                    newDate.setMonth(newDate.getMonth() + 6);
                                                    var formattedDate = newDate.toISOString().substr(0, 10);
                                                    $('#enambulan').val(formattedDate);
                                                });
                                            });
                                        </script>

                                        <div class="col-md-8 form-group" hidden>
                                            <input type="date" name="enam" id="enambulan" class="form-control" placeholder="Tanggal KB" value="<?= $row['tgl_kembali']; ?>" autocomplete="off" required>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <label>Obat/Alat KB</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <fieldset class="form-group">
                                                <select class="form-select" name="stok" id="basicSelect" required>
                                                    <option value="<?= $row['id_stok']; ?>" selected hidden><?= $row['nama_obat']; ?> | Sisa : <?= $row['stok_akhir']; ?></option> 
                                                    <?php
                                                    $stokObat = mysqli_query($konek, "SELECT * FROM tb_stok LEFT JOIN tb_obat ON tb_stok.obat_id = tb_obat.id_obat LEFT JOIN tb_kecamatan ON tb_stok.kecamatan_id = tb_kecamatan.id_kecamatan WHERE tb_kecamatan.nama_kecamatan = '$kec' AND tb_stok.tgl_awal <= CURDATE() AND tb_stok.tgl_akhir >= CURDATE()");
                                                    foreach ($stokObat as $dataObat) : 
                                                    ?>
                                                    <option value="<?= $dataObat['id_stok'] ?>" data-obatid="<?= $dataObat['obat_id'] ?>"><?= $dataObat['nama_obat']; ?> | Sisa : <?= $dataObat['stok_akhir']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </fieldset>
                                            <script>
                                                $(document).ready(function() {
                                                    $('#basicSelect').on('change', function() {
                                                        var selectedOption = $(this).find('option:selected')
                                                        var obatId = selectedOption.data('obatid')
                                                        $('#obat-id').val(obatId)
                                                    })
                                                })
                                            </script>
                                            <input type="hidden" name="obat_id" id="obat-id" class="form-control" value="<?= $row['obat_id'] ?>" placeholder="ID Obat" autocomplete="off" required>
                                        </div>

                                        <div class="col-md-4">
                                            <label>Jumlah Obat / Alat</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="hidden" name="idstok" id="jumlah" class="form-control" value="<?= $row['id_stok']; ?>" placeholder="Jumlah Obat/Alat (pcs)" autocomplete="off" required>
                                            <input type="hidden" name="jumlahawal" id="jumlah" class="form-control" value="<?= $row['jumlah_obat']; ?>" placeholder="Jumlah Obat/Alat (pcs)" autocomplete="off" required>
                                            <input type="number" name="jumlah" id="jumlah" class="form-control" value="<?= $row['jumlah_obat']; ?>" placeholder="Jumlah Obat/Alat (pcs)" autocomplete="off" required>
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