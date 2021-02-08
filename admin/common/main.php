<?php
session_start();
if(isset($_SESSION['taikhoan'])){
       $tk = $_SESSION['taikhoan'];
   include("../../connect/open.php");
   $sql = "SELECT * FROM admin WHERE userName='$tk'";
		$result = mysqli_query($con,$sql);
		while ($thongtin = mysqli_fetch_array($result)) {
			$quyen = $thongtin['quyen'];
			$block = $thongtin['block'];
			}
			if ($block=='1') {
				header("location:../process/dang_xuat.php");
			}
	} else {
		header("location:index.php");
	}
	?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://kit.fontawesome.com/a12292074e.js" crossorigin="anonymous"></script>
	<title>Document</title>
</head>
<body>
<?php 
	include("../header/header.php");
  if (isset($_GET["command"])) {
    $command = $_GET["command"];
    switch ($command) {
      case 1:
        include("../quan-li-admin/thiet-lap.php");
        break;
      case 2:
        include("../quan-li-admin/admin.php");
        break;
      case 3:
      	include("../chi-tiet-sp/chi-tiet-sp.php");
      	break;
      case 5:
      	include("../hang/hang.php");
      	break;
      case 4:
      	include("../theloai/theloai.php");
      	break;
      case 6:
      	include("../hang/sua-hang.php");
      	break;
      case 7:
      	include("../theloai/sua-tl.php");
      	break;
      case 8:
      	include("../hoadon/chi-tiet-hoa-don.php");
      	break;
      case 9:
      	include("../hoadon/hoadon.php");
      	break;
  }
  } else {
    include("../sp/san-pham.php");
  }
  if (isset($_GET['error'])) {
	$error = $_GET['error'];
	if($error==1) {
		echo "<script type='text/javascript'>alert('Tài khoản đã tồn tại');</script>";
	} else if ($error==2) {
		echo "<script type='text/javascript'>alert('Email đã tồn tại');</script>";
	} else if($error==4) {
		echo "<script type='text/javascript'>alert('SDT đã tồn tại');</script>";
	} else {
		echo "<script type='text/javascript'>alert('Đã có lỗi sảy ra vui lòng thử lại');</script>";
	}
}
 ?>

 		<script>
		function menu(){
			var x = document.getElementById("menu");
			var y = document.getElementById("margin");
			
			if (x.style.display=='block') {
				x.style.display ='none';
				y.style.marginLeft='3%';


			} else {
				x.style.display ='block';
				y.style.marginLeft='21%';
				
			}
			return false;
		}
	</script>
	<?php
	 include("../../connect/close.php");
	 ?>
</body>
</html>
