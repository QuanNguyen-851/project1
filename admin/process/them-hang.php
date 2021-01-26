<?php
    if (isset($_GET['hang'])) {
    	$hang = $_GET['hang'];
    	include("../../connect/open.php");
    	$sql = "INSERT INTO hang(tenHang) VALUES ('$hang') ";
    	$sql1 = "SELECT * FROM hang WHERE tenHang ='$hang'";
    	$result1 = mysqli_query($con,$sql1);
    	$check = mysqli_num_rows($result1);
    	if ($check ==0) {
    		mysqli_query($con,$sql);
    		header("location:../common/main.php?command=5");
    	} else {
			header("location:../common/main.php?command=5&exist");
    	}
    	include("../../connect/close.php");
    } else {
    	header("location:../common/main.php?command=5&error");
    }