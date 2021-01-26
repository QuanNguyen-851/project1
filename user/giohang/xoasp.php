<?php
session_start();
if (isset($_SESSION['giohang']) && isset($_GET['masp'])) {
    $masp = $_GET['masp'];
    unset($_SESSION['giohang'][$masp]);
    header('location:index.php');
    if ($masp == 0) {
        unset($_SESSION['giohang']);
    }
}
if (isset($_SESSION['giohang']) && isset($_GET['all'])) {
    unset($_SESSION['giohang']);
    header('location:index.php');
}
