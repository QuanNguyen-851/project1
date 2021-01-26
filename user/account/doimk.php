<?php
session_start();
if (isset($_SESSION['user']) == false) {
    header("Location: ../common/index.php");
}
if (isset($_SESSION['pass'])) {
    $passv = $_SESSION['pass'];
}

if (isset($_GET['user'])) {
    $user = $_GET['user'];
    include('../../connect/open.php');
    $sql = "SELECT * FROM `user1` WHERE userName='$user'";
    $regult = mysqli_query($con, $sql);
    $user1 = mysqli_fetch_array($regult);
    $pass = $user1['pass'];



    include('../../connect/close.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        LinhKien.com</title>

    <script src="https:kit.fontawesome.com/a12292074e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="../asset/css/doimk.css">

</head>

<body>


    <div id="main">

        <div id="content">
            <div style="margin:auto;">
                <form method="POST" action="doimk_process.php?user=<?php echo $user ?>">
                    <h2 style="font-family: sans-serif;"> Đổi mật khẩu </h2>
                    <input type="password" name="old_pass" id="old_pass" placeholder="mật khẩu cũ"><br>
                    <span id="errold"></span><br>
                    <input type="password" name="new_pass" id="new_pass" placeholder="mật khẩu mới"><br>
                    <span id="errnew"></span><br>
                    <input type="password" name="re_new_pass" id="re_new_pass" placeholder="mật khẩu nhập lại mật khẩu"><br>
                    <span id="errrnew"></span><br>
                    <br> <button onclick="return check()" type="submit" class="btn">đổi mật khẩu</button><br>
                    <a href="thongtintaikhoan.php"><i class="fas fa-undo-alt" style="margin-left: -375px;"></i> Trở lại</a>
                </form>
            </div>
        </div>


    </div>
    <?php
    include("../common/header.php");
    ?>
    <script>
        function check() {
            var errold = document.getElementById("errold");
            var old_pass = document.getElementById("old_pass").value;
            var pass = "<?php echo $passv; ?>";
            var dem = 0;
            if (old_pass == pass) {
                errold.innerHTML = "";
                dem++;
            } else {
                errold.innerHTML = " mật khẩu cũ còn trống hoặc không đúng";

            }
            var vnew_pass = document.getElementById("new_pass").value;
            var verrnew = document.getElementById("errnew");
            regegx = /^.\w{4,}$/;
            checkregegx = regegx.test(vnew_pass);
            if (checkregegx == false) {
                verrnew.innerHTML = "mật khẩu mới phải có 5 kí tự trở lên";
            } else {
                verrnew.innerHTML = "";
                dem++;
            }
            var vre_new_pass = document.getElementById("re_new_pass").value;
            var verrrnew = document.getElementById("errrnew");
            if (vre_new_pass != vnew_pass) {
                verrrnew.innerHTML = "mật khẩu nhập lại phải khớp với mật khẩu mới";
            } else {
                verrrnew.innerHTML = "";
                dem++;
            }
            if (dem == 3) {
                if (confirm("bạn có chắc muốn thay đổi không?") == true) {
                    alert("bạn đã đổi mật khẩu thành công!");
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