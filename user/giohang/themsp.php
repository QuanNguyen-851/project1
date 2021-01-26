<?php
session_start();
if (isset($_GET['soluong']) && isset($_SESSION['giohang'])) {
    $soluong = $_GET['soluong'];
    $_SESSION['giohang'][$masp] = $soluong;
    echo "1";
}
