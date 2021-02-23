<?php
session_start();
if (isset($_SESSION['user']) && isset($_GET['maHd'])) {
    $maHd = $_GET['maHd'];
    include('../../connect/open.php');
    //sửa lỗi hủy và nhận đơn cùng lúc
    $sql_loi = "SELECT * FROM `hoadon` WHERE maHd='$maHd' ";
    $re = mysqli_query($con, $sql_loi);
    $loi = mysqli_fetch_array($re);
    if ($loi['tinhTrang'] == "") {
        //cộng lại số lượng trong kho 
        $sqlkho = "SELECT * FROM `hoadonchitiet` WHERE maHd='$maHd'";
        $resultkho = mysqli_query($con, $sqlkho);
        while ($hoadonchitiet = mysqli_fetch_array($resultkho)) {
            $soluong = $hoadonchitiet['soluong']; //số lượng sản phẩm của đơn hàng
            $masp = $hoadonchitiet['maSp'];
            //lấy số lượng trong kho
            $sqlproducts = "SELECT * FROM `product` WHERE maSP='$masp'";
            $resultproduct = mysqli_query($con, $sqlproducts);
            $kho = mysqli_fetch_array($resultproduct);
            $tong = $kho['soLuong'] + $soluong;
            $sqlplus = "UPDATE `product` SET `soLuong`='$tong' WHERE maSP='$masp'";
            mysqli_query($con, $sqlplus);
        }

        //cập nhật lại trạng thái
        $sql = "UPDATE `hoadon` SET `tinhTrang` = '0' WHERE `hoadon`.`maHd` = '$maHd' ";
        mysqli_query($con, $sql);

        header("Location: hoadonchitiet.php?maHd=$maHd");
    } else {
        header("Location: hoadonchitiet.php?maHd=$maHd&err=1");
    }
    include('../../connect/close.php');
} else {
    header('Location: ../common/index.php');
}
