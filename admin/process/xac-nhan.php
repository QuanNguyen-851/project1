<?php
if (isset($_GET['ma'])) {
	$ma = $_GET['ma'];
include("../../connect/open.php");

		$sql = "UPDATE hoadon SET tinhTrang='1' WHERE maHd='$ma'";
	mysqli_query($con,$sql);
	
	header("location:../common/main.php?command=9&succes");
include("../../connect/close.php");
} else {
	header("location:../common/main.php");
}