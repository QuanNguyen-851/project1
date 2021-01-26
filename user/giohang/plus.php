<?php
session_start();
if (isset($_SESSION['giohang']) && isset($_GET['masp']) && isset($_GET['soluong'])) {

    $masp = $_GET['masp'];
    $soluong = $_GET['soluong'];
    $_SESSION['giohang'][$masp] = $soluong + 1;
    $giohang = $_SESSION['giohang'];
    header('Location:index.php');
}
