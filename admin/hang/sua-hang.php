<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<style>
		body {
			margin: 0;
			background: #595959
		}
		.thongtin{
			font-size: 20px;
			border-right: 2px solid black;
			text-decoration: none;
			padding-top: 13px;
			padding-right: 10px;
			padding-left: 10px;
		}
		.thongtin:hover{
			background: black;
		}
		 a{
        	text-decoration: none;
        }
        td.sp{
        	text-align: center;
        	height: 25px;
        }
	</style>
</head>
<body>
	<?php
	if(isset($_GET['exist'])) {
		echo "<script type='text/javascript'>alert('Đã tồn tại');</script>";
	}
	if (isset($_GET['ma'])) {
		$ma = $_GET['ma'];
	} else {
		header("location:../common/main.php?command=5");
	}
	include("../../connect/open.php");
	$sql = "SELECT * FROM hang WHERE maHang = $ma";
	$result1 = mysqli_query($con,$sql);
	while ($hang = mysqli_fetch_array($result1)) {
		$h = $hang['tenHang'];
		$ma = $hang['maHang'];
	}
	?>
	<div id='margin' style="margin-left: 3%;margin-top: 5%;border-left: 1px solid black;border-top: 1px solid black;height: 700px;background: white">
		<div style="height: 50px;width: 100%;background: #333333;margin-bottom: 0;display: flex;border-bottom: 2px solid black">
			<a style="color: white" class="thongtin" href="../common/main.php?command=5">Quay lại</a>
		</div>
		<center><h1 style="font-size: 50px;">Sửa hãng</h1></center>
		<div style="margin-top: 80px;width: 100%">

	<center><form style="border: 1px solid black;margin-right: 500px;margin-left: 500px;" action="../process/sua-hang.php?ma=<?php echo $ma; ?>" method="POST">
			<p style="margin-top: 50px;font-size: 30px">Tên hãng: <input style="height: 30px;font-size: 20px" type="text" name="hang" value="<?php echo $h; ?>"></p><br/><br/>
			<button style="margin-bottom: 50px;height: 30px;width: 80px">Update</button></center>
		</form>
	</div>
	</div>
</body>
</html>