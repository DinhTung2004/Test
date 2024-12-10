<?php


session_start();
ob_start();
if (!isset($_SESSION['Username']) || $_SESSION['Username'] != 'NDT') {
    header('location: ../site/DangNhap.php');
}
