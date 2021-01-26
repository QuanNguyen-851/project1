<?php
    if (isset($_POST['hang'])&&isset($_GET['ma'])) {
        $hang = $_POST['hang'];
        $ma = $_GET['ma'];
        include("../../connect/open.php");
        $sql = "UPDATE hang SET tenHang = '$hang' WHERE maHang = '$ma'";
        $sql1 = "SELECT * FROM hang WHERE tenHang ='$hang'";
        $result1 = mysqli_query($con,$sql1);
        $check = mysqli_num_rows($result1);
        if ($check ==0) {
            mysqli_query($con,$sql);
            header("location:../common/main.php?command=5");
        } else {
            header("location:../common/main.php?command=6&ma=$ma&exist");
        }
        include("../../connect/close.php");
    } else {
        header("location:../common/main.php?command=5&error");
    }