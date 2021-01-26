<?php
if (isset($_GET['masp'])) {
    $masp = $_GET['masp'];
}
include '../../connect/open.php';
$sql = "SELECT 
maSP,tenSP,gia,thongtinsp,anhSp,
hang.tenHang,theloai.tenTheLoai
FROM product
INNER JOIN hang on product.hang=hang.maHang 
INNER JOIN theloai on theloai.maTheLoai=product.theLoai where product.maSP='$masp'
";
$result = mysqli_query($con, $sql);


include '../../connect/close.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LinhKien.com</title>
    <link rel="stylesheet" type="text/css" href="../asset/css/chitietsp.css">
    <style>
        a:focus .imgp {
            border: 3px solid black;
        }
    </style>
</head>

<body>
    <?php
    include '../../connect/open.php';
    $sql2 = "SELECT * from product where maSP='$masp;'";
    $result2 = mysqli_query($con, $sql2);
    $product = mysqli_fetch_array($result2);
    include '../../connect/close.php';

    ?>
    <div id="container1">
        <div id="main1">

            <div id="left1">
                <div id="anh">
                    <div class="slide">
                        <!--img1-->
                        <img src="<?php echo $product['anhSp']; ?>">

                    </div>
                </div>

                <?php
                if (isset($_GET['page'])) {
                    $page = $_GET['page'];
                } else {
                    $page = 1;
                }
                ?>
                <div class="back" style=" margin-top: 100px;margin-left: 15px;"><a href="../common/index.php?page=<?php echo $page ?>"><i class="fas fa-undo-alt"></i> Trở lại</a></div>
            </div>
            <div id="right1">
                <div class="thongtin">
                    <table style="font-size: larger;font-family: sans-serif;" border="0" cellspacing="0" cellpadding="5" width="100%">
                        <tr>

                            <th colspan="2" style="text-overflow: ellipsis;width: 250px;overflow: hidden; white-space: nowrap;">
                                <?php echo $product['tenSP']; ?>
                            </th>
                        </tr>
                        <tr>

                            <th colspan="2" style="font-family: system-ui;color: red;">
                                <?php echo number_format($product['gia'])  . "." . "VND" ?>
                            </th>
                        </tr>
                        <?php
                        while ($thongtin = mysqli_fetch_array($result)) {
                        ?>

                            <tr>
                                <td style=" width:210px;border-top: 1px solid #e5e5e5; border-right: 1px solid #e5e5e5;">Nhà sản xuất:</td>
                                <td style="border-top: 1px solid #e5e5e5;">
                                    <?php
                                    echo $thongtin['tenHang'];
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td style=" width:170px;vertical-align: top; border-right: 1px solid #e5e5e5;border-top: 1px solid #e5e5e5;">Thông số sản phẩm:</td>
                                <td style="border-top: 1px solid #e5e5e5;">
                                    <a id="thongso"><?php echo $thongtin["thongtinsp"] ?></a>
                                </td>
                            </tr>
                        <?php
                        } ?>
                    </table>
                    <div class="mua">
                        <?php
                        if ($product['trangThai'] == "") {
                        ?>
                            <a onclick="them()" href="#" style="color:white;text-decoration:none">Thêm vào giỏ hàng</a>
                        <?php
                        } else if ($product['trangThai'] == "1") {
                        ?>
                            <a style="color:white;text-decoration:none; ">Ngừng kinh doanh</a>
                        <?php

                        }
                        ?>

                    </div>

                </div>

            </div>

        </div>

    </div>
    <div id="popup">
        <div id="main-popup" style="box-shadow: 0px 0px 35px grey;border-radius: 10px;">
            <a onclick="cancel()"><i class="far fa-times-circle" style=" position: absolute;right: 449px;top: 9px;font-size: 28px;"></i></a>
            <form action="../giohang/themgiohang.php?" method="post">
                <table border="0" cellspacing="0" cellpadding="0" width="100%" height="200px">
                    <tr>
                        <td rowspan="3" width="200px" style="text-align: center">
                            <img style="width:150px;height:150px" src="<?php echo $product['anhSp']; ?>">
                        </td>
                        <td style="height: 50px;">
                            <p style="text-overflow: ellipsis;width: 360px;overflow: hidden; white-space: nowrap; font-family: sans-serif;font-weight: bold;"><?php echo $product['tenSP']; ?></p>
                            <input type="hidden" id="masp" name="masp" value="<?php echo $product['maSP'] ?>">
                        </td>
                        </td>
                    </tr>
                    <tr>
                        <td style="height: 50px;">số lượng <input type="number" id="soluong" name="soluong" value="1" readonly></td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                </table>
                <div style="text-align:center"><button onclick="alert('thêm thành công')" style="border: none;outline: none;background:rgb(70, 128, 236); color:white;line-height: 30px;width: 100px;">đồng ý</button>

                </div>


            </form>
        </div>
    </div>
    <script>
        function them() {
            var popup = document.getElementById('popup');
            popup.style.display = "block";
        }

        function cancel() {
            var popup = document.getElementById('popup');
            popup.style.display = "none";
        }
    </script>
</body>

</html>