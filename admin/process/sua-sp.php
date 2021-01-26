<?php
if (isset($_POST['ten']) && isset($_POST['gia']) && isset($_GET['ma'])) {
	$ten = $_POST['ten'];
	$gia = $_POST['gia'];
	$ma = $_GET['ma'];
	$hang = $_POST['hang'];
	$theloai = $_POST['theloai'];
	include("../../connect/open.php");
	$sql = "UPDATE product SET tenSp ='$ten',gia='$gia',theLoai = '$theloai',hang = '$hang' WHERE maSP = '$ma'";
	mysqli_query($con,$sql);
	 header("location:../common/main.php?command=3&ma=$ma");
	include("../../connect/close.php");
	
}