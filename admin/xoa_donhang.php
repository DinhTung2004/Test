<?php

include_once('../connection/connect_database.php');
if (isset($_GET['idDH'])) {
    $sl_dhct = "delete from donhangchitiet where idDH=" . $_GET['idDH'];
    $kq_dhct = mysqli_query($conn, $sl_dhct);
    $sl_dh = "delete from donhang where idDH=" . $_GET['idDH'];
    $kq_dh = mysqli_query($conn, $sl_dh);
    if ($kq_dhct && $kq_dh) {
        echo "<script language='javascript'>alert('Xóa thành công');";
        echo "location.href='index_donhang.php';</script>";
    } else
        echo "fail";
}
