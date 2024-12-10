<?php

include_once('../connection/connect_database.php');
if (isset($_GET['idKM'])) {
    $sl = "delete from khuyenmai where idKM=" . $_GET['idKM'];
    $kq = mysqli_query($conn, $sl);
    if ($kq) {
        echo "<script language='javascript'>alert('Xóa thành công');";
        echo "location.href='KhuyenMai.php';</script>";
    } else
        echo "fail";
}
