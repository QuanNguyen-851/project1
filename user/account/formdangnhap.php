<?php
session_start();
if (isset($_SESSION['user'])) {
    header("Location: ../common/index.php");
} else {
    $check = false;
    if (isset($_COOKIE['user'])) {
        $user = $_COOKIE['user'];
        $pass = $_COOKIE['pass'];
        $check = true;
    }
}
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
            background: url('../anh/1975181.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            display: flex;
        }



        .container {
            width: 500px;
            height: 500px;
            background: rgba(0, 0, 0, .6);
            margin: auto;
            margin-top: 120px;
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
            <h1>????ng nh???p</h1>
            <form method="post" action="dangnhap_process.php">
                <input type="text" id="user" name="user" placeholder='T??n t??i kho???n' value="<?php
                                                                                            if ($check) {
                                                                                                echo $user;
                                                                                            }
                                                                                            ?>" required><br>
                <input type="password" id="pass" name="pass" placeholder='M???t kh???u' value="<?php
                                                                                            if ($check) {
                                                                                                echo $pass;
                                                                                            }
                                                                                            ?>" required>
                <div style="color:rgb(240, 32, 32)">

                    <?php if (isset($_GET['err'])) {
                        echo "t??i kho???n ho???c m???t kh???u kh??ng ch??nh x??c";
                    }
                    ?>
                </div> <br>
                <div style=" margin-left: 35px;width: 95px;"><input type="checkbox" id="check" name="check" <?php
                                                                                                            if ($check) {
                                                                                                                echo "checked";
                                                                                                            }
                                                                                                            ?>><a style="color:white;">Ghi nh??? </a>
                </div>
                <button>????ng nh???p</button>
            </form>
            <a style="color:white">N???u b???n ch??a c?? t??i kho???n xin vui l??ng nh???n</a> <a href="formdangky.php" style="font-size:20px; color:rgb(255, 9, 9)">????ng k??</a>
            <br><br><br>
            <div style=" margin-left: 35px;width: 95px;"><a href="../common/index.php" style="color:white;">
                    <i class="fas fa-undo-alt"></i> Tr??? l???i </a> </div>
        </div>
    </div>
</body>

</html>