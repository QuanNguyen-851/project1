<?php
session_start();

if (isset($_POST["old_pass"]) && isset($_POST["new_pass"]) && isset($_GET['user']) && isset($_SESSION['user'])) {
    $old_pass = md5($_POST['old_pass']);
    $newp_pass = md5($_POST['new_pass']);
    $newpv = $_POST['new_pass'];
    $user = $_GET['user'];
    include("../../connect/open.php");
    $sql = "UPDATE `user1` SET`pass`='$newp_pass' WHERE userName='$user'";
    mysqli_query($con, $sql);
    if (isset($_SESSION['pass'])) {
        $_SESSION['pass'] = $newpv;
    }
    header("Location: thongtintaikhoan.php?p=1");
    include("../../connect/close.php");
} else {
    header("Location: ../common/index.php ");
}
