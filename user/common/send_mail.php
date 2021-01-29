<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://kit.fontawesome.com/a12292074e.js" crossorigin="anonymous"></script>
    <style>
        body {
            margin: 0;
            padding: 0;
            background: url("../anh/1975181.jpg");
            background-size: cover;
        }

        #main {
            background: rgba(0, 0, 0, .6);
            width: 500px;
            height: 550px;
            margin: auto;
            margin-top: 50px;
            border-radius: 15px;
        }

        #top {
            height: 50px;
            border-radius: 15px;
        }

        .input {
            text-align: center;
            margin-top: 100px;
        }

        .inp {
            line-height: 40px;
            width: 80%;
            margin-bottom: 20px;
            border: none;
            outline: none;
            border-bottom: 3px solid rgb(255, 255, 255);
            background: none;
            color: white;
            font-size: larger;

        }

        h1 {
            font-family: sans-serif;
            text-align: left;
            width: 60%;
            margin-left: 47px;
            border-bottom: 5px solid rgb(49, 62, 233);
            color: white;

        }

        #input {
            text-align: center;

        }

        #cont {
            width: 400px;
            max-width: 400px;
            min-width: 400px;
            margin: 0px;
            height: 100px;
            min-height: 100px;
            max-height: 100px;
            margin-bottom: 20px;
            border-radius: 15px;
            outline: none;
            border: 3px solid rgb(255, 255, 255);
            background: white;

            font-size: larger;
        }

        button {
            line-height: 30px;
            width: 20%;
            background-color: aqua;
            border-radius: 10px;
            outline: none;
            border: none;
        }
    </style>
</head>

<body>
    <div id="main">
        <div id="top">
        </div>
        <?php

        if (isset($_SESSION['user'])) {
            $user = $_SESSION['user'];
            include("../../connect/open.php");
            $sql = "SELECT * FROM `user1` WHERE userName='$user'";
            $result = mysqli_query($con, $sql);
            $thongtin = mysqli_fetch_array($result);
            include("../../connect/close.php");
        }
        ?>
        <div id="input">
            <h1>Contact</h1>
            <form action="send_mail_process.php" method="post">
                <input type="email" class="inp" name="email" placeholder="Email" value="
                <?php
                if (isset($_SESSION['user'])) {
                    echo $thongtin['Email'];
                } else {
                    echo "";
                }
                ?>" required><br>
                <input type="password" class="inp" name="pass" placeholder="Password"><br>
                <textarea name="noidung" id="cont" required></textarea><br>
                <span id="err" style="color:red"></span>
                <br>
                <p style="color:red">
                    <?php
                    if (isset($_GET['err']) == 1) {
                        echo " Email hoặc mật khẩu của bạn không đúng ";
                    } else if (isset($_GET['err']) == 2) {
                        echo "Đã gửi thành công";
                    } else {
                        echo "";
                    }
                    ?>
                </p>
                <button>Gửi</button>
            </form>
            <div style=" margin-left: 35px;width: 95px;"><a href="../common/index.php" style="color:white;">
                    <i class="fas fa-undo-alt"></i> Trở lại </a> </div>
        </div>
    </div>


</body>

</html>