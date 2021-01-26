<?php
if (isset($_GET['ma'])) {
	$ma = $_GET['ma'];
include("../../connect/open.php");
$sql = "DELETE FROM product WHERE maSP='$ma'";
$sql1 = "SELECT * FROM product WHERE maSP='$ma'";
$result = mysqli_query($con,$sql1);
while ($s = mysqli_fetch_array($result)) {
	$link = $s['anhSp'];
}
mysqli_query($con,$sql);
unlink($link);
header("location:main.php");
include("../../connect/close.php");
} else {
	header("location:main.php");
}