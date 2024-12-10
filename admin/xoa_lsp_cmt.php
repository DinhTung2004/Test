<?php

include_once('../connection/connect_database.php');
if (isset($_GET['idCM'])) {
    $sl = "delete from sanpham_comment where id_comment=" . $_GET['idCM'];
    $kq = mysqli_query($conn, $sl);
    if ($kq) {
        echo "<script language='javascript'>alert('Xóa thành công');";
        echo "location.href='index_sp_comment.php';</script>";
    } else
        echo "fail";
}
