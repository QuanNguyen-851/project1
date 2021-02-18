<?php
session_start();
if (isset($_SESSION["user"]) == false) {
    header("Location: ../common/index.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        LinhKien.com</title>
    <link rel="stylesheet" type="text/css" href="../asset/css/khungthongtin.css">
    <script src="https://kit.fontawesome.com/a12292074e.js" crossorigin="anonymous"></script>

</head>

<body>
    <div id="main">
        <div style=" float: right;    width: 100px;;height: 200px;">
        </div>
        <div id="content">
            <div id="top">
                <i class="fa fa-user-circle-o" aria-hidden="true" style="color: white;font-size: 150px; margin-top: 120px; margin-left: 29px;"></i>
                <a style="color: aliceblue;font-size: 50px;font-family: sans-serif;">
                    <?php
                    if (isset($_SESSION["user"])) {
                        echo $_SESSION["user"];
                        $user = $_SESSION["user"];
                    }
                    ?>
                </a>
            </div>
            <?php
            include("../../connect/open.php");

            $sql = "SELECT * FROM `user` WHERE userName='$user' ";
            $result = mysqli_query($con, $sql);
            $user = mysqli_fetch_array($result);
            include("../../connect/close.php");

            ?>
            <div id="bottom">
                <!--  -->
                <form action="suathongtin_process.php" method="post">
                    <table width=" 100%" height="500px" border="0" cellspacing="0" cellpadding="10">
                        <tr>
                            <td colspan="3">
                                <h2> <i class="far fa-address-book"></i> Hồ sơ của tôi</h2>

                            </td>



                        </tr>
                        <tr>
                            <td class="t" width="180px">Tên đăng nhập</td>
                            <td><?php echo $user['userName'] ?></td>
                            <td width="340px" rowspan="7">
                                <div id="function">
                                    <ul class="cha">

                                        <a href="../hoadon/index.php">
                                            <li class="con">
                                                <i class="fas fa-receipt"> Đơn hàng</i>
                                            </li>
                                        </a>
                                        <a href=" doimk.php?user=<?php echo $user['userName'] ?>  " style=" text-decoration:none">
                                            <li class="con">
                                                <i class="fas fa-lock"> Đổi mật khẩu</i>
                                            </li>
                                        </a>
                                        <a href="dangxuat.php">
                                            <li class="con">
                                                <i class="fas fa-sign-out-alt"> Đăng xuất</i>
                                            </li>
                                        </a>

                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="t">Tên</td>
                            <input type="hidden" name="mauser" value="<?php echo $user['maUser'] ?>">
                            <td><input size="50" type="text" name="tenuser" id="tenuser" required value="<?php echo $user['tenUser'] ?>"><br>
                                <span id="errten" style="color:red"></span>
                            </td>
                        </tr>
                        <tr>
                            <td class="t">Email</td>
                            <td><input size="50" type="text" id="email" name="email" onchange="checkemail(this.value)" value="<?php echo $user['Email'] ?>"><br>
                                <span id="erremail" style="color:red"></span>
                            </td>
                        </tr>
                        <tr>
                            <td class="t">Số điện thoại</td>
                            <td><input size="50" id="sdt" name="sdt" required type="text" onchange="checksdt(this.value)" value="<?php echo $user['SDT'] ?>"><br>
                                <span id="errsdt" style="color:red"></span>
                            </td>
                        </tr>
                        <tr>
                            <td class="t">Ngày sinh</td>
                            <td><input size="50" name="DoB" id="DoB" required type="date" value="<?php echo $user['DoB'] ?>">
                                <span id="errDoB" style="color:red"></span>
                            </td>

                        </tr>
                        <tr>
                            <td class="t">Giới tính</td>
                            <td><input type="radio" name="gt" value="1" <?php if ($user['gioiTinh'] == 1) {
                                                                            echo 'checked';
                                                                        } ?>>Nam
                                <input type="radio" name="gt" value="0" <?php if ($user['gioiTinh'] == 0) {
                                                                            echo 'checked';
                                                                        } ?>>Nữ
                                <span id="errgt" style="color:red"></span></td>
                        </tr>
                        <tr>
                            <td class="t">Địa chỉ</td>
                            <td> <textarea name="address" id="address" required style="width:300px;  height: 60px;"><?php echo $user['address'] ?></textarea><br>
                                <span id="erraddress" style="color:red"></span>

                        </tr>
                        <tr>
                            <td>
                                <div class="back"><a href="../common/index.php"><i class="fas fa-undo-alt"></i> Trở lại</a></div>
                            </td>
                            <td colspan="2">
                                <button onclick="return check()" type="submit" class="luu">lưu thay đổi</button>
                            </td>
                        </tr>

                    </table>
                </form>
            </div>



        </div>


    </div>
    <?php
    include "../common/header.php";
    ?>

    <script>
        //check email
        var dem = 1

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
        //check sdt
        var dem1 = 1

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
                        errsdt.innerHTML = " ";
                        dem1 = 1;
                    }

                }
            };
            xmlhttp.open("GET", "check-sdt-process.php?sdt=" + str, true);
            xmlhttp.send();
        }

        var checkn = 0;

        function check() {

            var checkn = 0;
            //check email 
            var erremail = document.getElementById("erremail");
            var email = document.getElementById("email").value;
            var regexe = /^[\w\.\_]+@[a-z]{2,10}(\.[a-z]{2,10}){1,2}$/;
            var checkregexe = regexe.test(email);
            if (email == '') {
                erremail.innerHTML = "không được để trống";

            } else if (checkregexe) {
                erremail.innerHTML = '';
                checkn++;
            } else {
                erremail.innerHTML = 'sai định dạng';
            }


            //check sdt
            var sdt = document.getElementById("sdt").value;
            var errsdt = document.getElementById("errsdt");
            var regex = /^(\+84|0)([0-9]{9})$/;
            var checkregex = regex.test(sdt);
            if (sdt == "") {
                errsdt.innerHTML = "k để trống";
            } else if (checkregex) {
                errsdt.innerHTML = "";
                checkn++;
            } else {
                errsdt.innerHTML = "sai định dạng";
            }
            //check name
            var ten = document.getElementById("tenuser").value;
            var errten = document.getElementById("errten");
            if (ten == "") {
                errten.innerHTML = " không được để trống";
            } else {
                errten.innerHTML = "";
                checkn++;
            }


            //check date
            var DoB = document.getElementById("DoB").value;
            var errDoB = document.getElementById("errDoB");
            if (DoB == "") {
                errDoB.innerHTML = " không được để trống ";
            } else {
                errDoB.innerHTML = "";
                checkn++;
            }
            //check gioiTinh

            //check address
            var address = document.getElementById("address").value;
            var erraddress = document.getElementById("erraddress");
            if (address == "") {
                erraddress.innerHTML = "không được để trống";

            } else {
                erraddress.innerHTML = "";
                checkn++;
            }
            if (checkn == 5 && dem == 1 && dem1 == 1) {
                if (confirm('bạn có chắc muốn lưu thay đổi này không')) {
                    return true;
                } else {
                    return false;
                }
            }
            return false;
        }
    </script>



</body>

</html>