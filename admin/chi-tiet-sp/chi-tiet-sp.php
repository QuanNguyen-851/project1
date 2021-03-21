<?php
if (isset($_GET['ma'])) {
	$ma = $_GET['ma'];
} else {
	header("location:../common/main.php?");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<script src="../jquery-3.1.1.min.js"></script>
	<script src="../ckeditor/ckeditor.js"></script>
	<script src="../ckfinder/ckfinder.js"></script>
	<style>
		body{
			margin: 0;
			background: #595959
		}
		dialog{
			position: fixed;
		}
		.thongtin{
			color: white;
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
	</style>
</head>
<body>
	<?php
	include("../../connect/open.php");
	$sql = "SELECT * FROM (( product INNER JOIN hang ON product.hang = hang.maHang) INNER JOIN theloai ON product.theLoai = theloai.maTheLoai ) WHERE maSP='$ma'";
	$sql2 = "SELECT * FROM hang";
	$sql3 = "SELECT * FROM theloai";
	$result2 = mysqli_query($con,$sql2);
	$result3 = mysqli_query($con,$sql3);
	$result = mysqli_query($con,$sql);
	?>
	<div id='margin' style="margin-left: 3%;margin-top: 5%;border-left: 1px solid black;border-top: 1px solid black;height: 1300px;background: #666666">
		<div style="height: 50px;width: 100%;background: #333333;margin-bottom: 0;display: flex;">
			<a style="color: white" class="thongtin" href="../common/main.php">Quay lại</a>
			<a onclick="document.getElementById('sua').showModal()" class="thongtin" href="#">Sửa thông tin</a>
			<a onclick="document.getElementById('now').showModal()" class="thongtin" href="#">Update số lượng</a>

		</div>
		<?php
		while ($sp = mysqli_fetch_array($result)) {
			$ma = $sp['maSP'];
			$ten = $sp['tenSP'];
			$gia = $sp['gia'];
			$hang1 = $sp['hang'];
			$theloai1 = $sp['theLoai'];
			$sl = $sp['soLuong'];
		?>
			<div style="width: 100%;height: 45px;color: white">
				<h2 style="margin-top: 10px;margin-left: 10%"><?php echo $sp['tenSP']; ?></h2>
			</div>
			<hr style="width: 98%;margin-top: 0px">
			<div style="height: 500px;width: 100%">
				<div style="float: left;height: 500px;width: 400px;">
					<a onclick="document.getElementById('anh1').showModal()" href="#"><img style="margin-left: 23px;margin-top: 50px;" height="250px" width="350px" src="<?php echo $sp['anhSp']; ?>"></a><br/>
					<!-- <div style="width:100%;height: 100px;display: flex;margin-top: 75px ">
						<a onclick="document.getElementById('anh2').showModal()" href="#"><div style="margin-left: 23px;height: 75px;width: 100px;border: 1px solid white">
							<?php if (isset($sp['anhSp2']) && $sp['anhSp2']!='') {
								?>
								<img height="75px" width="100px" src="<?php echo $sp['anhSp2']; ?>">
							<?php } else { ?>
							<i style="font-size: 70px;margin-top: 3px;margin-left: 20px;color: white" class="fas fa-plus"></i>
								<?php
						}
							?>
						</div></a>
						<a onclick="document.getElementById('anh3').showModal()" href="#"><div style="margin-left: 22px;height: 75px;width: 100px;border: 1px solid white">
							<?php if (isset($sp['anhSp3']) && $sp['anhSp3']!='') {
								?>
								<img height="75px" width="100px" src="<?php echo $sp['anhSp3']; ?>">
							<?php } else { ?>
							<i style="font-size: 70px;margin-top: 3px;margin-left: 20px;color: white" class="fas fa-plus"></i>
								<?php
						}
							?>
						</div></a>
						<a onclick="document.getElementById('anh4').showModal()" href="#"><div style="margin-left: 22px;height: 75px;width: 100px;border: 1px solid white">
							<?php if (isset($sp['anhSp4']) && $sp['anhSp4']!='') {
								?>
								<img height="75px" width="100px" src="<?php echo $sp['anhSp4']; ?>">
							<?php } else { ?>
							<i style="font-size: 70px;margin-top: 3px;margin-left: 20px;color: white" class="fas fa-plus"></i>
								<?php
						}
							?>
						</div></a>

					</div> -->
				</div>
				<div style="float: left;height: 500px;width: 700px;">
					<div style="margin-top: 50px;margin-left: 50px;"><font style="color: white" size="50px">Giá:<?php echo number_format( $sp['gia']).' VND'; ?></font></div>
					<div style="margin-top: 50px;margin-left: 50px;"><font style="color: white" size="50px">Hãng:<?php echo $sp['tenHang']; ?></font></div>
					<div style="margin-top: 50px;margin-left: 50px;"><font style="color: white" size="50px">Thể loại:<?php echo $sp['tenTheLoai']; ?></font></div>
					<div style="margin-top: 50px;margin-left: 50px;"><font style="color: white" size="50px">Số lượng:<?php echo $sp['soLuong']; ?></font></div>
				</div>
				<hr width="95%">
				<center><div style="width: 100%;height: 700px;color: white">
					<form action="../process/noi-dung.php?ma=<?php echo $ma; ?>" method="POST">
						<textarea id="noi-dung" name="noi-dung"><?php if (isset($sp['thongtinsp']) && $sp['thongtinsp']!='') {
						echo $sp['thongtinsp'];
					}
					?></textarea>
						<button>Cập nhật</button>
					</form>
				</div></center>
			</div>
			<?php
		}
		?>
	</div>
	<dialog id="anh2">
		<center><h1>Đổi Ảnh</h1></center>
		<form action="../process/sua-anh.php?anh=2&ma=<?php echo $ma ?>" method="POST" enctype="multipart/form-data">
			Chọn ảnh:<input type="file" name="fileToUpload"><br/><br/><br/>
			<button>Cập nhật</button><button onclick="return huy()" style="margin-left: 200px">Hủy</button>
		</form>
	</dialog>
	<dialog id="anh1">
		<center><h1>Đổi Ảnh sản phẩm</h1></center>
		<form action="../process/sua-anh.php?anh=1&ma=<?php echo $ma ?>" method="POST" enctype="multipart/form-data">
			Chọn ảnh:<input type="file" name="fileToUpload" required="1"><br/><br/><br/>
			<button>Cập nhật</button><button onclick="return huy()" style="margin-left: 200px">Hủy</button>
		</form>
	</dialog>
	<dialog id="anh3">
		<center><h1>Đổi ảnh</h1></center>
		<form action="../process/sua-anh.php?anh=3&ma=<?php echo $ma ?>" method="POST" enctype="multipart/form-data">
			Chọn ảnh:<input type="file" name="fileToUpload"><br/><br/><br/>
			<button>Cập nhật</button><button onclick="return huy()" style="margin-left: 200px">Hủy</button>
		</form>
	</dialog>
	<dialog id="anh4">
		<center><h1>Đổi ảnh</h1></center>
		<form action="../process/sua-anh.php?anh=4&ma=<?php echo $ma ?>" method="POST" enctype="multipart/form-data">
			Chọn ảnh:<input type="file" name="fileToUpload"><br/><br/><br/>
			<button>Cập nhật</button><button onclick="return huy()" style="margin-left: 200px">Hủy</button>
		</form>
	</dialog>
	<dialog id="sua">
		<form action="../process/sua-sp.php?ma=<?php echo $ma; ?>" method="POST">
		<table>
			<tr>
				<td>Tên</td>
				<th><input required="1" type="text" name="ten" value="<?php echo $ten;?>"></th>
			</tr>
			<tr>
				<td>Giá</td>
				<th><input required="1" type="number" name="gia" value="<?php echo $gia;?>"></th>
			</tr>
			<tr>
			<td>Hãng</td>
 						<td>
 							<select name="hang">
 							
 								<?php
 								while ($hang = mysqli_fetch_array($result2)) {
 									?>
 									<option <?php if ($hang['maHang'] == $hang1) {
 										echo 'selected';
 									} ?> value="<?php echo $hang['maHang']; ?>"><?php echo $hang['tenHang']; ?> </option>
 								
 									
 								<?php		
 								
 								}
 								
 				?>
 			</select>
 						</td>
 					</tr>
 					<tr>
 						<td>Thể loại</td>
 						<td><select name="theloai">
 							
 								<?php
 								while ($theloai = mysqli_fetch_array($result3)) {
 									?>
 									<option <?php if ($theloai['maTheLoai'] == $theloai1) {
 										echo 'selected';
 									} ?> value="<?php echo $theloai['maTheLoai']; ?>"><?php echo $theloai['tenTheLoai']; ?> </option>
 								
 									
 								<?php		
 								
 								}
 								
 				?>
 			</select>
 						</td>
 					</tr>
		</table><br/>
		<button>Cập nhật</button><button onclick="return huy()" style="margin-left: 100px">Hủy</button>
	</form>
	</dialog>
	<dialog id="now">
		<form action="../process/update-soluong.php?ma=<?php echo $ma; ?>" method="POST">
			<table>
				<tr>
					<td>Số lượng sản phẩm hiện tại:</td>
					<th><?php echo $sl; ?></th>
				</tr>
				<tr>
					<td>Số lượng sản phẩm sau khi sửa:</td>
					<th><input style="width: 100px" type="number" name="sol" placeholder="Nhập số lượng" required="1"></th>
				</tr>

			</table><br/>
			<button style="margin-left: 50px;">Cập nhật</button><button onclick="return huy()" style="margin-left: 100px">Hủy</button>
		</form>
	</dialog>
	<script>
		function huy(){
			document.getElementById('anh1').close();
			document.getElementById('anh2').close();
			document.getElementById('anh3').close();
			document.getElementById('anh4').close();
			document.getElementById('sua').close();
			document.getElementById('now').close();
			return false;
		}
	</script>
		<script>
		CKEDITOR.replace('noi-dung', {
			filebrowserBrowseUrl:'../ckfinder/ckfinder.html',
			filebrowserImageBrowseUrl: '../ckfinder/ckfinder.html?type=Image',
			filebrowserFlashBrowseUrl: '../ckfinder/ckfinder.html?type=Flash',
			filebrowserUploadUrl:'../ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
			filebrowserUploadUrl:'../ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
			filebrowserUploadUrl:'../ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
		});
	</script>
</body>
</html>