<?php
if (isset($_GET['tl'])) {
    $tl = $_GET['tl'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LinhKien.com</title>
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

            <div style="width: 99%; height:60em; background-color:none ; margin: auto;  display: flex; 
                align-content: baseline; flex-wrap:wrap;
                    ">
                <?php

                include('../../connect/open.php');

                $count = "SELECT COUNT(*) as dem FROM `product` where theLoai ='$tl'";
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


                $sql = "SELECT maSP,tenSP,gia,thongtinsp,anhSp,hang.tenHang,theloai.tenTheLoai,trangThai
                     FROM product 
                     INNER JOIN hang on product.hang=hang.maHang 
                     INNER JOIN theloai on theloai.maTheLoai=product.theLoai where theloai.maTheLoai= '$tl'
                     ORDER BY maSP DESC limit $start,$limit";
                $result = mysqli_query($con, $sql);

                ?>
                <?php
                while ($thongtin = mysqli_fetch_array($result)) {
                ?>
                    <a class="tsp" href="?page=<?php echo $page ?>&cat=1&masp=<?php echo $thongtin['maSP'] ?>" title="Nh???n v??o ????? bi???t th??m th??ng tin s???n ph???m!">

                        <div style="margin: 5px;;width: 250px; height: 300px; background-color:white; margin-top: 10px; ">
                            <div class="anhsp" style="width: 100%;background-color: aqua;height: 30;height: 70%;">
                                <img style="height: 100%;width: 100%;" src="<?php echo $thongtin['anhSp']; ?>">
                            </div>
                            <div class="thongtin" style="width: 100%;height: 50px;background-color:white;word-wrap:break-word;overflow:hidden; text-align:center;">
                                <p style="text-overflow: ellipsis;width: 250px;overflow: hidden; white-space: nowrap;"> <?php echo $thongtin['tenSP']; ?></p>
                            </div>
                            <div class="gia" style="text-align: center;width: 100%;height: 14%;background-color: white ;border-radius: 0px 0px 15px 15px;">
                                <div class="er" style="line-height: 44px;color:red; ">
                                    <?php
                                    if ($thongtin['trangThai'] == "") {
                                        echo number_format($thongtin['gia'])  . "" . ".VND";
                                    } else if ($thongtin['trangThai'] == "1") {
                                        echo "Ng???ng kinh doanh";
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </a>
                <?php
                } ?>
                <div style="display: flex;flex-wrap: wrap;justify-content: center;margin:auto; width: 900px; margin-top: 30px; ">
                    <a href="?page=<?php if ($page > 1) {
                                        echo $page - 1;
                                    } else {
                                        echo $page = 1;
                                    } ?>&cat=2&tl=<?php echo $tl ?>">
                        <div class="page"><i class="fas fa-angle-double-left"></i></div>
                    </a>
                    <?php
                    for ($i = 1; $i <= $sotrang; $i++) {
                    ?>
                        <a id="num" onclick="focus()" href="?page=<?php echo $i ?>&cat=2&tl=<?php echo $tl ?>">
                            <div class="page">
                                <?php echo $i . "  "; ?>
                            </div>
                        </a>
                    <?php
                    }
                    ?>
                    <?php if ($page < $sotrang) { ?>
                        <a href="?page=<?php echo $page + 1 ?>&cat=2&tl=<?php echo $tl ?>">
                            <div class="page"><i class="fas fa-angle-double-right"></i></div>
                        </a>
                    <?php
                    } ?>
                </div>

            </div>


        </div>
        <div style="float: left; top: 110px;   position: fixed;box-shadow: 0px 0px 10px darkgray">
            <ul style="font-size: 20px" id="menu">
                <?php
                $sqlmenu = "SELECT * FROM `theloai`WHERE An IS null or An='0'";
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
        <!--
            <li class="bo"><a>linh ki???n pc</a>
                    <ul class="con">
                        <li><a href="?cat=2">Samsung</a></li>
                        <li><a href="?cat=2">Apple</a></li>
                        <li><a href="?cat=2">Oneplus</a></li>

                    </ul>

                </li>
        -->
        <?php
        include("footer.php");
        ?>
    </div>
    <script>
        var page = document.getElementsByClassName('page')[<?php echo $page  ?>]
        //page.style.border = '2px solid black';
        page.style.backgroundColor = 'rgb(70, 128, 236)';
        page.style.color = 'white';
    </script>
</body>

</html>