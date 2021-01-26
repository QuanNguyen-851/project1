<?php
if (isset($_POST['noi-dung']) && isset($_GET['ma'])) {
	$nd = $_POST['noi-dung'];
	$ma = $_GET['ma'];
	include("../../connect/open.php");
	$sql = "UPDATE product SET thongtinsp='$nd' WHERE maSP = '$ma'";
	mysqli_query($con,$sql);
	header("location:../common/main.php?command=3&ma=$ma");
	include("../../connect/open.php");
} else {
	echo "tèo";
}