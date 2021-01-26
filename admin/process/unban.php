<?php
if (isset($_GET["ma"])) {
	$ma = $_GET["ma"];
}
include("../../connect/open.php");
$sql = "UPDATE admin SET block='0' WHERE maAdmin='$ma' ";
mysqli_query($con,$sql);
include("../../connect/close.php");
header("location:../common/main.php?command=2");
?>