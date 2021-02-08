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
        a{
        	text-decoration: none;
        }
        img{
        	margin: 0;
        }
        .img{
        	height: 100px;
        	width: 100px;
        }
        td.sp{
        	text-align: center;
        }
	</style>
</head>
<body>
	<?php
	include("../../connect/open.php");
	if (isset($_GET['search']) && $_GET['search']!='') {
		$search = $_GET['search'];
		$sql = "SELECT * FROM (( product INNER JOIN hang ON product.hang = hang.maHang) INNER JOIN theloai ON product.theLoai = theloai.maTheLoai ) WHERE tenSP like '%$search%' ORDER BY maSP DESC";
	} else {
		$sql = "SELECT * FROM (( product INNER JOIN hang ON product.hang = hang.maHang) INNER JOIN theloai ON product.theLoai = theloai.maTheLoai ) ORDER BY maSP DESC";
	}
	$sql2 = "SELECT * FROM hang";
	$sql3 = "SELECT * FROM theloai";
	$result1 = mysqli_query($con,$sql);
	$result2 = mysqli_query($con,$sql2);
	$result3 = mysqli_query($con,$sql3);
	?>
	<div id='margin' style="margin-left: 3%;margin-top: 5%;border-left: 1px solid black;border-top: 1px solid black;background: white">
			<div style="height: 50px;width: 100%;background: #333333;margin-bottom: 0;display: flex;border-bottom: 2px solid black">
			<a style="color: white" onclick="document.getElementById('add').showModal()" class="thongtin" href="#">Thêm sản phẩm</a>
			<div class="formsearth">
            <form action="../common/main.php?search=<?php echo $search ?>">
                <div class="mainsearth"><input type="search" name="search" class="search" placeholder="Tìm kiếm" style="background:none">
                    <button class="buttonsearth"><i class="fa fa-search" aria-hidden="true"></i></button>
                    </div>
            </form>
        <br>
		</div>
		</div>
		<div>
			<center><table style="margin-top: 20px;color: black;width: 100%" cellpadding="0" cellspacing="0" border="1">
				<tr>
					<td class="sp" style="width: 85px">mã sản phẩm</td>
				
					<td colspan="2" class="sp" style="width: 300px">Tên sản phẩm</td>

				
					<td class="sp">Thể loại</td>
				
			
					<td class="sp">Hãng</td>
				
					<td class="sp">Giá</td>
					<td class="sp">Số lượng</td>
			
				
					<td class="sp">Thông tin sản phẩm</td>
				
				
					<td class="sp"></td>
				
					<td></td>
					<td></td>
				</tr>
		<?php
		while ($sp = mysqli_fetch_array($result1)) {
				?>
				<tr>
					<td class="sp"><?php echo $sp['maSP']; ?></td>
					<td class="sp"><?php echo $sp['tenSP']; ?></td>
					<td><img height="75px" width="150px" src="<?php echo $sp['anhSp']; ?>"></td>
					<td class="sp"><?php echo $sp['tenTheLoai']; ?></td>
					<td class="sp"><?php echo $sp['tenHang']; ?></td>

					<td class="sp"><?php echo number_format( $sp['gia']).' VND' ?></td>
					<?php if ($sp['soLuong']==0) { ?>
						<td class="sp"><font style="color: red">Hết hàng</font></td>
					<?php } else { ?>
					<td class="sp"><?php echo $sp['soLuong']; ?></td>
					<?php } ?>
					<td class="sp"><a href="../common/main.php?command=3&ma=<?php echo $sp['maSP']; ?>">Thông tin sản phẩm</a></td>
					<?php 
					if ($sp['trangThai']=='') { ?>
					<td class="sp"><a onclick="return confirm('Ngừng kinh doanh sản phẩm này ?')" href="../process/xoa-sp.php?ma=<?php echo $sp['maSP']; ?>">Ngừng kinh doanh</a></td>
				<?php } else { ?>
					<td class="sp"><a onclick="return confirm('Kinh doanh tiếp ?')" href="../process/tiep.php?ma=<?php echo $sp['maSP']; ?>">Tiếp tục kinh doanh</a></td>
				<?php } ?>
				</tr>
			
				<?php
			}
			?>
			</table></center>
	</div>
	<dialog style='position: fixed;' id='add'>
				<form action="../process/them-sp-process.php" method="POST" enctype="multipart/form-data">
					<table>
 					
 					<tr>
 						<td>Ảnh sản phẩm</td>
 						<td>
 							<input type="file" name="fileToUpload" required="1">
 						</td>
 					</tr>
 					<tr>
 						<td>Tên sản phẩm</td>
 						<td>
 							<input type="text" name="ten" required="1">
 						</td>
 					</tr>
 					<tr>
 						<td>Hãng</td>
 						<td>
 							<select name="hang">
 							
 								<?php
 								while ($hang = mysqli_fetch_array($result2)) {
 									?>
 									<option <?php if($hang['An']==1){ echo "disabled" ; } ?> value="<?php echo $hang['maHang']; ?>"><?php echo $hang['tenHang']; ?> </option>
 								
 									
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
 									<option <?php if($theloai['An']==1){ echo "disabled" ; } ?> value="<?php echo $theloai['maTheLoai']; ?>"><?php echo $theloai['tenTheLoai']; ?> </option>
 								
 									
 								<?php		
 								
 								}
 								
 				?>
 			</select>
 						</td>
 					</tr>
 					<tr>
 						<td>Giá</td>
 						<td>
 							<input type="number" name="gia" required="1">
 						</td>
 					</tr>
 					<tr>
 						<td>Số lượng</td>
 						<td><input required="1" type="number" name="soluong"></td>
 					</tr>
 				</table><br/>
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