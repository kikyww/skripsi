<?php
include '../koneksi.php';
$id = $_GET['id'];
$status = $_GET['status'];

if($status == 'Selesai'){
    $sql = mysqli_query($konek, "UPDATE tb_intervensi SET status_intervensi = '$status' WHERE id_intervensi = '$id'");
    if ($sql) {
        echo "<script>alert(`Agenda Telah Selesai`);</script>";
        echo '<meta http-equiv="refresh" content="0; url=./update.php?status='. $status .'&id='. $id .'">';
    }
} else {
    $sql = mysqli_query($konek, "UPDATE tb_intervensi SET status_intervensi = '$status' WHERE id_intervensi = '$id'");
    if ($sql) {
        echo "<script>alert(`Agenda Ditunda`);</script>";
        echo '<meta http-equiv="refresh" content="0; url=./agenda.php">';
    }
}

$konek->close();
exit();

?>
