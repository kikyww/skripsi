<?php 
    include '../utilities/sidebar.php';
    include '../koneksi.php';
    $id_user = $_SESSION['id_user'];

    if(!isset($id_user)){
        header('Location: ../index.php');
    }
?>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last"></div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="../wilayah.php">Wilayah</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Kecamatan</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="d-flex justify-content-between align-items-center">
                <div class="card-header">
                    Kecamatan
                </div>
                <a class="btn btn-primary" style="margin-right:20px;" href="create.php"><i class="fa fa-plus"></i></a>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>Kecamatan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $query = mysqli_query($konek, "SELECT * FROM tb_kecamatan ORDER BY nama_kecamatan ASC");
                    $no = 0;
                    while ($row = $query->fetch_array()) {
                        $no++;
                    echo"
                        <tr>
                            <td>$row[nama_kecamatan]</td>
                            <td>
                            <a href='update.php?id=$row[0]' class='btn icon btn-primary'><i class='bi bi-pencil'></i></a>
                            <a href='delete.php?id=$row[0]' onclick='return confirm(\" Hapus $row[nama_kecamatan]?\");' class='btn icon btn-danger'><i class='bi bi-trash'></i></a>
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