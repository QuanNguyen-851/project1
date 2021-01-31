<?php
session_start();
if (isset($_SESSION['giohang']) && isset($_GET['masp']) && isset($_GET['soluong'])) {

    $masp = $_GET['masp'];
    $soluong = $_GET['soluong']; //số lượng muốn mua 
    include('../../connect/open.php');
    //lấy số lượng kho
    $sql = "SELECT * FROM `product` WHERE maSP='$masp'";
    $result = mysqli_query($con, $sql);
    $kho = mysqli_fetch_array($result);
    if ($soluong >= $kho['soLuong']) {
        header('Location:index.php?err=1');
    } else {
        include('../../connect/close.php');
        $_SESSION['giohang'][$masp] = $soluong + 1;
        $giohang = $_SESSION['giohang'];
        header('Location:index.php');
    }
}
