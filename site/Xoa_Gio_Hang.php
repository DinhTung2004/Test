<?php
/**
 * Created by PhpStorm.
 * User: Nguyen Nhipuka
 * Date: 14-May-17
 * Time: 21:33
 */
session_start();
$id =(int) $_GET['idSP'];
unset($_SESSION['cart'][$id]);
$id =1;

header("location:GioHang.php?idSP=".$id);