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
            margin-left: 150px;

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
        	color: white;
        }
	</style>
</head>
<body>
	<?php
	include("../../connect/open.php");
	if (isset($_GET['search']) && $_GET['search']!='') {
		$search = $_GET['search'];
		$sql = "SELECT * FROM product WHERE tenSP like '%$search%'";
	} else {
		$sql = "SELECT * FROM product";
	}
	$sql2 = "SELECT * FROM hang";
	$sql3 = "SELECT * FROM theloai";
	$result1 = mysqli_query($con,$sql);
	$result2 = mysqli_query($con,$sql2);
	$result3 = mysqli_query($con,$sql3);
	?>
	<div id='margin' style="margin-left: 3%;margin-top: 5%;border-left: 1px solid black;border-top: 1px solid black;height: 710px;background: #666666">
			<div style="height: 50px;width: 100%;background: #333333;margin-bottom: 0;display: flex;">
			<a onclick="document.getElementById('add').showModal()" class="thongtin" href="#">Thêm sản phẩm</a>
			<div class="formsearth">
            <form action="main.php?search=<?php echo $search ?>">
                <div class="mainsearth"><input type="search" name="search" class="search" placeholder="Tìm kiếm" style="background:none">
                    <button class="buttonsearth"><i class="fa fa-search" aria-hidden="true"></i></button>
                    </div>
            </form>
        <br>
		</div>
		</div>
		<div style="height: 1000px;display: flex;flex-wrap:wrap; ">
		<?php
		while ($sp = mysqli_fetch_array($result1)) {
				?>
				<a href="chi-tiet-sp.php?ma=<?php echo $sp['maSP'] ?>"><div style="height: 230px;width: 300px;margin-left: 30px;margin-top: 30px;border: 1px solid black">
					<img height="200px" width="300px" src="<?php echo $sp['anhSp'] ?>">

					<center><font><?php echo $sp['tenSP'] ?></font></center>
					<a class="icon" onclick="return confirm('Xóa sản phẩm này ? ?')" href="xoa-sp.php?ma=<?php echo $sp['maSP']; ?>"><i style="color: darkred;position: absolute;margin-top: -220px;margin-left: 280px;" class="fas fa-times-circle"></i></a>
					
					
				</div></a>
				<?php
			}
			?>
	</div>
	<dialog id='add'>
				<form action="them-sp-process.php" method="POST" enctype="multipart/form-data">
					<table>
 					
 					<tr>
 						<td>Ảnh sản phẩm</td>
 						<td>
 							<input type="file" name="fileToUpload">
 						</td>
 					</tr>
 					<tr>
 						<td>Tên sản phẩm</td>
 						<td>
 							<input type="text" name="ten">
 						</td>
 					</tr>
 					<tr>
 						<td>Hãng</td>
 						<td>
 							<select name="hang">
 							
 								<?php
 								while ($hang = mysqli_fetch_array($result2)) {
 									?>
 									<option value="<?php echo $hang['maHang']; ?>"><?php echo $hang['tenHang']; ?> </option>
 								
 									
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
 									<option value="<?php echo $theloai['maTheLoai']; ?>"><?php echo $theloai['tenTheLoai']; ?> </option>
 								
 									
 								<?php		
 								
 								}
 								
 				?>
 			</select>
 						</td>
 					</tr>
 					<tr>
 						<td>Giá</td>
 						<td>
 							<input type="number" name="gia">
 						</td>
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