<?php
include("../../connect/open.php");
if(isset($_POST['new-pass']) &&  isset($_POST['current-pass']) && isset($_GET['ma'])){
	$new = $_POST['new-pass'];
	$old = $_POST['current-pass'];
	$ma = $_GET['ma'];
	$sql = "SELECT * FROM admin WHERE maAdmin='$ma'";
	$sql2 = "UPDATE admin SET pass='$new' WHERE maAdmin='$ma'";
	$result = mysqli_query($con,$sql);
	while ($mk = mysqli_fetch_array($result)){
		if($old == $mk['pass']){
			mysqli_query($con,$sql2);
			header("location:../common/main.php?command=1&success=1");
		} else {
			header("location:../common/main.php?command=1&success=0");
		}
	}
} else if(isset($_GET['ma']) && isset($_POST['new-pass'])) {
	$ma = $_GET['ma'];
	$pass = $_POST['new_pass'];
	$sql3 = "UPDATE admin SET pass='$pass' WHERE maAdmin='$ma'";
	header("location:../common/main.php?command=1&ma=$ma&success=1");
} else {
	if (isset($_GET['quyen']) && isset($_GET['ma'])) {
		$ma = $_GET['ma'];
		header("location:../common/main.php?command=1&tab=1&fail&ma=$ma");
	} else {
	header("location:../common/main.php?command=1&tab=1&fail");
}
}

	include("../../connect/close.php");
?>