<?php
session_start();
if (isset($_POST['masp']) && isset($_POST['soluong'])) {
    $masp = $_POST['masp'];
    $soluong = $_POST['soluong'];
    if (isset($_SESSION['giohang'])) {
        $_SESSION['giohang'][$masp] += $soluong;
    } else {
        $_SESSION['giohang'][$masp] = $soluong;
    }
    echo $masp;
    echo $soluong;
    header("location:../common/index.php");
} else {
    header("location:../common/index.php");
}
