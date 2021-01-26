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
</head>

<body>
    <?php
    //main 
    if (isset($_GET["cat"])) {
        $cat = $_GET["cat"];
        switch ($cat) {
            case 1: //chi tiết sản phẩm
                include("../ChiTietSp/chitietsp.php");
                break;
            case 2: //hiển thị của menu 
                include("../menu/khung_menu.php");
                break;
        }
    } else {
        include("main.php");
    }
    //header
    include("header.php");
    ?>


</body>

</html>