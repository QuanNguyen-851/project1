<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LinhKien.com</title>
    <script src="https://kit.fontawesome.com/a12292074e.js" crossorigin="anonymous"></script>
    <style>
        body {
            margin: 0;
            padding: 0;
            background: url("../anh/1975181.jpg");
            background-size: cover;
        }

        #main {
            width: 1042px;
            height: 500px;
            background-color: white;
            margin: auto;
            margin-top: 50px;
            border-radius: 15px;
        }

        #top {
            width: 100%;
            height: 100px;
            background: white;
            text-align: center;
            background-color: #83afff;
            border-radius: 15px 15px 0px 0px;
        }

        #content {

            background: white;

        }

        .table {
            width: 60%;
            margin-left: 20px;
        }

        #bottom {
            background: blue;
            width: 100%;
            height: 100px;
            margin-top: 71px;
            position: fixed;
        }

        .fa-sad-tear {
            font-size: larger;
            font-size: 150px;
            color: rgb(70, 128, 236);
        }

        a {
            text-decoration: none;
        }

        td {
            border-bottom: solid 2px #e5e5e5
        }

        .fa-plus {
            color: black;
        }

        .fa-minus {
            color: black;
        }
    </style>
</head>

<body>

    <div id="container">

        <div id="main">


            <div id="top">
                <p style="font-size: 46px;line-height: 90px;font-weight: bold;font-family: sans-serif;">Giỏ hàng</p>
            </div>
            <div id="content">

                <?php
                if (isset($_SESSION['giohang'])) {
                    $giohang = $_SESSION['giohang'];
                    include "../../connect/open.php";
                ?>
                    <form method="post" <?php if (isset($_SESSION['user'])) {
                                        ?> action="../hoadon/thongtinhoadon.php" <?php
                                                                                } else {
                                                                                    ?> action="../account/formdangnhap.php" <?php
                                                                                                                        } ?>>
                        <table class="table" border="0" cellspacing="0" cellpadding="">
                            <tr height="30px">
                                <td height="30px" width="100px">

                                </td style="text-align: center">
                                <td width="200px"> Tên sản phẩm

                                </td>
                                <td width="80px" style="text-align: center">
                                    Số lượng
                                </td>

                                <td width="150px" style="text-align: center">
                                    Thành tiền
                                </td>
                                <td style="text-align: center">
                                    <a href="xoasp.php?all=1" style="color:red"> <i class="far fa-trash-alt"></i> all</a>
                                </td>

                            </tr>
                            <?php
                            $count = 0;
                            $tongtien = 0;
                            foreach ($giohang as $masp => $soluong) {
                                $count++;
                                $sql = "select * from `product` where maSP='$masp'";
                                $result = mysqli_query($con, $sql);
                                $sanpham = mysqli_fetch_array($result);

                            ?>
                                <tr height="100px">
                                    <td height="100px" width="100px">
                                        <img style="width:100px; height:100px;margin: 10px;" src="<?php echo $sanpham['anhSp'] ?>">
                                    </td>
                                    <td width="200px">
                                        <p style="font-weight: bold;text-overflow: ellipsis;width: 200px;overflow: hidden; white-space: nowrap;font-family: sans-serif;">
                                            <?php echo $sanpham['tenSP'] ?> <br>

                                        </p>
                                        <a style="font-family: sans-serif;"> <?php echo number_format($sanpham['gia']) . " VND"  ?></a>
                                    </td>
                                    <td width="100px" style="text-align: center">
                                        <a href="minus.php?masp=<?php echo $masp ?>&soluong=<?php echo $soluong ?> ">
                                            <in class=" fas fa-minus"></in>
                                        </a>
                                        <input style="text-align: center;width: 25px;" type="text" readonly value="<?php echo $soluong ?>">

                                        <a href="plus.php?masp=<?php echo $masp ?>&soluong=<?php echo $soluong ?> ">
                                            <in class="fas fa-plus"></in>
                                        </a><br>


                                    </td>
                                    <?php $sotien = $sanpham['gia'] * $soluong; ?>
                                    <td width="150px" style="text-align: center"><?php echo number_format($sotien) . " VND" ?></td>
                                    <td style="text-align: center">
                                        <a style="color: black;" href="xoasp.php?masp=<?php echo $masp ?>"><i class="fas fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                            <?php
                                $tongtien += $sotien;
                            }
                            if ($count == 0) {
                                header("location:xoasp.php?masp=0");
                            }
                            ?>
                            <tr height="100px">
                                <td height="100px" colspan="5" style="border:none;">

                                    <a href="../common/index.php">
                                        <div style="    margin-left: 115px; width: 129px;height: 42px; background: black;line-height: 40px;color: white;font-family: sans-serif;border-radius: 10px;">
                                            Tiếp tục mua sắm
                                        </div>
                                    </a>


                                </td>
                            </tr>
                            <tr height="100px">
                                <td height="100px" colspan="5" style="border:none;">


                                </td>
                            </tr>
                        </table>
                        <table border="0" height="200px" width="350px" style="border-radius: 10px;position: absolute;right: 260px; top: 160px;border: solid 2px #e5e5e5;" cellspacing="0" cellpadding="10">
                            <tr height="50px" style="background: aliceblue;">
                                <td> Tổng tiền:</td>
                                <td style="text-align:right">
                                    <input type="text" hidden name="tongtien" value="<?php echo $tongtien ?>">
                                    <a><?php echo number_format($tongtien) . " " . "VND" ?></a></td>
                            </tr>
                            <tr>
                                <td colspan="2" style="text-align:center">

                                    <button onclick="thanhtoan()" style="border: none;background: rgb(70, 128, 236);width: 150px;height: 50px;color: white;font-family: sans-serif;font-size: 26px;outline: none;border-radius: 15px;">
                                        Thanh toán
                                    </button>
                                </td>
                            </tr>
                        </table>
                    </form>
                <?php
                    include "../../connect/close.php";
                } else {

                ?>
                    <div style="width: 320px;height: 260px;margin: auto;margin-top: 50px; text-align: center">
                        <i class="far fa-sad-tear"></i><br>
                        <p>Giỏ hàng của bạn đang còn trống</p>

                        <a href="../common/index.php">
                            <div style=" width: 142px;margin: auto;height: 46px;background: black;line-height: 40px;color: white;font-family: sans-serif;">Bắt đầu mua sắm</div>
                        </a>
                    </div>


                <?php
                }
                ?>
            </div>
        </div>
    </div>

</body>

</html>