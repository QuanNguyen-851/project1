<?php
session_start();
if (isset($_SESSION['user'])) {
    header("Location: ../common/index.php ");
} else {
    if (
        isset($_POST['user']) && isset($_POST['pass']) && isset($_POST['name']) && isset($_POST['email'])
        && isset($_POST['sdt']) && isset($_POST['address']) && isset($_POST['date']) && isset($_POST['gt'])
    ) {
        $user = $_POST['user'];
        $pass = md5($_POST['pass']);
        $name = $_POST['name'];
        $email = $_POST['email'];
        $sdt = $_POST['sdt'];
        $address = $_POST['address'];
        $date = $_POST['date'];
        $gt = $_POST['gt'];
        include("../../connect/open.php");
        $sql = "INSERT INTO `user`(`tenUser`, `userName`, `pass`, `SDT`, `Email`, `gioiTinh`, `DoB`, `address`) 
    VALUES ('$name','$user','$pass','$sdt','$email','$gt','$date','$address')";
        mysqli_query($con, $sql);
        include("../../connect/close.php");
        header("Location: formdangnhap.php");
    } else {
        header("Location: ../common/index.php ");
    }
}
