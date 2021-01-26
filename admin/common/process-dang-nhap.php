<?php 
	session_start();

	if(isset($_POST['admin']) && isset($_POST['pass'])){
		$admin = $_POST['admin'];
		$pass = $_POST['pass'];
		include("../../connect/open.php");
		$sql = "SELECT * FROM admin WHERE userName='$admin' AND pass='$pass'";
		$result = mysqli_query($con,$sql);
		$check = mysqli_num_rows($result);
		if($check!=0){
			while ($block = mysqli_fetch_array($result)){
				if ($block['block']==0){
					$_SESSION['taikhoan'] = $admin;
					header("location:main.php");
				} else {
					header("location:index.php?error=3");
				}
		}
	} else {
		header("location:index.php?error=2");
	}
} else {
	header("location:index.php");
}
include("../../connect/close.php");
?>
