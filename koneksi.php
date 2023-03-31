<?php
$konek = mysqli_connect("localhost", "root", "", "db_skripsi006");
if ($konek) {
    echo mysqli_error($konek);
}