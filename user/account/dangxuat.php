<?php
session_start();

if (isset($_SESSION['user'])) {
    unset($_SESSION['user']);
    if (isset($_SESSION['giohang'])) {
        unset($_SESSION['giohang']);
    }
    header('Location: formdangnhap.php');
} else {
    header("Location: ../common/index.php ");
}
