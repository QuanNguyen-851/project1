<?php
session_start();
if (isset($_SESSION['user']) && isset($_GET['maHd'])) {
    $username = $_SESSION['user'];
    $maHd = $_GET['maHd'];
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>
            LinhKien.com</title>
        <link rel="stylesheet" type="text/css" href="../asset/css/khungthongtin.css">
        <script src="https://kit.fontawesome.com/a12292074e.js" crossorigin="anonymous"></script>
        <style>
            body {
                background-image: url('../anh/1975181.jpg');
                background-size: cover;
            }

            #content {
                width: 1000px;
                height: 876px;
            }

            #top {
                height: 150px;
                background-color: #ccd2fe;
            }

            #main {
                background: none;
            }

            .last {
                background-color: white;
                height: 100px;
                display: flex;
                justify-content: center;
                border-radius: 0px 0px 15px 15px;


            }

            .trangThai {
                background-color: aqua;
                height: 50px;
                width: 140px;
                margin: 20px;
                text-align: center;
                color: white;
                line-height: 48px;
                font-size: 20px;
                font-family: sans-serif;
            }

            td {
                border-bottom: 2px solid #b3b3b3;
            }
        </style>

    </head>


    <body>

        <?php
        include('../../connect/open.php');
        $sql = "SELECT * FROM `user`  WHERE userName='$username'";
        $result = mysqli_query($con, $sql);
        $user = mysqli_fetch_array($result);

        ?>
        <div id="main">
            <div id="content" style="box-shadow: none;">
                <div id="top">
                    <table border="0" style="border:none;margin-left: 20px;">
                        <tr>
                            <td style="text-align: left;border:none">
                                <h1><i class="fas fa-user"></i><?php echo ' ' . $user['tenUser'] ?></h1>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: left;border:none"><i class="fas fa-mobile-alt"></i> <?php echo $user['SDT'] ?> </td>
                        </tr>
                        <tr>
                            <td style="text-align: left;border:none"><i class="fas fa-map-marker-alt"></i><?php echo $user['address'] ?></td>
                        </tr>
                    </table>
                </div>
                <div id="bottom">

                    <table border="0" width="100%" cellspacing="0" cellpadding="10">
                        <tr>
                            <td style="border:none"><a href="index.php"><i class="fas fa-chevron-left"></i> Trở lại</a></td>
                            <td style="border:none"> Mã đơn hàng : <a style=" color:red"> <?php echo $maHd ?></a> </td>
                            <td style="border:none; text-align:center">số lượng</td>
                            <td style="border:none;text-align:center"> tổng </td>
                        </tr>

                        <?php
                        $sqlchitiet = "SELECT product.maSP, anhSp , tenSP, hoadonchitiet.soluong, hoadonchitiet.gia  FROM `product` 
                        INNER JOIN hoadonchitiet ON hoadonchitiet.maSp=product.maSP WHERE hoadonchitiet.maHd='$maHd' ";
                        $resultchitiet = mysqli_query($con, $sqlchitiet);
                        while ($chitiet = mysqli_fetch_array($resultchitiet)) {
                        ?>
                            <tr>
                                <td width=" 150px" height="150px">
                                    <a href="../common/index.php?cat=1&masp=<?php echo $chitiet['maSP']  ?>"> <img style="height:150px;width:150px" src="<?php echo $chitiet['anhSp'] ?>"></a>
                                </td>
                                <td>
                                    <p style=" while_space:nowrap; width: 350px;overflow:hidden;text-overflow: ellipsis;"><?php echo $chitiet['tenSP'] ?></p><br>
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
                        $sqlhoadon = "SELECT * FROM `hoadon` WHERE maHd=' $maHd'";
                        $resulthoadon = mysqli_query($con, $sqlhoadon);
                        $hoadon = mysqli_fetch_array($resulthoadon);

                        ?>
                        <tr>
                            <td colspan="4" style="text-align: right;border:none;">
                                <a style="font-size: 15px;"></i><?php $time = date_create($hoadon['ngayDat']);
                                                                echo date_format($time, "H:i:s   d-m-Y") ?>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4" style="text-align: right;border:none;">
                                Người nhận:<br>
                                <a> <?php echo $hoadon['tenNguoiNhan'] ?></a>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4" style="text-align: right;border:none;">
                                Số điện thoại:<br>
                                <a> <i class="fas fa-mobile-alt"></i> <?php echo $hoadon['sdt'] ?></a>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4" style="text-align: right;border:none;">
                                Địa chỉ nhận hàng:<br>
                                <a> <i class="fas fa-map-marked-alt"></i> <?php echo $hoadon['address'] ?></a>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4" style="text-align: right;border:none;">
                                Tổng thanh toán:<br>
                                <a style="font-family: sans-serif;font-weight: bold;color: red;"><?php echo number_format($hoadon['tongTien']) . " " . "VND" ?></a><br>
                                <?php
                                if ($hoadon['tinhTrang'] == "") {
                                ?>
                                    <a style=" color: blue;">Đang chờ xác nhận...</a>
                                <?php
                                } ?>
                            </td>
                        </tr>
                    </table>
                    <div class="last">

                        <?php
                        if ($hoadon['tinhTrang'] == "") {
                        ?>
                            <a onclick="return confirm('Bạn có chắc muốn hủy đơn này không ?')" href="huydonhang.php?maHd=<?php echo $maHd ?>">
                                <div class="trangThai" style="background-color:red">Hủy đơn hàng</div>
                            </a>
                        <?php
                        } else if ($hoadon['tinhTrang'] == "1") {
                        ?>
                            <div class="trangThai" style="background-color: #46ff46;">Đã xác nhận</div>
                        <?php
                        } else {
                        ?>
                            <div class="trangThai" style="background-color:red">Đã hủy</div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <div style="height:150px">
                </div>
            </div>


        </div>
        <?php
        include('../../connect/close.php');
        include("../common/header.php");
        ?>
    </body>

    </html>
<?php
} else {
    header('location:../common/index.php');
}
