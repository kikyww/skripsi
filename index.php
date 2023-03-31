<?php
session_start();

if(!isset($_SESSION['id_user'])){
    header('Location: login/login.php');
} else {
    header('Location: utilities/dashboard.php');
} exit;