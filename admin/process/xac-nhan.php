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
		$sql = "UPDATE hoadon SET tinhTrang='1' WHERE maHd='$ma'";
	mysqli_query($con,$sql);
	
	header("location:../common/main.php?command=9&succes");
}
include("../../connect/close.php");
} else {
	header("location:../common/main.php");
}