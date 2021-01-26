<?php
include("../../connect/open.php");
if (isset($_POST['ten']) && isset($_POST['gt']) && isset($_POST['date']) && isset($_POST['Email']) && isset($_POST['sdt']) && isset($_POST['address'])) {
	$ten = $_POST['ten'];
	$gt = $_POST['gt'];
	$date = $_POST['date'];
	$email = $_POST['Email'];
	$sdt = $_POST['sdt'];
	$address = $_POST['address'];
	if (isset($_GET['ma'])) {
		$ma = $_GET['ma'];
	} else {
		$ma = $_GET['Ma'];
	}
	$checksql="SELECT * FROM admin WHERE maAdmin='$ma'";
	$resultcheck = mysqli_query($con,$checksql);
	while($a = mysqli_fetch_array($resultcheck)){
		$e = $a['Email'];
		$s = $a['SDT'];
	}
	$sql = "UPDATE admin SET tenAdmin='$ten',gt='$gt',DoB='$date',Email='$email',SDT='$sdt',Address='$address' WHERE maAdmin = '$ma'";
	$sql2 = "SELECT * FROM admin WHERE Email = '$email'";
	$sql3 = "SELECT * FROM admin WHERE SDT= '$sdt'";
	$result2 = mysqli_query($con,$sql2);
	$result3 = mysqli_query($con,$sql3);
	$check1 = mysqli_num_rows($result2);
	$check2 = mysqli_num_rows($result3);
	if ($check1==0 || $e == $email) {
		if ($check2==0 || $s ==$sdt) {
			mysqli_query($con,$sql);
			if (isset($_GET['ma'])) {
				header("location:main.php?command=1&ma=$ma&ok");
			} else {
				header("location:main.php?command=1&ok");
			}
		} else {
			if (isset($_GET['ma'])) {
				header("location:main.php?command=1&ma=$ma&sdt");
			} else {
				header("location:main.php?command=1&sdt");
			}
		}
		} else {
			if (isset($_GET['ma'])) {
				header("location:main.php?command=1&ma=$ma&email");
			} else {
				header("location:main.php?command=1&email");
			}
		}
	} else {
		if (isset($_GET['ma'])) {
				header("location:main.php?command=1&ma=$ma&loi");
			} else {
				header("location:main.php?command=1&loi");
			}
	}
	include("../../connect/close.php");
?>