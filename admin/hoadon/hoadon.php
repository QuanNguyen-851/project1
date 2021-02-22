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

		.thongtin {
			font-size: 20px;
			border-right: 2px solid black;
			text-decoration: none;
			padding-top: 13px;
			padding-right: 10px;
			padding-left: 10px;
		}

		.thongtin:hover {
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

		td.sp {
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
	include("../../connect/open.php");
	$sql = "SELECT * FROM hoadon INNER JOIN user ON hoadon.maUser=user.maUser ORDER BY maHd DESC";
	$result1 = mysqli_query($con, $sql);
	?>
	<div id='margin' style="margin-left: 3%;margin-top: 5%;border-left: 1px solid black;border-top: 1px solid black;background: white;min-height: 700px">
		<div style="height: 50px;width: 100%;background: #333333;margin-bottom: 0;border-bottom: 2px solid black">
			<center>
				<font style="color: white" size="50px">HÓA ĐƠN</font>
			</center>
		</div>

		<div>
			<center>
				<table style="margin-top: 20px;color: black;width: 100%;" cellpadding="0" cellspacing="0" border="1">
					<tr>
						<td class="sp" style="width: 85px">Mã hóa đơn</td>

						<td class="sp" style="width: 300px">Người đặt</td>

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
							<td class="sp"><?php echo $hd['tenUser']; ?></td>
							<td class="sp"><?php echo number_format($hd['tongTien']) . ' VND' ?></td>
							<td class="sp"><?php echo $hd['ngayDat']; ?></td>
							<td class="sp"><?php echo $hd['address'] ?>></td>
							<?php
							if ($hd['tinhTrang'] == '') { ?>
								<td style="color: blue;" class="sp">Đang chờ xác nhận</a></td>
							<?php } else if ($hd['tinhTrang'] == '1') { ?>
								<td style="color: green" class="sp">Đã xác nhận</td>
							<?php } else { ?>
								<td style="color: red" class="sp">Đã bị hủy</td>
							<?php } ?>
							<?php if ($hd['tinhTrang'] != '') { ?>
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

				</table>
			</center>
		</div>
</body>

</html>