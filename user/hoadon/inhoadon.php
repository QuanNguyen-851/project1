<?php
session_start();
if (isset($_SESSION['giohang']) && isset($_SESSION['user']) && isset($_POST['tongtien']) && isset($_POST['ten']) && isset($_POST['sdt']) && isset($_POST['address'])) {
    $tongtien = $_POST['tongtien'];
    $ten = $_POST['ten'];
    $sdt = $_POST['sdt'];
    $address = $_POST['address'];
    date_default_timezone_set("Asia/Ho_Chi_Minh");
    $time = date("Y-m-d") . " " . date("H:i:s");
    include("../../connect/open.php");
    $tenuser = $_SESSION['user'];
    $sqluser = "select * from user1 where `userName`='$tenuser'";
    $resultuser = mysqli_query($con, $sqluser);
    $user = mysqli_fetch_array($resultuser);
    $ma_user = $user['maUser'];
    //insert hoadon
    $sqlhoadon = "INSERT INTO `hoadon`(`maUser`, `tongTien`, `ngayDat`, `address`, `sdt`, `tenNguoiNhan`) VALUES ('$ma_user','$tongtien','$time','$address','$sdt','$ten')";
    mysqli_query($con, $sqlhoadon);
    include("../../connect/close.php");
    header("Location: inhoadonchitiet.php?mauser=$ma_user&time=$time ");
} else {
    header("Location:../common/index.php");
}
