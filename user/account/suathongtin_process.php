<?php
if (
    isset($_POST['mauser']) &&
    isset($_POST['tenuser']) && isset($_POST['email'])
    && isset($_POST['sdt']) && isset($_POST['DoB']) &&
    isset($_POST['gt']) && isset($_POST['address'])
) {
    $mauser = $_POST['mauser'];
    $tenuser = $_POST['tenuser'];
    $email = $_POST['email'];
    $sdt = $_POST['sdt'];
    $DoB = $_POST['DoB'];
    $gt = $_POST['gt'];
    $address = $_POST['address'];
    include("../../connect/open.php");
    $sql = "UPDATE `user1` SET 
   `tenUser`='$tenuser',`SDT`='$sdt',`Email`='$email',
   `gioiTinh`='$gt',`DoB`='$DoB',`address`='$address' WHERE `maUser`='$mauser' ";
    mysqli_query($con, $sql);
    header("Location: thongtintaikhoan.php");
    include("../../connect/open.php");
}
