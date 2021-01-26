<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

</head>

<body>
    <header class="header">

        <div class="formlogo">
            <a href="../index.php"><img src="../anh/logo_linhkien.gif" style=" width: 250px; height:100px"></a>

        </div>
        <div class="formsearth">
            <?php
            if (isset($_GET['search'])) {
                $search = $_GET['search'];
            } else {
                $search = "";
            }
            ?>
            <form action="../search/timkiemsp.php">
                <div class="mainsearth"><input type="search" value="<?php echo $search ?>" name="search" class="search" placeholder="Tìm kiếm" style="background:none">
                    <button class="buttonsearth"><i class="fa fa-search" aria-hidden="true"></i></button>
                </div>
            </form><br>
        </div>
        <div class="formicon">
            <?php
            $count = 0;
            if (isset($_SESSION['giohang'])) {
                $sanpham = $_SESSION['giohang'];
                foreach ($sanpham as $masp) {
                    $count++;
                }
            }

            ?>
            <div style="position:relative">
                <a href="../giohang/index.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i>
                    <div style="background-color: red;width: 20px;height: 20px;border-radius: 10px;color: white; text-align: center; position: absolute;left: 73px;top: 15px;">
                        <a><?php echo $count ?></a>
                    </div>
                </a>
            </div>
            <a href="mailto:nguyenmanhquan08052001@gmail.com" style="color:rgb(70, 128, 236);line-height: 27px;margin-left: 25px;;margin-top: 30px;;font-size: x-large; text-decoration: none;">
                <div class="profile"><i class="fa fa-envelope-o" aria-hidden="true"></i>Email</div>
            </a>
            <?php
            if (isset($_SESSION["user"])) {
            ?>
                <a href="../account/thongtintaikhoan.php" style="color:rgb(70, 128, 236);line-height: 28px;margin-left: 10px;margin-top: 30px;;font-size: x-large; text-decoration: none;">
                    <div class="profile"><i class="fa fa-user-circle-o" aria-hidden="true"></i>
                        <?php
                        echo $_SESSION["user"];
                        ?></div>
                </a>
            <?php
            } else {
            ?>
                <a href="../account/formdangnhap.php" style="color:rgb(70, 128, 236);line-height: 28px;margin-left: 10px;margin-top: 30px;;font-size: x-large; text-decoration: none;">
                    <div class="profile"><i class="fas fa-sign-in-alt"></i>
                        Login</div>
                </a>
            <?php
            }
            ?>
        </div>
    </header>
</body>

</html>