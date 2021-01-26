<?php
session_start();
if (isset($_SESSION["user"]) == false) {
    header("Location: ../common/index.php");
}

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
        td {
            border-bottom: 2px solid #dbdaea;
        }

        #chitiet {
            width: 150px;
            height: 45px;
            background: #3f54e6;
            border-radius: 35px;
            margin: auto;
            line-height: 44px;
            color: white;
            font-family: sans-serif;
        }

        .menu {
            color: blue;
            padding: 10px;
            border-bottom: solid 2px blue;
        }

        .menu:hover {
            border-bottom: none;
        }
    </style>

</head>

<body>
    <div id="main">
        <div id="content">
            <div id="top">
                <i class="fa fa-user-circle-o" aria-hidden="true" style="color: white;font-size: 150px; margin-top: 120px; margin-left: 29px;"></i>
                <a style="color: aliceblue;font-size: 50px;font-family: sans-serif;">
                    <?php
                    if (isset($_SESSION["user"])) {
                        $usern = $_SESSION["user"];
                        echo $usern;
                    }

                    ?>

                </a>
            </div>
            <?php
            include("../../connect/open.php");
            $sql = "SELECT * FROM `user1` INNER JOIN hoadon on user1.maUser=hoadon.maUser  WHERE user1.userName='$usern' ORDER by hoadon.maHd DESC LIMIT 0,5 ";
            $result = mysqli_query($con, $sql);
            include("../../connect/close.php");
            ?>
            <div id="bottom">
                <form>
                    <table width=" 100%" border="0" cellspacing="0" cellpadding="10">
                        <tr>
                            <td colspan="2" style="border:none;">
                                <h2> <i class="fas fa-receipt"> </i> Lịch sử đơn hàng</h2>

                            </td>
                        </tr>
                        <tr>
                            <td style="    border: none;">
                                <table border="0" width="100%" cellspacing="0" cellpadding="0">
                                    <tr height="50px">
                                        <td colspan="4">
                                            <div style="display: flex;    justify-content: flex-end;">
                                                <a href="menuhoadon.php?m=null">
                                                    <div class="menu"> Đang chờ </div>
                                                </a>
                                                <a href="menuhoadon.php?m=1">
                                                    <div class="menu"> Đã xác nhận</div>
                                                </a>
                                                <a href="menuhoadon.php?m=0">
                                                    <div class="menu"> Đã hủy</div>
                                                </a>
                                            </div>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td width="200px" style="text-align:center">Tổng</td>
                                        <td width="100px" style="text-align:center">Ngày đặt</td>
                                        <td width="150px" style="text-align:center">tình trạng</td>
                                    </tr>

                                    <?php
                                    $count = 0;
                                    while ($hoadon = mysqli_fetch_array($result)) {
                                        $count++;
                                    ?>

                                        <tr style="height:100px">
                                            <td style="text-align:center">
                                                <a href="hoadonchitiet.php?maHd=<?php echo $hoadon['maHd']; ?>">
                                                    <div id="chitiet">Chi tiết</div>
                                                </a>
                                            </td>
                                            <td style="text-align:center"> <?php echo number_format($hoadon['tongTien']) . " " . "VND"  ?></td>
                                            <?php
                                            $date = date_create($hoadon['ngayDat']);
                                            //echo date_format($date, "d/m/Y");
                                            ?>
                                            <td style="text-align:center"><?php echo date_format($date, "d/m/Y "); ?></td>
                                            <td style="text-align:center">
                                                <?php if ($hoadon['tinhTrang'] == "") {
                                                ?>
                                                    <a style="color: #7070e6;">Chờ xác nhận</a>
                                                <?php
                                                } else if ($hoadon['tinhTrang'] == "1") {
                                                ?>
                                                    <a style="color: #46ff46;">Đã xác nhận</a>
                                                <?php
                                                } else if ($hoadon['tinhTrang'] == "0") {
                                                ?>
                                                    <a style="color: red">Đã hủy</a>
                                                <?php
                                                } ?>
                                            </td>
                                        </tr>

                        </tr>

                    <?php
                                    }
                    ?>
                    <?php if ($count == 0) { ?>
                        <tr>
                            <td colspan="3" height="100px" style="text-align:center">Bạn chưa có đơn hàng nào</td>
                        </tr>
                    <?php
                    } ?>
                    </table>
                    </td>
                    <td width="340px" style="vertical-align: sub; border:none;">
                        <div id="function">
                            <ul class="cha">
                                <a href="../account/thongtintaikhoan.php">
                                    <li class="con">
                                        <i class="far fa-address-book" style="font-weight: bold;"> Hồ sơ của tôi</i>
                                    </li>
                                </a>
                                <a href="../account/doimk.php?user=<?php echo $usern; ?>  " style=" text-decoration:none">
                                    <li class="con">
                                        <i class="fas fa-lock"> Đổi mật khẩu</i>
                                    </li>
                                </a>
                                <a href="../account/dangxuat.php">
                                    <li class="con">
                                        <i class="fas fa-sign-out-alt"> Đăng xuất</i>
                                    </li>
                                </a>
                            </ul>
                        </div>
                    </td>
                    </tr>
                    <tr>
                        <td colspan="2" height="80px" style="border:none;">
                            <a href="../common/index.php">
                                <div style="    margin: auto; text-align:center;  width: 129px;height: 42px; background: black;line-height: 40px;color: white;font-family: sans-serif;border-radius: 10px;">
                                    Tiếp tục mua sắm
                                </div>
                            </a>
                        </td>
                    </tr>


                    </table>
                </form>
            </div>



        </div>


    </div>
    <?php
    include "../common/header.php";
    ?>

    <script>

    </script>
</body>

</html>