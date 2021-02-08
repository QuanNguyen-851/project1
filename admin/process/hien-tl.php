<?php
    if (isset($_GET['ma'])) {
    	$ma = $_GET['ma'];
    	include("../../connect/open.php");
    	$sql = "UPDATE theloai SET An = '0' WHERE maTheLoai = '$ma' ";
    		mysqli_query($con,$sql);
    		header("location:../common/main.php?command=4");
    	include("../../connect/close.php");
    } else {
    	header("location:../common/main.php?command=4&error");
    }