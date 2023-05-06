<?php 
    include '../utilities/sidebar.php';
    include '../koneksi.php';
    $id_user = $_SESSION['id_user'];

    if(!isset($id_user)){
        header('Location: ../index.php');
    }
    $kec = $_GET['kec'];
    $kel = $_GET['kel'];
    $query = mysqli_query($konek, "SELECT * FROM tb_kb LEFT JOIN tb_kelurahan ON tb_kb.kelurahan_id = tb_kelurahan.id_kelurahan LEFT JOIN tb_kecamatan ON tb_kb.kecamatan_id = tb_kecamatan.id_kecamatan LEFT JOIN tb_kepkel ON tb_kb.kepkel_id = tb_kepkel.id_kepkel LEFT JOIN tb_keluarga ON tb_kb.keluarga_id = tb_keluarga.id_keluarga LEFT JOIN tb_obat ON tb_kb.obat_id = tb_obat.id_obat LEFT JOIN tb_stok ON tb_kb.stok_id = tb_stok.id_stok WHERE tb_kecamatan.nama_kecamatan = '$kec' AND tb_kelurahan.nama_kelurahan = '$kel'");


?>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last"></div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="kb.php">KB</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Kecamatan <?= $kec ?></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="d-flex justify-content-between align-items-center">
                <div class="card-header">
                    Kelurahan <?= $kel ?>
                </div>
                <div class="buttons">
                    <a class="btn btn-secondary" style="margin-right:20px;" href="kelurahan.php?kec=<?= $kec ?>"><i class="fa fa-arrow-left"></i></a>
                    <a class="btn btn-primary" style="margin-right:30px;" href="create.php?kec=<?= $kec ?>&kel=<?= $kel ?>"><i class="fa fa-plus"></i></a>
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
                                url: 'filter.php?kec=<?= $kec ?>&kel=<?= $kel ?>',
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
                            <th>Kepala Keluarga</th>
                            <th>Nama (KB)</th>
                            <th>Alamat</th>
                            <th>Tanggal KB</th>
                            <th>KB Ulang</th>
                            <th>Obat/Alat</th>
                            <th>Jumlah</th>
                            <th>Aksi</th>
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
                            <td>$row[alamat_kepkel]</td>
                            <td>$row[tgl_kb]</td>
                            <td>$row[tgl_kembali]</td>
                            <td>$row[nama_obat]</td>
                            <td>$row[jumlah_obat]</td>
                            <td>
                            <a href='update.php?kec=$kec&kel=$kel&id=$row[0]' class='btn icon btn-primary'><i class='bi bi-pencil'></i></a>
                            <a href='delete.php?kec=$kec&kel=$kel&id=$row[0]' onclick='return confirm(\" Hapus?\");' class='btn icon btn-danger'><i class='bi bi-trash'></i></a>
                            </td>
                        </tr>";
                    }?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

<?php 
include '../utilities/footer.php';
?>