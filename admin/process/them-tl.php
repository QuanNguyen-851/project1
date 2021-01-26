<?php
    if (isset($_GET['tl'])) {
    	$tl = $_GET['tl'];
    	include("../../connect/open.php");
    	$sql = "INSERT INTO theloai(tenTheLoai) VALUES ('$tl') ";
    	$sql1 = "SELECT * FROM theloai WHERE tenTheLoai ='$tl'";
    	$result1 = mysqli_query($con,$sql1);
    	$check = mysqli_num_rows($result1);
    	if ($check ==0) {
    		mysqli_query($con,$sql);
    		header("location:../common/main.php?command=4");
    	} else {
			header("location:../common/main.php?command=4&exist");
    	}
    	include("../../connect/close.php");
    } else {
    	header("location:../common/main.php?command=4&error");
    }