<?php
if (isset($_GET['ma'])) {
	$ma = $_GET['ma'];
include("../../connect/open.php");
$sql = "UPDATE product SET trangThai=NULL WHERE maSP='$ma'";
mysqli_query($con,$sql);
header("location:../common/main.php");
include("../../connect/close.php");
} else {
	header("location:../common/main.php");
}
