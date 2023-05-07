<?php 
    include '../koneksi.php';
    session_start();
    $id_user = $_SESSION['id_user'];

    if (!isset($id_user)) {
        header('Location: ../index.php');
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak</title>
</head>

<body>

    <style>
        .demo {
            border: 1px solid;
            border-collapse: collapse;
            padding: 5px;
        }
    
        .demo th {
            border: 1px solid;
            padding: 5px;
            font-weight: normal;
        }
    
        .demo td {
            border: 1px solid;
            padding: 5px;
        }
    
        hr {
            border-bottom: 5px double #000;
            clear: both;
        }

        .cop {
            float: left;
            width: 550px;
            text-align: center;
        }

        .style1 {
            font-size: 16;
        }

        .style2 {
            font-size: 24px;
        }

        h2, h1, h3{
            padding: 0;
            margin: 0;
        }

        h1 {
            font-size: 22px;
            font-weight: bold;
        }

        h2 {
            font-size: 22px;
            font-weight: normal;
        }

        .logos {
            width: 95px;
            float: left;	
            margin-bottom: 8px;
        }

    </style>

    <div style=" position:relative; display:flex;">
        <div style="justify-content: center; align-items: center; margin:auto; ">
        <div style="display:flex; justify-content: center; width:650px; margin:auto; align-items: center;">    
        <div class="logos">
                <img src="../assets/images/logo/pemko.png" width="100" height="130">
            </div>
        <div class="cop">
            <h2 class="style1">PEMERINTAH PROVINSI KALIMANTAN SELATAN</h2>
            <h1 class="style2">DINAS PENGENDALIAN PENDUDUK KELUARGA BERENCANA DAN PEMERDAYAAN MASYARAKAT</h1>
            Jalan Brig Jend. Hasan Basri No. 16 <br />
            Telp./Fax. (0511) 3301346 Banjarmasin 70124</div>
        </div>
        <hr>