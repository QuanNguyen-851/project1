<?php
if (isset($_GET['success'])) {
	$suc=$_GET['success'];
	if ($suc==1) {
		echo "<script type='text/javascript'>alert('Đổi mật khẩu thành công');</script>";
	} else {
		echo "<script type='text/javascript'>alert('Mật khẩu cũ không đúng');</script>";
	}
}
if (isset($_GET['fail'])) {
	echo "<script type='text/javascript'>alert('Đã có lỗi sảy ra');</script>";

}
if (isset($_GET['email'])) {
	echo "<script type='text/javascript'>alert('Email đã tồn tại');</script>";	
} else if (isset($_GET['sdt'])){
	echo "<script type='text/javascript'>alert('Số điện thoại đã tồn tại');</script>";
} else if (isset($_GET['loi'])){
	echo "<script type='text/javascript'>alert(' Đã có lỗi sảy ra');</script>";
} else if(isset($_GET['ok'])){
	echo "<script type='text/javascript'>alert(' Thành công');</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<style>
		body{
			margin: 0;
			background: #595959
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
		td.name{
			height: 50px;
			font-size: 20px;
			text-align: right;
			color: white;
		}	
		td.input{
			width: 250px;
			text-align: right;
		}	
		input.input{
			height: 25px;
			font-size: 15px;
			width: 200px;
		}
	</style>
</head>
<body>
	<?php
	if (isset($_GET['ma'])) {
		$ma = $_GET['ma'];
		$sql2 = "SELECT * FROM admin WHERE maAdmin='$ma'";
	} else {
	$sql2 = "SELECT * FROM admin WHERE userName='$tk'";
}
	$result2 = mysqli_query($con,$sql2); 
	?>
	<div id='margin' style="margin-left: 5%;margin-top: 5%;border-left: 1px solid black;border-top: 1px solid black;height: 710px;background: #666666">
		<div style="height: 50px;width: 100%;background: #333333;margin-bottom: 0;display: flex;">
			<a class="thongtin" href="<?php if(isset($_GET['ma'])){ ?>main.php?command=1&ma=<?php echo $ma;
				} else {
				echo "main.php?command=1"; } ?>">Thông tin tài khoản</a>
			<a class="thongtin" href="<?php if(isset($_GET['ma'])){ ?>main.php?command=1&tab=1&ma=<?php echo $ma;
				} else {
				echo "main.php?command=1&tab=1"; } ?>">Đổi mật khẩu</a>
		</div>
		<?php
 					while ($thongtin = mysqli_fetch_array($result2)) {
 					if (isset($_GET["tab"])) {
			    	$command = $_GET["tab"];
 				   switch ($command) {
  				    case 1:
  				    if ($quyen == 1 && $tk!=$thongtin['userName']) {
  				    	
  				    	?>
  				    	<form action="doi-mk.php?quyen&ma=<?php echo $ma; ?>" method="post">
  				    	<table style="margin-left: 35%;margin-top: 50px;" border="0">
 					<tr>
 						<td class="name">Mật khẩu mới</td>
 						<td class="input"><input class="input" id="new-pass" type="password" name="new-pass" required="1" placeholder="Nhập mật khẩu mới" <?php if ($thongtin['quyen']==1){ echo "disabled";} ?>></td>
 					</tr>
 				</table>
 				<?php if ($quyen==1 && $thongtin['quyen']!=1 || $quyen==1 && $tk==$thongtin['userName'] ) {
 					?>
 				<center><button style="height: 30px;width: 100px;" >CẬP NHẬT</button></center>
 				<?php
 			}
 			?>
 			</form>
 		<?php 
 				} else { 
 					?>
  				    	<form action="doi-mk.php?ma=<?php echo $thongtin['maAdmin']; ?>" method="post">
  				    	<div style="color: white;font-size: 50px;width: 100%;margin-top: 50px;"><center>Đổi mật khẩu</center></div>
  				    	<table style="margin-left: 35%;margin-top: 50px;" border="0">
 					<tr>
 						<td class="name">Mật khẩu mới</td>
 						<td class="input"><input class="input" id="new-pass" type="password" name="new-pass" required="1" placeholder="Nhập mật khẩu mới" <?php if ($thongtin['quyen']==1 && $tk != $thongtin['userName']){ echo "disabled";} ?>></td>
 					</tr>
 					<tr >
 						<td class="name">Nhập lại mật khẩu mới</td>
 						<td class="input"><input class="input" id="re-new-pass" type="password" name="re-new-pass" required="1" placeholder="Nhập lại mật khẩu mới" <?php if ($thongtin['quyen']==1 && $tk != $thongtin['userName']){ echo "disabled";} ?>></td>
 					</tr>
 					<tr>
 						<td class="name">Mật khẩu hiện tại</td>
 						<td class="input"><input class="input" type="password" name="current-pass" required="1" placeholder="Mật khẩu hiện tại" <?php if ($thongtin['quyen']==1 && $tk != $thongtin['userName']){ echo "disabled";} ?>></td>
 					</tr>
 						
 				</table><br/>
 				<center><button style="height: 30px;width: 100px;" onclick=" return doimk()">CẬP NHẬT</button></center>
 			</form>
  				    	<?php
  				    }
  				     }
  				      } else { ?>
		<div style="color: white;font-size: 50px;width: 100%;margin-top: 50px;"><center>Thông tin tài khoản</center></div>
		<form action="<?php if(isset($_GET['ma'])){
	?>doi-thong-tin.php?ma=<?php echo $_GET['ma']; } else { ?> doi-thong-tin.php?Ma=<?php echo $thongtin['maAdmin'];
			} ?>" method='post'>
 				<table style="margin-left: 35%;margin-top: 50px;" border="0">
 					<tr>
 						<td class="name">Tài Khoản</td>
 						<td class="input"><input class="input" type="text" value="<?php echo $thongtin['userName']; ?>" readonly></td>
 					</tr>
 					<tr>
 						<td class="name">Tên admin</td>
 						<td class="input"><input class="input" type="text" name="ten" required="1" value="<?php echo $thongtin['tenAdmin']; ?>" <?php if ($quyen ==0) { echo 'readonly';} else if($thongtin['quyen']==1 && $tk != $thongtin['userName']){ echo 'readonly'; } ?>></td>
 					</tr>
 					<tr>
 						<td class="name">Giới tính</td>
 						<td >
 						<select style="height: 25px;margin-left: 43px;" name="gt" id="gt" <?php if ($quyen ==0) { echo 'disabled';} else if($thongtin['quyen']==1 && $tk != $thongtin['userName']){ echo 'disabled'; } ?> >
 						    <option value="-1">---</option>
 			                <option value="1" <?php if ($thongtin['gt']==1){ echo 'selected'; } ?>>Nam</option>
 			                <option value="0" <?php if ($thongtin['gt']==0){ echo 'selected'; } ?>>Nữ</option>
 						</select>
 					</td>
 					</tr>
 					<tr >
 						<td class="name">Ngày sinh</td>
 						<td class="input"><input class="input" type="date" name="date" required="1" value="<?php echo $thongtin['DoB']; ?>" <?php if ($quyen ==0) { echo 'readonly';} else if($thongtin['quyen']==1 && $tk != $thongtin['userName']){ echo 'readonly'; } ?>></td>
 					</tr>
 					<tr>
 						<td class="name">Email</td>
 						<td class="input"><input class="input" type="Email" name="Email" value="<?php echo $thongtin['Email']; ?>" <?php if ($quyen ==0) { echo 'readonly';} else if($thongtin['quyen']==1 && $tk != $thongtin['userName']){ echo 'readonly'; } ?>></td>
 					</tr>
 					<tr>
 						<td class="name">SĐT</td>
 						<td class="input"><input class="input" type="number" name="sdt"  required="1" value="<?php echo $thongtin['SDT']; ?>" <?php if ($quyen ==0) { echo 'readonly';} else if($thongtin['quyen']==1 && $tk != $thongtin['userName']){ echo 'readonly'; } ?>></td>
 					</tr>
 					<tr>
 						<td class="name">Địa chỉ</td>
 						<td class="input"><input class="input" type="text" name="address" required="1" value="<?php echo $thongtin['Address']; ?>" <?php if ($quyen ==0) { echo 'readonly';} else if($thongtin['quyen']==1 && $tk != $thongtin['userName']){ echo 'readonly'; } ?>></td>
 					</tr>
 				</table>
 				<?php if ($quyen==1 && $thongtin['quyen']!=1 || $quyen==1 && $tk==$thongtin['userName'] ) {
 					?>
 				<center><button style="height: 30px;width: 100px;" >CẬP NHẬT</button></center>
 				<?php
 			}
 			?>
 			</form>
 			<?php 
 		}
 	}
 		?>

	</div>
	<script>
		function doimk() {
			var x = document.getElementById('new-pass').value;
			var y = document.getElementById('re-new-pass').value;
			if (x!=y) {
				alert('Nhập lại mật khẩu không trùng khớp');
				return false;
			} else {
				return true;
			}
		}
	</script>
</body>
</html>