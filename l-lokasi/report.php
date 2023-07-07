<?php 
    include '../utilities/sidebar.php';
    include '../koneksi.php';
    $id_user = $_SESSION['id_user'];

    if(!isset($id_user)){
        header('Location: ../index.php');
    }

    $query = mysqli_query($konek, "SELECT * FROM tb_kb LEFT JOIN tb_kecamatan ON tb_kb.kecamatan_id = tb_kecamatan.id_kecamatan LEFT JOIN tb_kelurahan ON tb_kb.kelurahan_id = tb_kelurahan.id_kelurahan GROUP BY tb_kb.tgl_kb ORDER BY tb_kb.tgl_kb DESC");

?>

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last"></div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Laporan KB</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Laporan Tanggal Dan Lokasi KB</li>
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
                    Laporan Tanggal Dan Lokasi KB
                </div>
                <div class="buttons">
                    <button class="btn btn-primary" style="margin-right:30px;" id="rincian">Filter</button>
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
                })
            </script>

            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kelurahan</th>
                            <th>Tanggal</th>
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
                            <td><?= $row['nama_kelurahan']; ?></td>
                            <td><?= date('d-m-Y', strtotime($row['tgl_kb'])); ?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <script>
        $('#filter_form').hide()
        $(document).ready(function(){
            let isFilterHide = $('#filter_form').hide()
            let isFilterShow = false
            $('#rincian').click(function(){
                if(isFilterHide){
                    $('#filter_form').show()
                } if(isFilterShow) {
                    $('#filter_form').hide()
                }
                isFilterShow = !isFilterShow
            })
        })
    </script>

<?php 
include '../utilities/footer.php';
?>