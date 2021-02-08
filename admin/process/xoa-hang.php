<?php
    if (isset($_GET['ma'])) {
    	$ma = $_GET['ma'];
    	include("../../connect/open.php");
    	$sql = "UPDATE hang SET An = '1' WHERE maHang = '$ma' ";
    		mysqli_query($con,$sql);
    		header("location:../common/main.php?command=5");
    	include("../../connect/close.php");
    } else {
    	header("location:../common/main.php?command=5&error");
    }