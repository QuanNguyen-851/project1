<?php
if (isset($_SESSION['user'])) {
    header('Location: ../common/index.php');
}
if (isset($_POST["user"]) && isset($_POST["pass"])) {
    $user = $_POST["user"];
    $pass = $_POST["pass"];

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
                height: 620px;
                background: rgba(0, 0, 0, .6);
                margin: auto;
                margin-top: 70px;
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

            #email {
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

            #sdt {
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

            #address {
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

            #date {
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

            #name {
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
        </style>
    </head>

    <body>
        <div class="container">

            <div class="input">
                <h1>Thông tin tài khoản</h1>
                <!--  -->
                <form method="post" action="dangky_process.php">
                    <input type="hidden" name="user" value="<?php echo $user ?>">
                    <input type="hidden" name="pass" value="<?php echo $pass ?>">
                    <input type="text" id="name" name="name" placeholder='Tên người dùng'>
                    <span id="errname" style="color:red;"></span>
                    <input type="text" id="email" name="email" placeholder='Email' onchange="checkemail(this.value)">
                    <div id="erremail" style="color:red;"></div>
                    <input type="text" id="sdt" name="sdt" placeholder='Số điện thoại' onchange="checksdt(this.value)">
                    <div id="errsdt" style="color:red"></div>
                    <input type="text" id="address" name="address" placeholder='Địa chỉ'>
                    <span id="erraddress" style="color:red;"></span>
                    <input type="date" id="date" name="date">
                    <span id="errdate" style="color:red;"></span>
                    <div><label style="color: white;font-family:sans-serif;font-size: xx-large;">
                            <input type="radio" name="gt" value="1" checked> Nam</label> &emsp;
                        <label style="color: white;font-family:sans-serif;font-size: xx-large;">
                            <input type="radio" name="gt" value="0">Nữ</label> &emsp;</div>
                    <br>
                    <button onclick=" return check()">Đăng ký</button>
                </form>

            </div>

        </div>
        <script>
            var dem = 0

            function checkemail(str) {
                var erremail = document.getElementById("erremail");
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        console.log(this.responseText);
                        if (this.responseText == 1) {
                            erremail.innerHTML = "Email này đã được sử dụng ";
                            dem = 0;
                        } else {
                            erremail.innerHTML = " ";
                            dem = 1;
                        }

                    }
                };
                xmlhttp.open("GET", "check_email_process.php?email=" + str, true);
                xmlhttp.send();
            }
            var dem1 = 0

            function checksdt(str) {
                var errsdt = document.getElementById("errsdt");
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        console.log(this.responseText);
                        if (this.responseText == 1) {
                            errsdt.innerHTML = "số điện thoại này đã được sử dụng ";
                            dem1 = 0;
                        } else {
                            dem1 = 1;
                            errsdt.innerHTML = "";
                        }

                    }
                };
                xmlhttp.open("GET", "check-sdt-process.php?sdt=" + str, true);
                xmlhttp.send();
            }


            function check() {
                var checkn = 0;
                var address = document.getElementById("address").value;
                var erraddress = document.getElementById("erraddress");
                if (address == "") {
                    erraddress.innerHTML = "*";

                } else {
                    erraddress.innerHTML = "";
                    checkn++;
                }
                //check date
                var DoB = document.getElementById("date").value;
                var errDoB = document.getElementById("errdate");
                if (DoB == "") {
                    errDoB.innerHTML = " * ";
                } else {
                    errDoB.innerHTML = "";
                    checkn++;
                }
                //check name
                var ten = document.getElementById("name").value;
                var errten = document.getElementById("errname");
                if (ten == "") {
                    errten.innerHTML = "*";
                } else {
                    errten.innerHTML = "";
                    checkn++;
                }
                //check email
                var erremail = document.getElementById("erremail");
                var email = document.getElementById("email").value;
                var regexe = /^[\w\.\_]+@[a-z]{2,10}(\.[a-z]{2,10}){1,2}$/;
                var checkregexe = regexe.test(email);
                if (email == '') {
                    erremail.innerHTML = "không để trống";

                } else if (checkregexe) {
                    erremail.innerHTML = '';
                    checkn++;
                    if (dem == 0) {
                        erremail.innerHTML = "Email này đã được sử dụng ";
                    }
                } else {
                    erremail.innerHTML = 'sai định dạng';

                }

                //check sdt
                var sdt = document.getElementById("sdt").value;
                var errsdt = document.getElementById("errsdt");
                var regex = /^(\+84|0)([0-9]{9})$/;
                var checkregex = regex.test(sdt);

                if (sdt == "") {
                    errsdt.innerHTML = "không để trống";
                } else if (checkregex == false) {
                    errsdt.innerHTML = "sai định dạng";
                } else {
                    errsdt.innerHTML = "";
                    checkn++;
                    if (dem1 == 0) {
                        errsdt.innerHTML = "số điện thoại này đã được sử dụng ";
                    }
                }


                if (checkn == 5 && dem == 1 && dem1 == 1) {
                    return true;
                } else {
                    return false;
                }

                return false;
            }
        </script>
    </body>

    </html>
<?php
} ?>