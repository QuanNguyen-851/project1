<?php
session_start();
if (isset($_SESSION['user'])) {
    $usern = $_SESSION['user'];
} else {
    header('location: ../common/index.php ');
}
if (isset($_POST['tongtien'])) {
    $tongtien = $_POST['tongtien'];
}
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
            padding: 0;
            margin: 0;
            background: url('../anh/1975181.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            display: flex;
        }

        .container {
            width: 500px;
            height: 500px;
            background: white;
            margin: auto;
            margin-top: 50px;
            border-radius: 15px;
        }

        .top {
            margin: 0px;
            width: 100%;
            height: 100px;
            background: #83afff;
            text-align: center;
            border-radius: 15px 15px 0px 0px;
        }

        .bottom {
            width: 100%;
            height: 100%;
            border-radius: 0px 0px 15px 15px;
        }

        input {
            width: 250px;
            height: 30px;
            border-radius: 5px;
            outline: none;
        }

        textarea {
            width: 250px;
            height: 100px;
            max-width: 250px;
            max-height: 100px;
            border-radius: 5px;
            outline: none;

        }

        span {
            color: red;
        }

        button {
            border: none;
            background: aqua;
            width: 100px;
            height: 50px;
            font-size: 25px;
        }
    </style>
</head>

<body>
    <div class="container">

        <?php
        include('../../connect/open.php');
        $sql = "SELECT * FROM `user` WHERE userName='$usern'";
        $result = mysqli_query($con, $sql);
        $thongtin = mysqli_fetch_array($result);
        include('../../connect/close.php')
        ?>
        <div class="top">

            <a style="font-size: 35px;line-height: 90px;font-family: sans-serif;">Thông tin người nhận</a>
        </div>

        <div class="bottom">
            <table border="0" width='100%' cellpadding="10">
                <form action="inhoadon.php" method="post">
                    <tr height="50px">
                        <td width="125px" style="text-align: right; font-size: 20px;">Người nhận</td>
                        <td>
                            <input type="text" name="ten" id="ten" value="<?php echo $thongtin['tenUser'] ?>">
                            <input hidden type="text" hiden name="tongtien" value="<?php echo $tongtien ?>">
                            <br><span id="errt"></span>
                        </td>


                    </tr>
                    <tr height="50px">
                        <td style="text-align: right; font-size: 20px;">Số điện thoại</td>
                        <td>
                            <input type="text" name="sdt" id="sdt" value="<?php echo $thongtin['SDT'] ?>">
                            <br><span id="errsdt"></span>
                        </td>


                    </tr>
                    <tr height="50px">
                        <td style="text-align: right; font-size: 20px;vertical-align: top;">Địa chỉ</td>
                        <td>
                            <textarea name="address" id="address"><?php echo $thongtin['address'] ?></textarea>
                            <br><span id="erradd"></span>
                        </td>


                    </tr>
                    <tr>
                        <td colspan="2" style="text-align: center">
                            <button onclick="return check()">Mua</button>
                        </td>



                    </tr>
                    <tr>
                        <td colspan="2">
                            <a href="../giohang/index.php"><i class="fas fa-undo-alt"></i> Trở lại</a>
                        </td>



                    </tr>
                </form>
            </table>

        </div>


    </div>
    <script>
        function check() {
            //check ten
            var check = 0;
            var ten = document.getElementById('ten').value;
            var errt = document.getElementById('errt');
            var regex = /^\w\D[^!@#$%^&*()_+-=`~';:/.,|]+$/;
            var checkregex = regex.test(ten);
            if (ten == "") {
                errt.innerHTML = "không được để trống";
            } else if (checkregex == false) {
                errt.innerHTML = "Tên không được chứa kí tự đặc biệt hoặc số";
            } else {
                errt.innerHTML = "";
                check++;
            }
            //check SDt
            var sdt = document.getElementById("sdt").value;
            var errsdt = document.getElementById("errsdt");
            var regex = /^(\+84|0)([0-9]{9})$/;
            var checkregexsdt = regex.test(sdt);
            if (sdt == "") {
                errsdt.innerHTML = "k để trống";
            } else if (checkregexsdt) {
                errsdt.innerHTML = "";
                check++;
            } else {
                errsdt.innerHTML = "sai định dạng";
            }
            //check address
            var address = document.getElementById('address').value;
            var erradd = document.getElementById('erradd');
            if (address == "") {
                erradd.innerHTML = "không được để trống";
            } else {
                erradd.innerHTML = "";
                check++;
            }
            if (check == 3) {

                return true;
            } else {
                return false;
            }


            return false;
        }
    </script>

</body>

</html>