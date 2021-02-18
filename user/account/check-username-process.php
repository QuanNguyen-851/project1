<?php
if (isset($_GET['username'])) {
    $username = $_GET['username'];

    include("../../connect/open.php");
    $sql = "SELECT * FROM `user` Where userName='$username'";
    $result = mysqli_query($con, $sql);
    $check = mysqli_num_rows($result);
    include("../../connect/close.php");
    if ($check == 0) {
        echo "0";
    } else {
        echo "1";
    }
} else {
    header("Location: ../common/index.php ");
}
