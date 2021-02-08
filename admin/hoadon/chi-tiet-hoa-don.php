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
		td{
			text-align: center;
		}
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
if (isset($_GET['ma'])) {
	$maHd = $_GET['ma'];
include("../../connect/open.php");
$sql = "SELECT product.maSP, anhSp , tenSP, hoadonchitiet.soluong, hoadonchitiet.gia  FROM `product` 
                        INNER JOIN hoadonchitiet ON hoadonchitiet.maSp=product.maSP WHERE hoadonchitiet.maHd='$maHd' ";
$result = mysqli_query($con,$sql);
?>
<div id='margin' style="margin-left: 3%;margin-top: 5%;border-left: 1px solid black;border-top: 1px solid black;background: white;min-height: 700px">
	<div style="height: 50px;width: 100%;background: #333333;margin-bottom: 0;display: flex;border-bottom: 2px solid black">
			<a style="color: white"  class="thongtin" href="../common/main.php?command=9">Quay lại</a>
			
		</div>
	  <table border="1" width="100%" cellspacing="0" cellpadding="0">
                        <tr>
                        	<td></td>
                            <td>Tên sản phẩm</td>
                            <td>Số lượng</td>
                            <td>Tổng </td>
                        </tr>
                        <?php
while ($chitiet = mysqli_fetch_array($result)) { ?>
	<tr>
                                <td width=" 150px" height="150px">
                                    <img style="height:150px;width:150px" src="<?php echo $chitiet['anhSp'] ?>"></a>
                                </td>
                                <td>
                                   <?php echo $chitiet['tenSP'] ?><br>
                                    <?php echo number_format($chitiet['gia']) . " " . "VND" ?>
                                </td>
                                <?php

                                $tong = $chitiet['gia'] * $chitiet['soluong'];
                                ?>
                                <td width="100px" style=" text-align: center"><?php echo $chitiet['soluong'] ?></td>
                                <td width="200px" style=" text-align: center"> <?php echo number_format($tong) . " " . "VND" ?></td>
                            </tr>
                          <?php
								}
								?>
							</table>
						</div>
						<?php
					}
					?>

</body>
</html>
