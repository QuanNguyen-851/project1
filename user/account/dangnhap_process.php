<?php
session_start();
if (isset($_SESSION['user'])) {
    header("Location: ../common/index.php ");
}
if (isset($_POST['user']) && isset($_POST['pass'])) {

    $user = $_POST['user'];
    $passvalue = $_POST['pass'];
    $pass = md5($_POST['pass']);
    include("../../connect/open.php");
    $sql = "SELECT * FROM `user1` where userName='$user' And pass='$pass'";
    $result = mysqli_query($con, $sql);
    $check = mysqli_num_rows($result);
    print_r($check);

    if ($check == 0) {
        header("Location: formdangnhap.php?err=1");
    } else {
        $_SESSION["user"] = $user;
        $_SESSION['pass'] = $passvalue;
        if (isset($_POST["check"])) {
            setcookie("user", "$user", time() + 86400 * 2);
            setcookie("pass", "$passvalue", time() + 86400 * 2);
        } else {
            setcookie("user", "$user", time() - 100);
            setcookie("pass", "$passvalue", time() - 100);
        }

        header("Location: ../common/index.php");
    }

    include("../../connect/close.php");
} else {
    header("Location: formdangnhap.php");
}
