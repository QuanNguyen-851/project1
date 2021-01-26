<?php
if (isset($_GET['ma'])) {
	$ma = $_GET['ma'];
	include("../../connect/open.php");
	$sql = "DELETE FROM product WHERE maSP='$ma'";
	$sql1 = "SELECT * FROM product WHERE maSP='$ma'";
	$result = mysqli_query($con, $sql1);
	while ($s = mysqli_fetch_array($result)) {
		$link = $s['anhSp'];
		$linh2 = $s['anhSp2'];
		$linh3 = $s['anhSp3'];
		$linh4 = $s['anhSp4'];
	}
	mysqli_query($con, $sql);
	unlink($link);
	unlink($link2);
	unlink($link3);
	unlink($link4);
	header("location:../common/main.php");
	include("../../connect/close.php");
} else {
	header("location:../common/main.php");
}
