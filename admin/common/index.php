<?php
session_start();
if(isset($_SESSION['taikhoan'])){
        header("location:main.php");
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            background: url('../asset/anh/1975181.jpg');
            background-size: cover;
            background-repeat: no-repeat;

            display: flex;
        }



        .container {
            width: 500px;
            height: 400px;
            background: rgba(0, 0, 0, .6);
            margin: auto;
            margin-top: 150px;
            border-radius: 15px;


        }

        .input {
            text-align: center;
            margin-top: 100px;
        }

        .input h1 {
            font-family: sans-serif;
            text-align: left;
            width: 60%;
            margin-left: 47px;
            border-bottom: 5px solid rgb(49, 62, 233);
            color: white;

        }


        #user {
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

        #pass {
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

        .input button {
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
    <div class="container">

        <div class="input">
            <h1>Đăng nhập</h1>
            <form method="post" action="../process/process-dang-nhap.php">
                <input type="text" id="user" name="admin" placeholder='Tên tài khoản' required><br>
                <input type="password" id="pass" name="pass" placeholder='Mật khẩu' required>
                <div style="color:rgb(240, 32, 32)">

                    <?php if (isset($_GET['error'])) {
                        $error = $_GET['error'];
                        if ($error == 3) {
                            echo "Tài khoản của bạn đã bị khóa";
                    } else {
                        echo "tài khoản hoặc mật khẩu không chính xác";
                    }
                }
                    ?>
                </div>
                <button>Đăng nhập</button>
            </form>
            
    </div>
</body>

</html>