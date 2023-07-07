<?php 
    include '../koneksi.php';
    include '../utilities/sidebar.php';
    include_once('../function/Kecamatan.php');
    $id_user = $_SESSION['id_user'];
    $opd = $_GET['opd'];

    if(!isset($id_user)){
        header('Location: ../index.php');
    }

    $query = mysqli_query($konek, "SELECT * FROM tb_intervensi LEFT JOIN tb_jenisinv ON tb_intervensi.jenis_id = tb_jenisinv.id_jenis LEFT JOIN tb_opd AS o ON tb_intervensi.kunjungan_id = o.id_opd LEFT JOIN tb_kecamatan ON tb_intervensi.kecamatan_id = tb_kecamatan.id_kecamatan LEFT JOIN tb_kelurahan ON tb_intervensi.kelurahan_id = tb_kelurahan.id_kelurahan WHERE o.nama_opd <> 'Masyarakat Setempat' AND o.nama_opd = '$opd' ORDER BY tb_intervensi.id_intervensi ASC");
?>

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last"></div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Laporan Intervensi</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Laporan Kunjungan Instansi</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<section class="section">
        <div class="card">
            <div class="d-flex justify-content-between align-items-center">
                <div class="card-header">
                    <h4>Rincian Kunjungan <?= $opd ?></h4>
                </div>
                <div class="buttons">
                    <button class="btn btn-primary" id="btn-rincian">Rincian</button>
                    <a class="btn btn-secondary" style="margin-right:30px;" href="./report.php"><i class="fa fa-arrow-left"></i></a>
                </div>
            </div>

            <form method="POST" action="cetak-pdf.php?opd=<?= $opd ?>" target="_blank" id="wilayah-form">
                <div id='wilayah-filter'>
                    <div class="row m-3">
                        <label for="fil-kecamatan" class="col-sm-2 col-form-label">Kecamatan</label>
                        <div class="col-sm-4">
                            <fieldset class="form-group">
                                <select class="form-select" name="kecamatan_id" id="filKecamatan" >
                                    <option value="" selected hidden>Pilih Kecamatan</option>
                                    <?php 
                                    $getKecamatan = getKecamatan();
                                    foreach($getKecamatan as $dataKec) :
                                    ?>

                                    <option value="<?= $dataKec['id_kecamatan']; ?>"><?= $dataKec['nama_kecamatan']; ?></option>
                                    
                                    <?php endforeach; ?>
                                </select>
                            </fieldset>
                        </div>
                        <label for="fil-kelurahan" class="col-sm-2 col-form-label">Kelurahan</label>
                        <div class="col-sm-4">
                            <fieldset class="form-group">
                                <select class="form-select" name="kelurahan_id" id="filKelurahan" >
                                    <option value="x" selected hidden>Pilih Kelurahan</option>
                                    <option value=""></option>
                                </select>
                            </fieldset>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" name="submit" class="btn btn-primary" id="pdf-start" style="margin-right:10px;">PDF</button>
                        <button class="btn btn-primary" id="filter-btn" style="margin-right:30px;">Filter</button>
                    </div>
                </div>
            </form>

            <script>
                $(document).ready(function() {
                    $('#filKecamatan').change(function() {
                        let kecamatan_id = $(this).val();
                        $.ajax({
                            type : "POST",
                            url : "../lt-kb/get-kelurahan.php",
                            data : {kecamatan_id : kecamatan_id},
                            dataType : "json",
                            success : function(data) {
                                var options = '';
                                $.each(data, function(index, value){
                                    options += '<option value="' + value.id_kelurahan + '">' + value.nama_kelurahan + '</option>';
                                });
                                $('#filKelurahan').html(options)
                            }
                        })
                    })

                    $('#filter-btn').click(function(event) {
                        event.preventDefault();
                        
                        let filKecamatan = $('#filKecamatan').val();
                        let filKelurahan = $('#filKelurahan').val();

                        let urlParams = new URLSearchParams(window.location.search);
                        let opdParam = urlParams.get('opd');

                        let postData = {
                            opd: opdParam,
                            kecamatan_id: filKecamatan,
                            kelurahan_id: filKelurahan
                        };

                        $.ajax({
                            url: 'filter.php',
                            type: 'POST',
                            data: postData,
                            success: function(response) {
                                $('#table1 tbody').html(response);
                            }
                        });
                    });

                })
            </script>

            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                        <th class="text-center">No</th>
                            <th class="text-center">Judul</th>
                            <th class="text-center">Deskripsi</th>
                            <th class="text-center">Tanggal</th>
                            <th class="text-center">Jenis</th>
                            <th class="text-center">Tempat</th>
                            <th class="text-center">Kecamatan</th>
                            <th class="text-center">Kelurahan</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $no = 0;
                    while ($row = $query->fetch_array()) {
                        $no++;
                    ?>
                        <tr>
                            <td class="text-center"><?= $no ?></td>
                            <td class="text-center"><?= $row['judul_intervensi'] ?></td>
                            <td class="text-center"><?= $row['deskripsi_intervensi'] ?></td>
                            <td class="text-center"><?= date('d-m-Y', strtotime($row['tgl_intervensi'])) ?></td>
                            <td class="text-center"><?= $row['nama_jenis'] ?></td>
                            <td class="text-center"><?= $row['tempat_intervensi'] ?></td>
                            <td class='text-center'><?= $row['nama_kecamatan'] ?></td>
                            <td class='text-center'><?= $row['nama_kelurahan'] ?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <script>
        $('#wilayah-form').hide()
        $(document).ready(function(){
            var isFilterHide = $('#wilayah-form').hide()
            var isFilterShow = false
            $('#btn-rincian').click(function(){
                if(isFilterHide){
                    $('#wilayah-form').show()
                } if(isFilterShow) {
                    $('#wilayah-form').hide()
                }
                isFilterShow = !isFilterShow
            })

        })
    </script>

<?php 
include '../utilities/footer.php';
?>