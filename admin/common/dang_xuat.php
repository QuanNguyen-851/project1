<?php
	session_start();
	unset($_SESSION['taikhoan']);
	header("location:index.php");
 ?>