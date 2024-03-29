<?php 
session_start();

if (!isset($_SESSION['id_user']) && $_SESSION['id_user'] == false) {
    header('location:../auth/login.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skripsi</title>
    
    <link rel="stylesheet" href="../assets/css/main/app.css">
    <link rel="stylesheet" href="../assets/css/main/app-dark.css">
    <!-- <link rel="shortcut icon" href="../assets/images/logo/favicon.svg" type="image/x-icon"> -->
    <link rel="shortcut icon" href="../assets/images/logo/bkkbn-fav.png" type="image/png">
    
    <link rel="stylesheet" href="../assets/css/shared/iconly.css">
    <link rel="stylesheet" href="../assets/extensions/@fortawesome/fontawesome-free/css/all.min.css">

    <!-- Simple Datatable -->
    <link rel="stylesheet" href="../assets/extensions/simple-datatables/style.css">
    <link rel="stylesheet" href="../assets/css/pages/simple-datatables.css">

    <!-- Sweet Alert -->
    <link rel="stylesheet" href="../assets/extensions/sweetalert2/sweetalert2.min.css">
    <script src="../assets/extensions/sweetalert2/sweetalert2.min.js"></script>
    <script src="../assets/js/pages/sweetalert2.js"></script>

    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- jQuery UI CDN -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Alpine.js -->
    <!-- <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.12.0/dist/cdn.min.js"></script> -->
    
    <!-- Sweet Alert2 -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script> -->

    <!-- jquery -->
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css"> -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css"> -->

    <!-- template jquery -->
    <!-- <link rel="stylesheet" href="../assets/css/pages/fontawesome.css">
    <link rel="stylesheet" href="../assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="../assets/css/pages/datatables.css"> -->
</head>

<body> 
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
    <div class="sidebar-header position-relative">
        <div class="d-flex justify-content-between align-items-center">
            <div class="log">
                <a href="../index.php"><img src="../assets/images/logo/bkkbn.png" alt="Logo" srcset=""></a>
            </div>
            <div class="theme-toggle d-flex gap-2  align-items-center mt-2">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--system-uicons" width="20" height="20" preserveAspectRatio="xMidYMid meet" viewBox="0 0 21 21"><g fill="none" fill-rule="evenodd" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><path d="M10.5 14.5c2.219 0 4-1.763 4-3.982a4.003 4.003 0 0 0-4-4.018c-2.219 0-4 1.781-4 4c0 2.219 1.781 4 4 4zM4.136 4.136L5.55 5.55m9.9 9.9l1.414 1.414M1.5 10.5h2m14 0h2M4.135 16.863L5.55 15.45m9.899-9.9l1.414-1.415M10.5 19.5v-2m0-14v-2" opacity=".3"></path><g transform="translate(-210 -1)"><path d="M220.5 2.5v2m6.5.5l-1.5 1.5"></path><circle cx="220.5" cy="11.5" r="4"></circle><path d="m214 5l1.5 1.5m5 14v-2m6.5-.5l-1.5-1.5M214 18l1.5-1.5m-4-5h2m14 0h2"></path></g></g></svg>
                <div class="form-check form-switch fs-6">
                    <input class="form-check-input  me-0" type="checkbox" id="toggle-dark" >
                    <label class="form-check-label" ></label>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--mdi" width="20" height="20" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path fill="currentColor" d="m17.75 4.09l-2.53 1.94l.91 3.06l-2.63-1.81l-2.63 1.81l.91-3.06l-2.53-1.94L12.44 4l1.06-3l1.06 3l3.19.09m3.5 6.91l-1.64 1.25l.59 1.98l-1.7-1.17l-1.7 1.17l.59-1.98L15.75 11l2.06-.05L18.5 9l.69 1.95l2.06.05m-2.28 4.95c.83-.08 1.72 1.1 1.19 1.85c-.32.45-.66.87-1.08 1.27C15.17 23 8.84 23 4.94 19.07c-3.91-3.9-3.91-10.24 0-14.14c.4-.4.82-.76 1.27-1.08c.75-.53 1.93.36 1.85 1.19c-.27 2.86.69 5.83 2.89 8.02a9.96 9.96 0 0 0 8.02 2.89m-1.64 2.02a12.08 12.08 0 0 1-7.8-3.47c-2.17-2.19-3.33-5-3.49-7.82c-2.81 3.14-2.7 7.96.31 10.98c3.02 3.01 7.84 3.12 10.98.31Z"></path></svg>
            </div>
            <div class="sidebar-toggler x">
                <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
            </div>
        </div>
    </div>
    <div class="sidebar-menu">
        <ul class="menu">
            <li class="sidebar-title">Menu</li>
            <li class="sidebar-item active ">
                <a href="../index.php" class='sidebar-link'>
                    <i class="bi bi-grid-fill"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <?php if($_SESSION['roles'] == 'ADMIN'){ ?>
            <li class="sidebar-item  has-sub">
                <a href="#" class='sidebar-link'>
                    <i class="bi bi-house-fill"></i>
                    <span>Master Admin</span>
                </a>
                <ul class="submenu ">
                    <li class="submenu-item ">
                        <a href="../akun/list.php">Akun dan Registrasi</a>
                    </li>
                    <li class="submenu-item ">
                        <a href="../kecamatan/kecamatan.php">Kecamatan</a>
                    </li>
                    <li class="submenu-item ">
                        <a href="../kelurahan/kelurahan.php">Kelurahan</a>
                    </li>
                    <li class="submenu-item ">
                        <a href="../obat/obat.php">Obat/Alat KB</a>
                    </li>
                    <li class="submenu-item ">
                        <a href="../jenis-inv/jenis.php">Jenis Intervensi</a>
                    </li>
                    <li class="submenu-item ">
                        <a href="../opd/opd.php">OPD</a>
                    </li>
                </ul>
            </li>
            <?php } ?>

            <?php if($_SESSION['roles'] == 'ADMIN' || $_SESSION['roles'] == 'PKB'){ ?>
            <li class="sidebar-item">
                <a href="../stok/stok.php" class='sidebar-link'>
                    <i class="bi bi-thermometer-half"></i>
                    <span>Kelola Stok</span>
                </a>
            </li>
            <?php } ?>

            <?php if($_SESSION['roles'] == 'ADMIN' || $_SESSION['roles'] == 'PKB'){ ?>
            <li class="sidebar-item has-sub">
                <a href="#" class='sidebar-link'>
                    <i class="bi bi-stack"></i>
                    <span>Data Akseptor KB</span>
                </a>
                <ul class="submenu ">
                    <li class="submenu-item ">
                        <a href="../keluarga/kecamatan.php">Akseptor KB</a>
                    </li>
                    <li class="submenu-item ">
                        <a href="../kb/kecamatan.php">Catatan KB</a>
                    </li>
                    <li class="submenu-item ">
                        <a href="../t-kb/kecamatan.php">Catatan Tidak KB</a>
                    </li>
                </ul>
            </li>

            <li class="sidebar-item  has-sub">
                <a href="#" class='sidebar-link'>
                    <i class="bi bi-building"></i>
                    <span>Data Intervensi</span>
                </a>
                <ul class="submenu ">
                    <li class="submenu-item ">
                        <a href="../agenda/agenda.php">Agenda Intervensi</a>
                    </li>
                    <li class="submenu-item ">
                        <a href="../catatan/catatan.php">Catatan</a>
                    </li>
                    <li class="submenu-item ">
                        <a href="../intervensi/kecamatan.php">Intervensi</a>
                    </li>
                </ul>
            </li>
            <?php } ?>

            <?php if($_SESSION['roles'] == 'ADMIN' || $_SESSION['roles'] == 'KABID'){ ?>
            <li class="sidebar-item has-sub">
                <a href="#" class='sidebar-link'>
                    <i class="bi bi-collection-fill"></i>
                    <span>Laporan KB</span>
                </a>
                <ul class="submenu ">
                    <li class="submenu-item">
                        <a href="../l-kb/report.php">Laporan KB</a>
                    </li>
                    <li class="submenu-item">
                        <a href="../l-obat/report.php">Obat/Alat Digunakan</a>
                    </li>
                    <li class="submenu-item">
                        <a href="../l-lokasi/report.php">Lokasi KB</a>
                    </li>
                    <li class="submenu-item">
                        <a href="../lt-kb/report.php">Laporan Tidak KB</a>
                    </li>
                    <li class="submenu-item">
                        <a href="../l-pus/report.php">Laporan PUS</a>
                    </li>
                </ul>
            </li>

            <li class="sidebar-item has-sub">
                <a href="#" class='sidebar-link'>
                    <i class="bi bi-book-fill"></i>
                    <span>Laporan Intervensi</span>
                </a>
                <ul class="submenu ">
                    <li class="submenu-item">
                        <a href="../l-intervensi/report.php">Laporan Intervensi</a>
                    </li>
                    <li class="submenu-item">
                        <a href="../l-sosialisasi/report.php">Laporan Sosialisasi</a>
                    </li>
                    <li class="submenu-item">
                        <a href="../l-kunjungan/report.php">Laporan Kunjungan</a>
                    </li>
                </ul>
            </li>
            <?php } ?>

        </ul>
    </div>
        </div>
    </div>
</div>
<div id="main" class='layout-navbar'>
<header class='mb-3'>
                <nav class="navbar navbar-expand navbar-light navbar-top">
                    <div class="container-fluid">
                        <a href="#" class="burger-btn d-block d-xl-none">
                            <i class="bi bi-justify fs-3"></i>
                        </a>

                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ms-auto mb-lg-0"></ul>
                            <div class="dropdown">
                                <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                    <div class="user-menu d-flex">
                                        <div class="user-name text-end me-3">
                                            <h6 class="mb-0 text-gray-600"><?= $_SESSION['nama']; ?></h6>
                                            <p class="mb-0 text-sm text-gray-600"><?= $_SESSION['roles']; ?></p>
                                        </div>
                                        <div class="user-img d-flex align-items-center">
                                            <div class="avatar avatar-md">
                                                <img src="../assets/images/faces/1.jpg">
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton" style="min-width: 11rem;">
                                    <li>
                                        <h6 class="dropdown-header">Hello, <?= $_SESSION['nama']; ?>!</h6>
                                    </li>
                                    <li><a class="dropdown-item" href="../akun/profil.php?username=<?= $_SESSION['username'] ?>"><i class="icon-mid bi bi-person me-2"></i> My
                                            Profile</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="../auth/logout.php" onclick="return confirm('Ingin logout?');"><i class="icon-mid bi bi-box-arrow-left me-2"></i>Logout</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>
            </header>

<div id="main-content">
