<?php
session_start();
if (isset($_SESSION['user'])) {
    header("Location: ../common/index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LinhKien.com</title>
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

        #repass {
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
            <h1>????ng k??</h1>
            <form method="POST" action="dienthongtin.php">
                <input type="text" id="user" name="user" placeholder='T??n t??i kho???n' onchange="checkUsername(this.value)" required="required"><br>
                <span id="errn" style="color:red;"></span>
                <input type="password" id="pass" name="pass" placeholder='M???t kh???u' required><br>
                <input type="password" id="repass" name="repass" placeholder='Nh???p l???i m???t kh???u'>
                <div style="color:rgb(240, 32, 32)"><span id="err"></span> </div> <br>
                <button onclick="return t()" type="submit"> continue</button>
            </form>
            <a style="color:white">N???u b???n ???? c?? t??i kho???n xin vui l??ng nh???n</a><a href="formdangnhap.php" style="font-size:20px; color:red; ">????ng nh???p</a>
        </div>
    </div>

    <script>
        var dem = 0;

        function checkUsername(str) {
            var errn = document.getElementById("errn");
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    console.log(this.responseText);
                    if (this.responseText == 1) {
                        errn.innerHTML = "t??i kho???n ???? t???n t???i";
                        dem = 0;
                    } else {
                        errn.innerHTML = "";
                        dem = 1;
                    }

                }
            };
            xmlhttp.open("GET", "check-username-process.php?username=" + str, true);
            xmlhttp.send();
        }

        function t() {
            var check = 0;
            var usern = document.getElementById("user").value;
            var errn = document.getElementById("errn");
            var regegxn = /^[\w\.]+$/;
            var checkregegxn = regegxn.test(usern);
            if (usern == '') {
                errn.innerHTML = "kh??ng ???????c ????? tr???ng";
            } else if (checkregegxn == false) {
                errn.innerHTML = "T??n t??i kho???n kh??ng ??????c ch???a kho???ng tr???ng v?? k?? t??? ?????c bi???t ";

            } else {
                errn.innerHTML = "";
                check++;

            }
            //regexpass
            var pass = document.getElementById("pass").value;
            var rpass = document.getElementById("repass").value;
            var err = document.getElementById("err");
            var regegx = /^.\w{4,}$/;
            var checkregegx = regegx.test(pass);

            if (checkregegx == false) {
                err.innerHTML = "m???t kh???u kh??ng d?????i 5 k?? t???";
            } else if (pass != rpass) {
                err.innerHTML = "m???t kh???u nh???p l???i kh??ng ????ng";
            } else {
                err.innerHTML = "";
                check++;
            }
            if (check == 2 && dem == 1) {
                return true;
            } else {
                return false;
            }
            console.log(dem);


            return false;
        }
        <?php

        ?>
    </script>

</body>

</html>