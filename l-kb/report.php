<?php 
    include '../utilities/sidebar.php';
    include '../koneksi.php';
    $id_user = $_SESSION['id_user'];

    if(!isset($id_user)){
        header('Location: ../index.php');
    }

    $query = mysqli_query($konek, "SELECT * FROM tb_kb LEFT JOIN tb_kelurahan ON tb_kb.kelurahan_id = tb_kelurahan.id_kelurahan LEFT JOIN tb_kecamatan ON tb_kb.kecamatan_id = tb_kecamatan.id_kecamatan LEFT JOIN tb_kepkel ON tb_kb.kepkel_id = tb_kepkel.id_kepkel LEFT JOIN tb_keluarga ON tb_kb.keluarga_id = tb_keluarga.id_keluarga LEFT JOIN tb_obat ON tb_kb.obat_id = tb_obat.id_obat LEFT JOIN tb_stok ON tb_kb.stok_id = tb_stok.id_stok ORDER BY tb_kecamatan.nama_kecamatan ASC, tb_kelurahan.nama_kelurahan ASC");


?>

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last"></div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Laporan</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Laporan KB</li>
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
                    Laporan KB
                </div>
                <div class="buttons">
                    <button class="btn btn-primary" style="margin-right:30px;" id="rincian">Rincian</button>
                </div>
            </div>

            <div class="col-12" id="btn-rincian">
                <div class="card-header">
                    <h4>Rincian Laporan KB</h4>
                </div>
                <div class="card-body">
                    <p class="text-muted">Rincian dari laporan kb</p>
                    <div class="buttons">
                        <button class="btn btn-secondary" id="btn-filter">Date Filter</button>
                        <a href="chart.php" class="btn btn-secondary">Chart</a>
                        <button class="btn btn-secondary" id="btn-pdf">PDF</button>
                    </div>
                </div>
            </div>

            <form method="POST" action="tes-cetak.php" id="filter_form">
                <div id='date-filter'>
                    <div class="row m-3">
                        <label for="start_date" class="col-sm-2 col-form-label">Mulai Tanggal:</label>
                        <div class="col-sm-4">
                            <input type="date" class="form-control" id="start_date" name="start_date">
                        </div>
                        <label for="end_date" class="col-sm-2 col-form-label">Sampai Tanggal:</label>
                        <div class="col-sm-4">
                            <input type="date" class="form-control" id="end_date" name="end_date">
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" name="submit" class="btn btn-primary" style="margin-right:10px;">Cetak PDF</button>
                        <button type="submit" class="btn btn-primary" style="margin-right:30px;">Filter</button>
                    </div>
                </div>
            </form>

            <script>
                $(document).ready(function() {
                    $('#filter_form').submit(function(event) {
                        event.preventDefault()
                        var start_date = $('#start_date').val();
                        var end_date = $('#end_date').val();
                    
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
                })
            </script>

            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kepala Keluarga</th>
                            <th>Nama (KB)</th>
                            <th>Tanggal KB</th>
                            <th>KB Ulang</th>
                            <th>Obat/Alat</th>
                            <th>Jumlah</th>
                            <th>Kecamatan</th>
                            <th>Kelurahan</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $no = 0;
                    while ($row = $query->fetch_array()) {
                        $no++;
                    echo"
                        <tr>
                            <td>$no</td>
                            <td>$row[nama_kepkel]</td>
                            <td>$row[nama_keluarga]</td>
                            <td>$row[tgl_kb]</td>
                            <td>$row[tgl_kembali]</td>
                            <td>$row[nama_obat]</td>
                            <td>$row[jumlah_obat]</td>
                            <td>$row[nama_kecamatan]</td>
                            <td>$row[nama_kelurahan]</td>
                        </tr>";
                    }?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>


    <script>
        $('#btn-rincian').hide()
        $('#filter_form').hide()
        $(document).ready(function(){
            var isBtnShow = $('#btn-rincian').hide()
            var isBtnHide = false
            $('#rincian').click(function(){
                if(isBtnShow){
                    $('#btn-rincian').show()
                } if(isBtnHide) {
                    $('#btn-rincian').hide()
                }
                isBtnHide = !isBtnHide
            })

            var isFilterShow = $('#filter_form').hide()
            var isFilterHide = false
            $('#btn-filter').click(function(){
                if(isFilterShow){
                    $('#filter_form').show()
                } if(isFilterHide) {
                    $('#filter_form').hide()
                }
                isFilterHide = !isFilterHide
            })

            

        })
    
    </script>

<?php 
include '../utilities/footer.php';
?>