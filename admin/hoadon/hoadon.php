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
		.formsearth {
            background-color: none;
            width: 860px;


            height: 50px;
            
        }
        .mainsearth {
            background-color: white;
            width: 810px;
            height: 50px;

            display: flex;
            margin-top: 0px;
            margin-left: 100px;

        }
        .buttonsearth {
            width: 50px;
            border: none;
            outline: none;
            background: none;
        }
        .search {
            width: 760px;
            border: none;
            border-radius: 20px 0px 0px 20px;
            outline: none;
            font-size: 16px;
            background: none;

        }
        td.sp{
        	text-align: center;
        	height: 75px
        }
	</style>
</head>
<body>
	<?php
	if (isset($_GET['succes'])) {
		echo "<script type='text/javascript'>alert('Đã xác nhận');</script>";
	}
	if (isset($_GET['not'])) {
		echo "<script type='text/javascript'>alert('Đơn hàng đã bị hủy');</script>";
	}
	if (isset($_GET['fail'])) {
		echo "<script type='text/javascript'>alert('Đơn hàng đã được xử lý bởi người khác ');</script>";
	}
	if (isset($_GET['view'])) {
		$pag = $_GET['view'];
		if ($pag == 1) {
		$sql = "SELECT * FROM hoadon WHERE tinhTrang = '0' ORDER BY maHd DESC";
	} else if ($pag == 2) {
		$sql = "SELECT * FROM hoadon WHERE tinhTrang = '1' ORDER BY maHd DESC";
	} else {
		$sql = "SELECT * FROM hoadon  WHERE tinhTrang is null ORDER BY maHd DESC";
	} 
	} else {
		$sql = "SELECT * FROM hoadon  ORDER BY maHd DESC";
	}
	include("../../connect/open.php");
	$result1 = mysqli_query($con,$sql);
	?>
	<div id='margin' style="margin-left: 3%;margin-top: 5%;border-left: 1px solid black;border-top: 1px solid black;background: white;min-height: 700px">
			<div style="height: 50px;width: 100%;background: #333333;margin-bottom: 0;border-bottom: 2px solid black">
				<center><font style="color: white" size="50px">ĐƠN HÀNG</font></center>
			</div>
			
		<div>
			<select style="margin-top: 20px;margin-bottom: 10px;margin-left: 10px;height: 20px;" onchange="xem()" id="view">
				<option value="1">All</option>
				<option  <?php if (isset($pag) && $pag == 2) {
					echo 'selected';
				} ?> value="2">Đã xác nhận</option>
				<option <?php  if (isset($pag) && $pag == 1) {
					echo 'selected';
				} ?> value="3">Đã bị hủy</option>
				<option <?php if (isset($pag) && $pag == 4) {
					echo 'selected';
				} ?> value="4">Đang chờ xác nhận</option>
			</select>
			<center><table style="margin-top: 0px;color: black;width: 100%;" cellpadding="0" cellspacing="0" border="1">
				<tr>
					<td class="sp" style="width: 85px">Mã hóa đơn</td>
				
					<td class="sp" style="width: 200px">Người đặt</td>

					<td class="sp" style="width: 200px">SĐT</td>
				
					<td class="sp">Tổng tiền</td>
				
			
					<td class="sp">Ngày đặt</td>
				
					<td class="sp">Địa chỉ</td>
			
					<td class="sp">Tình trạng</td>

					<td class="sp">Xác nhận</td>

					<td class="sp">Hủy Đơn</td>
				
					<td class="sp">Chi tiết</td>
				</tr>
		<?php
		while ($hd = mysqli_fetch_array($result1)) {
				?>
				<tr>
					<td class="sp"><?php echo $hd['maHd']; ?></td>
					<td class="sp"><?php echo $hd['tenNguoiNhan']; ?></td>
					<td class="sp"><?php echo $hd['sdt']; ?></td>
					<td class="sp"><?php echo number_format( $hd['tongTien']).' VND' ?></td>
					<td class="sp"><?php echo $hd['ngayDat']; ?></td>
					<td class="sp"><?php echo $hd['address'] ?></td>
					<?php
					if ($hd['tinhTrang']=='') { ?>
						<td style="color: blue;" class="sp">Đang chờ xác nhận</a></td>
					<?php } else if ($hd['tinhTrang']=='1') { ?>
						<td style="color: green" class="sp">Đã xác nhận</td>
					<?php } else { ?>
						<td style="color: red" class="sp">Đã bị hủy</td>
					<?php } ?>
					<?php if ($hd['tinhTrang']!='') { ?>
						<td class="sp">Xác nhận</td>
						<td class="sp">Hủy đơn</td>
					<?php } else { ?>
					<td class="sp"> <a onclick="return confirm('Xác nhận đơn hàng này ?')" href="../process/xac-nhan.php?ma=<?php echo $hd['maHd']; ?>">Xác nhận</a></td>
					<td class="sp"> <a onclick="return confirm('Xác nhận hủy đơn ?')" href="../process/huy-don.php?ma=<?php echo $hd['maHd']; ?>">Hủy đơn</a></td>
				<?php } ?>
					 <td class="sp"><a href="../common/main.php?command=8&ma=<?php echo $hd['maHd']; ?>">Xem</a></td>
					 <?php
							}
						 ?>
						
			</table></center>
			<?php
			$check = mysqli_num_rows($result1);
			if ($check == 0) { ?>
				<center><div style="margin-top: 100px;font-size: 50px;color: blue">Không có đơn hàng nào</div></center>
					<?php
			} 
			?>
	</div>
	<script>
		function xem(){
			var x = document.getElementById('view').value;
			 if (x == 1){
			 	location.replace("main.php?command=9");
			 } else if (x == 2) {
			 	location.replace("main.php?command=9&view=2");
			 } else if (x == 3) {
			 	location.replace("main.php?command=9&view=1");
			 } else if (x == 4) {
			 	location.replace("main.php?command=9&view=4");
			 }
		}
	</script>
</body>
</html>