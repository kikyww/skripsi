<?php 
    include '../utilities/sidebar.php';
    include '../koneksi.php';
    $id_user = $_SESSION['id_user'];

    if(!isset($id_user)){
        header('Location: ../index.php');
    }

    $query = mysqli_query($konek, "SELECT * FROM tb_stok LEFT JOIN tb_obat ON tb_stok.obat_id = tb_obat.id_obat LEFT JOIN tb_kecamatan ON tb_stok.kecamatan_id = tb_kecamatan.id_kecamatan ORDER BY tb_stok.stok_stamp DESC");

?>

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last"></div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Laporan</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Laporan Obat/Alat</li>
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
                    Laporan Obat/Alat
                </div>
                <div class="buttons">
                    <button class="btn btn-primary" style="margin-right:30px;" id="rincian">Rincian</button>
                </div>
            </div>

            <div class="col-12" id="btn-rincian">
                <div class="card-header">
                    <h4>Rincian Laporan Obat</h4>
                </div>
                <div class="card-body">
                    <div class="buttons">
                        <button class="btn btn-secondary" id="btn-filter">Date Filter</button>
                        <button class="btn btn-secondary" id="btn-pdf">PDF</button>
                        <button class="btn btn-secondary" id="csv-export">CSV (All)</button>
                        <button class="btn btn-secondary" id="excel-export">Excell (All)</button>
                        <a href="detail.php" class="btn btn-secondary">Detail</a>
                    </div>
                </div>
            </div>

            <form method="POST" action="cetak-pdf.php" target="_blank" id="filter_form">
                <div id='date-filter'>
                    <div class="row m-3">
                        <label for="start_date" class="col-sm-2 col-form-label">Mulai Tanggal:</label>
                        <div class="col-sm-4">
                            <input type="date" class="form-control" id="start_date" name="start_date" required>
                        </div>
                        <label for="end_date" class="col-sm-2 col-form-label">Sampai Tanggal:</label>
                        <div class="col-sm-4">
                            <input type="date" class="form-control" id="end_date" name="end_date" required>
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
                    $('#filter-btn').click(function(event) {
                        event.preventDefault()
                        var start_date = $('#start_date').val()
                        var end_date = $('#end_date').val()
                    
                        $.ajax({
                            url: 'filter.php',
                            type: 'POST',
                            data: {
                                start_date: start_date,
                                end_date: end_date
                            },
                            success: function(response) {
                                $('#table1 tbody').html(response)
                            }
                        })
                    })
                
                    $('#csv-start').click(function(event) {
                        event.preventDefault()
                        var start_date = $('#start_date').val()
                        var end_date = $('#end_date').val()
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
                                link.download = 'data-obat.csv'
                                link.click()
                            }
                        }
                        xhr.send('start_date=' + start_date + '&end_date=' + end_date)
                    })
                
                    $('#excel-start').click(function(event) {
                        event.preventDefault()
                        var start_date = $('#start_date').val()
                        var end_date = $('#end_date').val()
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
                                link.download = 'data-obat.xlsx'
                                link.click()
                            }
                        
                        xhr.send('start_date=' + start_date + '&end_date=' + end_date)
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
                            <th>No</th>
                            <th>Obat / Alat KB</th>
                            <th>Stok Awal</th>
                            <th>Stok Sisa</th>
                            <th>Tanggal Di Stok</th>
                            <th>Tanggal Pengembalian</th>
                            <th>Kecamatan</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $no = 0;
                    while ($row = $query->fetch_array()) {
                        $no++;
                    ?>
                        <tr>
                            <td><?= $no; ?></td>
                            <td><?= $row['nama_obat']; ?></td>
                            <td><?= $row['stok_awal']; ?></td>
                            <td><?= $row['stok_akhir']; ?></td>
                            <td><?= date('d-m-Y', strtotime($row['tgl_awal'])); ?></td>
                            <td><?= date('d-m-Y', strtotime($row['tgl_akhir'])); ?></td>
                            <td><?= $row['nama_kecamatan']; ?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <script>
        $('#btn-rincian').hide()
        $('#filter_form').hide()
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

            var isFilterHide = $('#filter_form').hide()
            var isFilterShow = false
            $('#btn-filter').click(function(){
                if(isFilterHide){
                    $('#filter_form').show()
                } if(isFilterShow) {
                    $('#filter_form').hide()
                }
                isFilterShow = !isFilterShow
            })


            var isPDFShow = false
            $('#btn-pdf').click(function(){
                if(isFilterHide){
                    $('#filter_form').show()
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