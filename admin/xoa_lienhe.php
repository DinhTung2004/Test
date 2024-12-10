<?php

include_once('../connection/connect_database.php');
if (isset($_GET['idGL'])) {
    $sl = "delete from gopy_lienhe where idGL=" . $_GET['idGL'];
    $kq = mysqli_query($conn, $sl);
    if ($kq) {
        echo "<script language='javascript'>alert('Xóa thành công');";
        echo "location.href='index_Lienhe.php';</script>";
    } else
        echo "fail";
}
