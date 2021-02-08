<?php
if (isset($_GET['ma']) && isset($_POST['sol'])) {
	include("../../connect/open.php");
	$ma = $_GET['ma'];
	$soluong = $_POST['sol'];
	$sql1 = "SELECT soLuong FROM product WHERE maSp='$ma'";
	$rel = mysqli_query($con,$sql1);
	$s = mysqli_fetch_array($rel);
	$now = $s['soLuong'];
	$after = $now + $soluong;
	$sql = "UPDATE product SET soLuong = '$after' WHERE maSp = '$ma'";
	mysqli_query($con,$sql);
	include("../../connect/close.php");
	header("location:../common/main.php?command=3&ma=$ma");

} else {
	header("location:../common/main.php?error");
}