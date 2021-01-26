<?php
if (isset($_GET['ten']) && isset($_GET['account']) && isset($_GET['date']) && isset($_GET['Email']) && isset($_GET['sdt']) && isset($_GET['pass']) && isset($_GET['address'])) {
	$ten = $_GET['ten'];
	$user = $_GET['account'];
	$pass = $_GET['pass'];
	$date = $_GET['date'];
	$email = $_GET['Email'];
	$sdt = $_GET['sdt'];
	$address = $_GET['address'];
	$gt = $_GET['gt'];
include("../../connect/open.php");
$sql = "INSERT INTO admin(tenAdmin, userName, pass, gt, DoB, Email, SDT, Address, quyen, block) VALUES ('$ten','$user','$pass','$gt','$date','$email','$sdt','$address','0','0') ";
$sql1 = "SELECT * FROM admin WHERE userName='$user'";
$sql2 = "SELECT * FROM admin WHERE Email='$email'";
$sql2 = "SELECT * FROM admin WHERE SDT='$sdt'";
$result = mysqli_query($con,$sql1);
$result2 = mysqli_query($con,$sql2);
$check = mysqli_num_rows($result);
$check2 = mysqli_num_rows($result2);
$check3 = mysqli_num_rows($result3);
if ($check == 0) {
	if($check2==0){
		if ($check3==0) {
	echo $check;
	mysqli_query($con,$sql);
	header("location:main.php?command=2");
	} else { header("locationmain.php?command2&error=4");
	}
} else {
	header("location:main.php?command=2&error=2");
}
	} else {
	header("location:main.php?command=2&error=1");
}
 } else {
	header("location:main.php?command=2&error=3");
}
include("../../connect/close.php");
?>