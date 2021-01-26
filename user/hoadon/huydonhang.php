<?php
session_start();
if (isset($_SESSION['user']) && isset($_GET['maHd'])) {
    $maHd = $_GET['maHd'];
    include('../../connect/open.php');
    $sql = "UPDATE `hoadon` SET `tinhTrang` = '0' WHERE `hoadon`.`maHd` = '$maHd' ";
    mysqli_query($con, $sql);
    include('../../connect/close.php');
    header("Location: hoadonchitiet.php?maHd=$maHd");
} else {
    header('Location: ../common/index.php');
}
