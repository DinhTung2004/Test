<?php
/**
 * Created by PhpStorm.
 * User: Nguyen Nhipuka
 * Date: 14-May-17
 * Time: 22:35
 */
session_start();
$id =(int) $_GET['idSP'];
$_SESSION['cart'][$id]['qty']--;
$id =1;
header("location:GioHang.php?idSP=".$id);