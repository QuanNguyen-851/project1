
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
		a.icon{
			color: red;
		}
		a{
			text-decoration: none;
		}
		a.ok{
			color: green;
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
	</style>
</head>
<body>
	<?php 
	echo $_GET['search'];
	if(isset($_GET['search'])){
		$search = $_POST['search'];
		$sql1 = "SELECT * FROM admin WHERE userName like %$search% OR tenAdmin like %$search% ";
	} else {
		$sql1 = "SELECT * FROM admin";
	}

	$result1 = mysqli_query($con,$sql1); 
?>
	<div id='margin' style="margin-left: 3%;margin-top: 5%;border-left: 1px solid black;border-top: 1px solid black;display: flex;flex-wrap:wrap;background: white;min-height: 700px">
		<div style="height: 50px;width: 100%;background: #333333;margin-bottom: 0;display: flex;border-bottom: 2px solid black">
			<a style="color: white" onclick="document.getElementById('add').showModal()" class="thongtin" href="#">Thêm admin</a>
			
		</div>
		<?php
			while ($ds = mysqli_fetch_array($result1)) {
				?>
				<div style="height: 220px;width: 150px;margin-left: 30px;margin-top: 30px;">
					<div style="width: 100%;height: 200px;border: 1px solid black;">
						<div style="height: 10px">
								<?php
							if ($ds['quyen'] == 0){ 
								if($ds['block']==0){
								 ?>
									<a class="icon" onclick="return confirm('Chặn tài khoản này ?')" href="../process/ban.php?ma=<?php echo $ds['maAdmin']; ?>">
										<i style="margin-left: 5px;color: red" class="fas fa-ban"></i>
									</a>
								<?php
								 } else { 
								 	?>
								<a class="ok" onclick="return confirm('Bỏ chặn tài khoản này ?')" href="../process/unban.php?ma=<?php echo $ds['maAdmin']; ?>"><i style="margin-left: 5px;color: green" class="far fa-check-circle"></i>
								</a> 
							<?php
							 } 
							 ?>
					<?php 
					      }
					?>
						</div>
						<center><a class="profile" href="../common/main.php?command=1&ma=<?php echo $ds['maAdmin'] ?>"><i style="font-size: 150px;color: blue;margin-top: 7px;" class="fas fa-user"></i></center>
					<center><font style="margin-top: 5px;color: black" ><?php  if($ds['quyen']==1){ echo "Super Admin"; } else { echo "Admin";} ?></font></center></a>
					</div>
					<div style="width: 100%;height: 15px;margin-top: 5px;"><center><font style="color: black"><?php echo $ds['tenAdmin']; ?></font></center></div>
				</div></a>
			<?php
			 } 
			?>
			<dialog id='add'>
				<form action="../process/them-admin.php">
					<table>
 					<tr>
 						<td>Tên admin:</td>
 						<td><input type="text" name="ten" required="1"></td>
 					</tr>
 					<tr>
 						<td>Tên tài khoản</td>
 						<td><input type="text" name="account" required="1"></td>
 					</tr>
 					<tr>
 						<td>Mật khẩu</td>
 						<td><input id="pass" type="password" name="pass" required="1"></td>
 					</tr>
 					<tr>
 						<td>Nhập lại mật khẩu</td>
 						<td><input id="re-pass" type="password" required="1"></td>
 					</tr>
 					<tr>
 						<td>Giới tính</td>
 						<td>
 						<select name="gt" id="gt">
 						    <option value="-1">---</option>
 			                <option value="1">Nam</option>
 			                <option value="0">Nữ</option>
 						</select>
 					</td>
 					</tr>
 					<tr>
 						<td>Ngày sinh</td>
 						<td><input type="date" name="date"></td>
 					</tr>
 					<tr>
 						<td>Email:</td>
 						<td><input type="Email" name="Email" required="1"></td>
 					</tr>
 					<tr>
 						<td>SĐT</td>
 						<td><input type="number" name="sdt"  required="1"></td>
 					</tr>
 					<tr>
 						<td>Địa chỉ</td>
 						<td><input type="text" name="address" required="1"></td>
 					</tr>
 				</table><br/>
 						<center><button onclick="return them()">Thêm</button><button style="margin-left: 100px;" onclick="return huy()">Hủy</button></center>
				</form>
			</dialog>
	</div>
	<script>
		function add(){
			document.getElementById("add").showModal();
		}
		function huy(){
			document.getElementById("add").close();
			return false;
		}
		function them(){
			var z=0;
			var x = document.getElementById('pass').value;
			var y = document.getElementById('re-pass').value;
			var gt = document.getElementById('gt').value;
			if (x!=y) {
				alert('Nhập lại mật khẩu không trùng khớp');
			} else {
				z+=1;
			}
			if (gt=='-1') {
				alert('Chưa chọn giới tính');
			} else {
				z+=1;
			}
			if (z==2) {
				return true;
			} else {
				return false;
			}
		}
	</script>
</body>
</html>