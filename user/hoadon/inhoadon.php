<?php
session_start();
if (isset($_SESSION['giohang']) && isset($_SESSION['user']) && isset($_POST['tongtien']) && isset($_POST['ten']) && isset($_POST['sdt']) && isset($_POST['address'])) {
    include("../../connect/open.php");
    $giohang = $_SESSION['giohang'];
    $check = 1;
    foreach ($giohang as $masp => $soluong) {
        //lấy số lượng sản phẩm trong kho
        $soluongsp = "SELECT * FROM `product` WHERE maSP='$masp'";
        $resultsp = mysqli_query($con, $soluongsp);
        $kho = mysqli_fetch_array($resultsp);
        //trừ số lượng sản phẩm trong dtb
        if ($kho['soLuong'] >= $soluong) {
            $update = $kho['soLuong'] - $soluong;
            $sqlupdate = "UPDATE `product` SET`soLuong`='$update' WHERE maSP='$masp'";
            mysqli_query($con, $sqlupdate);
            $check = $check * 1;
        } else {
            $check = $check * 0;
            $ma = $masp;
        }
    }
    if ($check != 0) {
        $tongtien = $_POST['tongtien'];
        $ten = $_POST['ten'];
        $sdt = $_POST['sdt'];
        $address = $_POST['address'];
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $time = date("Y-m-d") . " " . date("H:i:s");

        $tenuser = $_SESSION['user'];
        $sqluser = "select * from user where `userName`='$tenuser'";
        $resultuser = mysqli_query($con, $sqluser);
        $user = mysqli_fetch_array($resultuser);
        $ma_user = $user['maUser'];
        //insert hoadon
        $sqlhoadon = "INSERT INTO `hoadon`(`maUser`, `tongTien`, `ngayDat`, `address`, `sdt`, `tenNguoiNhan`) VALUES ('$ma_user','$tongtien','$time','$address','$sdt','$ten')";
        mysqli_query($con, $sqlhoadon);
        include("../../connect/close.php");
        header("Location: inhoadonchitiet.php?mauser=$ma_user&time=$time ");
    } else {
        unset($_SESSION['giohang'][$ma]);
        header("location:../common/index.php?cat=1&masp=$ma");
    }
} else {
    header("Location:../common/index.php");
}
