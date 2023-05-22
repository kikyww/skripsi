<?php 
    include '../koneksi.php';
    include '../utilities/sidebar.php';
    include '../function/Kecamatan.php';
    $id_user = $_SESSION['id_user'];

    if(!isset($id_user)){
        header('Location: ../index.php');
    }

    $query = mysqli_query($konek, "SELECT *, SUM(DATE_SUB(CURDATE(), INTERVAL 49 YEAR) >= tb_keluarga.lahir_keluarga) AS age_nonpus, SUM(DATE_SUB(CURDATE(), INTERVAL 50 YEAR) <= tb_keluarga.lahir_keluarga) AS age_pus FROM tb_keluarga INNER JOIN tb_kepkel ON tb_keluarga.kepkel_id = tb_kepkel.id_kepkel INNER JOIN tb_kecamatan ON tb_keluarga.kecamatan_id = tb_kecamatan.id_kecamatan LEFT JOIN tb_kelurahan ON tb_keluarga.kelurahan_id = tb_kelurahan.id_kelurahan GROUP BY tb_keluarga.kecamatan_id, tb_keluarga.kelurahan_id ORDER BY tb_keluarga.kecamatan_id DESC, tb_keluarga.kelurahan_id DESC");
?>

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last"></div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Laporan</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Laporan PUS</li>
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
                    Laporan PUS
                </div>
                <div class="buttons">
                    <button class="btn btn-primary" style="margin-right:30px;" id="rincian">Rincian</button>
                </div>
            </div>

            <div class="col-12" id="btn-rincian">
                <div class="card-header">
                    <h4>Rincian PUS</h4>
                </div>
                <div class="card-body">
                    <div class="buttons">
                        <button class="btn btn-secondary" id="btn-filter">Filter</button>
                        <button class="btn btn-secondary" id="btn-pdf">PDF</button>
                        <button class="btn btn-secondary" id="csv-export">CSV (All)</button>
                        <button class="btn btn-secondary" id="excel-export">Excell (All)</button>
                        <a href="chart.php" class="btn btn-secondary">Chart</a>
                    </div>
                </div>
            </div>

            <form method="POST" action="cetak-pdf.php" target="_blank" id="wilayah-form">
                <div id='wilayah-filter'>
                    <div class="row m-3">
                        <label for="fil-kecamatan" class="col-sm-2 col-form-label">Kecamatan</label>
                        <div class="col-sm-4">
                            <fieldset class="form-group">
                                <select class="form-select" name="kecamatan_id" id="filKecamatan" required>
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
                                <select class="form-select" name="kelurahan_id" id="filKelurahan" required>
                                    <option value="x" selected hidden>Pilih Kelurahan</option>
                                    <option value=""></option>
                                </select>
                            </fieldset>
                        </div>
                        <label for="fil-kategori" class="col-sm-2 col-form-label">Kategori</label>
                        <div class="col-sm-5">
                            <fieldset class="form-group">
                                <select class="form-select" name="kategori" id="filKategori" required>
                                    <option value="PUS" selected>PUS (Pasangan Usia Subur Kurang 50 Tahun)</option>
                                    <option value="Non-PUS">Non-PUS (Pasangan Usia Diatas 50 Tahun)</option>
                                </select>
                            </fieldset>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-primary" id="csv-start" style="margin-right:10px;">CSV</button>
                        <button class="btn btn-primary" id="excel-start" style="margin-right:10px;">Excel</button>
                        <button type="submit" name="submit" class="btn btn-primary" id="pdf-start" style="margin-right:10px;">PDF</button>
                        <button class="btn btn-primary" id="filter-btn" style="margin-right:30px;">Filter</button>
                    </div>
                </div>
            </form>

            <script>
                $(document).ready(function() {
                    $('#filKecamatan').change(function() {
                        var kecamatan_id = $(this).val();
                        $.ajax({
                            type : "POST",
                            url : "get-kelurahan.php",
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

                    $('#filter-btn').click(function(event) {
                        event.preventDefault()
                        var filKecamatan = $('#filKecamatan').val()
                        var filKelurahan = $('#filKelurahan').val()
                        var filKategori = $('#filKategori').val()
                    
                        $.ajax({
                            url: 'filter.php',
                            type: 'POST',
                            data: {
                                kecamatan_id: filKecamatan,
                                kelurahan_id: filKelurahan,
                                kategori: filKategori
                            },
                            success: function(response) {
                                $('#table1 tbody').html(response)
                            }
                        })
                    })
                
                    $('#csv-start').click(function(event) {
                        event.preventDefault()
                        var filKecamatan = $('#filKecamatan').val()
                        var filKelurahan = $('#filKelurahan').val()
                        var url = 'export-csv.php'
                        var xhr = new XMLHttpRequest()

                        xhr.open('POST', url, true)
                        xhr.responseType = 'blob'
                        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')

                        xhr.onload = function() {
                            if (this.status === 200) {
                                var blob = new Blob([this.response], { type: 'text/csv' })
                                var link = document.createElement('a')
                                link.href = window.URL.createObjectURL(blob)
                                link.download = 'tidak_kb.csv'
                                link.click()
                            }
                        }
                        xhr.send('kecamatan_id=' + filKecamatan + '&kelurahan_id=' + filKelurahan)
                    })
                
                    $('#excel-start').click(function(event) {
                        event.preventDefault()
                        var filKecamatan = $('#filKecamatan').val()
                        var filKelurahan = $('#filKelurahan').val()
                        var kategori = $('#filKategori').val()
                        var url = 'export-excel.php'
                        var xhr = new XMLHttpRequest()

                        xhr.open('POST', url, true)
                        xhr.responseType = 'blob'
                        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')

                        xhr.onload = function() {
                            if (this.status === 200) {
                                var blob = new Blob([this.response], { type: 'text/xls' })
                                var link = document.createElement('a')
                                link.href = window.URL.createObjectURL(blob)
                                link.download = 'laporan-data-PUS-Non-Pus.xlsx'
                                link.click()
                            }
                        }
                        xhr.send('kecamatan_id=' + filKecamatan + '&kelurahan_id=' + filKelurahan + '&kategori=' + kategori)
                    })
                })

                $(document).on('click', '#csv-export', function(e) {
                    e.preventDefault()
                    var url = 'export-csv.php'
                    window.open(url, '_blank')
                })

                $(document).on('click', '#excel-export', function(e) {
                    e.preventDefault();
                    var url = 'export-excel.php'
                    window.open(url, '_blank')
                })
            </script>

            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Kecamatan</th>
                            <th class="text-center">Kelurahan</th>
                            <th class="text-center">PUS</th>
                            <th class="text-center">Non-PUS</th>
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
                            <td class='text-center'><?= $row['nama_kecamatan'] ?></td>
                            <td class='text-center'><?= $row['nama_kelurahan'] ?></td>
                            <td class='text-center'><?= $row['age_pus'] ?></td>
                            <td class='text-center'><?= $row['age_nonpus'] ?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <script>
        $('#btn-rincian').hide()
        $('#wilayah-form').hide()
        $(document).ready(function(){
            var isBtnHide = $('#btn-rincian').hide()
            var isBtnShow = false
            $('#rincian').click(function(){
                if(isBtnHide){
                    $('#btn-rincian').show()
                } if(isBtnShow) {
                    $('#btn-rincian').hide()
                }
                isBtnShow = !isBtnShow
            })

            var isFilterHide = $('#wilayah-form').hide()
            var isFilterShow = false
            $('#btn-filter').click(function(){
                if(isFilterHide){
                    $('#wilayah-form').show()
                } if(isFilterShow) {
                    $('#wilayah-form').hide()
                }
                isFilterShow = !isFilterShow
            })

            var isPDFShow = false
            $('#btn-pdf').click(function(){
                if(isFilterHide){
                    $('#wilayah-form').show()
                    $('#pdf-start').show()
                    $('#btn-pdf').hide()                
                } if(isPDFShow){
                    $('#filter_form').hide()
                    $('#pdf-start').hide()
                    $('#btn-pdf').show()
                }
                isPDFShow = !isPDFShow
            })
        })
    </script>

<?php 
include '../utilities/footer.php';
?>