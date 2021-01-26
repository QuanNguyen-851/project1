<?php
if (isset($_GET['sdt'])) {
    $sdt = $_GET['sdt'];

    include("../../connect/open.php");
    $sql = "SELECT * FROM `user1` Where SDT='$sdt'";
    $result = mysqli_query($con, $sql);
    $check = mysqli_num_rows($result);
    include("../../connect/close.php");
    if ($check == 0) {
        echo "0";
    } else {
        echo "1";
    }
}
