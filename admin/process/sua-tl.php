<?php
    if (isset($_POST['hang'])&&isset($_GET['ma'])) {
        $hang = $_POST['hang'];
        $ma = $_GET['ma'];
        include("../../connect/open.php");
        $sql = "UPDATE theloai SET tenTheLoai = '$hang' WHERE maTheLoai = '$ma'";
        $sql1 = "SELECT * FROM theloai WHERE tenTheLoai ='$hang'";
        $result1 = mysqli_query($con,$sql1);
        $check = mysqli_num_rows($result1);
        if ($check ==0) {
            mysqli_query($con,$sql);
            header("location:../common/main.php?command=4");
        } else {
            header("location:../common/main.php?command=7&ma=$ma&exist");
        }
        include("../../connect/close.php");
    } else {
        header("location:../common/main.php?command=7&error");
    }