<?php
if (isset($_GET['ma']) && isset($_POST['sol'])) {
	include("../../connect/open.php");
	$ma = $_GET['ma'];
	$soluong = $_POST['sol'];
	

	
	
	$sql = "UPDATE product SET soLuong = '$soluong' WHERE maSp = '$ma'";
	mysqli_query($con,$sql);
	include("../../connect/close.php");
	header("location:../common/main.php?command=3&ma=$ma");

} else {
	header("location:../common/main.php?error");
}