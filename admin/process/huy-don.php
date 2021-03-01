<?php
if (isset($_GET['ma'])) {
	$ma = $_GET['ma'];
include("../../connect/open.php");
$sql20 = "SELECT * FROM hoadon WHERE maHd ='$ma'";
$result15 = mysqli_query($con,$sql20);
$check = mysqli_fetch_array($result15);
$ok = $check['tinhTrang'];
echo $ok;
if ($ok != NULL) {
	header("location:../common/main.php?command=9&fail");
} else {

$sql1 = "SELECT maSp,soluong FROM hoadonchitiet WHERE maHd='$ma'";
$res = mysqli_query($con,$sql1);
while ($sl = mysqli_fetch_array($res)) {
	$masp = $sl['maSp'];
	$slg = $sl['soluong'];
	$sql2 = "SELECT soLuong FROM product WHERE maSp = $masp";
	$result2 = mysqli_query($con,$sql2);
	$total = mysqli_fetch_array($result2);
	$now = $total['soLuong'];
	$after = $now + $slg;
		$sql = "UPDATE hoadon SET tinhTrang='0' WHERE maHd='$ma'";
			$sql3 = "UPDATE product SET soLuong = '$after' WHERE maSp = $masp";
			mysqli_query($con,$sql3);
		mysqli_query($con,$sql);
	}
		header("location:../common/main.php?command=9&not");
}
include("../../connect/close.php");
} else {
	header("location:../common/main.php");
}