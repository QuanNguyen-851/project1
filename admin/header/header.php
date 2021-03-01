
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://kit.fontawesome.com/a12292074e.js" crossorigin="anonymous"></script>
	<title>Document</title>
	<style>
		body{
			margin: 0;
		}
		li{
			list-style: none;
			margin-top: 30px;
			border-bottom: 1px solid white;
			border-bottom-width: 1px;
		}
		a.header{
			text-decoration: none;
			color: white;
		}
		ul{
			margin-top: 100px;
		}
	</style>
</head>
<body>
	<div style="height: 50px;background: #404040;width: 100%;position: fixed;">
		<a onclick="return menu()" href="#"><i style="color: white;font-size: 50px;margin-left: 20px;padding-left: 10px;padding-right: 10px;" class="fas fa-bars"></i></a>
		<i style="font-size: 45px;color: white;margin-left: 1150px;" class="fas fa-user"></i>&emsp;<font style="color: white;font-size:30px;"><?php echo $tk ?></font>
	</div>
	<div style="position: fixed;background: #4d4d4d;width: 18%;height: 710px;margin-top: 50px;display: none;" id="menu">
		<ul>
			<li><a class="header" href="../common/main.php">Sản phẩm</a></li>
			<li><a class="header" href="../common/main.php?command=4">Thể loại</a></li>
			<li><a class="header" href="../common/main.php?command=5">Hãng</a></li>
			<li><a class="header" href='../common/main.php?command=1'>Thiết lập cá nhân</a></li>
			<li><a class="header" href='../common/main.php?command=9'>Đơn hàng</a></li>
			<?php if($quyen == 1){ ?>
				<li><a class="header" href='../common/main.php?command=2'>Quản lí tài khoản</a></li> <?php } ?>
			<li><a class="header" href="../process/dang_xuat.php">Đăng xuất</a></li>

		</ul>
	</div>
	<a href="dang_xuat.php">Đăng xuất</a>
</body>
</html>