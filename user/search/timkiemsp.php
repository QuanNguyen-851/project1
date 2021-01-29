<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LinhKien.com</title>
    <link rel="stylesheet" type="text/css" href="../asset/css/khung.css">
    <script src="https://kit.fontawesome.com/a12292074e.js" crossorigin="anonymous"></script>
    <style>
        .page {
            border: 2px solid gray;
            background-color: white;
            width: 35px;
            height: 40px;
            margin-left: 10px;
            text-align: center;
            line-height: 38px;
            text-decoration: none;
        }

        #num {
            text-decoration: none;
            font-family: sans-serif;
        }

        #num :hover {
            background-color: #ddd;
        }

        .tsp {
            font-family: sans-serif;
            text-decoration: none;
            color: black;
            font-size: larger;
            margin-left: 3px;
        }

        a {
            text-decoration: none;

        }
    </style>

</head>

<body>
    <div id="main">

        <div id="content">

            <div style="width: 99%; height:60em; background-color:none  ; margin: auto;  display: flex; 
                align-content: baseline; flex-wrap:wrap;
                    ">
                <?php
                include('../../connect/open.php');
                if (isset($_GET['search'])) {

                    $search = $_GET['search'];
                    if ($search == "") {
                        header('Location:../common/index.php');
                    }
                } else {
                    header('Location:../common/index.php');
                }
                $count = "SELECT COUNT(*) as dem FROM `product`WHERE product.tenSP LIKE'%$search%'";
                $resultc = mysqli_query($con, $count);
                $soluong = mysqli_fetch_array($resultc);
                $start = 0;
                $limit = 12;
                $page = 1;
                $sotrang = ceil($soluong['dem'] / $limit);
                if (isset($_GET['page'])) {
                    $page = $_GET['page'];
                    $start = ($page - 1) * $limit;
                }
                $sql = "SELECT maSP,tenSP,gia,thongtinsp,anhSp,hang.tenHang,theloai.tenTheLoai
                     FROM product 
                     INNER JOIN hang on product.hang=hang.maHang 
                     INNER JOIN theloai on theloai.maTheLoai=product.theLoai 
                     WHERE product.tenSP LIKE'%$search%' or hang.tenHang LIKE'%$search%' 
                     ORDER BY maSP DESC limit $start,$limit";
                $result = mysqli_query($con, $sql);

                ?>
                <?php

                while ($thongtin = mysqli_fetch_array($result)) {
                ?>
                    <a class="tsp" href="../common/index.php?page=<?php echo $page ?>&cat=1&masp=<?php echo $thongtin['maSP'] ?>" title="Nhấn vào để biết thêm thông tin sản phẩm!">
                        <div style="margin: 5px;;width: 250px; height: 300px; background-color:white; margin-top: 10px; ">
                            <div class="anhsp" style="width: 100%;background-color: aqua;height: 30;height: 70%;">
                                <img style="height: 100%;width: 100%;" src="<?php echo $thongtin['anhSp']; ?>">
                            </div>
                            <div class="thongtin" style="width: 100%;height: 50px;background-color:white;word-wrap:break-word;overflow:hidden; text-align:center;">
                                <p style="text-overflow: ellipsis;width: 250px;overflow: hidden; white-space: nowrap;"> <?php echo $thongtin['tenSP']; ?></p>
                            </div>
                            <div class="gia" style="text-align: center;width: 100%;height: 14%;background-color: white ;border-radius: 0px 0px 15px 15px;">
                                <div class="er" style="line-height: 44px;color:red; ">
                                    <?php echo number_format($thongtin['gia'])  . "" . ".VND" ?>
                                </div>
                            </div>
                        </div>
                    </a>
                <?php
                } ?>

            </div>
        </div>

    </div>
    <div style="float: left; top: 110px;   position: fixed;box-shadow: 0px 0px 10px darkgray">
        <ul style="font-size: 20px" id="menu">
            <?php
            $sqlmenu = "SELECT * FROM `theloai`";
            $resultmenu = mysqli_query($con, $sqlmenu);
            while ($menu = mysqli_fetch_array($resultmenu)) {
            ?>
                <li class="bo"><a href="?cat=2&tl=<?php echo $menu['maTheLoai'] ?>"><?php echo $menu['tenTheLoai'] ?></a>
                </li>
            <?php
            }
            include('../../connect/close.php');
            ?>


        </ul>
    </div>

    </div>
    <?php
    include('../common/header.php');
    ?>
    <script>
        var page = document.getElementsByClassName('page')[<?php echo $page  ?>]
        //page.style.border = '2px solid black';
        page.style.backgroundColor = 'rgb(70, 128, 236)';
        page.style.color = 'white';
    </script>
</body>

</html>