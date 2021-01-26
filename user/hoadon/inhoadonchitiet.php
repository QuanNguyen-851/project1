<?php
session_start();
if (isset($_SESSION['giohang']) && isset($_SESSION['user']) && isset($_GET['mauser']) && isset($_GET['time'])) {
    $mauser = $_GET['mauser'];
    $time = $_GET['time'];
    $giohang = $_SESSION['giohang'];
    //lấy mã đơn hàng
    include('../../connect/open.php');
    $sql = "SELECT * FROM `hoadon` WHERE maUser='$mauser' AND ngayDat='$time'";
    $result = mysqli_query($con, $sql);
    $hoadon = mysqli_fetch_array($result);
    $mahd = $hoadon['maHd'];

    //in hoadonchitiet
    foreach ($giohang as $masp => $soluong) {
        // lấy giá
        $sqlgia = "SELECT * FROM `product` WHERE maSP='$masp'";
        $resultgia = mysqli_query($con, $sqlgia);
        $product = mysqli_fetch_array($resultgia);
        $gia = $product['gia'];
        // insert
        $sqlin = "INSERT INTO `hoadonchitiet`(`maSp`, `maHd`, `soluong`, `gia`) VALUES ('$masp','$mahd','$soluong','$gia')";
        mysqli_query($con, $sqlin);
    }
    //clear giỏ hàng
    unset($_SESSION['giohang']);
    include('../../connect/close.php');
    header("Location:index.php");
} else {
    header("Location:../common/index.php");
}
