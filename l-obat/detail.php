<?php 
    include '../utilities/sidebar.php';
    include '../koneksi.php';
    $id_user = $_SESSION['id_user'];

    if(!isset($id_user)){
        header('Location: ../index.php');
    }

    $query = mysqli_query($konek, "SELECT *, SUM(tb_kb.jumlah_obat) AS jumlah FROM tb_kb LEFT JOIN tb_kelurahan ON tb_kb.kelurahan_id = tb_kelurahan.id_kelurahan LEFT JOIN tb_kecamatan ON tb_kb.kecamatan_id = tb_kecamatan.id_kecamatan LEFT JOIN tb_keluarga ON tb_kb.keluarga_id = tb_keluarga.id_keluarga LEFT JOIN tb_obat ON tb_kb.obat_id = tb_obat.id_obat LEFT JOIN tb_stok ON tb_kb.stok_id = tb_stok.id_stok GROUP BY tb_stok.id_stok ORDER BY tb_stok.tgl_awal DESC");

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
                    Detail Sasaran Obat
                </div>
                <div class="buttons">
                    <a class="btn btn-secondary" style="margin-right:20px;" href="report.php"><i class="fa fa-arrow-left"></i></a>
                </div>
            </div>

                <form action="POST" id="filter_form">
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
                        <button type="submit" class="btn btn-primary" style="margin-right:30px;">Filter</button>
                    </div>
                </form>

                <script>
                    $(document).ready(function() {
                        $('#filter_form').submit(function(event) {
                            event.preventDefault();

                            var start_date = $('#start_date').val();
                            var end_date = $('#end_date').val();
                        
                            $.ajax({
                                url: 'filter-detail.php',
                                type: 'POST',
                                data: {
                                    start_date: start_date,
                                    end_date: end_date
                                },
                                success: function(response) {
                                    $('#table1 tbody').html(response)
                                }
                            });
                        });
                    });
                </script>

            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kecamatan</th>
                            <th>Obat / Alat KB</th>
                            <th>Total</th>
                            <th>Tanggal</th>
                            <th>Rincian</th>
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
                            <td><?= $row['nama_kecamatan']; ?></td>
                            <td><?= $row['nama_obat']; ?></td>
                            <td><?= $row['jumlah']; ?></td>
                            <td><?= date('d-m-Y', strtotime($row['tgl_awal'])); ?></td>
                            <td>
                                <a href="rincian.php?id=<?=$row['id_stok'] ?>&kec=<?=$row['nama_kecamatan'] ?>&tgl=<?= $row['tgl_awal'] ?>" class="btn btn-primary"><i class="fa fa-book-open"></i></a>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

<?php 
    include '../utilities/footer.php';
?>