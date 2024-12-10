<?php

include_once('../connection/connect_database.php');
if (isset($_GET['idUser'])) {
    $sl = "delete from users where idUser=" . $_GET['idUser'];
    $kq = mysqli_query($conn, $sl);
    if ($kq) {
        echo "<script language='javascript'>alert('Xóa thành công');";
        echo "location.href='index_user.php';</script>";
    } else
        echo "fail";
}
