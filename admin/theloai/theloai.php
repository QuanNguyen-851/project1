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
	include("../../connect/open.php");
	$sql = "SELECT * FROM theloai";
	$result1 = mysqli_query($con,$sql);
	?>
	<div id='margin' style="margin-left: 3%;margin-top: 5%;border-left: 1px solid black;border-top: 1px solid black;height: 700px;background: white">
			<div style="height: 50px;width: 100%;background: #333333;margin-bottom: 0;display: flex;border-bottom: 2px solid black">
			<a style="color: white" onclick="document.getElementById('add').showModal()" class="thongtin" href="#">Thêm thể loại</a>
		</div>
		<div>
			<center><table style="margin-top: 20px;color: black;width: 100%" cellpadding="0" cellspacing="0" border="1">
				<tr>
					<td class="sp" style="width: 85px">Mã thể loại</td>
				
					<td class="sp">Tên Thể loại</td>
				
					
					<td></td>
					<td></td>
				</tr>
		<?php
		while ($tl = mysqli_fetch_array($result1)) {
				?>
				<tr>
					<td class="sp"><?php echo $tl['maTheLoai']; ?></td>
					<td class="sp"><?php echo $tl['tenTheLoai']; ?></td>
					<td class="sp"><a href="../common/main.php?command=7&ma=<?php echo $tl['maTheLoai']; ?>">Sửa</a></td>
					<?php if ($tl['An']==1) { ?>
						<td class="sp"><a onclick="return confirm('Hiện thể loại này ?')" href="../process/hien-tl.php?ma=<?php echo $tl['maTheLoai']; ?>">Hiện</a></td>
					<?php } else { ?>

					<td class="sp"><a onclick="return confirm('Ẩn thể loại này ?')" href="../process/xoa-tl.php?ma=<?php echo $tl['maTheLoai']; ?>">Ẩn</a></td>
				<?php } ?>

				</tr>
			
				<?php
			}
			?>
			</table></center>
	</div>
	<dialog style='position: fixed;' id='add'>
		<form action="../process/them-tl.php?">
			Tên thể loại: <input type="text" name="tl"><br/><br/>
			<center><button onclick="return them()">Thêm</button><button style="margin-left: 100px;" onclick="return huy()">Hủy</button></center>
		</form>
	</dialog>
	<script>
				function huy(){
			document.getElementById("add").close();
			return false;
		}
			</script>
</body>
</html>